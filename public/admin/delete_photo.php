<?php
require_once("../../includes/initialize.php"); 
if(!$session->is_logged_in()) { redirect_to("login.php");}

if(empty($_GET('id'))) {
    $session->message("No photograph ID was provided");
    redirect_to('index.php');
}


    

?>
