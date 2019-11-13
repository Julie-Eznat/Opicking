<?php
// $page_id =  OPICKING_THEME_IMG_JARALLAX_ID;
// if ( ! empty( $page_id ) ) {
//     $image= get_the_post_thumbnail_url($page_id);
    
$jarallax_image2 = get_theme_mod( Customizer_Jarallax::SETTING_JARALLAX_IMAGE2);
if ( !empty($jarallax_image2) ):  ?>

<div class="jarallax jara2" data-speed="0.6">
  <img class="jarallax-img" src="<?php echo $jarallax_image2 ?>" alt="">

 
</div>

<?php endif;
// }
