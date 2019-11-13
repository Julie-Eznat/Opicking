<?php

get_header();

if ( have_posts() ) :

    get_template_part( 'template-parts/single' );
    
endif;

get_footer();





