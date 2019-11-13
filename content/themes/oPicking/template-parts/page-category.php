<main class="category " >
    <div class="container-fluid">
        <div class="row">
            <div class="card-columns"> 
                <?php

                if (isset($_REQUEST['idcat'])){
                    $idcat=$_REQUEST['idcat']; 
                
                    $results = $wpdb->get_results("
                    SELECT wp_posts.ID FROM wp_posts, wp_terms, wp_term_relationships, wp_term_taxonomy WHERE wp_terms.term_id =".$idcat." AND wp_terms.term_id = wp_term_taxonomy.term_id AND wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id AND wp_term_relationships.object_id=wp_posts.ID
                    ");
                }
                if (isset($_REQUEST['typesearch'])){
                    $typesearch=$_REQUEST['typesearch'];
                }

                if (isset($_REQUEST['search'])&& $_REQUEST['search']!="")
                {   
                    $search = ($_REQUEST['search']);
                    $results = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}posts WHERE (post_title LIKE '%".$search."%' AND  post_status='publish') ");
                }

                $no_results = "Désolé il n'y a pas de résultats ";
                    
                if ($results)
                {
                    foreach($results as $value)
                    { 
                        $post_id = $value->ID;

                        $title_que = $wpdb->get_results( "SELECT post_title FROM {$wpdb->prefix}posts WHERE  ID=$post_id ");
                        $title = $title_que[0]->post_title;

                        $link_que = $wpdb->get_results( "SELECT meta_value FROM {$wpdb->prefix}postmeta WHERE (meta_key='link' AND post_id=$post_id) ");
                        
                        $link = $link_que[0]->meta_value;
                        $content_que = $wpdb->get_results( "SELECT meta_value FROM {$wpdb->prefix}postmeta WHERE (meta_key='link_description' AND post_id=$post_id) ");
                        $content = $content_que[0]->meta_value;
                        $embed_code = wp_oembed_get ($link) ;
                        ?>
                        <div class="card"style="z-index:1;">
                            <?php
                            if ( ! empty( $embed_code) ) :
                            ?>
                            <div class= "wrap_single embed-responsive-item">
                            <div class="card-img-top embed-responsive" style="padding-top:0.5rem; text-align:center;"><?php echo $embed_code?></div>
                            </div>
                            <div class="card-body">
                                <?php
                                endif;
                                if ( ! empty( $title ) ) :
                                ?>
                                <h3 class="card-title"><a href="<?php the_permalink(); ?>"><?php echo $title; ?></a></h3>
                                
                                <?php
                                endif;
                                if ( ! empty( $content) ) :
                                ?>
                                <p><?php echo $content; ?></p>
                                <?php
                                endif;
                                ?>
                            </div>
                        </div>
                        
        
                    <?php   
                    }
                }
                else
                { echo $no_results."<br><hr>";}

                
                ?>
            </div>
        </div>
    </div>

</main>
<!-----------------------------------affichage des categories ----------------------------------------------------------------------->
<!------------------------------------Séparation page catégory search---------------------------------------------------------------->

<?php

if (!$results)
{
    $ecology_query = new WP_Query(
        [
            'post_type'      => 'ecology',
            'orderby'        => 'date',
            'order'          => 'DESC',
            'posts_per_page' => '',
            'paged'          => 1
        ]
    );
    ?>

    <main class="categorytwo " >
        <div class="container-fluid">
            <div class="row">
                <div class="card-columns">
                    <?php

                    if ( $ecology_query->have_posts() ) :
                    while ( $ecology_query->have_posts() ) :
                        $ecology_query->the_post();

                        $title = get_the_title();
                        $link = get_field('link');
                        $content= get_field('link_description');
                        $embed_code = wp_oembed_get ($link) ;

                        ?>
                        <div class="card"style="z-index:1;">
                            <?php
                            if ( ! empty( $embed_code) ) :
                            ?> 
                            <div class= "wrap_single embed-responsive-item">
                            <div class="card-img-top embed-responsive" style="text-align:center; padding-top:0.5rem"><?php echo $embed_code?></div>
                            </div>
                            <div class="card-body">
                                <?php
                                endif;
                                if ( ! empty( $title ) ) :
                                ?>
                                <h5 class="card-title"><a href="<?php the_permalink(); ?>"><?php echo $title; ?></a></h5>
                                
                                <?php
                                endif;
                                if ( ! empty( $content) ) :
                                ?>
                                <p><?php echo $content; ?></p>
                                <?php
                                endif;
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
    </main>
<?php
}    
