<?php
require_once('include/MysqliDb.php');
require('post_get.php');
require "commonZajednicki.php";

define('KOJIJESAJT', $_SERVER['HTTP_HOST']);
if (KOJIJESAJT == 'kupimobilni' || KOJIJESAJT == 'kupimobilni.net') {
    require "commonMasine.php";
} else {
    require "commonAgro.php";
}
require 'include/vezica.php';

echo 'DCROOT + '.DCROOT;

$common = new common($db);
$kategorije = new kategorije($db);
$sesKor = new functions($db); // za registraciju
$sesKor->sec_session_start();

require "include/lang.php";
include(DCROOT."/include/osnpodaci.php");

// login podaci
require "stranice/loginIndex.php";

//$jezLan = file_get_contents(DCROOT . '/cronkreirani/vrsteJezikaCron.json');
//$jezLan = json_decode($jezLan, true);

// jezici
$langjsonfileNew = file_get_contents(DCROOT.'/cron/crongotovo/langNew.json');
$jsonlang = json_decode($langjsonfileNew,true); // ako je ,true onda je array

if($jezikId == 1){$jezik = 'srb';}
elseif($jezikId == 2){$jezik = 'eng';}
elseif($jezikId == 3){$jezik = 'ger';}
elseif($jezikId == 4){$jezik = 'rus';}
elseif($jezikId == 5){$jezik = 'srblat';}

if ($_SESSION['stranica']==$stranica) {
    $sesStr = false;
} else {
    $sesStr = true;
    $_SESSION['stranica'] = $stranica;
}


require "stranice/opisivacstrane.php";



/*echo '<br>';
echo 'POST';
echo '<br>';
var_dump($_POST);
echo '$specPodaci';
echo '<br>';
var_dump($specPodaci);
echo '$kontrole';
echo '<br>';
var_dump($kontrole);
echo '$_SESSION';
echo '<br>';
var_dump($_SESSION);
echo '<br>';
echo 'STRANICA';
echo '<br>';
var_dump($stranica);
echo '<br>';*/


//$korpases = $_SESSION['korpases'];
//$korpasescase = $_SESSION['korpasescase'];