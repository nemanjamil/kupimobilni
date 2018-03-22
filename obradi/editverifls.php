<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 27. 08. 2015.
 * Time: 01:12
 */
//var_dump($_POST);
//die;
$id = $common->clearvariable($_POST[id]);
$ImeLokSamo = $common->clearvariable($_POST[ImeLokSamo]);
$IdLokSamo = $common->clearvariable($_POST[id]);
$ZemljaLokSamo = $common->clearvariable($_POST[ZemljaLokSamo]);
$ImeSlike = $common->friendly_convert($ImeLokSamo);
$LinkLokSamo = $common->clearvariable($_POST[LinkLokSamo]);

//$db->setTrace(true);

if (isset($IdLokSamo)) {
    $updatelok = Array(
        "ImeLokSamo" => "$ImeLokSamo",
        "PodaciLokSamo" => "$PodaciLokSamo",
        "LinkLokSamo" => "$LinkLokSamo",
        "ZemljaLokSamo" => "$ZemljaLokSamo"

    );

    //$db->startTransaction();
    $db->where("IdLokSamo", $id);
    $db->update('lokalnasu', $updatelok);

    $idubacenog = $IdLokSamo;

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

        require_once('foreachKratakOpis.php');


        $idKratakOpis = 'IdLokSamo';
        $tabelaKratakOpis = 'loksamoopisnew';
        $kolonaIdLanguage = 'IdLanguage';
        $kolonaKratakOpis = 'LokSamoOpis';

        require_once('ubaciKratakOpis.php');
        //ubacili OPISE!


        $error_msg .= 'ok - Ubaceno u bazu';


        // ako je sve u redu onda ubacujemo sliku
        $slika = $_FILES;
        $imeslike = $ImeSlike;
        $idba = $id;
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
        $error_msg .= 'Nema nesto od: id od samouprave : ' . $IdLokSamo . ' $idUbacenog : ' . $idUbacenog;
        die;
    }

    //$db->commit();//


 //   var_dump($db->trace);
//die;
    header("Location:admin/verifikacijals");

} else {
    $error_msg["error"] = 'Greska pri izmeni samouprave';
}


echo $m = json_encode($error_msg);


?>