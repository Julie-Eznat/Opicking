<?php


// LES CUSTOMS FIELDS CHAMPS ACF
$link = get_field('link');
$content= get_field('link_description');

//ici on s'occupe des TAGS
$posttags = get_the_term_list( 
  $post->ID, 
  'tag',
  '<div class="tag"><button type="button" class="btn btn-light btn-sm" data-toggle="button" aria-pressed="false" autocomplete="off">',
  '</button><button type="button" class="btn btn-light ml-3" data-toggle="button" aria-pressed="false" autocomplete="off">' ,
  '</button></div>'); 

// Je récupere mes infos de mon article ppur généré des infos comme post ID
the_post(); 
		
$author_id = get_the_author_meta('ID');
$curauth = get_user_by('ID', $author_id);

$user_nicename    = $curauth->user_nicename;
$display_name     = $curauth->display_name;
$user_description = $curauth->user_description;
$avatar = get_avatar_url($author_id, [
  'default' => 'monsterid',
]);
 
rewind_posts(); // Je reset la loop
$embed_code = wp_oembed_get($link); 

?>
<!--PARTIE MAIN-->
<main class="main main_article" style="">
  <div class="container">
    <div class="row justify-content-between">
<!--PARTIE POST EMBED-->      
      <div class="col-12 col-md-6 col-lg-8">
          
        <h3 class="main__title" style=""><?php the_title(); ?></h3>
          <?php  
          // PARTIE 1 -- JE VERIFIE LA PRESENCE D INFORMATION OEMBED       
          

          // FALSE  ---  JE CHARGE LE TEMPLATE CORRESPONDANT
              if ($embed_code == false){
                  get_template_part( 'template-parts/post/post-no-embed' );
              } else{

          // TRUE  ---  JE CHARGE LE TEMPLATE CORRESPONDANT
                $embed_code;
                  get_template_part( 'template-parts/post/post-embed' );
              };
          //// PARTIE PRESENT SUR TOUTES LES PAGES ////// 
          ?>
        
          <div class="main__description" class="p-3" >
            <?php  // LE CONTENT EST IDENTIQUE SELON LE TYPE DE LIEN
            echo $content
             ?>
          </div>

              <div class="main__icone" >
                <?php  
                // AFFICHAGE GOOD NOTATION POUR ARTICLE
                  show_good_notation();
                // AFFICHAGE BAD NOTATION POUR ARTICLE
                  show_bad_notation();
            
                ?>
              </div> 
            </div>
          <!-- PARTIE PROFILE DE LA PAGE -->
          <div class="profil_container mt-3 col-12 col-md-5 col-lg-4 col-xl-3" >
            <div class= "border p-3">
              <img src="<?php  echo $avatar;  ?>" alt="image_profil">

                <h5 class=mt-3 > <u> <?php  echo $display_name ;  ?> </u> 
                </h5>
                  
                <p> Nombre de partages : <?php //fonction wordpress pour compter les posts par auteur
                the_author_posts()   ?>
                </p>

                <div class="w-100 border p-2 mb-2" >
                  <?php  echo $user_description ;  ?>
                </div>

                <!-- ici je force la reditection en utilisant une concaténation de url HOME et le NOM de l'auteur -->
                <a href="<?=get_home_url().'/author/'.$user_nicename;?>"  >
                  <button class=" btn btn-dark btn-sm "></i>
                  Voir le profil
                </button>
                </a> 
                  
              
            </div>
          </div>
      <!-- PARTIE COMMENTAIRE -->
      <div class="comment_post col-12 col-md-7 col-lg-6">

        <?php
          $args = array(
           'post_id' => $id,
          );
          // j'appelle la classe ci dessous et j'utilise la boucle des commentaires.
          $comments_query = new WP_Comment_Query;
          $comments = $comments_query->query( $args );
           // Comment Loop
          if ( $comments ) :
            // j'affiche les commentaire via une boucle 
            foreach ( $comments as $comment) :?>

            <h6 class="comment_author"> <?=$comment->comment_author ?> </h6>

            <div class="comment_content"  > <?= $comment->comment_content ?> </div>
            
            <div class="comment_date text-right"> <?= get_the_date()?> </div>
            <?php

            // ICI j'appelle les votes des commentaire
              show_good_comment_notation();      
              show_bad_comment_notation();
           
            
            endforeach;
          endif;
            ?>
      </div>

      <?php  
      // ICI je vérifier si l'utilsateur enregistré, ce sont les seuls qui peuvent commenter. 
      if( is_user_logged_in() ) {  

      get_template_part( 'template-parts/post/comment-form' );

      }

      ?>

    </div>
  </div>
</main>


