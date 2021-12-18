<?php


global $table_prefix, $wpdb;

$posgold_tblname_config = 'posgold_config';
$posgold_wp_track_table = $table_prefix . "$posgold_tblname_config ";
$posgold_charset_collate = $wpdb->get_charset_collate();
#Check to see if the table exists already, if not, then create it


$posgold_sql_install = " CREATE TABLE ". $posgold_wp_track_table . " ( ";
$posgold_sql_install .= "  id INT NOT NULL AUTO_INCREMENT, ";
$posgold_sql_install .= "  token VARCHAR(500), ";
$posgold_sql_install .= "  bodegaid INT(10), ";
$posgold_sql_install .= "  syncro_seconds INT(10), ";
$posgold_sql_install .= "  syncro_last DATETIME, ";
$posgold_sql_install .= "  image_path VARCHAR(250), ";
$posgold_sql_install .= "  image_sync BOOL, ";
$posgold_sql_install .= "  api_aplica VARCHAR(5), ";
$posgold_sql_install .= "  api_aplica2 VARCHAR(5), ";
$posgold_sql_install .= "  nivel_precio VARCHAR(2), ";
$posgold_sql_install .= "   PRIMARY KEY (id)  "; 
$posgold_sql_install .= ")".$posgold_charset_collate;

$wpdb->query($posgold_sql_install);

$wpdb -> query("insert into `".$table_prefix."posgold_config` (`id`, `token`, `syncro_seconds`, `syncro_last`, `image_path`, `image_sync`) values(NULL,'SIN TOKEN','500','2000-01-01 12:00:00','/',false);
");

///Se crea el campo para guardar el id del producto
$wpdb -> query("ALTER TABLE ".$table_prefix."wc_product_meta_lookup ADD COLUMN posgold_product_id INT");





$posgold_tblname_category_terms = 'terms_posgold';
$posgold_wp_track_table_category_terms = $table_prefix . "$posgold_tblname_category_terms ";

///Se crea la tabla para guardar las relaciones de las categorias
$table_category_terms  = " CREATE TABLE ". $posgold_wp_track_table_category_terms . " ( ";
$table_category_terms .=" id INT NOT NULL AUTO_INCREMENT,";
$table_category_terms .=" term_id INT,";
$table_category_terms .=" category_id INT,";
$table_category_terms .=" grupo_id INT,";
$table_category_terms .=" PRIMARY KEY (id) ";
$table_category_terms .=" )";
  
$wpdb-> query($table_category_terms);


    
  
