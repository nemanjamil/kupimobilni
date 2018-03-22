<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 12. 11. 2015.
 * Time: 13:00
 */
define('DCROOT', $_SERVER['DOCUMENT_ROOT']);

include(DCROOT.'/include/MysqliDb.php');
include(DCROOT.'/include/vezica.php');
include(DCROOT . '/commonMasine.php');
include(DCROOT . '/commonZajednicki.php');


$upitTr = "TRUNCATE TABLE vremenska;";
$db->rawQuery($upitTr);


$doc = new DOMDocument();
$doc->load('http://www.hidmet.gov.rs/korisnici/dodatna_oprema/prognoza_numerika.xml');
$data = $doc->getElementsByTagName("forecast");

$j = 0;
foreach ($data as $row) {

    $location_idv = $row->getElementsByTagName("location_id");
    $idd = $location_idv->item(0)->nodeValue;

    $gradv = $row->getElementsByTagName("grad");
    $grad = $gradv->item(0)->nodeValue;

    $prognoza_startv = $row->getElementsByTagName("prognoza_start");
    $prognoza_start = $prognoza_startv->item(0)->nodeValue;

    $prognoza_terminv = $row->getElementsByTagName("prognoza_termin");
    $prognoza_termin = $prognoza_terminv->item(0)->nodeValue;

    $temperaturav = $row->getElementsByTagName("temperatura");
    $temperatura = $temperaturav->item(0)->nodeValue;

    $pritisakv = $row->getElementsByTagName("pritisak");
    $pritisak = $pritisakv->item(0)->nodeValue;

    $brzina_vetrav = $row->getElementsByTagName("brzina_vetra");
    $brzina_vetra = $brzina_vetrav->item(0)->nodeValue;

    $smer_vetrav = $row->getElementsByTagName("smer_vetra");
    $smer_vetra = $smer_vetrav->item(0)->nodeValue;

    $vlagav = $row->getElementsByTagName("vlaga");
    $vlaga = $vlagav->item(0)->nodeValue;

    $padavinev = $row->getElementsByTagName("padavine");
    $padavine = $padavinev->item(0)->nodeValue;

    $simbolv = $row->getElementsByTagName("simbol");
    $simbol = $simbolv->item(0)->nodeValue;

    $opisv = $row->getElementsByTagName("opis");
    $opis = $opisv->item(0)->nodeValue;
    $j++;

    $vreme = Array(
        'idgrada' => $idd,
        'imegrada' => $grad,
        'prognoza_start' => $prognoza_start,
        'prognoza_termin' => $prognoza_termin,
        'temperatura' => $temperatura,
        'pritisak' => $pritisak,
        'brzina_vetra' => $brzina_vetra,
        'smer_vetra' => $smer_vetra,
        'vlaga' => $vlaga,
        'padavine' => $padavine,
        'simbol' => $simbol,
        'opis' => $opis

    );

    $db->insert('vremenska', $vreme);



}

/*
$ime = "Vremenska prognoza";
$kome = "office@onaportal.com";
$tekst = "test";
$email = "office@onaportal.com";

$ip=getenv('REMOTE_ADDR'); // uzimamo IP adresu od servera da znamo odakle je korisnik
$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=utf-8\r\n";
$headers .= "From: $ime <$email>\r\n";
$naslov = "Uradjena vremenska za za www.onaportal.com";


$message = "Uradjena Vremenska prognoza  ".$backupFile;
mail($kome, $naslov, $message, $headers);

*/
header("Location: " . URLVRATI . "");
//echo 'Ubacena temperatura u bazu';