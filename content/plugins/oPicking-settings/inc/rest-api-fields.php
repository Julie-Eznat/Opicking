<?php

add_action( 'rest_api_init', 'opicking_register_fields' );

/**
 * @link https://developer.wordpress.org/rest-api/extending-the-rest-api/modifying-responses/#using-register_rest_field
 * @link https://developer.wordpress.org/reference/functions/register_rest_field/
 */
function opicking_register_fields() {
    

    register_rest_field( 
        'ecology', 
        'link_acf', [
        'get_callback'    => 'read_acf_field_link',
        'update_callback' => 'update_acf_field_link',
        'schema'          => null,
      ] );

      register_rest_field( 
        'ecology', 
        'link_description', [
        'get_callback'    => 'read_acf_field_link_description',
        'update_callback' => 'update_acf_field_link_description',
        'schema'          => null,
      ] );
   

    register_rest_field(
        'ecology',
        'authorName',
        [
            'get_callback' => 'opicking_get_author_name'
        ]
    );

    register_rest_field(
        'ecology',
        'authorId',
        [
            'get_callback' => 'opicking_get_author_id'
        ]
    );
        
}




/**
 * @link https://developer.wordpress.org/reference/functions/get_the_author_meta/
 */
function opicking_get_author_name( $ecology ) {
    $authorName = get_the_author_meta(
        'nickname',
        $ecology['author']
    );

    return $authorName;
}
function opicking_get_author_id( $ecology ) {
    $authorId = get_the_author_meta(
        'ID',
        $ecology['ID']
    );

    return $authorId;
}



function acf_to_rest_api($response, $post) {
    if (!function_exists('get_field')) 
   
    return $response;
 
    if (isset($post)) {
       
    $acf = get_fields($post->id);
    $response->data['fields'] = $acf;

    }

    return $acf;
}




function read_acf_field_link( $object, $field_name, $request ) {
    $field_name= 'link';
  return get_field( $field_name, $object[ 'id' ] );
}

function update_acf_field_link( $value, $object, $field_name ) {
    $field_name= 'link';
  if ( ! $value || ! is_string( $value ) ) {
    return;
  }

  return update_field( $field_name, strip_tags( $value ), $object->ID );
}


function read_acf_field_link_description( $object, $field_name, $request ) {
    $field_name= 'link_description';
    
  return get_field( $field_name, $object[ 'id' ] );
}

function update_acf_field_link_description( $value, $object, $field_name ) {
    $field_name= 'link_description';

  if ( ! $value || ! is_string( $value ) ) {
    return;
  }

  return update_field( $field_name, strip_tags( $value ), $object->ID );
}