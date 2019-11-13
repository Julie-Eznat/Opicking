<?php

//Dans une page Stats 


// // Creation d'un tableau de stats pour les commentaires 

function dasboard_posts_note(){

    global $wpdb;
    $author=wp_get_current_user();

        // ici le récupère le nom d'utilisateur avec une jointure sur la table user
        $query_name= $wpdb->get_results(
        "SELECT * 
        FROM {$wpdb->prefix}comments_note 
        INNER JOIN {$wpdb->prefix}users 
        ON {$wpdb->prefix}comments_note.comments_note_user = {$wpdb->prefix}users.id 
        AND comments_note_user='$author->ID'" );

        foreach ($query_name as $results){

            $comments=$wpdb-> get_results("SELECT * 
            FROM {$wpdb->prefix}comments_note 
            INNER JOIN {$wpdb->prefix}comments 
            ON {$wpdb->prefix}comments_note.comments_note_id = {$wpdb->prefix}comments.comment_ID 
            AND comments_note_id='$results->comments_note_id'" );
            
            echo $results->user_login;
            $results->comments_note_value;

                    foreach ($comments as $comment){

                        echo            
                        $comment->comment_author;
                        $comment->comment_content;
                    };

};
}


    
    
