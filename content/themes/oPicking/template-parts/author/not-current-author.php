<?php

$author_id=$author;

// ICI on récupère le nom de posts des auteurs
function count_post($author){

  global $wpdb;
   $query = "SELECT COUNT(*) FROM wp_posts WHERE post_author = '".$author."' AND post_type = 'ecology' AND post_status='publish' " ;
   $num_posts = $wpdb->get_var($query);
   return  $num_posts;
}
 echo $num_posts;
//Je récupère l'utilisateur courrant. 
$current_user = wp_get_current_user();



// ICI méthode 1
$author_nicename = get_the_author_meta('user_nicename', $author_id );
$author_url = get_the_author_meta('user_url', $author_id );

$author_description = get_the_author_meta('user_description', $author_id );

$author_level = get_the_author_meta('user_level', $author_id );

if ($author_level == '7' ){
  $author_role= 'Cueilleur';
}elseif ($author_level == '0' ){
  $author_role= 'Abonné';
}elseif ($author_level == '10' ){
  $author_role= 'Admin';
};





get_header();

?>
<!-- UPDATE PROFIL - FOR CURRENT   -->

<main class="main main__profil">
    <div class="container container__profil" style=" ">
    <div class='row text-left'>


<div class="mb-4 col-12 d-flex">
          <div class="titleprghp">
              <h3 class="prg"> Information sur l'utilisateur</h3> 
          </div>
</div>
              
        <div class='col-6'>
        

        
          <div class="mb-3 col add__post__title">
            <div  class="col-12  ">Pseudo :
              <span class="author__info col-12">
                <?= $author_nicename?>
              </span>
                  </div>
                </div>
                <div class="mb-3 col add__post__url">
                <div  class="col-12 ">Nombre de posts :
                  <span class="col-6">
                 <?php echo count_post($author); ?>
                  </span>
            </div>
          </div>   
        
        
         <div class='mb-3 col add__post__description'>

          <div  class="col-12 ">Description :
            <span class="author__infocol-12">
            <?php echo $author_description ?>
            </span>
          </div>
         </div>

        
        </div>
       
        
        <div class='col-6'>
        

        
          <div class="mb-3 col add__post__title">
            <div  class="col-12  ">Rôle :
              <span class="author__info col-12">
                <?= $author_role?>
              </span>
                  </div>
                </div>
                <div class="mb-3 col add__post__url">
                <div  class="col-12 ">Site référence :
                  <span class="col-6">
                   <?= $author_url ?>
                  </span>
            </div>
          </div>   
        
        
        

        
        </div>
     
        
    
        </div>     
    </div>

    </div>

    <div class="container container_posts" style=" ">
      <div class='row text-left'>
              <div class="col-12">
         
                      <h3 class="prg"> Liste des articles postés</h3> 
            
              </div>


      </div> 
        <div class='row text-left'>

          <?php
            $url="http://localhost/projet-LaCueillette/wp-json/wp/v2/ecology?per_page=100";
            $ch = curl_init();
          
            
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL,$url);
            $result=curl_exec($ch);
            $posts = json_decode($result, true);
          
      
          
          foreach ($posts as  $post) 
          { 
            if($post['authorId'] === $author_id) 
               {   
            
            ?>
            <div class="col-6 mt-4 bold">  
               <?php echo $post['title']["rendered"] ?>  
            </div>
         
            <div class="col-4 mt-4"> 
              <?php echo date('F j, Y', strtotime($post['date'])); ?> 
            </div>

            <a href="<?php echo $post['link']?>" class="col-2 src_post " >

            <button class=" btn btn-dark btn-sm mt-4 "style="">Voir l'article</button>

            </a> 
          <?php }
          } 
          
          ?>

        </div> 

    
       
    </div>    
</main>



     
        