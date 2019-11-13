<?php
//1 : je vérifie que le formulaire  été soumis
//2 : je récupère les differents champs du formulaire
//3 : je sanitize les champs pour éviter les infiltrations
//4 : j'insère le formulaire dans la base de données

global $wpdb;

$categories = $wpdb->get_results("SELECT * 
FROM {$wpdb->prefix}terms 
JOIN {$wpdb->prefix}term_taxonomy ON {$wpdb->prefix}term_taxonomy.term_id = {$wpdb->prefix}terms.term_id 
WHERE {$wpdb->prefix}term_taxonomy.parent = 0 AND {$wpdb->prefix}term_taxonomy.taxonomy LIKE 'cat%'"
);

$tags = get_terms( array(
    'taxonomy' => 'tag',
    'hide_empty' => false,
) );


?>


<div class='container container__profil mt-4 mb-4'>
    <form  action="<?php $_SERVER['HTTP_REFERER'];?>" name="creatpost" role="form" method="POST" >
        
           
            <div class='row'> 
                <div class="col-12">
                            <h1 style="text-size:1.5.rem; padding:1rem; background-color: #181a28; text-align:center; color:white; text-transform:uppercase;font-weight:bold;">Créer un post</h1>
                </div>
            </div> 
                
            <div class='row'> 
                <div class='col-12 col-md-8'>
                    

                    <label for='form_addpost_title' class='mt-3 control-label'> Titre de l'article </label>
                    <input class='form-control' style='width:80%;' type='text' id='form_addpost_title' name='form_addpost_title' placeholder='Titre' >

                    <label for='form_addpost_description' class='mt-3 control-label'> Description de l'article </label>
                    <textarea class='form-control' style='width:80%;'  rows=6 id='form_addpost_description' name='form_addpost_description' placeholder='Description'  > 
                   </textarea>
                    <label for='post_addpost_url' class='mt-3 control-label'>Lien à afficher</label>
                    <input class='form-control' style='width:80%;' type='url' name='form_addpost_url' id='form_addpost_url' placeholder='Adresse du lien' >

                    <input type='hidden' name='form_addpost_submitted' id='form_addpost_submitted' >
                    
                    <hr>
                    <div id='form_addpost_tags'>                
                       
                       <?php

                        foreach ($tags as $tag)
                        {
                            echo "<input type='checkbox' style='font-size:0.8rem; color:#F2FDE8; font-weight:bold;' name='tag-".$tag->term_id."' id='tag-'".$tag->term_id."' > ".$tag->name.", ";
                        }
                        ?>
                                       
               
                    </div>
                    <hr>




                    <button type="submit" id="form_addpost_button" name="form_addpost_button" class="btn btn-dark">Poster votre article</button>
                </div>
                <div class='col-12 col-md-4' style='background-color:#F2FDE8;padding:2rem 1rem;border-radius:1rem;'>
                    <div class="form-group">
                        <label for="sel1">Catégories</label>

                        <?php

                        foreach ($categories as $category)
                        {
                            echo "<h5 style='margin-top:1rem;'><input name='form_addpost_category_parent' type='checkbox'> ".$category->name."</h5>";
                           
                            $sub_categories = $wpdb->get_results("SELECT *  
                                FROM wp_terms 
                                JOIN wp_term_taxonomy
                                ON wp_terms.term_id = wp_term_taxonomy.term_id
                                WHERE wp_term_taxonomy.parent=$category->term_id"
                            );
                            foreach($sub_categories as $sub_category)
                            {
                                echo "<h6 style='margin-left:1rem; font-size:0.8rem;'><input name='form_addpost_category_child' type='checkbox'> ".$sub_category->name."</h6>";
                            }
                        }?>
                      
                        

                    </div>

                </div>
            </div>
            
    
    </form>
    </div>
</main>


<?php






    

if (isset ($_POST['form_addpost_title']))
{
    $form_addpost_title       =  sanitize_text_field ($_POST['form_addpost_title']);
    $form_addpost_description =  sanitize_textarea_field ($_POST['form_addpost_description']);
    $form_addpost_url         =  sanitize_url ($_POST['form_addpost_url']);
    // $form_addpost_tags        =  sanitize_term( $_POST['form_addpost_tags'], 'tag');

    // CONEXION API REST //
$process = curl_init('http://localhost/projet-LaCueillette/wp-json/wp/v2/ecology');

/// ARRAY DATA
$data = array(
'status' => 'publish',
'title' => ['raw' => $form_addpost_title],
// 'cat1' => [], // Insérer les catégories,  
// 'cat2' => [],// Insérer les catégories,  
// 'cat3' => [],// Insérer les catégories,  
// 'tag' => [],// Insérer les tags,  
'link_description' => $form_addpost_description,
'link_acf' => $form_addpost_url 
);

$data_string = json_encode($data);
// var_dump($data_string);

curl_setopt($process, CURLOPT_TIMEOUT, 30);
curl_setopt($process, CURLOPT_POST, 1);

curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");

curl_setopt($process, CURLOPT_POSTFIELDS, $data_string);

curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);

curl_setopt($process, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',          
    // connexion basic auth
    "Authorization: Basic SnVsaWU6ZDYzPzZuODN5MlU=",                                                                  
    'Content-Length: ' . strlen($data_string))                                                                       
);

$return = curl_exec($process);
curl_close($process);
//////// DEVELOPEMENT APPERCU DU RESULTAT ///////
echo '<h2>Results</h2>';
print_r($return);
echo '<h2>Decoded</h2>';
$result = json_decode($return, true);
print_r($result);

}


