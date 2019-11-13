
<?php  if( is_user_logged_in() ) {

      get_template_part( 'template-parts/footer/footer-register' );

     } else  {
   
      get_template_part( 'template-parts/footer/footer-no-register' );
     }
   ?>
