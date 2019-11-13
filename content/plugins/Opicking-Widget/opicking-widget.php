<?php
/*
Plugin Name: Custom post type Ecology Widget

Description: Display Custom Post Type in a widget
Version: 1.0
Author: Julie EUZENAT

*/
if ( ! defined( 'WPINC' ) ) {
    http_response_code( 404 );
    exit;
}

define( 'CPT_WIDGET_VERSION', '1.0' );


$plugin_dir_path = plugin_dir_path( __FILE__ );

require $plugin_dir_path . 'inc/widgets.php';


add_action('widgets_init', 'init_custom_taxonomy_widget');

function init_custom_taxonomy_widget()
{
    register_widget('CustomTaxonomyWidget');
}