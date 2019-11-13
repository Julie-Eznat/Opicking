<?php

###########################################
// Customizer configuration

// Call files

require get_theme_file_path( 'inc/customizer/class-customizer-section-jarallax.php' );
require get_theme_file_path( 'inc/customizer/class-customizer-section-welcome.php' );
require get_theme_file_path( 'inc/customizer/class-customizer-section-carousel.php' );


add_action( 'customize_register', 'opicking_customize_register' );


function opicking_customize_register ( $wp_customize ) {

    // Add panel
    $panel_id = 'opicking_theme_panel';
    
    $wp_customize->add_panel(
        $panel_id,
        [
            'priority'      => 1,
            'title'         => 'Homepage',
            'description'   => 'Option de personnalisation du thème oPicking'
        ]
    );
        
    $section_jarallax       = new Customizer_Jarallax(
        $wp_customize,
        $panel_id
    );

    $section_welcome        = new Customizer_Welcome(
        $wp_customize,
        $panel_id
    );

    $section_carrousel      = new Customizer_Delay(
        $wp_customize,
        $panel_id
    );
       
}