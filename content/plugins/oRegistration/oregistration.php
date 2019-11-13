<?php
/*
  Plugin Name: oRegistration
  Plugin URI: http://www.opicking.me
  Description: Users registration form, utiliser le shortcode [cr_custom_registration] ou  <?php custom_registration_function(); ?>
  Version: 1.0
  Author: opicking
  Author URI: http://www.opicking.me
 */
function registration_form() {
echo'
  
  <div class="row text-center">
  <div class="col no-padding text-center">
  <p class="h4 mb-4 titrejaune">Vous enregistrer</p>
  </div>
  </div>
  
    <div class="container-fluid footer_form ">
        <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
        <div class="row text-center">            
            <div class="col-12 col-lg-2">
                <div>
                    <label class="label__register" for="username">Nom d\'utilisateur</label> <br>
                    <input class="label__register__input" type="text" name="username" id="username" value="' . ( isset( $_POST['username'] ) ? $username : null ) . '"  class="form-control" placeholder="Min 6 caractères ">
                </div>
            </div>
            <div class="col-12 col-lg-2">
                <div>
                    <label class="label__register"for="password">Mot de passe</label> <br>
                    <input class="label__register__input" type="password" name="password" id="password" value="' . ( isset( $_POST['password'] ) ? $password : null ) . '"  class="form-control" placeholder="Min 8 caractéres">
                </div>
            </div>
            <div class="col-12 col-lg-2">
                <div>
                    <label class="label__register" for="firstname">Prénom </label> <br>
                    <input class="label__register__input" type="text" name="firstname" id="firstname" value="' . ( isset( $_POST['firstname'] ) ? $firstname : null ) . '"  class="form-control" placeholder="Prénom">
                </div>
            </div>
            <div class="col-12 col-lg-2">
                <div>
                    <label class="label__register" for="lastname">Nom</label> <br>
                    <input class="label__register__input" type="text" name="lastname" id="lastname" value="' . ( isset( $_POST['lastname'] ) ? $lastname : null ) . '"  class="form-control" placeholder="Nom">
                </div>
            </div>
            <div class="col-12 col-lg-2">
                <div>
                <label class="label__register" for="email">Courriel</label> <br>
                <input class="label__register__input" type="text" name="email" id="email" value="' . ( isset( $_POST['email'] ) ? $email : null ) . '"  class="form-control" placeholder="Votre adresse courriel">
                </div>
            </div> 
            <div class="btn-register col-12  col-lg-2"> 
            <div>
            <label class="label__register" for="lastname"></label> <br>
                <button class=" btn btn-sm btn-info btn-block label__register__validate" type="submit" name="submit">
                    Vous inscrire
                </button>
            </div>
        </div>
        </form>
      <hr>
    </div>
    </div>
    ';
}
function registration_validation( $username, $password, $firstname, $lastname, $email)  {
/*     classe WP_Error instanciée et globalisée pour qu'elle puisse être accédée hors de la portée de la fonction.
 */    
    global $reg_errors;
    $reg_errors = new WP_Error;
    // Vérification que tous les champs sont renseignés
    if ( empty( $username ) || empty( $password ) || empty( $email ) || empty( $lastname ) || empty( $firstname )) {
        $reg_errors->add('field', 'Il manque un champ');
    }
    
    // Vérification que le nom d'utilisateur a plus de 6 caractères
    if ( strlen( $username )< 6 ) {
        $reg_errors->add( 'username_length', 'Le nom d\'utilisateur est trop court' );
    }
    // Vérification que le nom d'utilisateur n'existe pas 
    if ( username_exists( $username ) ){
        $reg_errors->add('user_name', 'Ce nom d\'utilisateur existe déja');
    }
    
    // Vérification de la validité du nom d'utilisateur
    if ( ! validate_username( $username ) ) {
        $reg_errors->add( 'username_invalid', 'Désolé ce nom d\'utilisateur n\'est pas valide' );
    }
    // Vérification que le mot de passe a plus de 8 caractères
    if (strlen( $password )<8  ) {
        $reg_errors->add( 'password', 'Le mot de passe est trop court' );
    }
    // Vérification que l'adresse email semble valide
    if ( is_email( $email ) ) {
        $reg_errors->add( 'email_invalid', 'Adresse courriel non valide' );
    }
    
    // Vérification que l'adresse email n'existe pas déja
    if ( email_exists( $email ) ) {
        $reg_errors->add( 'email', 'Le courriel existe déja' );
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
// fonction d'ajout de l'utilisateur dans la base avec wp_insert_user
function registration_completion(){

    global $reg_errors, $username, $password, $firstname, $lastname, $email;
    if ( count( $reg_errors->get_error_messages() )== 0 ) {          ////////////////////////////// a vérifier les parenthèses
        $userdata = [
        'user_login'    =>   $username,
        'user_email'    =>   $email,
        'user_pass'     =>   $password,
        'first_name'    =>   $firstname,
        'last_name'     =>   $lastname
        ];
        $user = wp_insert_user( $userdata );
        if (!is_wp_error($user)) {
            echo '<p style=\text-align:center; font-weight:bold; color:white;\">Enregistrement terminé, vous pouvez vous connecter.</p>';
        }
        else {
            echo "erreur denregistrement";
        }   
    }
    else
    {
        echo '<p style=\text-align:center; font-weight:bold; color:red;\">Erreur d\'enregistrement.</p>';
        
    }
}
// fonction qui fait appel aux autres
function custom_registration_function() {
    if ( isset($_POST['submit'] ) ) {
        registration_validation(
        $_POST['username'],
        $_POST['password'],
        $_POST['email'],
        $_POST['firstname'],
        $_POST['lastname']
        );
         
        // nettoyage des inputs
        global $username, $password, $email, $firstname, $lastname;
        $username   =   sanitize_user( $_POST['username'] );
        $password   =   esc_attr( $_POST['password'] );
        $email      =   sanitize_email( $_POST['email'] );
        $firstname =   sanitize_text_field( $_POST['firstname'] );
        $lastname  =   sanitize_text_field( $_POST['lastname'] );
 
 
        // call @function complete_registration to create the user
        // only when no WP_error is found
        registration_completion(
        $username,
        $password,
        $email,
        $firstname,
        $lastname
        );
    }
 
    registration_form(
        $username,
        $password,
        $email,
        $firstname,
        $lastname
        );
}
// creation d'un nouveau shortcode: [cr_custom_registration]
add_shortcode( 'cr_custom_registration', 'custom_registration_shortcode' );
 
// The callback function that will replace [book]
function custom_registration_shortcode() {
    ob_start();
    custom_registration_function();
    return ob_get_clean();
}