<?php


function registration_validation_author( $nicename, $password, $email, $description )  { 

    global $reg_errors;
    $reg_errors = new WP_Error;
    /**
     * At this point, $_GET/$_POST variable are available
     *
     * We can do our normal processing here
     */ 
   

    /*     classe WP_Error instanciée et globalisée pour qu'elle puisse être accédée hors de la portée de la fonction.
    */    
    
    // Vérification que tous les champs sont renseignés
    if ( empty( $nicename ) || empty( $password ) || empty( $email ) || empty( $description ) ) {
        $reg_errors->add('field', 'Il manque un champ');
    }

    // Vérification que le nom d'utilisateur a plus de 6 caractères
    if ( strlen( $nicename )< 6 ) {
        $reg_errors->add( 'username_length', 'Le nom d\'utilisateur doit comporter 6 caractères' );
    }
    // Vérification que le nom d'utilisateur n'existe pas 
    if ( username_exists( $nicename ) ){
        $reg_errors->add('user_name', 'Ce nom d\'utilisateur existe déja');
    }

    // Vérification de la validité du nom d'ufunction function_contact_form() {utilisateur
    if ( ! validate_username( $nicename ) ) {
        $reg_errors->add( 'username_invalid', 'Désolé ce nom d\'utilisateur n\'est pas valide' );
    }

    // Vérification que le mot de passe a plus de 8 caractères
    if (strlen( $password )<8  ) {
        $reg_errors->add( 'password', 'Le mot de passe est trop court' );
    }
    // Vérification que l'adresse email semble valide
    if ( is_email( $email ) ) {
        $reg_errors->add( 'email_invalid', 'Il y a une erreur dans votre saisie' );
    }
    // Vérification que l'adresse email n'existe pas déja
    if ( email_exists( $email ) ) {
        $reg_errors->add( 'email', 'Il y a une erreur dans votre saisie' );
    }
    // Vérification que la description n'est pas trop longue
    if ( strlen( $description ) < 500 ) {
        $reg_errors->add( 'description', 'La description est trop longue (500 caractères max) ' );
    } 


    // On affiche les erreurs dans le formulaire
    if ( is_wp_error( $reg_errors ) ) {

        foreach ( $reg_errors->get_error_messages() as $error ) {
            echo '<div>';
            echo '<strong>Erreurs</strong>:';
            echo $error . '<br/>';
            echo '</div>';
        }

    }
}

function registration_completion_author(){

    global $reg_errors, $nicename, $password, $email, $description;
    // global $reg_errors, $nicename, $password, $email, $description;
    if ( count( $reg_errors->get_error_messages() )== 0 ) {          ////////////////////////////// a vérifier les parenthèses

        $userdata = [
        'user_login'    =>   $nicename,
        'user_email'    =>   $email,
        'user_pass'     =>   $password,
        'user_description'    =>   $description,
        
        ];

        $user = wp_insert_user( $userdata );

        echo 'Enregistrement terminé';   
    }
    else
    {
        echo 'Erreur d\'enregistrement';        
    }


}

function custom_registration_function_author() {
  // sanitize user form input
  if ( isset($_POST['maj_form'] ) ) {
    registration_validation_author(
        $_POST['nicename'],
        $_POST['password'],
        $_POST['email'],
        $_POST['description']
   

        );
    
 global $nicename, $password, $email, $description;

  $nicename   =   sanitize_user( $_POST['nicename'] );
  $password   =   esc_attr( $_POST['password'] );
  $email      =   sanitize_email( $_POST['email'] );
  $description =   sanitize_text_field( $_POST['description'] );


  registration_completion(
    $nicename,
    $password,
    $email,
    $description
  
    );

}
}

// creation d'un nouveau shortcode: [cr_custom_registration]
add_shortcode( 'registration_author', 'custom_registration_shortcode' );
 
// The callback function that will replace [book]
function registration_author_shortcode() {
    ob_start();
    custom_registration_function_author();
    return ob_get_clean();
}
// add_action ('register_form', 'registration_completion');

// // fonction d'ajout de l'utilisateur dans la base avec wp_insert_user
// function registration_completion(){

    
// }

