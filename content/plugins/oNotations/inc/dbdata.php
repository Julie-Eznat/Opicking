<?php
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
        
      ) $charset_collate;";
      
      
      require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
      dbDelta( $sql );

}

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