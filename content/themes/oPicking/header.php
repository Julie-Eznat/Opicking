<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
  <title>oPicking</title>
  <link rel="stylesheet" href="css/style.css" />
</head>
<body <?php body_class(); ?>>
 <?php  $user = wp_get_current_user(); $user_nicename= $user->user_nicename;
 
 
 
// $cat1 =  get_terms( array( 
//   'taxonomy' => 'cat1',
//   'parent'   => 0
// ) );
// var_dump($cat1);
// $cat2 =  get_terms( array( 
//   'taxonomy' => 'cat2',
//   'parent'   => 0
// ) );
// $cat3 =  get_terms( array( 
//   'taxonomy' => 'cat3',
//   'parent'   => 0
// ) );
// $sscat1 =  get_terms( array( 
//   'taxonomy' => 'cat1',
//   'childless' => true,
 
// ) );
// $sscat2 =  get_terms( array( 
//   'taxonomy' => 'cat2',
//   'childless' => true,
  
// ) );
// $sscat3 =  get_terms( array( 
//   'taxonomy' => 'cat3',
//   'childless' => true,
 
// ) );
?>
  <!--Layout header-->

  
  <header class="header" >
    <div class="header__container container-fluid"> 
      <div class="header__container__row  row ">
        <div class="header__container__row__col     header__navbar col no-padding">
          <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid d-flex flex-row justify-content-between">
                <div class="m-r-auto">
                <a class="navbar-brand " href="http://opicking.me"> 
                  <img src="<?php echo get_template_directory_uri(); ?>/app/assets/images/opicking.png" alt="" class="header__logo">
                  <span class= "logo_name" >  oPicking</span></a>
                </div>
        
                <div class="">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
        
                    <div class="collapse navbar-collapse" id="navbarsExample07">
                    <ul class="navbar-nav mr-auto">
          
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown07" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Catégories</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown07">
          
                            <?php

                              dynamic_sidebar( 'Widgets de la nav_bar' ); 
                              ?>  
                        
                      
                      
                    </ul>
                  
                    <form class="form-inline my-2 my-md-0" type="GET" id="searchform" action="<?php the_permalink(149);?>?typesearch=word">
                      <input class="form-control" type="text" placeholder="Search" aria-label="Search" name="search" id="search">
                      <span class="input-group-btn">
                        <button class="btn btn-default" id="search_user"><i  class="fa fa-search" aria-hidden="true"></i></button>
                        </span>
                    </form>
                </div>
              </div>
           

           
              <?php 
                  //on vérifie que le formulaire n'a pas été validé
                  if(isset($_POST["login"])){
                    opicking_login();
                  }
                  if(isset($_POST["logout"])){
                    opicking_logout();
                  }
              ?>

              <?php if(!is_user_logged_in()){ ?>
              <button id="login_user"><i  class="fa fa-user" aria-hidden="true"></i></button>
              <?php } else {?>
              <button id="logout_user"><i  class="fa fa-sign-out" aria-hidden="true"></i></button>
                 <a href="<?=get_home_url().'/author/'.$user_nicename;?>"><i class="fa fa-id-card" aria-hidden="true" style="color:white; background:none; border:none;"></i></a>
               <?php }?>
              </div>
             
          </div>
        </nav>
      </div>
    </div>
  </div>

<!--MODALE D'AFFINAGE RECHERCHE-->
<div id="search_options">
      <div class="container">
        <div class="row">
            <div class="col-12 col-md-2">
             Affiner la recherche
            </div>
            <div class="col-12 col-md-10">
              <input type="checkbox" name="search_tag_checkbox">Tags <input type="checkbox" name="search_video_checkbox">Video 
              <div class="form-group">
                <label for="sel1">Filtrer par</label>
                <select class="form-control" id="form_addpost_category">
                    <option>Par date</option>
                    <option>Par popularité</option>
                </select>
                <input type="checkbox" name="search_orderup_checkbox">Ordre croissant <input type="checkbox" name="search_orderdown_checkbox">Ordre décroissant
            </div>
              
            </div> 
        </div>
      </div>
  </div>

  <!--MODALE DE CONNEXION-->
  <div id="form_login">
    <form class="container" action="" method='post'>
      <div class="row">
          <div class="col-12 col-md-3">
            <label class='my-username' >Connection</label><br> 
            <input type='text' name='username' class='text' value=''>
          </div>
          <div class="col-12 col-md-3">
            <label class='my-password' >Mot de passe</label><br>
            <input type='password' name='password' class='text' value=''>
          </div>
          <div class="col-12 col-md-3">
            <input class='myremember' name='rememberme' type='checkbox' value='forever'> Se souvenir de moi
          </div>
          <div class="col-12 col-md-3">
            <input type='hidden' id='login' name='login' value='login'>
            <button type='submit' id='submitbtn' name='submit'>Se connecter</button>
        </div> 
      </div>
    </form>
  </div>

 <!--MODALE DE DECONNEXION-->
  <div id="form_logout">
      <form class="container" action="" method="post">
        <div class="row">
            <div class="col-12 col-md-4">
              Voulez-vous vraiment vous déconnecter ?
            </div>
            <div class="col-12 col-md-4">
              <input type='hidden' id='login' name='logout' value='logout'>
              <button type='submit' id='submit_logout' name='submit_logout'>OUI</button>
              <!-- <button id='submit_escape' name='submit_escape'>NON</button> -->
            </div> 
        </div>
    </form>
  </div>

</header>
