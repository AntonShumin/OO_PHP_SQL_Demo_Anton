<?php
require_once("../includes/database.php");
require_once("../includes/functions.php");
require_once("../includes/user.php");

$user = User::find_by_id(1);
echo $user->full_name();

$users = User::find_all();
foreach($users as $user){
    echo "User: " . $user->username . "<br />";
    echo "Name: ". $user->full_name() . "<br /><br />";
}


echo "<hr ?>";

/*
$user_set = User::find_all()
while ($user = $database->fetch_array($user_set)) {
    echo "User: ". $user['username'] . "<br />";
    echo "Name: ". $user['firstname'] . " " . $user['last_name'] . "<br /><br />";
}
*/

?>