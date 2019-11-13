<?php

// FONCTION DE TEST DU PLUGIN 

// FONCTION NOTATION POST

global $wpdb;
$id_post = 272;
$user_id = 16;

 ("SELECT * FROM `wp_posts_note` WHERE posts_note_user='$user_id' AND posts_note_id='$id_post'");


