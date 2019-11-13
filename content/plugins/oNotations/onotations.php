<?php
/*
Plugin Name: oNotations 
Description: Un plugin fait par la Dream Team Rocket pour le site o'Picking.
Author: DTR - Dream Team Rocket 
Version: 1.0
*/

if ( ! defined( 'WPINC' ) ) {
    http_response_code( 404 );
    exit;
}

define( 'ONOTATIONS_VERSION', '1.0' );

$plugin_dir_path = plugin_dir_path( __FILE__ );

// Create table for posts

register_activation_hook (__FILE__, 'function_table_posts_install');


  function function_table_posts_install(){
    global $wpdb;

    $table_name = $wpdb->prefix.'posts_note';
    $charset_collate = $wpdb->get_charset_collate();


    $sql = "CREATE TABLE $table_name ( 
        id bigint(20) NOT NULL AUTO_INCREMENT,
        posts_note_id BIGINT(20) NOT NULL, 
        posts_note_value BIGINT(20) NOT NULL, 
        posts_note_user BIGINT(20) NOT NULL, 
        PRIMARY KEY id (id)
        
      )  $charset_collate;";
      
      
      require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
      dbDelta( $sql );
    
}

// Create table for comments

register_activation_hook (__FILE__, 'function_table_comments_install');

function function_table_comments_install(){
  
    global $wpdb;

    $table_name = $wpdb->prefix.'comments_note';

   $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name ( 
        id bigint(20) NOT NULL AUTO_INCREMENT,
        comments_note_id BIGINT(20) NOT NULL,  
        comments_note_value BIGINT(20) NOT NULL, 
        comments_note_user BIGINT(20) NOT NULL, 
        PRIMARY KEY id (id)
        
      ) $charset_collate;";
     //comments_note_id - id du commentaires

      
      require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
      dbDelta( $sql );
     
      // Adding default values

   } 

// Create table for statistiques users





// require $plugin_dir_path . 'inc/dbdata.php';
require $plugin_dir_path . 'inc/onotation-post.php';
require $plugin_dir_path . 'inc/onotation-comment.php';
require $plugin_dir_path . 'inc/stats.php';
