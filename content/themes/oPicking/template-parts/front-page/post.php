<?php

$carousel_delay = get_theme_mod( Customizer_Delay::SETTING_CAROUSEL_DELAY);





  $args = array(
    'posts_per_page'=>4,
    'post_type'=>'ecology',
    'tax_query' => array(
      'relation' => 'OR',
      array(
          'taxonomy' => 'cat1',
          'field'    => 'slug',
          'terms'    => array( 'faune' ),
      ),
    ), 
  );


$ecology_query = new WP_Query($args);

?>

<!--DEBUT DIV CAROUSSEL AVEC JARALLAX EN FOND-->
<section>
  <main class="main" class="data-jarallax" data-speed="0.2" > 
    <div class="container-fluid main__carousel">           
      <div class="carousel slide" data-ride="carousel" id="multi_item" data-interval="<?php echo $carousel_delay ?>"> 
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="row">
      
              <?php
                if ( $ecology_query->have_posts() ) :
                  while ( $ecology_query->have_posts() ) :
                    $ecology_query->the_post();

                    $title = get_the_title();
                    $link = get_field('link');
                    $content= get_field('link_description') ;//  custom_field_excerpt() j'ai mis cette fonction en place
                    $embed_code = wp_oembed_get($link);
                    ?>
                   
                     
                    <div class="col-md main__carousel__item__card  embed-responsive-item">

                     <?php
                        if ( ! empty( $title ) ) :
                      ?>
                        <h5 class="main__carousel__item__card__title"><a href="<?php the_permalink(); ?>"><?php echo $title; ?></a></h5>
                      <?php
                        endif;
                      ?>

                    <?php 
                      
                      if ($embed_code == false){ 
                        echo '<div class="no-embed-responsive p-4"> <p class=no-embed-content>'.$content.'</p>'; 
                      }  else { 
                        echo '<div class="embed-responsive">'.$embed_code; 
                         
                      }   ;
                       
                       
                      ?> 
                    
                    
                    </div> 

                   </div> 
                    <?php

                  endwhile;
              
                  wp_reset_postdata();
                endif;
              ?>


            </div>
          </div>

<?php
$args = array(
  'posts_per_page'=>4,
  'post_type'=>'ecology',
  'tax_query' => array(
    'relation' => 'OR',
    array(
      'taxonomy' => 'cat2',
          'field'    => 'slug',
          'terms'    => array( 'flore' ),
    ),
  ),
);
  

$ecology_query = new WP_Query($args);

?>
          <div class="carousel-item">
          <div class="carousel-item active">
            <div class="row">
      
              <?php
                if ( $ecology_query->have_posts() ) :
                  while ( $ecology_query->have_posts() ) :
                    $ecology_query->the_post();

                    $title = get_the_title();
                    $link = get_field('link');
                    $content= get_field('link_description') ;//  custom_field_excerpt() j'ai mis cette fonction en place
                    $embed_code = wp_oembed_get($link);
                    ?>
                   
                     
                    <div class="col-md main__carousel__item__card  embed-responsive-item">

                     <?php
                        if ( ! empty( $title ) ) :
                      ?>
                        <h5 class="main__carousel__item__card__title"><a href="<?php the_permalink(); ?>"><?php echo $title; ?></a></h5>
                      <?php
                        endif;
                          ?>
                      <?php 
                      
                      if ($embed_code == false){ 
                        echo '<div class="no-embed-responsive p-4"> <p class=no-embed-content>'.$content.'</p>'; 
                      }  else { 
                        echo '<div class="embed-responsive">'.$embed_code; 
                         
                      }   ;
                       
                       
                      ?> 
                    
                    
                    </div> 
                   </div> 
                    <?php

                  endwhile;
              
                  wp_reset_postdata();
                endif;
              ?>


            </div>
          </div>

        </div>
      </div>
    </div>
  </main>
</section>
<!--FIN DIV DU CAROUSSEL-->

