<?php
/**
 * Created by PhpStorm.
 * User: Nikola Markovic
 * Date: 02.11.2017.
 * Time: 09:32
 * Expl: Servis za ubacivanje komitenata na sajt
 */
//$VrsteDokumenataPrefiksZaSinhronizaciju
//$DatumZaSinhronizaciju
//$KomitentSifraZaSinhronizaciju
//$MagacinSifraZaSinhronizaciju
//$KreatorZaSinhronizaciju
//$ValutaZaSinhronizaciju
//$NapomenaNarudz


//require 'includeZaCalcServise.php';

$calculus = new calculusServisi($db);


$urlServisa = URLCALCSERVICE . 'UbaciZagDok';
$postParametri = [
    'vrstadokumenta' => $VrsteDokumenataPrefiksZaSinhronizaciju,
    'datum' => $DatumZaSinhronizaciju,
    'komitent' => $KomitentSifraZaSinhronizaciju,
    'magacin' => $MagacinSifraZaSinhronizaciju,
    'kreator' => $KreatorZaSinhronizaciju,
    'agent' => '',
    'datumprometa' => '',
    'valuta' => $ValutaZaSinhronizaciju,
    'valutaplacanja' => '',
    'ekstdok1' => '',
    'ekstdok2' => '',
    'ekstdok3' => '',
    'status' => '',
    'prokmag' => '',
    'prokknj' => '',
    'zavrsen' => '',
    'statusdok' => '',
    'napomena' => $NapomenaNarudz,
    'nacinisporuke' => ''



];


$curlInitStanje = $calculus->posaljiPodatkeCalc($urlServisa, $postParametri);


if ($curlInitStanje) {
    $dom = new DOMDocument();
    $dom->loadXML($curlInitStanje);

    $tables = $dom->getElementsByTagName('string');

    if (!empty($tables)) {
        $ID = $tables->item(0)->nodeValue;


            echo '</br>';
            echo '</br>';
            echo '<h3 style="color:#0a1989 !important;">' .$ID.'</h3> - <h4>Zaglavlje Id Dokument u Calculusu</h4>';
            echo '</br>';
            echo '</br>';

    } else {
        echo 'empty(string) Zaglavlje dokumenta';
        die;
    }

} else {
    echo 'nema curlinitstanje';
    die;
}
