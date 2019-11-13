<?php


   function show_good_notation(){
 
//j'affiche le formulaire de bonne notation

    echo"
    <div class='form_post_notation d-flex'>
    <div class='post_notation_like '>
    <form action='' method='post'>
     <input type='hidden' name='useful' id='useful' value='2'>
      <button type='submit' style='border:none; background:none;'>
      <img src='http://opicking.me/content/themes/oPicking/public/images/kiwi.png' title='Article utile' alt='Article utile' style='width:30px;'></button>
    ";
  //j'execute la fonction qui affiche le nombre de bonnes notations   
    display_good_notation();
  }

  function show_bad_notation(){
//j'affiche le formulaire de mauvaise notation
    echo" </div>
    
    <div class='post_notation_dislike ml-6'>
    <form action='' method='post'>
     <input type='hidden' name='no-useful' id='no-useful' value='1'>
      <button type='submit' style='border:none; background:none;'>
      <img src='http://opicking.me/content/themes/oPicking/public/images/tomate.png' title='Article pas utile' alt='Article pas utile' style='width:30px;'></button>
    ";
 //j'execute la fonction qui affiche le nombre de mauvaises notations
    display_bad_notation(); 
  }



   
function display_good_notation(){

  global $wpdb;
      get_datas_form_notation();

    
    $current_post = get_the_ID();
    $query = "SELECT COUNT(*) FROM wp_posts_note WHERE posts_note_id = '".$current_post."' AND posts_note_value = 2  " ;
    $num_good_rows = $wpdb->get_var($query);
    echo"   <span class='badge badge-light'>".$num_good_rows." </span>
    </form>
    ";
    return $num_good_rows;

  }


function display_bad_notation(){

  global $wpdb;
    get_datas_form_notation();

    $current_post = get_the_ID();
    $query = "SELECT COUNT(*) FROM wp_posts_note WHERE posts_note_id = '".$current_post."' AND posts_note_value = 1  " ;
    $num_bad_rows = $wpdb->get_var($query);
    echo "
   <span class='badge badge-light'>".$num_bad_rows." </span>
   </form>
    </div>
     
    </div>";
    return $num_bad_rows;

}

  function get_datas_form_notation()
  {
    // si l'utilisateur est enregistré
      if (is_user_logged_in()) {
        // si le bouton USEFUL est activé
          if (isset($_POST['useful'])) {
          // je stock dans la variable note, la valeur.   
              $note= $_POST['useful'];
  
        // ID Mon utilisateur courant
          $current_user = wp_get_current_user()->ID;
        // ID de l'article actuel  
          $current_post = get_the_ID();
        // creation d'une variable note, je pars du principe de note= false.  
          $vote = false;


          // je me connecte à la BDD
          global $wpdb;
   
        // Je controle qu'il n'y a pas deja un vote pour ce poste et cet utilisateur
              $query = "SELECT * FROM wp_posts_note WHERE posts_note_user ='".$current_user."' AND posts_note_id = '".$current_post."'" ;
              $num_rows = $wpdb->get_var($query);
          // S'il y a un enregistrement je passela variable vote à true. 
          if ($num_rows>0) {
              $vote = true;
          }
          // si le vote est resté à false, j'insere les donnés dans ma table
          if (!$vote) {
              $results= $wpdb->get_results(" INSERT INTO wp_posts_note (posts_note_id, posts_note_value, posts_note_user) VALUES ($current_post, $note, $current_user )");
          } else  {
            // sinon j'update la note
              $results= $wpdb->get_results("UPDATE wp_posts_note
              SET posts_note_id = $current_post, posts_note_value = $note, posts_note_user = $current_user
              WHERE posts_note_user ='".$current_user."' AND posts_note_id = '".$current_post."'");
          }
   
    }
  
      else if (isset($_POST['no-useful'])) {
        $note=$_POST['no-useful'];

        $current_user = wp_get_current_user()->ID;
        $current_post = get_the_ID();
        $vote = false;
        global $wpdb;


        $query = "SELECT * FROM wp_posts_note WHERE posts_note_user ='".$current_user."' AND posts_note_id = '".$current_post."'" ;
        $num_rows = $wpdb->get_var($query);
        // créer une variable $vote=true/false
        if ($num_rows>0) {
            $vote = true;
        }

        if (!$vote) {
            $results= $wpdb->get_results(" INSERT INTO wp_posts_note (posts_note_id, posts_note_value, posts_note_user) VALUES ($current_post, $note, $current_user )");
        } else {
            $results= $wpdb->get_results("UPDATE wp_posts_note
        SET posts_note_id = $current_post, posts_note_value = $note, posts_note_user = $current_user
        WHERE posts_note_user ='".$current_user."' AND posts_note_id = '".$current_post."'");
}
}

}
}

 





 
