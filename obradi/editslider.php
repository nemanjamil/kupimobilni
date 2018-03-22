<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 14. 08. 2015.
 * Time: 15:46
 */

$BanerAktivan = $common->clearvariable($_POST[baneraktivan]);
$BanerOpis = $common->clearvariable($_POST[baneropis]);
$BanerLink = $common->friendly_convert($naziv);

$BanerUrl = $common->clearvariable($_POST[BanerUrl]);



if (!$br) $br = NULL;


if (isset($naziv)) {
    $updatebaner = Array(
        "BanerNaziv" => $naziv,
        "BanerKategorijaArtiklaId" => $br,
        "BanerAktivan" => $BanerAktivan,
        "BanerOpis" => $BanerOpis,
        "BanerLink" => $BanerLink,
        "BanerUrl" => $BanerUrl,
        "BanerDodatniOpis" => $string
    );


    $db->startTransaction();


    $db->where("BanerId", $id);


    if ($db->update('baneri', $updatebaner)) {

        $error_msg = 'Update : ' . $db->count . ' red';

        // ako je sve u redu onda ubacujemo sliku
        $slika = $_FILES;
        $imeslike = $BanerLink;
        $idba = $id;
        $table = 'baneri';
        $kolona = 'BanerSlika';
        $location = '/assets/images/banners';
        $nazivInputPolja = 'slikeMultiple';
        $idkolone = 'BanerId';
        $w = '1920';
        $h = '940';
        $preview = '1'; //ako pravimo thumb sliku _mala (80, 110) i _srednja  250, 340
        $orgSlika = '0'; // da li zelimo da snimimo i originalnu sliku

        $ubacisliku->ubacislikuBanerNew($slika, $imeslike, $idba, $table, $kolona, $location, $nazivInputPolja, $idkolone, $w, $h, $preview, $orgSlika);

        $db->commit();


        //header("Location:admin/glavni-slajder");
        header("Location: ".URLVRATI."");

    } else {
        $error_msg["error"] = 'Greska pri izmeni taga';
    }

}
//echo $m = json_encode($error_msg);
?>