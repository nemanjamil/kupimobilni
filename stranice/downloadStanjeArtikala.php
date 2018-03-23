<?php
function kojijehost($tipHosta){

    if ($tipHosta == 1) {
        $hostTip = '/data/kupimobilni'; // server Linux
    } elseif ($tipHosta == 3) {
        $hostTip = 'C:/wamp64/www/kupimobilni'; // Nemanja Windows
    } elseif ($tipHosta == 4) {
        $hostTip = 'G:/projects/kupimobilni'; // Nikola
    } else {
        $hostTip = '/var/www/kupimobilni'; // Nemanja Linux
    }
    return $hostTip;
}
$mcProd = getenv('KUPIMOBILNI');
$documentroot = kojijehost($mcProd);
include ($documentroot."/vezafull.php");
require_once ($documentroot.'/thumblib/ThumbLib.inc.php');
include($documentroot.'/stranice/parse/simple_html_dom.php');
$kategorijeDodatna = new kategorijeDodatna($db);
$jezLan = $db->get('languagejezik', null, "IdLanguage,ShortLanguage");
$varsleep = 10;


// 1. zakucavamo server execution time na 0 tj. da ne stane dok se sve ne izvrsi i da prikaze sve error - e.
ini_get('display_errors');
ini_set('max_execution_time', 0);

// 2. Pa prvo povlacimo file sa servera kod nas.
require('downloadFileStanjeArtikala.php');
sleep(10);

// 3. Zatim update-ujemo stanje u bazi sa tim file koji smo skinuli.
require('updateFileStanjeArtikala.php');
sleep(10);

?>

<h1 class="centriraj">Zavrsen proces update stanja i cena artikala</h1>
