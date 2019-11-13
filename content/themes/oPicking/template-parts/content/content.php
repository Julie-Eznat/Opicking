<?php
// $page_id =  OPICKING_THEME_ACCUEIL_ID;
// if (! empty($page_id)) {
//     $image= get_the_post_thumbnail_url($page_id); 
 $jarallax_image = get_theme_mod( Customizer_Jarallax::SETTING_JARALLAX_IMAGE);
 $title_welcome = get_theme_mod( Customizer_Welcome::SETTING_WELCOME_TITLE);
 $text_welcome = get_theme_mod( Customizer_Welcome::SETTING_WELCOME_TEXT);
    if ( !empty($jarallax_image) ):  ?>   

<!--SECTION PARAGRAPHE INTRODUCTION-->
<section>
  <div class="jarallax jara1">
    <img class="jarallax-img" src="<?php echo $jarallax_image ?>" alt="">
    <div class="block_introduction" style="">
      <div class="introduction">
        <h2 class="titrejaune"><?php echo $title_welcome?></h2>
        <p class="introduction__content"><?php echo $text_welcome?></p>
      </div>
    </div>
</section>
<!--FIN PARAGRAPHE INTRODUCTION-->

<?php endif;
// }
