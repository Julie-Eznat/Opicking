<?php


   function show_good_comment_notation(){
    $current_comment = get_comment_ID(); 
    echo"
    <div class='form_post_notation d-flex'>
    <div class='post_notation_like '>
    <form action='' method='post'>
     <input type='hidden' name='useful".$current_comment."' id='useful' value='2'>
     
     <button type='submit' style='border:none; background:none;'>
     <img src='http://opicking.me/content/themes/oPicking/public/images/poire.png' title='Article utile' alt='Article utile' style='width:20px;'></button>

    ";
    display_good_comment_notation();
  }

  function show_bad_comment_notation(){
    $current_comment = get_comment_ID(); 
    echo" </div>

    <div class='post_notation_dislike ml-6'>
    <form action='' method='post'>
     <input type='hidden' name='no-useful".$current_comment."' id='no-useful' value='1'>
     <button type='submit' style='border:none; background:none;'>
     <img src='http://opicking.me/content/themes/oPicking/public/images/cerise.png' title='Pas Utile' alt='Article pas utile' style='width:20px;'></button>
    ";
    display_bad_comment_notation();
  }


  function get_datas_form_comment_notation()
  {
      if (is_user_logged_in()){
          $current_comment = get_comment_ID();

          if (isset($_POST['useful'.$current_comment])) {

              $note=($_POST['useful'.$current_comment]);
       
     
          $current_user = wp_get_current_user()->ID;
          $current_comment = get_comment_ID();
  
          $vote = false;

          global $wpdb;

          $query = "SELECT * FROM wp_comments_note WHERE comments_note_user ='".$current_user."' AND comments_note_id = '".$current_comment."'" ;
          $num_rows = $wpdb->get_var($query);
          // créer une variable $vote=true/false
          if ($num_rows>0) {
              $vote = true;
          }
         
          if (!$vote) {
              $results= $wpdb->get_results(" INSERT INTO wp_comments_note (comments_note_id, comments_note_value, comments_note_user) VALUES ($current_comment, $note, $current_user )");
          } else {
              $results= $wpdb->get_results("UPDATE wp_comments_note
       SET comments_note_id = $current_comment, comments_note_value = $note, comments_note_user = $current_user
       WHERE comments_note_user ='".$current_user."' AND comments_note_id = '".$current_comment."'");
          }
   
         
      }
      if (isset($_POST['no-useful'.$current_comment])) {

        $note=($_POST['no-useful'.$current_comment]);
 

          $current_user = wp_get_current_user()->ID;
          $current_comment = get_comment_ID();

          $vote = false;

          global $wpdb;

          $query = "SELECT * FROM wp_comments_note WHERE comments_note_user ='".$current_user."' AND comments_note_id = '".$current_comment."'" ;
          $num_rows = $wpdb->get_var($query);
          // créer une variable $vote=true/false
          if ($num_rows>0) {
              $vote = true;
          }
        
          if (!$vote) {
              $results= $wpdb->get_results(" INSERT INTO wp_comments_note (comments_note_id, comments_note_value, comments_note_user) VALUES ($current_comment, $note, $current_user )");
          } else {
              $results= $wpdb->get_results("UPDATE wp_comments_note
      SET comments_note_id = $current_comment, comments_note_value = $note, comments_note_user = $current_user
      WHERE comments_note_user ='".$current_user."' AND comments_note_id = '".$current_comment."'");
    }

   
    }
  }
}
 


function display_good_comment_notation(){

  global $wpdb;
      get_datas_form_comment_notation();

    
    $current_comment = get_comment_ID();
    $query = "SELECT COUNT(*) FROM wp_comments_note WHERE comments_note_id = '".$current_comment."' AND comments_note_value = 2  " ;
    $num_good_comments_row = $wpdb->get_var($query);
    echo"   <span class='badge badge-light'>".$num_good_comments_row." </span>
    </form>
    ";
    return $num_good_comments_row;
}
  
  function display_bad_comment_notation(){

    global $wpdb;

      get_datas_form_comment_notation();

      $current_comment = get_comment_ID();
      $query = "SELECT COUNT(*) FROM wp_comments_note WHERE comments_note_id = '".$current_comment."' AND comments_note_value = 1  " ;
      $num_bad_comments_row = $wpdb->get_var($query);
      echo "
      <span class='badge badge-light'>".$num_bad_comments_row." </span>
      </form>
        </div>
        </div>";
      return $num_bad_comments_row;
    
  }

