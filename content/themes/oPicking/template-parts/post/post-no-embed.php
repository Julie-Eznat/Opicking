<?php 


//post ID
$id=get_the_id();
$link = get_field('link');
$content= get_field('link_description');
$posttags = get_the_term_list( 
    $post->ID, 
    'tag',
    '<div class="tag"><button type="button" class="btn mr-2 btn-light btn-sm" data-toggle="button" aria-pressed="false" autocomplete="off">',
    '</button><button type="button" class="btn mr-2 btn-light btn-sm" data-toggle="button" aria-pressed="false" autocomplete="off">' ,
    '</button></div>'); //'<ul class="tag"><li>', '</li><li>','</li></ul>'

  $no_embed = 'Oops... Pas de pré-lecture disponible, il va falloir sortir du site pour consulter ce lien!';
// AUTHORS
// <button type="button" class="btn btn-primary" data-toggle="button" aria-pressed="false" autocomplete="off">
// </button>

the_post(); // queue first post
		
		$author_id = get_the_author_meta('ID');
		$curauth = get_user_by('ID', $author_id);
		
		$user_nicename    = $curauth->user_nicename;
		$display_name     = $curauth->display_name;
		$user_description = $curauth->user_description;
		$user_level       = $curauth->user_level;
		$user_url         = $curauth->user_url;
		$user_website     = $curauth->website_name;
		$user_twitter     = $curauth->twitter;
 
    rewind_posts(); // rewind the loop



?>


        <div class= "wrap_single embed-responsive-item " >

          <div class="main__link main__link no_embed  " style="">
          <div class=no_embed_description> <?php echo $no_embed; ?>  </div>
            <a class="link_no_embed" href="<?php echo $link; ?>"><?php echo $link; ?>
            </a>

          </div>
          <div class="tag_container mt-3 col-12 col-md-4 col-lg-2" >
            <?php echo $posttags    ?>
          </div>
        </div> 
      
     