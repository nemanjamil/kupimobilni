<?php
require_once($documentroot.'/include/MysqliDb.php');
require_once($documentroot.'/post_get.php');
require_once($documentroot.'/include/vezica.php');
$common = new common($db);
$kategorije = new kategorije($db);
