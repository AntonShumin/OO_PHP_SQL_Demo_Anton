<?php
require_once("../includes/database.php");
require_once("../includes/user.php");

$record = User::find_by_id(1);
echo $record['username'];


?>