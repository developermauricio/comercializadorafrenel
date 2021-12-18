<?php



function posgold_syncro_products_page_display(){
   
    if(is_admin()){
        if(isset($_POST['nonce']) && !empty(isset($_POST['nonce']))){
            if(wp_verify_nonce( $_POST['nonce'], 'nonce_security_posgold' )){

                posgold_syncro_produsct_display_post($_POST['desde']);

            }else{
                echo '<h2 class="text-center text-danger">EL TIEMPO DE ESPERA CADUCO, POR FAVOR INTENTA DE NUEVO</h2>';
                posgold_syncro_produsct_display_get();
            }
        }
        else{
            posgold_syncro_produsct_display_get();
        }

    }
    else{

        echo ' <h2>No tienes permisos de administrador, por lo tanto no puedes ingresar</h2>';
    }
}

///Para mostrar la parte de POST
function posgold_syncro_produsct_display_post($fecha_desde){
    set_time_limit(6000);
    global $wpdb, $table_prefix;

    $sql = $wpdb->get_results("SELECT * FROM ".$table_prefix ."posgold_config")[0];

    $bodegaid = $wpdb->last_result[0]->bodegaid;
    $api_aplica = $wpdb->last_result[0]->api_aplica;
    $api_aplica2 = $wpdb->last_result[0]->api_aplica2;
    $nivel_precio = 'Precio' . $wpdb->last_result[0]->nivel_precio;

    if ($bodegaid === null || $bodegaid === 'null' || $bodegaid === '')
        $bodegaid = '';
    else if ($api_aplica === null || $api_aplica === 'null' || $api_aplica === '')
        $api_aplica = '';
    else if ($api_aplica2 === null || $api_aplica2 === 'null' || $api_aplica2 === '')
        $api_aplica2 = '';

    $params_URL = posgold_getUrl();

    $response_productos = wp_remote_get($params_URL["Url"].'/apiGold/ProductoAPI/GetProduct_V4?empresaid='.$params_URL["Empresaid"].'&usuarioid=1&codigo=&descripcion=&categoriaid=null&grupoid=&items_x_pagina=50000&pagina=0&subgrupoid=&precio_min=&precio_max=&bodegaid='. $bodegaid .'&orden=&api='. $api_aplica .'&api2='. $api_aplica2 .'&nombreFull=&ult_mov='.urlencode($fecha_desde));

    $response_array_productos = json_decode($response_productos["body"],true)["Datos"];

    ?>
        <br />
        <br />

        <h2 class="text-center">Productos Sincronizados</h2>

        <table class="table table-sm table-bordered">
            <thead>
                <tr>
                    <th>
                        #
                    </th>
                    <th>
                        Id
                    </th>
                    <th>
                        Post Id
                    </th>
                    <th>
                        Codigo
                    </th>
                    <th>
                        Referencia
                    </th>
                    <th>
                        Producto
                    </th>
                    <th>
                        Disponible
                    </th>
                    <th>
                        Precio 1
                    </th>
                    <th>
                        Imagen
                    </th>
                </tr>
            </thead>
            <tbody>
                    <?php
                        $conteo=0;

                        foreach($response_array_productos as $item){      
                            $conteo++;                   
                            $existe_ID = posgold_existe_product($item);
                            $ultimo_ID= posgold_insert_productos($item,$existe_ID,$nivel_precio);
                            posgold_insert_wp_wc_product_meta_lookup($item,$ultimo_ID,$nivel_precio);
                            posgold_insert_wp_term_taxonomy($item, $ultimo_ID);
                                                     
                            echo "<tr>";
                            echo "<td>".$conteo."</td>";
                            echo "<td>".$item["Productoid"]."</td>";
                            echo "<td>".$ultimo_ID."</td>";
                            echo "<td class='text-center'>".$item["Producto_cod"]."</td>";
                            echo "<td class='text-center'>".$item["Referencia"]."</td>";
                            echo "<td>".$item["Producto"]."</td>";
                            echo "<td class='text-center'>".$item["Disponible"]."</td>";
                            echo "<td>".$item[$nivel_precio]."</td>";
                            echo "<td>".$item["Imagenes"][0]." (".count($item["Imagenes"]).")</td>";
                            echo "</tr>";

                            flush();
                            ob_flush();
                        }

                        posgold_act_config();
                    ?>
                
            </tbody>
        </table>

        <h2 class="text-center">FIN DEL PROCESO</h2>


        
    <?php

}


///Para mostrar la parte del GET
function posgold_syncro_produsct_display_get(){
    $posgold_nonce = wp_create_nonce('nonce_security_posgold');

    global $wpdb, $table_prefix;

    $ult_syncro = $wpdb->get_results("SELECT syncro_last FROM ".$table_prefix ."posgold_config")[0]->syncro_last;

    ?>
    <br />
    <br />
    <br />

        <div class="container">
            <h2 class="text-center">Sincronizacion de Productos</h2>
            <form action="" method="post">
                <input type="hidden" class="form-control" value="<?php echo $posgold_nonce ?>" name="nonce" />
                <br />

                <div class="row">
                    <div class="col-md-6">
                        <label>Sincronizar desde</label>
                        <select class="form-control" name="desde">
                            <option value="2000-01-01 12:00:00">Desde el inicio</option>
                            <option value="<?php echo $ult_syncro ?>">Ultima Vez (<?php echo $ult_syncro ?>)</option>
                        </select>
                    </div>
              
                    <div class="col-md-6 text-center">
                        <br />
                        <button type="submit" class="btn btn-success btn-lg text-center">Sincronizar</button>
                    </div>
                </div>
            </form>
        </div>

    <?php

}


function posgold_act_config(){
    global $wpdb, $table_prefix;

    $wpdb->query("UPDATE ".$table_prefix ."posgold_config SET syncro_last=NOW()");
}



///Funcion para saber si el item es nuevo
function posgold_existe_product($item){
    ///Se valida si existe el item
    global $wpdb, $table_prefix;

    $existe_result = $wpdb->get_results("SELECT product_id FROM ".$table_prefix ."wc_product_meta_lookup WHERE posgold_product_id=".$item["Productoid"]);
    
    if(count($existe_result)>=1){

        $attachments = get_attached_media("image", $existe_result[0]->product_id);
        foreach($attachments as $image){
            $image_array = get_object_vars( $image );

            wp_delete_attachment( $image_array["ID"], true );
        }


        return $existe_result[0]->product_id;
    }else{
        return null;
    }
}



///Funcion para insertar en WP_POSTS
function posgold_insert_productos($item,$existeid=null,$nivel_precio='1'){
   global $wpdb, $table_prefix;
    
    if($item["texto_adicional"] === null || $item["texto_adicional"] === 'null' || isset($item["texto_adicional"])){
        $item["texto_adicional"] = $item["Producto"];
    }

    $datos_post=[
        'post_author'       => wp_get_current_user(),
        'post_date'         => current_time('mysql', 1),
        'post_date_gmt'     => current_time('mysql', 1),
        'post_content'      => $item["texto_adicional"],
        'post_title'        => $item["Producto"],
        'post_excerpt'      => $item["Producto"],
        'post_status'       => $item["borrador"] === true ? 'draft' : 'publish',
        'comment_status'    => 'open',
        'ping_status'       => 'closed',
        'post_password'     => '',
        'post_name'         => str_replace(' ','-',$item["Producto"]),
        'to_ping'           => '',
        'pinged'            => current_time('mysql', 1),
        'post_modified_gmt' => current_time('mysql', 1),
        'post_content_filtered' => '',
        'post_parent'       => '',
        'guid'              => str_replace(' ','-',$item["Producto"]),
        'menu_order'        => 0,
        'post_type'         => 'product',
        'post_mime_type'    => '',
        'comment_count'     => 0,
        'meta_input'        => [
                            '_sku'              =>$item["Producto_cod"],
                            '_regular_price'    =>$item[$nivel_precio],
                            'total_sales'       =>'0',
                            '_tax_status'       =>'taxable',
                            '_tax_class'        =>'',
                            '_manage_stock'     =>'yes',
                            '_backorders'       =>'no',
                            '_sold_individually'=>'0',
                            '_virtual'          =>'0',
                            '_downloadable'     =>'no',
                            '_download_limit'   =>'-1',
                            '_download_expiry'  =>'-1',
                            '_stock'            =>$item["Disponible"]>0 ?$item["Disponible"]:0,
                            '_stock_status'     =>$item["Disponible"]>0 ?'instock':'outofstock',
                            '_wc_average_rating'=>'0',
                            '_wc_review_count'  =>'0',
                            '_product_version'  =>'1.0.0',
                            '_price'            =>$item[$nivel_precio]
                                //'_product_image_gallery' => 
                                ]
    ];

    $lastid=null;

    if($existeid){
        $datos_post["ID"] = $existeid;
        $lastid = $existeid;
        wp_update_post( $datos_post);
    }
    else{
        $lastid = wp_insert_post($datos_post); //actualmente se crean siempre
    }

   

    $data = [
        'ID' => $lastid,
        'guid' => get_option('siteurl') .'/?post_type=product&#038;p='.$lastid
    ];


    ///Se mira si existe la categoria
    $term_category_id = posgold_existe_category($item);

    ///Se setea la categoria
    posgold_set_terms_taxonomy_category($term_category_id,$lastid);


    ///Se busca el grupo
    $term_grupo_id = posgold_existe_grupo($item);

    if($term_grupo_id>0){
        posgold_set_terms_taxonomy_grupo($term_grupo_id,$lastid);
    }

   
    ///Se valida para no insertar el sin imagen disponible
    if($item["Imagenes"][0] !=="Imagen-no-disponible.jpg"){
        
        $cantidad_img = count($item["Imagenes"]);
        

        ///Se recorre cada imagen
        foreach($item["Imagenes"] as $imagen_item){
            $cantidad_img = $cantidad_img-1;

            insert_image_attachment($lastid,$item["Imagenes"][$cantidad_img]);
        }

        $ids_attachs = $wpdb -> get_results("SELECT GROUP_CONCAT(id) as ids FROM ".$table_prefix."posts WHERE post_type='attachment' AND post_parent=".$lastid)[0]-> ids;
        $wpdb->query("DELETE FROM ".$table_prefix."postmeta WHERE meta_key='_product_image_gallery' AND post_id=".$lastid);


        ///Se actualiza el meta de gallery para mostrar todas las imagenes
        add_post_meta($lastid, '_product_image_gallery', $ids_attachs, true );
    }

   return $lastid;
}




///Funcion para ingresar los datos en wp_wc_product_meta_lookup
function posgold_insert_wp_wc_product_meta_lookup($item,$ultimoID,$nivel_precio='1'){
    global $table_prefix,$wpdb;

    $Data = [
        'product_id'    => $ultimoID,
        'sku'           => $item["Producto_cod"],
        'virtual'       => 0,
        'downloadable'  => 0,
        'min_price'     => $item[$nivel_precio],
        'max_price'     => $item[$nivel_precio],
        'onsale'        => 0,
        'stock_quantity'=> $item["Disponible"],
        'stock_status'  => 'instock',
        'rating_count'  => 0,
        'average_rating'=> 0,
        'total_sales'   => 0,
        'tax_status'    => 'taxable',
        'tax_class'     => '',
        'posgold_product_id' => $item["Productoid"]
    ];

    $insert_result= $wpdb->insert($table_prefix.'wc_product_meta_lookup',$Data);
}


function insert_image_attachment($post_id, $imagen_name){
    $params_URL = posgold_getUrl();

    $image_url        = $params_URL["Url"].'/Files/Images/'.$imagen_name; // Define the image URL here
    $image_name       = basename($image_url);
    $upload_dir       = wp_upload_dir(); // Set upload folder
    $image_data       = file_get_contents($image_url); // Get image data
    $unique_file_name = wp_unique_filename( $upload_dir['path'], $image_name ); // Generate unique name
    $filename         = basename( $image_name ); // Create image file name

    // Check folder permission and define file location
    if( wp_mkdir_p( $upload_dir['path'] ) ) {
        $file = $upload_dir['path'] . '/' . $filename;
    } else {
        $file = $upload_dir['basedir'] . '/' . $filename;
    }

    // Create the image  file on the server
    file_put_contents( $file, $image_data );

    // Check image file type
    $wp_filetype = wp_check_filetype( $filename, null );

    
    // Set attachment data
    $attachment = [
        'post_mime_type' => $wp_filetype['type'],
        'post_title'     => sanitize_file_name( $filename ),
        'post_content'   => sanitize_file_name( $filename ),
        'post_status'    => 'inherit'
    ];

    // Create the attachment
    $attach_id = wp_insert_attachment( $attachment, $file, $post_id );

    // Include image.php
    require_once(ABSPATH . 'wp-admin/includes/image.php');

    // Define attachment metadata
    $attach_data = wp_generate_attachment_metadata( $attach_id, $file );

    // Assign metadata to attachment
    wp_update_attachment_metadata( $attach_id, $attach_data );

    // And finally assign featured image to post
    set_post_thumbnail( $post_id, $attach_id );
}

function posgold_insert_wp_term_taxonomy($item, $ultimo_ID){
    global $table_prefix, $wpdb;

    $terms = array();
    foreach ($item["TagsProductos"] as $tag){

        $Data = [
            'description'     => "",
            'parent'          => 0,
            'slug'            => $tag
        ];

        $existent_term = term_exists( $tag, 'product_tag' );

        if( $existent_term && isset($existent_term['term_id']) ) {
            $term_id = $existent_term['term_id'];
            $terms[] = (int) $term_id;
        }else{
            $term = wp_insert_term($tag, 'product_tag', $Data);
            if( !is_wp_error($term) && isset($term['term_id']) ) {
                $term_id = $term['term_id'];
                $terms[] = (int) $term_id;
            } 
        }

    }

    wp_set_object_terms($ultimo_ID, $terms, 'product_tag' );
}


