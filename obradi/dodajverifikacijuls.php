<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 27. 08. 2015.
 * Time: 00:14
 */

//var_dump($_POST);
//die;

$ImeLokSamo = $common->clearvariable($_POST[ImeLokSamo]);
$ImeSlike = $common->friendly_convert($ImeLokSamo);
$ZemljaLokSamo = $common->clearvariable($_POST[ZemljaLokSamo]);
//$PodaciLokSamo = $common->clearvariable($_POST[string]);
$LinkLokSamo = $common->clearvariable($_POST[LinkLokSamo]);


if (isset($ImeLokSamo)) {

$db->setTrace(true);
    $insertData = Array(
        'ImeLokSamo' => $ImeLokSamo,
        'ZemljaLokSamo' => $ZemljaLokSamo,
        'LinkLokSamo' => $LinkLokSamo
    );

    //$db->startTransaction();
    $idubacenog = $db->insert('lokalnasu', $insertData);


    if ($idubacenog) {
        // Ubacujemo NAZIVE U NOVU BAZU

        require_once('foreachNaziv.php');


        $idnaziv = 'IdLokSamo';
        $tabelaNaziv = 'loksamotextnew';
        $kolonaIdLanguage = 'IdLanguage';
        $kolonaNaziv = 'LokSamoNaslov';

        require_once('ubaciNaziv.php');

    //ubacili nazive!


    // Ubacujemo OPISE U NOVU BAZU

        require_once('foreachVelikiOpis.php');


        $idVelikiOpis = 'IdLokSamo';
        $tabelaVelikiOpis = 'loksamoopisnew';
        $kolonaIdLanguage = 'IdLanguage';
        $kolonaVelikiOpis = 'LokSamoOpis';

        require_once('ubaciVelikiOpis.php');
        //ubacili OPISE!


    $error_msg = 'Insert : ' . $db->count . ' red';

    // ako je sve u redu onda ubacujemo sliku
    $slika = $_FILES;
    $imeslike = $ImeSlike;
    $idba = $idubacenog;
    $table = 'lokalnasu';
    $kolona = 'SlikaLokSamo';
    $location = '/assets/images/loksamoup';
    $nazivInputPolja = 'slikeMultipleLs';
    $idkolone = 'IdLokSamo';
    $w = '400';
    $h = '400';
    $preview = '0'; //ako pravimo thumb sliku _mala (80, 110) i _srednja  250, 340
    $orgSlika = '0'; // da li zelimo da snimimo i originalnu sliku

    $ubacisliku->ubacislikuLs($slika, $imeslike, $idba, $table, $kolona, $location, $nazivInputPolja, $idkolone, $w, $h, $preview, $orgSlika);


} else {
        $error_msg["error"] = 'Nema $idubacenog';
}


    //$db->commit();
//var_dump($db->trace);
} else {
    $error_msg["error"] = 'Nema Imena Lokalne samouprave';
}

echo $error_msg;
var_dump($idubacenog);
var_dump($db->trace);
//header("Location:$url");
