require('bootstrap');
require('jarallax');
require('jquery');
var jQuery = $;

var app = {

  

  init: function() {
    
    
    // --------------------APPEL AUX DIFFERENTES FONCTIONS A L'INITIALISATION
    app.jara();
    app.login_form();
    app.logout_form();
    app.search_options();
    app.create_post();

  },

  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// ---------------------------FONCTION TEST


 //---------------------------FONCTION CONNCERNANT LE JARALLAX
  jara: function(){
   
    jarallax(document.querySelectorAll('.jarallax'), { speed: 0.2 });
    jarallax(document.querySelectorAll('.jarallax-keep-img'), {keepImg: true,});
  },


  //--------------------------FONCTION SOUS FORMULAIRE DE CONNEXION D'UTILISATEUR
  login_form: function()
  {
    $("#login_user").hover(function(){ $("#login_user").css("color","#6BA03C");}, function(){ $(this).css("color","white");});
    
    $("#login_user").click(function(){ 
      if ($("#form_login").css('display') == 'none')
      {
        $("#form_login").show( "slow" );
      }
      else{
        $("#form_login").hide( "slow" );
      } 
    });
  },

  //--------------------------FONCTION SOUS FORMULAIRE DE DECONNEXION D'UTILISATEUR
  logout_form: function()
  {
    $("#logout_user").hover(function(){ $("#logout_user").css("color","#6BA03C");}, function(){ $(this).css("color","white");});
    
    $("#logout_user").click(function(){ 
      if ($("#form_logout").css('display') == 'none')
      {
        $("#form_logout").show( "slow" );
      }
      else{
        $("#form_logout").hide( "slow" );
      } 
    });

    $("#form_logout").mouseleave(function(){
        $("#form_logout").hide( "slow" );
    });


  },


    //--------------------------FONCTION SOUS FORMULAIRE DE SEARCH
  search_options: function()
  {
         
    $("#search").click(function(){ 
      if ($("#search_options").css('display') == 'none')
      {
        $("#search_options").show( "slow" );
      }
      else{
        $("#search_options").hide( "slow" );
      } 
    });
  },

  
};

  $(app.init);