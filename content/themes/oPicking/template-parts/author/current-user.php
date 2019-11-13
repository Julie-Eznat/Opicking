<?php
//0 : vérifier que le current user est connecté et donc a droit à modifier cette page ou que l'utilisateur de droit supérieur (admin) ai le droit de modifier ces infos.
//1 : on récupere les infos du current user de la base de donnée
//2 : on affiche ces infos dans le formulaire (value)
//3 : sur le click button
// 3.1 : on vérifie que l'envoi du formulaire a été effectué
// 3.2 : on récupère les valeurs des champs (modifiés ou non
// 3.3 : on contrôle les infos mises dans les champs
// 3.3.1 : si problème de champ, on affiche l'info correspondante
// 3.3.2 : sinon on met à jour la base de données
//4 : on recharge la page pour afficher les nouvelles valeurs
if( is_user_logged_in() && is_author(get_current_user_id()) ) {
        //Je récupère l'utilisateur courant. 
        $current_user = wp_get_current_user();
        $author_id    = $author;
        // echo $author_id;
        get_header();
        // ICI méthode 1
        $author_update_nicename    = get_the_author_meta('user_nicename', $author_id );
        $author_url                    = get_the_author_meta('user_url', $author_id );
        $author_update_description = get_the_author_meta('user_description', $author_id );
        $author_update_password    = get_the_author_meta('user_pass', $author_id );
        $author_update_email       = get_the_author_meta('user_email', $author_id );
        if ($author_level == '7' ){
            $author_role= 'Collecteur';
        }elseif ($author_level == '10' ){
            $author_role= 'Abonné';
        }
        ?>
            <!-- UPDATE PROFIL - FOR CURRENT   -->

            <main class="main main__profil">
                <div class="container container__profil" style=" ">
                <div class='row'>

                    <form class="form col-12 " style="text-align:center" action="<?php $_SERVER['HTTP_REFERER'];?>" role="form" method="POST" id="author_update_form">
                        <div class='row mb-3'>
                            <div class=" col-12">
                                <div class="titleprghp">
                                    <h1 class="prg" style="text-size:1.5.rem; padding:1rem; background-color: #181a28; text-align:center; color:white; text-transform:uppercase; font-weight:bold;">Information sur l'utilisateur</h1> 
                                </div>
                            </div>
                        </div>

                        <div class="row text-left">
                        
                            <div class="form-group">
                            <label for="nom" class="col-6 control-label">Pseudo :</label>
                            <div class="col-12">
                                <input type="text" class="form-control" name="author_update_nicename" id="author_update_nicename" value="<?= $author_update_nicename;?>">
                            </div>
                            </div>
                            <div class="form-group">
                            <label for="mail" class="col-6 control-label">Email :</label>
                            <div class="col-12">
                                <input type="email" class="form-control" name="author_update_email" id="author_update_email" value="<?=$author_update_email;?>">
                            </div>
                            
                            </div>   
                            
                    
                            <div class="form-group">
                            <label for="password" class="col-8 control-label">Mot de passe :</label>
                            <div class="col-12">
                                <input type="password" class="form-control" name="author_update_password" id="author_update_password" value="<?=$author_update_password;?>">
                            </div>
                            </div>
                            </div>         

                            <div class='row text-left'>

                            <label for="mail" class="col-6 control-label">Description :</label>
                            <div class="col-12">
                            
                                <textarea class="form-control" id="author_update_description" name="author_update_description" rows="5" style="width:"><?= $author_update_description;?></textarea>
                            </div>
                            </div>

                            <div class='row mt-3 text-center'>
                            <div class="col-12">
                                <input type="hidden" class="form-control" name="author_update_infos" id="author_update_infos"> 
                                Voulez vous supprimer votre compte ? <input type="checkbox" name="delete_author" id="delete_author">
                                <hr>
                                <button type='submit' class="btn btn-dark"> Mettre à jour mes informations </button>
                                
                            </div>
                            </div>     
                                    
                        </div>
                    
                        </form>
                       
                           
                        
                </div>
        <?php
        if (isset($_REQUEST['author_update_infos']))
        {
            if (!empty($_REQUEST['author_update_infos']) || !empty($_REQUEST['author_update_password']) || !empty($_REQUEST['author_update_email']) || !empty($_REQUEST['author_update_description']))
            {
   
                $author_update_nicename     = sanitize_user($_REQUEST[ 'author_update_nicename']);
                $author_update_password     = sanitize_text_field($_REQUEST[ 'author_update_password']);
                $author_update_email        = sanitize_email($_REQUEST['author_update_email']);
                $author_update_description  = sanitize_textarea_field($_REQUEST[ 'author_update_description']);
                
            // https://developer.wordpress.org/reference/functions/update_user_meta/
               // update_user_meta( $user_id, $meta_key, $meta_value, $prev_value );//
               //https://codex.wordpress.org/Function_Reference/update_user_meta//
                $miseajour=wp_update_user(
                    array("ID" => $current_user,
                    "user_nicename" => $author_update_nicename,
                    "user_email" => $author_update_email,
                    "description" => $author_update_description,
                    "user_pass" => $author_update_password
                    )
                );
                
                if($miseajour)
                {
                    echo"<h2 style='background-color: black; text-align:center; color:white;'>Mise a jour effectuée, <a href='".home_url()."'> veuillez vous reconnecter</h2>";
                }
            }
            else
            {
                echo "Il manque des informations";
            }
        }
        else 
        {
            //echo "Utilisateur non connecté";
        }
}
?>