

    <?php  if( is_user_logged_in() && is_author(get_current_user_id())  ) {  
            get_template_part( 'template-parts/author/current-user' );
            get_template_part( 'template-parts/add-post');
            get_template_part( 'template-parts/footer/footer-register' );
           
        
    } 
    else {

             get_template_part( 'template-parts/author/not-current-author' );
             get_template_part( 'template-parts/footer/footer-register' );
        
    } 


?>           

 