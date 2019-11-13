<?php

/**
 * @link https://developer.wordpress.org/reference/functions/get_role/
 */
function update_roles_capabilities() {
    /**
     * @var WP_Role
     */
    $administrator = get_role( 'administrator' );

    $administrator->add_cap( 'edit_post_link', true );
    $administrator->add_cap( 'read_post_link', true );
    $administrator->add_cap( 'delete_post_link', true );
    $administrator->add_cap( 'edit_posts_link', true );
    $administrator->add_cap( 'edit_others_posts_link', true );
    $administrator->add_cap( 'publish_posts_link', true );
    $administrator->add_cap( 'read_private_posts_link', true );
    $administrator->add_cap( 'create_posts_link', true );

    $administrator->add_cap( 'manage_tag', true );
    $administrator->add_cap( 'edit_tag', true );
    $administrator->add_cap( 'delete_tag', true );
    $administrator->add_cap( 'assign_tag', true );

    $administrator->add_cap( 'manage_tag1',  true );
    $administrator->add_cap( 'edit_tag1', true );
    $administrator->add_cap( 'delete_tag1', true );
    $administrator->add_cap( 'assign_tag1', true );

    $administrator->add_cap( 'manage_tag2',  true );
    $administrator->add_cap( 'edit_tag2', true );
    $administrator->add_cap( 'delete_tag2', true );
    $administrator->add_cap( 'assign_tag2', true );
 
    $administrator->add_cap( 'manage_tag3',  true );
    $administrator->add_cap( 'edit_tag3', true );
    $administrator->add_cap( 'delete_tag3', true );
    $administrator->add_cap( 'assign_tag3', true );

// ici je donne  les droits à mon éditeur/Collecteur

    $editor = get_role( 'editor' );

    $editor->add_cap( 'edit_post_link', true );
    $editor->add_cap( 'read_post_link', true );
    $editor->add_cap( 'delete_post_link', true );
    $editor->add_cap( 'edit_posts_link', true );
    $editor->add_cap( 'edit_others_posts_link', false );
    $editor->add_cap( 'publish_posts_link', true );
    $administrator->add_cap( 'read_private_posts_link', false );
    $editor->add_cap( 'create_posts_link', true );

    $editor->add_cap( 'manage_tag', false );
    $editor->add_cap( 'edit_tag', true );
    $editor->add_cap( 'delete_tag', true );
    $editor->add_cap( 'assign_tag', true );

    $editor->add_cap( 'manage_tag1',  false );
    $editor->add_cap( 'edit_tag1', false );
    $editor->add_cap( 'delete_tag1', false );
    $editor->add_cap( 'assign_tag1', true );

    $editor->add_cap( 'manage_tag2',  false );
    $editor->add_cap( 'edit_tag2', false );
    $editor->add_cap( 'delete_tag2', false );
    $editor->add_cap( 'assign_tag2', true );
 
    $editor->add_cap( 'manage_tag3',  false );
    $editor->add_cap( 'edit_tag3', false );
    $editor->add_cap( 'delete_tag3', false );
    $editor->add_cap( 'assign_tag3', true );


  
    $subscriber = get_role( 'subscriber' );

    $subscriber->add_cap( 'edit_post_link', false );
    $subscriber->add_cap( 'read_post_link', true );
    $subscriber->add_cap( 'delete_post_link', false );
    $subscriber->add_cap( 'edit_posts_link', false );
    $subscriber->add_cap( 'edit_others_posts_link', false );
    $subscriber->add_cap( 'publish_posts_link', false );
    $subscriber->add_cap( 'read_private_posts_link', false );
    $subscriber->add_cap( 'create_posts_link', false );

    $subscriber->add_cap( 'manage_tag', false );
    $subscriber->add_cap( 'edit_tag', false );
    $subscriber->add_cap( 'delete_tag', false );
    $subscriber->add_cap( 'assign_tag', false );
    
    $subscriber->add_cap( 'manage_tag1',  false );
    $subscriber->add_cap( 'edit_tag1', false );
    $subscriber->add_cap( 'delete_tag1', false );
    $subscriber->add_cap( 'assign_tag1', false );

    $subscriber->add_cap( 'manage_tag2',  false );
    $subscriber->add_cap( 'edit_tag2', false );
    $subscriber->add_cap( 'delete_tag2', false );
    $subscriber->add_cap( 'assign_tag2', false );
 
    $subscriber->add_cap( 'manage_tag3',  false );
    $subscriber->add_cap( 'edit_tag3', false );
    $subscriber->add_cap( 'delete_tag3', false );
    $subscriber->add_cap( 'assign_tag3', false );
}


