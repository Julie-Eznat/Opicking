<?php



add_action('wp_enqueue_scripts', 'opicking_enqueue_scripts');
function opicking_enqueue_scripts(){
    wp_enqueue_style(
        'opicking-style',
        get_theme_file_uri('public/css/style.css'),
        [],
        OPICKING_THEME_VERSION
    );
    
    wp_enqueue_script(
        'opicking-script',
        get_theme_file_uri('public/js/app.js'),
        [],
        OPICKING_THEME_VERSION,
        true
    );
   
    
}


