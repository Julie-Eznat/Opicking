<?php
// $page_id =  OPICKING_THEME_CONTACT_FORM_ID;
// if ( ! empty( $page_id ) ) {
//   $image= get_the_post_thumbnail_url($page_id);    
$jarallax_image4 = get_theme_mod( Customizer_Jarallax::SETTING_JARALLAX_IMAGE4);
if ( !empty($jarallax_image4) ):  ?>

  <section>
  <div id="contact" class="jarallax jara4 blue-dark" data-speed="1.4" style="z-index:2;">
    <img class="jarallax-img" src="<?php echo $jarallax_image4 ?>" alt="">
    <?php ocontact() ?>
<?php endif;
// }