<?php


function posgold_syncro_order_pending_page_display(){
    if(is_admin()){
        if(isset($_POST['nonce']) && !empty(isset($_POST['nonce']))){
            if(wp_verify_nonce( $_POST['nonce'], 'nonce_security_posgold' )){

                posgold_syncroning_orders($_POST['desde'],$_POST['hasta']);

            }else{
                echo '<h2 class="text-center text-danger">EL TIEMPO DE ESPERA CADUCO, POR FAVOR INTENTA DE NUEVO</h2>';
                //posgold_syncro_order_pendientes_show();
                posgold_select_date();
            }
        }
        else{
            //posgold_syncro_order_pendientes_show();
            posgold_select_date();
        }

    }
    else{

        echo ' <h2>No tienes permisos de administrador, por lo tanto no puedes ingresar</h2>';
    }
}



function posgold_syncroning_orders($desde, $hasta){
    set_time_limit(6000);
 
    global $wpdb, $table_prefix;

    $sql_config = $wpdb->get_results("SELECT * FROM ".$table_prefix ."posgold_config")[0];

    $tblname = $table_prefix."wc_order_stats";

    $sql_pedidos  = " SELECT a.*, ";
    $sql_pedidos .= " b.first_name as Nombre,";
    $sql_pedidos .= " b.last_name as Apellido,";
    $sql_pedidos .= " b.email as Email,";
    $sql_pedidos .= " b.city as Ciudad,";
    $sql_pedidos .= " b.state as Departamento,";
    $sql_pedidos .= " (SELECT COUNT(x.order_item_id) FROM ".$table_prefix."wc_order_product_lookup x WHERE x.order_id=a.order_id) as Items ";
    $sql_pedidos .= " FROM ".$table_prefix."wc_order_stats a ";
    $sql_pedidos .= " INNER JOIN ".$table_prefix."wc_customer_lookup b ON a.customer_id=b.customer_id ";
    $sql_pedidos .= " WHERE (a.status='wc-on-hold' OR a.status='wc-processing') AND a.posgold_prefijo IS NULL AND a.date_created>='".$desde."' AND a.date_created<='".$hasta."'";

    $pedidos_pend = $wpdb->get_results($sql_pedidos);


    $params_URL = posgold_getUrl();

    ?>
    <h2 class="text-center">SINCRONIZANDO PEDIDOS</h2>
    <table class="table table-sm table-bordered">
        <thead>
            <tr>
                <th class="text-center">
                    Order ID
                </th>
                <th class="text-center">
                    Fecha
                </th>
                <th class="text-center">
                    Cliente
                </th>
                <th class="text-center">
                    Email
                </th>
                <th class="text-center">
                    Ciudad
                </th>
                <th class="text-center">
                    Items
                </th>
                <th class="text-center">
                    Total
                </th>
                <th class="text-center">
                    Resultado
                </th>
                <th class="text-center">
                    Pedido PosGold
                </th>
            </tr>
        </thead>
        <tbody>
        <?php
        foreach($pedidos_pend as $item){

            echo "<tr>";
            echo "<td>".$item->order_id."</td>";
            echo "<td>".$item->date_created."</td>";
            echo "<td>".$item->Nombre." ".$item->Apellido."</td>";
            echo "<td>".$item->Email."</td>";
            echo "<td>".$item->Ciudad."</td>";
            echo "<td>".$item->Items."</td>";
            echo "<td>".$item->net_total."</td>";

                //Se buscan las metas del post, para obtener la informacion de envio
                $metas = get_post_meta($item->order_id,null,false);

                $objeto = [];
                $objeto["Empresaid"] = "1";
                $objeto["Tipodocumento_Prefijo"] = $sql_config->pedido_prefijo;
                $objeto["Fecha"] = $item -> date_created;
                $objeto["TerceroNit"] = $sql_config->pedido_terceronit;
                $objeto["Tercero"] = $item -> Nombre." ".$item -> Apellido;
                $objeto["Telefono"] = $metas["_billing_phone"][0];
                $objeto["Telefono2"] = null;
                $objeto["Direccion"] = $metas["_billing_address_1"][0]." / ".$metas["_billing_address_2"][0];
                $objeto["Email"] = $item -> Email;
                $objeto["Ciudad"] = $item -> Ciudad;
                $objeto["Departamento"] = $item -> Departamento;
                $objeto["Detalles"] = [];

                ///Se buscan los detalles del pedido
                $sql_detalles_order  =" SELECT ";
                $sql_detalles_order .=" a.product_id, ";
                $sql_detalles_order .=" a.sku, ";
                $sql_detalles_order .=" a.posgold_product_id, ";
                $sql_detalles_order .=" b.order_item_id, ";
                $sql_detalles_order .=" b.product_qty, ";
                $sql_detalles_order .=" b.product_net_revenue / b.product_qty as product_net_revenue, ";
                $sql_detalles_order .=" b.tax_amount, ";
                $sql_detalles_order .=" b.date_created ";
                $sql_detalles_order .=" FROM ".$table_prefix."wc_product_meta_lookup a ";
                $sql_detalles_order .=" INNER JOIN ".$table_prefix."wc_order_product_lookup b ON b.product_id=a.product_id ";
                $sql_detalles_order .=" WHERE b.order_id=".$item->order_id;

                $detalles_items = $wpdb->get_results($sql_detalles_order);

                $index_detalle = 0;
                foreach($detalles_items as $item2){
                    $objeto["Detalles"][$index_detalle]["Productoid"] = $item2 -> posgold_product_id; 
                    $objeto["Detalles"][$index_detalle]["Producto_Cod"] = $item2 -> sku;
                    $objeto["Detalles"][$index_detalle]["Cantidad"] = $item2 -> product_qty;
                    $objeto["Detalles"][$index_detalle]["Precio"] = $item2 -> product_net_revenue;
                    $objeto["Detalles"][$index_detalle]["Impuesto_Porc"] = $item2 -> tax_amount;

                    $index_detalle++;
                }

               
                $response_pedido = wp_remote_post($params_URL["Url"].'/apiGold/PedidoApi/PedidoCreateExterno', array('body'=>$objeto));

                $response_result_pedido = json_decode($response_pedido["body"],true);

                ///Se valida el estilo a mostrar de la celda
                if($response_result_pedido["Status"]==true){
                    echo "<td class='table-success'>".$response_result_pedido['Message']."</td>";

                    $sql_update = "UPDATE ".$table_prefix."wc_order_stats SET posgold_prefijo='".$response_result_pedido["Pedido_Prefijo"]."' ";
                    $sql_update.= ",posgold_tipodocumentoid=".$response_result_pedido["Pedido_Tipodocumentoid"];
                    $sql_update.= ",posgold_numero=".$response_result_pedido["Pedido_Numero"];
                    $sql_update.= ",posgold_pedidoid=".$response_result_pedido["Pedidoid"];
                    $sql_update.= ",status='wc_completed'";
                    $sql_update.= " WHERE order_id=".$item->order_id;

                    ///Se hace el update del pedido
                    $wpdb->query($sql_update);

                }
                else{
                    echo "<td class='table-danger'>".$response_result_pedido['Message']."</td>";
                }
                
                echo "<td>N/A</td>";
                echo "</tr>";

                flush();
                ob_flush();
            
        }
        ?>
        </tbody>
    </table>

    <?php
}


function posgold_select_date(){
    ?>
    
        <form method="post">
            <div class="row">
                <div class="col-md-4">
                    <label>Fecha Desde</label>
                    <input type="date" class="form-control" name="desde" id="desde" required />
                </div>

                <div class="col-md-4">
                    <label>Fecha Hasta</label>
                    <input type="date" class="form-control" name="hasta" required/>
                </div>

                <input type="submit" name="test" id="test" value="BUSCAR PEDIDOS" /><br/>
                    
            </div>   
        </form>
            
    <?php

    if(array_key_exists('test',$_POST)){
        posgold_syncro_order_pendientes_show($_POST['desde'], $_POST['hasta']);
    }
}

///Accion para mostrar los pedidos pendientes por sincronizar
function posgold_syncro_order_pendientes_show($desde, $hasta){
    global $wpdb, $table_prefix;

    $tblname = $table_prefix."wc_order_stats";

    $validarCampo = $wpdb->query(" SHOW COLUMNS FROM $tblname WHERE Field in ('posgold_prefijo', 'posgold_numero', 'posgold_tipodocumentoid','posgold_pedidoid','posgold_estado')" );
    
    if($validarCampo < 5){
        $sqlAlter  = "ALTER TABLE $tblname ADD COLUMN posgold_prefijo varchar(5), ";
        $sqlAlter .= "ADD COLUMN posgold_numero int, ";
        $sqlAlter .= "ADD COLUMN posgold_tipodocumentoid int,";
        $sqlAlter .= "ADD COLUMN posgold_estado VARCHAR(250),";
        $sqlAlter .= "ADD COLUMN posgold_pedidoid int ";
        $resultAlter = $wpdb->query($sqlAlter);
    }

    $sql_pedidos  = " SELECT a.*, ";
    $sql_pedidos .= " b.first_name as Nombre,";
    $sql_pedidos .= " b.last_name as Apellido,";
    $sql_pedidos .= " b.email as Email,";
    $sql_pedidos .= " b.city as Ciudad,";
    $sql_pedidos .= " b.state as Departamento,";
    $sql_pedidos .= " (SELECT COUNT(x.order_item_id) FROM ".$table_prefix."wc_order_product_lookup x WHERE x.order_id=a.order_id) as Items ";
    $sql_pedidos .= " FROM ".$table_prefix."wc_order_stats a ";
    $sql_pedidos .= " INNER JOIN ".$table_prefix."wc_customer_lookup b ON a.customer_id=b.customer_id ";
    $sql_pedidos .= " WHERE (a.status='wc-on-hold' OR a.status='wc-processing') AND a.posgold_prefijo IS NULL AND a.date_created>='".$desde."' AND a.date_created<='".$hasta."'";
    
    $pedidos_pend = $wpdb->get_results($sql_pedidos);

    // var_dump($pedidos_pend);

    ?>

    <h1 class="text-center">PEDIDOS PENDIENTES POR SINCRONIZAR</h1>
    <br />

    <table class="table table-sm table-bordered">
        <thead>
            <tr>
                <th class="text-center">
                    Order ID
                </th>
                <th class="text-center">
                    Fecha
                </th>
                <th class="text-center">
                    Fecha GMT
                </th>
                <th class="text-center">
                    Cliente
                </th>
                <th class="text-center">
                    Apellido
                </th>
                <th class="text-center">
                    Email
                </th>
                <th class="text-center">
                    Ciudad
                </th>
                <th class="text-center">
                    Items
                </th>
                <th class="text-center">
                    Total
                </th>
                <th class="text-center">
                    Status
                </th>
                <th class="text-center">
                    Estado
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($pedidos_pend as $item){

                    echo "<tr>";
                        echo "<td>".$item->order_id."</td>";
                        echo "<td>".$item->date_created."</td>";
                        echo "<td>".$item->date_created_gmt."</td>";
                        echo "<td>".$item->Nombre."</td>";
                        echo "<td>".$item->Apellido."</td>";
                        echo "<td>".$item->Email."</td>";
                        echo "<td>".$item->Ciudad."</td>";
                        echo "<td>".$item->Items."</td>";
                        echo "<td>".$item->net_total."</td>";
                        echo "<td>".$item->status."</td>";
                        echo "<td>".$item->posgold_estado."</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>


    <?php
          $posgold_nonce = wp_create_nonce('nonce_security_posgold');
    ?>

    <form action="" method="post">
        <input type="hidden" class="form-control" value="<?php echo $posgold_nonce ?>" name="nonce" />
        <input type="hidden" class="form-control" value="<?php echo $desde ?>" name="desde" />
        <input type="hidden" class="form-control" value="<?php echo $hasta ?>" name="hasta" />
        <br />
        <button type="submint" class="btn btn-primary">
                CARGAR PEDIDOS PENDIENTES
        </button>
    </form>

    <?php
}


