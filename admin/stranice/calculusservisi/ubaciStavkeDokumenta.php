<?php
/**
 * Created by PhpStorm.
 * User: Nikola Markovic
 * Date: 02.11.2017.
 * Time: 09:32
 * Expl: Servis za ubacivanje komitenata na sajt
 */
//$ID
//$MagacinSifraZaSinhronizaciju
//$ArtikalSifraUbac
//$OpisArtiklaUbac
//$KolicinaNarudzlista




//require 'includeZaCalcServise.php';

$calculus = new calculusServisi($db);

$urlServisaZaArtikle = URLCALCSERVICE . 'UbaciStavDok';
$postParametriZaArtikle = [
    'kljucdok' => $ID,
    'magacin' => $MagacinSifraZaSinhronizaciju,
    'artusl' => 'A',
    'sifartusl' => $ArtikalSifraUbac,
    'nazartusl' => $OpisArtiklaUbac,
    'tarifa' => '',
    'kolicina' => $KolicinaNarudzlista,
    'nabcena' => '',
    'vpcena' => '',
    'mpcena' => '',
    'popust' => '',
    'poulazu' => '',
    'napomena' => ''

];


$curlInitUbacArtikla = $calculus->posaljiPodatkeCalc($urlServisaZaArtikle, $postParametriZaArtikle);

if ($curlInitUbacArtikla) {
    $dom = new DOMDocument();
    $dom->loadXML($curlInitUbacArtikla);
    $tables = $dom->getElementsByTagName('string');

    if (!empty($tables)) {

        $IDUbac = $tables->item(0)->nodeValue;

            echo '</br>';
            echo '</br>';
            echo '<h3 style="color:#44892c !important;">'.$IDUbac.'</h3> - <h4>Stavka ID Dokumenta u Calculusu</h4><br> ';
            echo '</br>';
            echo '</br>';


    } else {
        echo 'empty(string ) Stavke Dokumenta';
        die;
    }

} else {
    echo 'nema curlinitstanje';
    die;
}
