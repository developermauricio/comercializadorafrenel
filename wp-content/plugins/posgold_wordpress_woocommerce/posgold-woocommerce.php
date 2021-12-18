<?php

/*
Plugin Name: PosGold WooCommerce
Plugin URI: http://posgold.com.co/
Description: Éste plugin sincroniza productos, categorias, imagenes e items de una instancia PosGold.
Version: 2.0
Author: Posgold, Juan Camilo Romero
Author URI: https://posgold.com.co
License: GPL
License URI: http://
Text Domain: miplugin-beziercode
Domain Path: /languages/
*/

function posgold_install(){
    include('Activator.php');
}

function posgold_load_libraries($hook){

    if($hook =="toplevel_page_posgold_syncro_order_pending" || $hook =="toplevel_page_posgold_configuracion" || $hook =="toplevel_page_posgold_syncro_products" || $hook =="toplevel_page_posgold_syncro_categories"){
        wp_enqueue_style('bootstrap',
        plugins_url('admin/css/bootstrap.css',__FILE__ ),
        [],
        null,
        'all'
        );

        wp_enqueue_script('jquery.3.6.0',
            plugins_url('admin/js/jquery.3.6.0.js',__FILE__ ),
            [],
            null,
            true
        );


        wp_enqueue_script('configuration-posgold',
            plugins_url('admin/js/configuration-posgold.js',__FILE__ ),
            [],
            null,
            true
        );
    }else{
        return;
    }

    

    
}



add_action( 'admin_enqueue_scripts','posgold_load_libraries' );


function posgold_deactivation(){
    flush_rewrite_rules();

    global $table_prefix, $wpdb;

    $tblname = 'posgold_config';
    $posgold_sql_uninstall = $table_prefix . "$tblname ";

    $wpdb->query("DROP TABLE ". $posgold_sql_uninstall ." ");

    $wpdb->query("ALTER TABLE ".$table_prefix."wc_product_meta_lookup	DROP COLUMN posgold_product_id");

    $wpdb->query("DROP TABLE ".$table_prefix."terms_posgold");
  
}

function posgold_unistall(){
  
}

///Funciones para inicializar pluggin
register_activation_hook( __FILE__, 'posgold_install');
register_deactivation_hook( __FILE__, 'posgold_deactivation');
register_uninstall_hook( __FILE__, 'posgold_unistall' );


add_action( 'admin_menu', 'posgold_options_page');




if( ! function_exists('posgold_options_page')){

    function posgold_options_page(){

        add_menu_page(
        'PosGold Configuracion', 
        'PosGold Configuracion', 
        'manage_options', 
        'posgold_configuracion', 
        'posgold_configuracion_page_display', 
        '', 
        6);

        add_submenu_page('posgold_configuracion','Syncro Productos','Syncro Productos','manage_options','posgold_syncro_products','posgold_syncro_products_page_display');
        add_submenu_page('posgold_configuracion','Syncro Categorias','Syncro Categorias','manage_options','posgold_syncro_categories','posgold_syncro_categories_page_display');
        add_submenu_page('posgold_configuracion','Pedidos Pendientes','Pedidos Pendientes','manage_options','posgold_syncro_order_pending','posgold_syncro_order_pending_page_display');
        add_submenu_page('posgold_configuracion','Pedidos Enviados','Pedidos Enviados','manage_options','posgold_syncro_order_completed','posgold_syncro_order_completed_page_display');

        require_once 'Syncro/Products_Syncro.php';
        require_once 'Syncro/Categories_Syncro.php';
        require_once 'Syncro/Pedido_Syncro.php';
        require_once 'Syncro/Pedido_Uploaded.php';
    }
}

if( ! function_exists('posgold_configuracion_page_display')){
    function posgold_configuracion_page_display(){

        include('ConfigurationForm.php');

        if(isset($_POST['nonce']) && !empty(isset($_POST['nonce']))){
            if(wp_verify_nonce( $_POST['nonce'], 'nonce_security_posgold' )){

                global $table_prefix, $wpdb;

                $tblname = $table_prefix . 'posgold_config';
               
                $sql_update= "UPDATE $tblname SET token='".$_POST["token"]."' ,syncro_seconds=".$_POST["syncro_seconds"].",pedido_prefijo='".$_POST["pedido_prefijo"]."'";
                $sql_update .= ",image_path='".$_POST["image_path"]."',image_sync=".$_POST["image_sync"].",bodegaid=".$_POST["bodegaid"]?:"NULL";
                $sql_update .= ",nivel_precio='".$_POST["nivel_precio"]."',api_aplica='".$_POST["api_aplica"]."',api_aplica2='".$_POST["api_aplica2"]."'";
                $sql_update .= ",pedido_terceronit='".$_POST["pedido_terceronit"]."'";
                $sql_update .= " WHERE id=".$_POST['id'];

                // echo $sql_update;
             
                echo '<h2 class="text-center text-success">DATOS ACTUALIZADOS CON EXITO</h2>';
               
                $wpdb->query($sql_update);

            }else{
                echo '<h2 class="text-center text-danger">EL TIEMPO DE ESPERA CADUCO, POR FAVOR INTENTA DE NUEVO</h2>';
            }
        }


        posgold_configuracion_form_display();
    }
    
}


function posgold_getUrl(){
    require_once 'Security.php';
    return posgold_getURL_security();
}


