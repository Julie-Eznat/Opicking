<?php

add_action( 'widgets_init', 'ocooking_register_navbar_widget' );

function ocooking_register_navbar_widget() {
    register_sidebar(
        [
            'name'          => 'Widgets de la nav_bar',
            'id'            => 'nav_bar-widgets',
            'before_widget' => '',
            'after_widget'  => ''
        ]
    );
}


add_action( 'widgets_init', 'opicking_register_home_widget' );

function opicking_register_home_widget() {
    register_sidebar(
        [
            'name'          => 'Widgets home',
            'id'            => 'home-widget',
            'class'         => 'introduction',
            'before_widget' => '',
            'after_widget'  => ''
        ]
    );
}