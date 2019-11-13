<?php
add_action('after_setup_theme', 'remove_admin_bar');
 
/* cache l'admin-bar pour tous sauf admin */
function remove_admin_bar()
{
    if (!current_user_can('administrator') && !is_admin())
    {
        show_admin_bar(false);
    }
}

	
/* Cache l'admin bar pour tous sauf l'admin*/
/* show_admin_bar(false);*/

?>