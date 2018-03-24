<?php
/**
 * Created by PhpStorm.
 * User: Nikola Markovic
 * Date: 4.1.2018.
 * Time: 14:54
 */
echo ini_get('display_errors');
ini_set('max_execution_time', 0);


$serverVarijabla = getenv('KUPIMOBILNI');

if ($serverVarijabla == 1) {
    define('ROOTLOC', '/data/kupimobilni');

    require_once(ROOTLOC . '/include/MysqliDb.php');
    require(ROOTLOC . '/post_get.php');
    require ROOTLOC . '/include/vezica.php';
    $common = new common($db);
    $kategorije = new kategorije($db);
    $jezikId = 1;

} else {
    define('ROOTLOC',$_SERVER['DOCUMENT_ROOT']);
    require_once(ROOTLOC . '/include/MysqliDb.php');
    require(ROOTLOC . '/post_get.php');
    require ROOTLOC . '/include/vezica.php';
    $common = new common($db);
    $kategorije = new kategorije($db);
    $jezikId = 1;

}
define('URLCALCSERVICE', 'http://10.8.0.6/CalculusWebService/CalculusWebService.asmx/');
$timeUbac = @date('[d/M/Y:H:i:s]');