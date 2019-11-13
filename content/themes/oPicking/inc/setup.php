<?php

add_action('after_setup_theme', 'opicking_setup');

function opicking_setup(){
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
}