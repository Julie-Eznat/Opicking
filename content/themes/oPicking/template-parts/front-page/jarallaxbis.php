
<?php
 //  dynamic_sidebar( 'Widgets home' );
// $page_id =  OPICKING_THEME_IMG_JARALLAXBIS_ID;
// if ( ! empty( $page_id ) ) {
//     $image= get_the_post_thumbnail_url($page_id);
$jarallax_image3 = get_theme_mod( Customizer_Jarallax::SETTING_JARALLAX_IMAGE3);
if ( !empty($jarallax_image3) ):  ?>   
  

<div class="jarallax jara3" data-speed="0.6">
  <img class="jarallax-img" src="<?php echo $jarallax_image3 ?>" alt="">
  <!--<div class="cloud_tag" style="">
        <div class="introduction">
        </div>  
      </div>  -->
</div>

<?php endif;
// }<section>
 