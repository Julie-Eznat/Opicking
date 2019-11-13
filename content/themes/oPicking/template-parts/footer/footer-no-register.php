
   <footer class="footer  ">    <!--mettre fixed-bottom si doit rester fixe en bas-->
   
   <?php    custom_registration_function()  ?>
 
    <!-- <div class="container-fluid text-center   "> -->
    <div class="container-fluid">
    <div class="row footer__links">
          <div class="col-12 col-md-4 pb-3 text-center">
            
              <a href="<?php the_permalink(3) ?>" class="footer__links__color">Mentions Legales</a>
        
          </div>  
          <div class="col-12 col-md-4 pb-3 text-center">
      
              <a href="https://www.twitter.com/" class="footer__links__color"><i class="fa fa-twitter" aria-hidden="true"></i></a>
              <a href="https://www.facebook.com/" class="footer__links__color"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
              <a href="https://github.com/" class="footer__links__color"><i class="fa fa-github" aria-hidden="true"></i></a>
       
          </div>
          <div class="col-12 col-md-4 pb-3 text-center">
          
              <a href="<?php the_permalink(190) ?>" class="footer__links__color">FAQ </a> 
              <a href="<?php the_permalink(192) ?>" class="footer__links__color">A propos </a>  
      
        </div>
      </div>
    </div>
  </footer>
  <script src="js/app.js"></script>
  <!-- Object Fit polyfill -->
  <script src="https://unpkg.com/object-fit-images/dist/ofi.min.js"></script>
  <!-- Jarallax -->
  <script src="https://unpkg.com/jarallax@1.10/dist/jarallax.min.js"></script>
  <!-- Include it if you want to use Video parallax -->
  <script src="https://unpkg.com/jarallax@1.10/dist/jarallax-video.min.js"></script>
  <!-- Include it if you want to parallax any element -->
  <script src="https://unpkg.com/jarallax@1.10/dist/jarallax-element.min.js"></script>
   <?php wp_footer(); ?>
</body>
</html>