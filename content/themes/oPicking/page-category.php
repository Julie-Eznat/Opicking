<?php

get_header();

if ( have_posts() ) :

    get_template_part( 'template-parts/page-category' );

    
endif;

get_footer();