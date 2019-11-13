<?php


if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
  
    exit;
}


function function_uninstall_posts_note(){
    global $wpdb;

    $table_name = $wpdb->prefix.'posts_note';

if($wpdb->ger_var("
SHOW TABLES LIKE '$table_name'") == $table_name)  {
        $sql="DROP TABLE '$table_name'";
        $wpdb->query($sql);
    }                           

}

function_uninstall_posts_note();


function function_uninstall_comments_note(){
    global $wpdb;

    $table_name = $wpdb->prefix.'comments_note';

if($wpdb->ger_var("
   SHOW TABLES LIKE '$table_name'") == $table_name)  {
        $sql="DROP TABLE '$table_name'";
        $wpdb->query($sql);
    }                           

}

function_uninstall_comments_note();  
   