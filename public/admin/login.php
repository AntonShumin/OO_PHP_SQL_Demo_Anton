<?php
require_once("../includes/database.php");
require_once("../includes/functions.php");
require_once("../includes/session.php");
require_once("../includes/user.php");

if($session->is_logged_in()) {
    redirect_to("index.php")
}

if(isset($_POST['submit'])) {
    //form has been submitted
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    //check the database to see if the password exist
    if($found_user){
    $session->login($found_user);
    redirect_to("index.php");
    } else {
        $message = "Username/password combination incorrect.";
    }
} else {
    $username = "";
    $password = "";
}




?>