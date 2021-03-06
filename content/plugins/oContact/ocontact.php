<?php
/*
Plugin Name: oContact 
Description: Un plugin fait par la Dream Team Rocket pour le site o'Picking.
Author: DTR - Dream Team Rocket 
Version: 1.0
*/

if ( ! defined( 'WPINC' ) ) {
    http_response_code( 404 );
    exit;
}

define( 'OCONTACT_VERSION', '1.0' );

$plugin_dir_path = plugin_dir_path( __FILE__ );

///////////////// CREATION TABLE DES COURRIELS RECUS


register_activation_hook (__FILE__, 'function_table_contact_install');

   function function_table_contact_install(){
    global $wpdb;

    $table_name = $wpdb->prefix.'contact';
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE " . $table_name ."( 
        id bigint(20) NOT NULL AUTO_INCREMENT,
        contact_ip varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
        contact_referer varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
        contact_date datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
        contact_email varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
        contact_message text COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
        contact_firstname varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
        contact_lastname varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
        contact_telephone varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
        PRIMARY KEY id (id)
      )". $charset_collate .";";
      dbDelta( $sql );
}

///////////////// CREATION TABLE DES QUESTIONS POUR VALIDATION FORMULAIRE


register_activation_hook (__FILE__, 'function_table_questions_install');

function function_table_questions_install(){

 global $wpdb;

  $table_name = $wpdb->prefix.'user_questions';

   $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name ( 
        id bigint(20) NOT NULL AUTO_INCREMENT,
        question_question varchar(250) COLLATE utf8mb4_unicode_520_ci NOT NULL,
        question_response1 varchar(250) COLLATE utf8mb4_unicode_520_ci NOT NULL , 
        question_reponse2 varchar(250) COLLATE utf8mb4_unicode_520_ci NOT NULL ,
        question_reponse3 varchar(250) COLLATE utf8mb4_unicode_520_ci NOT NULL,
        question_answer bigint(20) NOT NULL ,
        PRIMARY KEY id (id)

      ) $charset_collate;";
     //comments_note_id - id de la questions

      require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
      dbDelta( $sql );

      // Adding default values
}






///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////// FONCTIONS FORMULAIRE
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function ocontact()
{
    contact_form();
    if (isset($_POST['contact_submit']))
    {

        //------------------RECUPERATION DES INFOS DU MESSAGE ET SANITISATION-------------------------//
        if(isset($_POST['contact_firstname'])&&isset($_POST['contact_lastname'])&&isset($_POST['contact_mail'])&&isset($_POST['contact_message']))
        {
            
            $mail_admin = get_bloginfo('admin_email');
            echo "mail admin : ". $mail_admin;
            $urlsite = "http://wwww.opicking.me";
var_dump( $mail_admin);
            //recupération des infos du formulaire, on pourrait factoriser la récupération du POST qui est un tableau associatif
            $contact_firstname = $_POST['contact_firstname'];
            $contact_lastname = $_POST['contact_lastname'];
            $contact_mail = $_POST['contact_mail'];
            $contact_message = $_POST['contact_message'];
            if (isset($_POST['contact_telephone']))
            {
                $contact_telephone = $_POST['contact_telephone'];
                //formate l'affichage du tél sous la forme 01 02 03 04 05
                $contact_telephone = wordwrap(sanitize_text_field( $contact_telephone ), 2, ' ', true);
            }
            else 
            {
                $contact_telephone="Non renseigné";
            }

            //on nettoie les chaines de caractères des champs pour éviter les injections malsaines de codes dans le formulaire (sanitize)
            $contact_firstname = sanitize_text_field( $contact_firstname );
            $contact_lastname = sanitize_text_field( $contact_lastname );
            $contact_mail = sanitize_email( $contact_mail );
            $contact_message = sanitize_textarea_field( $contact_message ); 

            //petites infos de tracking....
            $contact_ip =  $_SERVER['REMOTE_ADDR'] ;
            $contact_date = date("Y-m-d h:i:sa");
            // de quelle page vient l'utilisateur
            $contact_referer = $_SERVER['HTTP_REFERER'];


            //enregistrement dans la table
            global $wpdb;
            
            $wpdb->insert(
              $wpdb->prefix.'contact',
              [
                  'contact_ip' => $contact_ip,
                  'contact_date' => $contact_date,
                  'contact_email' => $contact_mail,
                  'contact_message' => $contact_message,
                  'contact_firstname' => $contact_firstname,
                  'contact_lastname' => $contact_lastname,
                  'contact_telephone' => $contact_telephone,
              ]
              );


            //envoi à l'adresse de l'administrateur
            $to = $mail_admin;
            //sujet du message
            $subject = 'Courriel du site oPicking';
            // reconstruction du message en vue d'une présentation plus lisible à la réception, au format html et non texte brut
            $message = "
                <html><body>
                <h1>MESSAGE DU SITE OPICKING</h1>
                <table style='border-color: #666; width:100%; border:10px grey solid;' cellpadding='2'>
                        <tr style='background: #eee; border:1px grey dotted;'>
                        <td style='border:1px grey dotted;'><h2>Nom : </h2> </td><td style='border:1px grey dotted;'>".$contact_firstname."</td></tr>
                        <tr ><td style='border:1px grey dotted;'><h2>Prénom : </h2> </td><td style='border:1px grey dotted;'>".$contact_lastname."</td></tr>
                        <tr><td style='border:1px grey dotted;'><h2>Email : </h2> </td><td style='border:1px grey dotted;'>".$contact_mail."</td></tr>
                        <tr><td style='border:1px grey dotted;'><h2>Téléphone : </h2> </td><td style='border:1px grey dotted;'>".$contact_telephone."</td></tr>
                        <tr><td style='border:1px grey dotted;'><h2>Date : </h2> </td><td style='border:1px grey dotted;'>".$contact_date."</td></tr>
                        <tr><td style='border:1px grey dotted;'><h2>IP : </h2> </td><td style='border:1px grey dotted;'>".$contact_ip."<a href='https://www.hostip.fr/' target='blank'>Lien</a></td></tr>
                        <tr><td style='border:1px grey dotted;'><h2>Referer : </h2> </td><td style='border:1px grey dotted;'>".$contact_referer."</td></tr>
                        <tr><td style='border:1px grey dotted;'><h2>Message : </h2></td><td style='border:1px grey dotted;'>.$contact_message.</td></tr>
                </table>
                </body></html>
            ";


            //création des entêtes de mails, au format html, avec encodage UTF-8
            $headers = "From: " . $contact_mail . "\r\n";
            $headers .= "Reply-To: ". $contact_mail . "\r\n"; 
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset= utf8\n";

            // utilisation de la fonction mail de php pour envoyer le message à l'administrateur
            // envoi du message de confirmation à l'utilisateur si l'envoi a mail admin n'a pas eu d'échec 
            if (mail($to, $subject, $message, $headers))
            {
                $messageback = "<b>Bonjour ".$contact_lastname." ".$contact_firstname.", votre message a <a href='".$urlsite."'>".get_bloginfo('name')." a bien été envoyé, nous y répondrons au plus vite.<br>Veuillez ne pas répondre àn ce message";
                // $headersback = "From: " . $contact_mail . "\r\n";
                // $headersback .= "Reply-To: ". $contact_mail . "\r\n";
                $headersback = "MIME-Version: 1.0\r\n";
                $headersback .= "Content-Type: text/html; charset= utf8\n";
                if (mail($contact_mail, 'Message à oPicking',$messageback, $headersback)){ echo "email envoyé";}else{echo "message non envoyé";}
            }

        }
        else {
            echo "il manque :";
            if(!isset($_POST['contact_firstname'])){echo " prénom,";}
            if(!isset($_POST['contact_lastname'])){echo " nom";}
            if(!isset($_POST['contact_mail'])){echo " mail,";}
            if(!isset($_POST['contact_message'])){echo " message,";}
        }
    }
}


//fonction qui affiche le formulaire
function contact_form(){
    if(!isset($_POST['contact_firstname'])){$firstname = '';}
    if(!isset($_POST['contact_lastname'])){$lastname = '';}
    if(!isset($_POST['contact_mail'])){$contact_name = '';}
    if(!isset($_POST['contact_message'])){$contact_message='';}
    echo"
        
    <div  class='container'>
            <div class='contact__form text-center'>
                <h2>Restez en  <span class='titrejaune'>Contact avec nous</span></h2>
                <p class='form_contact_content'>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ad ipsam dicta</p> 
                <form method='POST' action='' >
                <div class='row'> 
                   
                        <div class='col-12 col-md-6 contact_left'>
                                <div class='form-group'>
                                    <input type='text' class='form-control' id='contact_firstname' name='contact_firstname' placeholder='Entrez votre nom*'>
                                </div>
                                <div class='form-group'>
                                    <input type='text' class='form-control' id='contact_lastname' name='contact_lastname' placeholder='Entrez votre prénom*''>
                                </div>
                                <div class='form-group'>
                                    <input type='email' class='form-control' id='contact_mail' name='contact_mail' placeholder='Entrez votre adresse email*'>
                                </div>

                        </div>
                        <div class='col-12 col-md-6 contact_right'>
                            <div class='form-group'>
                                <textarea class='form-control' id='contact_message' name='contact_message'  rows='5' placeholder='Votre message'></textarea>
                                <small id='emailHelp' class='form-text text-muted'>* Champs obligatoires</small>
                                <button type='submit' name='contact_submit'>Envoyer</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div> 
    </div>
</section>

    ";
}
