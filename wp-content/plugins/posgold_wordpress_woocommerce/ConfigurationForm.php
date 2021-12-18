<?php


///Funcion para hacer el render del formulario de configuracion
function posgold_configuracion_form_display(){
    if(is_admin()){
        $posgold_nonce = wp_create_nonce('nonce_security_posgold');

        global $table_prefix, $wpdb;

        $tblname = $table_prefix . "posgold_config";
        $sql = "SELECT * FROM $tblname where id=1" ;

        $validarCampo = $wpdb->query(" SHOW COLUMNS FROM $tblname WHERE Field in ('api_aplica','api_aplica2','nivel_precio','pedido_prefijo','pedido_terceronit')" );

        if($validarCampo < 5){
            $sqlAlter  = "ALTER TABLE $tblname ADD COLUMN IF NOT EXISTS api_aplica VARCHAR(5), ";
            $sqlAlter .= "ADD COLUMN IF NOT EXISTS api_aplica2 VARCHAR(5), ";
            $sqlAlter .= "ADD COLUMN IF NOT EXISTS pedido_prefijo VARCHAR(5),";
            $sqlAlter .= "ADD COLUMN IF NOT EXISTS pedido_terceronit VARCHAR(15),";
            $sqlAlter .= "ADD COLUMN IF NOT EXISTS nivel_precio VARCHAR(2)";

            // echo $sqlAlter;

            $resultAlter = $wpdb->query($sqlAlter);
        }

        

        ///Se buscan los datos principales
        $resultado = $wpdb->query($sql);

        if($resultado !== false){
            if($resultado !=0){
                // var_dump($wpdb->last_result[0]);

                ?>
                  

                    <br />
                    <br />
                    <br />

                    <div class="container">
                        <h2 class="text-center">CONFIGURACION DE POSGOLD</h2>
                        <form action="" method="post">

                            <input type="hidden" class="form-control" value="<?php echo $posgold_nonce ?>" name="nonce" />
                            <input type="hidden" class="form-control" value="<?php echo $wpdb->last_result[0]->id ?>" name="id" />


                            <div class="row">
                                <div class="col-md-6">
                                    <label>TOKEN</label>
                                    <input type="text" class="form-control" required
                                    value="<?php echo $wpdb->last_result[0]->token ?>" name="token" />
                                </div>

                                <div class="col-md-3">
                                    <label>Periodo Sincronzacion (Segundos)</label>
                                    <input type="number" class="form-control" required
                                    value="<?php echo $wpdb->last_result[0]->syncro_seconds ?>" name="syncro_seconds" />
                                </div>

                                <div class="col-md-3">
                                    <label>Ultima Sincronización</label>
                                    <input type="text" class="form-control" readonly
                                    value="<?php echo $wpdb->last_result[0]->syncro_last ?>" name="syncro_last" />
                                </div>

                                <div class="col-md-3">
                                    <label>Path Imagenes Locales</label>
                                    <input type="text" class="form-control"
                                    value="<?php echo $wpdb->last_result[0]->image_path ?>" name="image_path" />
                                </div>

                                <div class="col-md-3">
                                    <label>Imagenes Syncro</label><br />
                                    <input type="number" class="form-control" max="1"
                                    value="<?php echo $wpdb->last_result[0]->image_sync ?>" name="image_sync" />
                                </div>

                                <div class="col-md-3">
                                    <label>Id Bodega</label><br />
                                    <input type="text" class="form-control"
                                    value="<?php echo $wpdb->last_result[0]->bodegaid ?>" name="bodegaid" />
                                </div>

                                <div class="col-md-3">
                                    <label>Nivel de Precio</label>
                                    <select class="form-control" name="nivel_precio">
                                        <option value="1"<?php echo $wpdb->last_result[0]->nivel_precio=="1"?"selected":null ?>>Precio 1</option>
                                        <option value="2"<?php echo $wpdb->last_result[0]->nivel_precio=="2"?"selected":null ?>>Precio 2</option>
                                        <option value="3"<?php echo $wpdb->last_result[0]->nivel_precio=="3"?"selected":null ?>>Precio 3</option>
                                        <option value="4"<?php echo $wpdb->last_result[0]->nivel_precio=="4"?"selected":null ?>>Precio 4</option>
                                        <option value="5"<?php echo $wpdb->last_result[0]->nivel_precio=="5"?"selected":null ?>>Precio 5</option>
                                    </select>

                                </div>

                                <div class="col-md-3">
                                    <label>Web publica</label>
                                    <select class="form-control" name="api_aplica">
                                        <option value="null" <?php echo $wpdb->last_result[0]->api_aplica=="null"?"selected":null ?>>NO APLICA</option>
                                        <option value="true" <?php echo $wpdb->last_result[0]->api_aplica=="true"?"selected":null ?>>SI</option>
                                        <option value="false" <?php echo $wpdb->last_result[0]->api_aplica=="false"?"selected":null ?>>NO</option>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label>Web privada</label>
                                    <select class="form-control" name="api_aplica2">
                                        <option value="null" <?php echo $wpdb->last_result[0]->api_aplica2=="null"?"selected":null ?>>NO APLICA</option>
                                        <option value="true" <?php echo $wpdb->last_result[0]->api_aplica2=="true"?"selected":null ?>>SI</option>
                                        <option value="false" <?php echo $wpdb->last_result[0]->api_aplica2=="false"?"selected":null ?>>NO</option>
                                    </select>

                                </div>

                                <div class="col-md-3">
                                    <label>Prefijo Pedidos</label>
                                    <input type="text" class="form-control"
                                    value="<?php echo $wpdb->last_result[0]->pedido_prefijo ?>" name="pedido_prefijo" maxlength="5" />
                                </div>

                                <div class="col-md-3">
                                    <label>Nit Tercero Pedido</label>
                                    <input type="text" class="form-control"
                                    value="<?php echo $wpdb->last_result[0]->pedido_terceronit ?>" name="pedido_terceronit" required />
                                </div>

                                <div class="col-md-2">
                                    <br />
                                    <button type="submit" class="btn btn-success">Actualizar</button>
                                </div>

                            </div>

                        </form>

                        <br />
                        <br />
                       


                    </div>


                   

                <?php
            }
        }

     
        ?>
      
       
        <?php

    }
    else{

        ?>
            <h2>No tienes permisos de administrador, por lo tanto no puedes ingresar</h2>
        <?php

    }

}





function posgold_synco_items(){

    $http_params=[
        'method'=>'GET',
        'timeout' => 180
    ];

    wp_remote_get('https://comercial.godpos.com.co', $http_params);
}

