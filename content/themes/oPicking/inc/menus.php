<?php

add_action( 'after_setup_theme', 'opicking_register_nav_menus' );

function opicking_register_nav_menus() {
    register_nav_menus(
        [
            'header-menu' => 'Menu de la nav_bar',
                       
        ]
    );
}



