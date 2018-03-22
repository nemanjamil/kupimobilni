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
$jezLan = $db->get('LanguageJezik', null, "IdLanguage,ShortLanguage");

$varsleep = 10;

// KALKULUS IDIJEVI
// 2. Pa prvo povlacimo PARENT kategorije sa servera.
// OVO JE SAMO NULTI NIVO
require('insertParentKategorija.php');
echo '</br>';
echo '<h4 class="bojacrvenaosn">Ubacene parent kategorije</h4>';
echo '</br>';
sleep($varsleep);


// PONOVO DA POZOVEMO ISITI IZML
// 3. Zatim povlacimo sve ostale kategorije sa servera.
require('updateKategorija.php');
echo '</br>';
echo '<h4 class="bojacrvenaosn">Ubacene kategorije</h4>';
echo '</br>';

sleep($varsleep);

// NASI IDIJEVI
// 4. Zatim update-ujemo parent kategorije.
require('updateKategorijaParent.php');
echo '</br>';
echo '<h4 class="bojacrvenaosn">Update parent kategorije</h4>';
echo '</br>';

sleep($varsleep);
// 5. I na kraju updatujemo sve kategorije
//require('updateKategorija.php');
/*echo '</br>';
echo '<h4 class="bojacrvenaosn">Update kategorije</h4>';
echo '</br>';*/



?>

<h1 class="centriraj">Zavrsen proces download-a kategorija - grupa iz Calculus-a</h1>
