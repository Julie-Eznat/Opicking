<?php
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function opicking_login()
{
    if(isset($_POST['login']))
    {
      
        $login_data['user_login'] = sanitize_user($_POST['username']);
        $login_data['user_password'] = esc_attr($_POST['password']);
    
        $user = wp_signon( $login_data, false );
    /*   if($remember){$remember = "true";}
        else {$remember = "false";}  */
        $user_verify = wp_signon( $login_data, false ); 
        if(is_user_logged_in()){}

            
        if ( is_wp_error($user_verify) ) 
        { 
            echo '<span style = "color: red; font-weight:bolder;border-radius:0.5rem; background-color:white;padding:0.5rem;"><i class="fa fa-exclamation-triangle"></i> Mauvais identifiants </span>'; 
        } 
        else
        { 
            wp_clear_auth_cookie();
            do_action('wp_login', $user->ID);
            wp_set_current_user($user->ID);
            wp_set_auth_cookie($user->ID, true);
            $redirect_to = home_url();
            wp_safe_redirect($redirect_to);
            //echo "<script type='text/javascript'>window.location.href='". home_url() ."'</script>";
            //exit;
          
             echo "<script type='text/javascript'>window.location.href='". home_url() ."'</script>"; 
        
        }
    }
}
add_action( 'init', 'opicking_login' );
/////////////////////////////////////////////////////////////////////////////////////////////////////////
function opicking_logout()
{
    if (isset($_POST['logout']))  
    {
        wp_logout();
        //$redirect_to = home_url();
        //wp_safe_redirect($redirect_to);
       echo "<script type='text/javascript'>window.location.href='". home_url() ."'</script>"; 
    }
}
add_action( 'init', 'opicking_logout' );