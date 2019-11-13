<?php

get_header();
//ici terminer le front - aérer l'affichage - Creer une vignette pour les nos embeds

    ?>

    <main class="category" >
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-xl-8 ">
                    <?php


$queried_object = get_queried_object();
$name = $queried_object->name;
$taxonomy =$queried_object->taxonomy;



$args = array(
    'post_type' => 'ecology',
    'order' => 'ASC', 
    'tax_query' => array(
        array(
            'taxonomy' => $taxonomy  ,
            'field'    => 'slug',
            'terms'    => $name, //set your region
        ),
    ),
);
                    $ecology_query = new WP_Query($args);
                       
                   
                    if ( $ecology_query->have_posts() ) :
                        while ( $ecology_query->have_posts() ) :
                        
                        $ecology_query->the_post();
                        $id=get_the_ID();
                        $title = get_the_title();
                        $link = get_field('link');
                        $content= get_field('link_description');
                        $embed_code = wp_oembed_get($link);
                        $comments_count=wp_count_comments($id);


                        
                            ?>
                            <div class="card mb-4" style="z-index:1;">
                            <div class="card-body">
                            <?php if ( !empty( $title ) ) :
                                ?>
                                <h5 class="card-title"><a href="<?php the_permalink(); ?>"><?php echo $title; ?></a></h5>
                                
                                <?php
                                endif;?>
                            
                                <?php
                                if ($embed_code == false){
                                ?> 
                                <div class= "wrap_single no-embed-responsive-item">
                                    <div class="card-img-top embed-responsive" style=" padding-top:5rem"><?php echo  $content; ?>
                                    </div>
                                <?php
                                } else{
                                ?>
                                <div class= "wrap_single embed-responsive-item">
                                    <div class="card-img-top embed-responsive" style="text-align:center; padding-top:0.5rem"><?php echo $embed_code?>
                                    </div><p style=" padding-top:1rem"><?php echo $content; ?></p>
                                <?php  };?>
                            
                                             
                                    
                                    
                                  
                             </div>
                             <?php if($comments_count->total_comments  == 0 ) {
                                 echo '<strong style="padding-top:1rem; padding-top:1rem"> Soyez le premier à commenter!</strong>';
                             }else{
                             
                             echo '<p style="padding-top:1rem ;padding-top:1rem"> Commentaire : '. $comments_count->total_comments.'</p>' ;    
                            } ?>
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
    </main>
<?php get_footer();
   
