<?php
function kojijehost($tipHosta){

    if ($tipHosta == 1) {
        $hostTip = '/data/kupimobilni'; // server Linux
    } elseif ($tipHosta == 3) {
        $hostTip = 'C:/wamp64/www/kupimobilni'; // Nemanja Windows
    } elseif ($tipHosta == 4) {
        $hostTip = 'G:/projects/XXXXXX'; // Nikola
    } else {
        $hostTip = '/var/www/kupimobilni'; // Nemanja Linux
    }
    return $hostTip;
}
$mcProd = getenv('KUPIMOBILNI');

$documentroot = kojijehost($mcProd);

// 1. zakucavamo server execution time na 0 tj. da ne stane dok se sve ne izvrsi i da prikaze sve error - e.
echo ini_get('display_errors');
ini_set('max_execution_time', 0);

include ($documentroot."/vezafull.php");
require_once ($documentroot.'/thumblib/ThumbLib.inc.php');
include($documentroot.'/stranice/parse/simple_html_dom.php');
$kategorijeDodatna = new kategorijeDodatna($db);
$jezLan = $db->get('languagejezik', null, "IdLanguage,ShortLanguage");

$varsleep = 10;


$arraySifraGrupa = array('02.', '09.','07.', '06.','14.');
$arrlength = count($arraySifraGrupa);

for ($x = 0; $x < $arrlength; $x++) {
    $idKategorijeGlavna = $arraySifraGrupa[$x];

    echo "<br>";
    echo "IdGlavne Kategorije iz koje vuce Artikle: ";
    echo $idKategorijeGlavna;
    echo "</br>";

    require('jedanDownloadArtikala.php');

    if ($x == 0) {
        echo '<h2 class="bojaNaran">Prosao PRVI</h2>';
        echo '</br>';
        sleep(10);
    } else if ($x == 1) {

        echo '<h2 class="bojaZelenaEner">Prosao DRUGI</h2>';
        echo '</br>';
        sleep(10);

    } else if ($x == 2) {
        echo '<h2 class="bojaTamnoZuta">Prosao TRECI</h2>';
        echo '</br>';
        sleep(10);

    } else if ($x == 3) {
        echo '<h2 class="bojaZelenaSveEner">Prosao CETVRTI</h2>';
        echo '</br>';
        sleep(10);

    } else if ($x == 4) {
        echo '<h2 class="bojaZutaEner">Prosao PETI</h2>';
        echo '</br>';
        sleep(10);

    } else {
        echo '</br>';
        echo '<h2 class="BOJACRVENA">NESTO NIJE U REDU</h2>';
        echo '</br>';
        die;


    }

    sleep(10);
}
