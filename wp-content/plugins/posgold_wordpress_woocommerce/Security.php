<?php

function posgold_getURL_security(){
    global $wpdb, $table_prefix;

    $token = $wpdb->get_results("SELECT token FROM ".$table_prefix ."posgold_config")[0]->token;

    $response_token = wp_remote_get("http://comercial.goldpos.com.co/apiGold/TokenApi/TokenConnectionData?token=".$token);

    // var_dump($response_token);

    $response_object_token = json_decode($response_token["body"],true);

    if($response_object_token['Status']==true){
       return $response_object_token["Data"];
    }
    else{
        return null;
    }

    var_dump($response_object_token);
        

    
}