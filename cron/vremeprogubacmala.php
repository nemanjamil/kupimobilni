<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 12. 11. 2015.
 * Time: 13:01
 */
define('DCROOT', $_SERVER['DOCUMENT_ROOT']);

include (DCROOT.'/include/MysqliDb.php');
include (DCROOT.'/include/vezica.php');
include(DCROOT . '/commonMasine.php');


$upitTur = "TRUNCATE TABLE vremenskamala;";
$db->rawQuery($upitTur);

$doc = new DOMDocument();
$doc->load( 'http://www.hidmet.gov.rs/korisnici/dodatna_oprema/prognoza.xml' );
$dataset = $doc->getElementsByTagName( "forecast" );

$j=1;
foreach($dataset as $row) {

    $location_idv = $row->getElementsByTagName( "location_id" );
    $idd = $location_idv->item(0)->nodeValue;

    $name = $row->getElementsByTagName( "name" );
    $name = $name->item(0)->nodeValue;

    for ($i = 1; $i <= 5; $i++) {

        $timestamp = 'timestamp_'.$i;
        $timestamp = $row->getElementsByTagName( $timestamp );
        $timestamp = $timestamp->item(0)->nodeValue;

        $malav = 'min_'.$i;
        $malav = $row->getElementsByTagName( $malav );
        $malav = $malav->item(0)->nodeValue;

        $max = 'max_'.$i;
        $max = $row->getElementsByTagName( $max );
        $max = $max->item(0)->nodeValue;

        $opis = 'opis_'.$i;
        $opis = $row->getElementsByTagName( $opis );
        $opis = $opis->item(0)->nodeValue;

        $simbol = 'simbol_'.$i;
        $simbol = $row->getElementsByTagName( $simbol );
        $simbol = $simbol->item(0)->nodeValue;

        $vrememala = Array(
            'IdGradaVremenskaMala' => $idd,
            'ImeGradaVremenskaMala' => $name,
            'DatumVremeVremenskaMala' => $timestamp,
            'MinimalnaVremenskaMala' => $malav,
            'MaksimalnaVremenskaMala' => $max,
            'OpisVremenskaMala' => $opis,
            'SimbolVremeVremenskaMala' => $simbol

        );



        $db->insert('vremenskamala', $vrememala);



    }

    $j++;
}
header("Location: " . URLVRATI . "");
//echo 'Ubacena temperatura u bazu';

?>