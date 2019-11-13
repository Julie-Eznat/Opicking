<?php

class Post_Type_Ecology
{
    // ICI NOMMER LE SOUS THEME
    public const NAME = 'ecology';
    // ICI NOMMER LES GRANDES CATEGORIES - 1 constant = 1 catégorie
    public const TAXONOMY_1 = 'cat1';
    public const TAXONOMY_2 = 'cat2';
    public const TAXONOMY_3 = 'cat3';
    public const TAXONOMY_4 = 'tag';


    public function __construct() {
        add_action( 'init', [ $this, 'register_post_type' ] );
        add_action( 'init', [ $this, 'register_taxonomies' ] );
      
    }

    /**
     * Création du Custom Post Type (CPT / CCT) 
     */
    public function register_post_type() {
        register_post_type(
            self::NAME, 
            [
                /**
                 * @link https://developer.wordpress.org/reference/functions/get_post_type_labels/
                 */
                'labels' => [ 
                    'name'               => 'posts',
                    'singular_name'      => 'Post',
                    'menu_name'          => 'Thème Ecologie',
                    'all_items'          => 'Tous les posts', 
                    'add_new_item'       => 'Ajouter un post',
                    'edit_item'          => 'Editer un post',
                    'new_item'           => 'Nouveau post',
                    'view_item'          => 'Voir le post',
                    'view_items'         => 'Voir les posts',
                    'search_items'       => 'Rechercher des posts',
                    'not_found'          => 'Aucun post trouvé',
                    'not_found_in_trash' => 'Aucun post trouvé dans la corbeille',

                    'attributes'         => '',
                    'archives'           => 'Archives des Posts',
                  
                    'items_list'            =>  'Liste des posts', 
                    'items_list_navigation' =>  'Navigation dans la liste des posts.', 
                    'item_updated'          =>  'Post mis à jour.', 
                    'filter_items_list'     =>  'Filtrer dans la liste des posts.'
                ],
                'label'                 => __( 'Ecologie', 'text_domain' ),
                'description'           => __( 'Tous les articles de ce thème.', 'text_domain' ),
                'supports'              => array( 'title', 'thumbnail','comments', 'customs-fields', 'page-attributes', 'post-formats' ),
               
                'menu_position'       => 1,
                'menu_icon'           => 'dashicons-admin-site-alt',
                'hierarchical'          => true,
                'public'                => true,
                'show_ui'               => true,
                'show_in_menu'          => true,
                'menu_position'         => 5,
                'show_in_admin_bar'     => true,
                'show_in_nav_menus'     => true,
                'has_archive'      => true,
                'can_export'       => true,
                'delete_with_user' => false,
                'capabilities' => [
                    'edit_post'          => 'edit_post_link', 
                    'read_post'          => 'read_post_link_link', 
                    'delete_post'        => 'delete_post_link', 
                    'edit_posts'         => 'edit_posts_link', 
                    'publish_posts'      => 'publish_posts_link',   
                    'create_posts'       => 'create_posts_link', 
                ],
                'exclude_from_search'   => false,
                'publicly_queryable'    => true,
                'capability_type'       => 'post',
                'show_in_rest'        => true, 
            ]
        );
    }
    public function register_taxonomies() {
      // On créé un register taxonomy par grandes catégories
        $this->register_taxonomy_1();
        $this->register_taxonomy_2();
        $this->register_taxonomy_3();
        $this->register_taxonomy_4();
    }

    
    private function register_taxonomy_1() {
        register_taxonomy(
            self::TAXONOMY_1,
            self::NAME,
            [
                'label'             => 'Catégorie 1',
                'public'            => true,
                'show_in_rest'      => true,
                'show_admin_column' => true,
                'hierarchical'      => true,
                'capabilities' => [
                    'manage_terms'          => 'manage_tag1', 
                    'edit_terms'            => 'edit_tag1', 
                    'delete_terms'           => 'delete_tag1', 
                    'assign_terms'         => 'assign_tag1', 
                    
                ],  
            ]
        );
    }
    
    private function register_taxonomy_2() {
        register_taxonomy(
            self::TAXONOMY_2,
            self::NAME,
            [
                'label'             => 'Catégorie 2',
                'public'            => true,
                'show_in_rest'      => true,
                'show_admin_column' => true,
                'hierarchical'      => true,
                'capabilities' => [
                    'manage_terms'          => 'manage_tag2', 
                    'edit_terms'            => 'edit_tag2', 
                    'delete_terms'           => 'delete_tag2', 
                    'assign_terms'         => 'assign_tag2', 
                    
                ],  
            ]
        );
    }
    
    private function register_taxonomy_3() {
        register_taxonomy(
            self::TAXONOMY_3,
            self::NAME,
            [
                'label'             => 'Catégorie 3',
                'public'            => true,
                'show_in_rest'      => true,
                'show_admin_column' => true,
                'hierarchical'      => true,
                'capabilities' => [
                    'manage_terms'          => 'manage_tag3', 
                    'edit_terms'            => 'edit_tag3', 
                    'delete_terms'           => 'delete_tag3', 
                    'assign_terms'         => 'assign_tag', 
                    
                ],  
            ]
        );
    }
    private function register_taxonomy_4() {
        register_taxonomy(
            self::TAXONOMY_4,
            self::NAME,
            [
                'label'             => 'Tag',
                'public'            => true,
                'show_in_rest'      => true,
                'show_admin_column' => true,
                'hierarchical'      => false,
                'capabilities' => [
                    'manage_terms'          => 'manage_tag', 
                    'edit_terms'             => 'edit_tag', 
                    'delete_terms'            => 'delete_tag', 
                    'assign_terms'         => 'assign_tag', 
                    
                ],                
            ]
        );
    }





}