<?php



function posgold_syncro_categories_page_display(){
    // require_once '../Security.php';
   
    if(is_admin()){
        if(isset($_POST['nonce']) && !empty(isset($_POST['nonce']))){
            if(wp_verify_nonce( $_POST['nonce'], 'nonce_security_posgold' )){

                posgold_syncro_category_display_post();

            }else{
                echo '<h2 class="text-center text-danger">EL TIEMPO DE ESPERA CADUCO, POR FAVOR INTENTA DE NUEVO</h2>';
                posgold_syncro_category_display_get();
            }
        }
        else{
            posgold_syncro_category_display_get();
        }
        
       

    }
    else{

        echo ' <h2>No tienes permisos de administrador, por lo tanto no puedes ingresar</h2>';
    }
}





function posgold_syncro_category_display_get(){
    $posgold_nonce = wp_create_nonce('nonce_security_posgold');


    ?>
    <br />
    <br />
    <br />

        <div class="container">
            <h2 class="text-center text-primary">Sincronizacion de Categorias</h2>
            <form action="" method="post">
                <input type="hidden" class="form-control" value="<?php echo $posgold_nonce ?>" name="nonce" />
                <br />

                <div class="row">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-success btn-lg text-center">Sincronizar Categorias</button>
                    </div>
                </div>
            </form>
        </div>

<?php
}




function posgold_syncro_category_display_post(){
    $response_array_clasificacion= posgold_syncro_categories();

    ?>

    <br />

    <div class="container">
        <h2 class="text-center text-success">Categorias Sincronizadas</h2>

    <?php
    echo "<ul>";

    foreach($response_array_clasificacion as $item){

        echo "<li>";
        echo "<b>".$item["Descripcion"]."</b>";

            echo "<ol>";
                foreach($item["Grupos"] as $grupo){
                    echo "<li>".$grupo["Descripcion"]."</li>";
                }
            echo "</ol>";

        echo "</li>";
    }

    echo "</ul>";

    ?>
    </div>
    <?php

    // var_dump($response_array_clasificacion);
    // echo $url_get;

}


///Funcion para saber si el item es nuevo
function posgold_existe_category($item){
    ///Se valida si existe el item
    global $wpdb, $table_prefix;

    $existe_result = $wpdb->get_results("SELECT term_id FROM ".$table_prefix ."terms_posgold WHERE category_id=".$item["Categoriaid"]);
    
    if(count($existe_result)>=1){
        return $existe_result[0]->term_id;
    }else{
        return 0;
    }
}


///Funcion para saber si el item es nuevo
function posgold_existe_grupo($item){
    ///Se valida si existe el item
    global $wpdb, $table_prefix;

    $existe_result = $wpdb->get_results("SELECT term_id FROM ".$table_prefix ."terms_posgold WHERE Grupo_id=".$item["Grupoid"]);
    
    if(count($existe_result)>=1){
        return $existe_result[0]->term_id;
    }else{
        return 0;
    }
}


///Funcion para sincronizar las categorias
function posgold_syncro_categories(){
    global $wpdb, $table_prefix;

    $posgold_tblname_category_terms = 'terms_posgold';
    $posgold_wp_track_table_category_terms = $table_prefix . "$posgold_tblname_category_terms ";


    $table_category_terms  = " CREATE TABLE if not exists ". $posgold_wp_track_table_category_terms . " ( ";
    $table_category_terms .=" id INT NOT NULL AUTO_INCREMENT,";
    $table_category_terms .=" term_id INT,";
    $table_category_terms .=" category_id INT,";
    $table_category_terms .=" grupo_id INT,";
    $table_category_terms .=" PRIMARY KEY (id) ";
    $table_category_terms .=" )";
    
    $wpdb-> query($table_category_terms);



    $params_URL = posgold_getUrl();

    $url_get = $params_URL["Url"].'/apiGold/CategoriaAPI/GetCategoriasGrupos?empresaid='.$params_URL["Empresaid"];
     
    $response_clasificacion = wp_remote_get($url_get);

    $response_array_clasificacion = json_decode($response_clasificacion["body"],true);

    foreach($response_array_clasificacion as $item){

        $id_exist = posgold_existe_category($item);

        $parametro=[
            'cat_ID'                => $id_exist,
            'taxonomy'              => 'product_cat',
            'cat_name'              => $item["Descripcion"],
            'category_description'  => $item["Descripcion"],
            'category_nicename'     => $item["Descripcion"],
            'category_parent'       => null
        ];

        $result_id= wp_insert_category($parametro);

        if($id_exist==0){
            $wpdb->query("INSERT INTO ".$table_prefix."terms_posgold (term_id,category_id) VALUES (".$result_id.",".$item["Categoriaid"].")");
        }       

            foreach($item["Grupos"] as $grupo){
                $id_exist_grupo = posgold_existe_grupo($grupo);

                $parametro_grupo=[
                    'cat_ID'    => $id_exist_grupo,
                    'taxonomy'  => 'product_cat',
                    'cat_name'  =>  $grupo["Descripcion"],
                    'category_description' => $grupo["Descripcion"],
                    'category_nicename' => $grupo["Descripcion"],
                    'category_parent' => $result_id
                ];
            
                $result_grupo_id= wp_insert_category($parametro_grupo, true);

                if($id_exist_grupo==0){
                    $wpdb->query("INSERT INTO ".$table_prefix."terms_posgold (term_id,grupo_id) VALUES (".$result_grupo_id.",".$grupo["Grupoid"].")");
                }    
            }

    }

    return $response_array_clasificacion;

}


///function para establecer el grupo
function posgold_set_terms_taxonomy_category($termid, $postid){
    global $wpdb, $table_prefix;

    $existe_result = $wpdb->get_results("SELECT term_taxonomy_id FROM ".$table_prefix ."term_taxonomy WHERE term_id=".$termid);
    
    if(count($existe_result)>=1){

        $wpdb->query("DELETE FROM ".$table_prefix."term_relationships WHERE object_id=".$postid." AND term_taxonomy_id IN (SELECT term_taxonomy_id WHERE taxonomy='product_cat')");

        $term_taxonomy_id= $existe_result[0]->term_taxonomy_id;
        $insert = $wpdb->query("INSERT INTO ".$table_prefix."term_relationships (object_id,term_taxonomy_id,term_order) VALUES (".$postid.",".$term_taxonomy_id.",0)");

    }
}


///function para obtener el taxonomy id de una categoria
function posgold_set_terms_taxonomy_grupo($termid, $postid){
    global $wpdb, $table_prefix;

    $existe_result = $wpdb->get_results("SELECT term_taxonomy_id FROM ".$table_prefix ."term_taxonomy WHERE term_id=".$termid);
    
    if(count($existe_result)>=1){

        $term_taxonomy_id= $existe_result[0]->term_taxonomy_id;
        $insert = $wpdb->query("INSERT INTO ".$table_prefix."term_relationships (object_id,term_taxonomy_id,term_order) VALUES (".$postid.",".$term_taxonomy_id.",0)");

    }
}



