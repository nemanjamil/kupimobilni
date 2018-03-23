<?php
ini_set('memory_limit', '256M');

define('DCROOT', $_SERVER['DOCUMENT_ROOT']);
require DCROOT.'/vezafull.php';
$sesKor = new functions($db);
$sesKor->sec_session_start();

require DCROOT."/include/lang.php";

if (!$valutasession) {
    echo "Nema valutasession";
    die;
}

if (!$jezikId) {
    echo "Nema jezik";
    die;
}
/*
 * 5043 - Auto - 02.
 * 5044 - Mobilni - 09.
 * 5045 - Laptop - 07.
 * 5046 - Kamere - 06.
 * 5047 - Racunar - 14.
 * */

$var_user = '2';
define('KATEGORIJESAJTCRON', '5043, 5044, 5045, 5046, 5047');
require "croncreate/menu-kategorije-cron-cir-create.php";
require "croncreate/menu-kategorije-cron-lat-create.php";

require "croncreate/menu-kategorije-navbar-cron-create.php";

// kategorije
require "croncreate/kategorijecron-create.php";
require "croncreate/kategorijecron-create-cir.php";

require "croncreate/cronlanguage.php";
require "croncreate/cronCitiesJson.php";
// require "croncreate/artikliNaziv.php"; moramo da vidimo za sta nam sluzi ovo
require "croncreate/cronOsnovniPodaci.php";

// informacije
require "croncreate/informacije-cron-create.php";
require "croncreate/informacije-cron-create-lat.php";


// preporuka nedelje
//require "croncreate/preporukaNedeljePocetnacron-create.php";
require "croncreate/preporukaNedeljePocetnacron-create-Mika-design.php";

require "croncreate/blog-single-fashion-cron-create.php";
require "croncreate/blog-single-fashion-cron-create-cir.php";

require "croncreate/our-brands-v2-cron-create.php";

// 3 reda
//ne koristi se vise
//ovo su bila ona 3 reda artikala na pocetnoj stranici na masinama

/*$jez = '5';
$KomiRabatKupi = '0';
$varijablaAlati = 10;
$naziv = 'alatimasine';
require "croncreate/product-special-alatimasine-cron-create.php";

$varijablaAlati = 11;
$naziv = 'materijal';
require "croncreate/product-special-alatimasine-cron-create.php";

$varijablaAlati = 12;
$naziv = 'srafovi';
require "croncreate/product-special-alatimasine-cron-create.php";*/



echo 'ok';