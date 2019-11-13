<?php
/*
Plugin Name: oPicking Settings
Description: Les CPT fait par la Dream Team Rocket pour le site o'Picking.
Author: DTR - Dream Team Rocket 
Version: 1.0
*/

if ( ! defined( 'WPINC' ) ) {
    http_response_code( 404 );
    exit;
}


$plugin_dir_path = plugin_dir_path( __FILE__ );

require $plugin_dir_path . 'inc/class-post-type-ecology.php';
require $plugin_dir_path . 'inc/roles.php';
require $plugin_dir_path . 'inc/admin-menu.php';
require $plugin_dir_path . 'inc/rest-api-fields.php';


$post_type_project = new Post_Type_Ecology;



/**
 * 
 */

function opicking_activation() {
    $post_type_ecology = new Post_Type_ecology();
   
    $post_type_ecology->register_post_type();
    $post_type_ecology->register_taxonomies();

    update_roles_capabilities();

    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'opicking_activation' );




/**
 * Ajouter un traitement à la désactivation du plugin
 *
 * 
 */
register_deactivation_hook( __FILE__, 'opicking_deactivation' );

function opicking_deactivation() {
    // On désactive le post type
   
    unregister_post_type( post_type_Ecology::NAME );

    unregister_taxonomy( Post_Type_Ecology::TAXONOMY_1 );
    unregister_taxonomy( Post_Type_Ecology::TAXONOMY_2 );
    unregister_taxonomy( Post_Type_Ecology::TAXONOMY_3 );
    unregister_taxonomy( Post_Type_Ecology::TAXONOMY_4 );
  
   
    flush_rewrite_rules();
}




