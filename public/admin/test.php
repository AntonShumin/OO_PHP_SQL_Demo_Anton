<?php
require_once("../../includes/initialize.php");

if(!$session->is_logged_in()) {
    redirect_to("login.php");
}
?>

<?php include_layout_template('admin_header.php'); ?>

<?php
/* Test user->create()
    $user = new User();
    $user->username = "bruh";
    $user->password = "test";
    $user->first_name = "FirstName";
    $user->last_name = "LastName";
    $user->create();
    
    Test User->update*/
    $user = User::find_by_id(5);
    $user->username = "NewUserName2";
    $user->update();
    

?>

<?php include_layout_template('admin_footer.php'); ?>

