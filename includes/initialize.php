<?php
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
defined('SITE_ROOT') ? null : define('SITE_ROOT', 'Q:'.DS.'Projects'.DS.'wamp64'.DS.'www'.DS.'OO_PHP_SQL_Demo_Anton');
defined('LIB_PATH') ? null : define('LIB_PATH',SITE_ROOT.DS.'includes');

//Configuratiebestand eerst laden
require_once(LIB_PATH.DS."config.php");
//Basisfuncties
require_once(LIB_PATH.DS."functions.php");
//DB en geheugen
require_once(LIB_PATH.DS."session.php");
require_once(LIB_PATH.DS."database.php");
require_once(LIB_PATH.DS."database_object.php");
//
require_once(LIB_PATH.DS."user.php");


?>