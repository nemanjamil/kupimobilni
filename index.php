<?php
/*error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 1);*/
require 'vezafull.php';
define('RB_ROOT', dirname(__FILE__));


$users = $db->get('komitenti');
var_dump($users);
