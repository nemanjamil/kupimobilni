<?php


$KomitentIme = $common->clearvariable($_POST[KomitentIme]);
$KomitentPrezime = $common->clearvariable($_POST[KomitentPrezime]);
$KomitentMesto = $common->clearvariable($_POST[KomitentMesto]);
$KomitentAdresa = $common->clearvariable($_POST[KomitentAdresa]);
$KomitentPosBroj = $common->clearvariable($_POST[KomitentPosBroj]);
$KomitentTelefon = $common->clearvariable($_POST[KomitentTelefon]);
$KomitentMobTel = $common->clearvariable($_POST[KomitentMobTel]);
$KomitentEmail = $common->clearvariable($_POST[KomitentEmail]);
$KomitentUserName = $common->clearvariable($_POST[KomitentUserName]);
$KomitentiSlika = $common->friendly_convert($KomitentIme);

/*
if (!$VerifikovanLS)
    $VerifikovanLS = NULL;

if (!$VerifikovanDib)
    $VerifikovanDib = NULL;
*/


if (isset($KomitentIme)) {
    $updateprofil = Array(
        'KomitentEmail' => $KomitentEmail,
        'KomitentIme' => $KomitentIme,
        'KomitentPrezime' => $KomitentPrezime,
        'KomitentMesto' => $KomitentMesto,
        'KomitentAdresa' => $KomitentAdresa,
        'KomitentPosBroj' => $KomitentPosBroj,
        'KomitentTelefon' => $KomitentTelefon,
        'KomitentMobTel' => $KomitentMobTel,
        'KomitentUserName' => $KomitentUserName,
    );


    // $db->setTrace(true);
    $db->startTransaction();


    $db->where("KomitentId", $id);

    if ($db->update('komitenti', $updateprofil)) {
        $error_msg .= 'Update : ' . $db->count . ' red <br>';



        // ako je sve u redu onda ubacujemo sliku
        $slika = $_FILES;
        $imeslike = $KomitentiSlika;
        $idba = $id;
        $table = 'komitenti';
        $kolona = 'KomitentiSlika';
        $location = KOMSLIKE;
        $nazivInputPolja = 'slikeMultiple';
        $idkolone = 'KomitentId';
        $w = '400';
        $h = '400';
        $preview = '1'; //ako pravimo thumb sliku _mala (80, 110) i _srednja  250, 340
        $orgSlika = ''; // da li zelimo da snimimo i originalnu sliku

        // ovo cu kasnije napraviti
        //$ubacisliku->ubacislikuKomitent($slika, $imeslike, $idba, $table, $kolona, $location, $nazivInputPolja, $idkolone, $w, $h, $preview, $orgSlika);


    } else {
        echo $error_msg .= 'NOT UPDATE <br>';
        die;
    }

    $db->commit();

    //var_dump($db->trace);

    //$error_msg["ok"] = 'Izmenjen komitent';
    //header("Location:admin/listaartikala");
    header("Location: " . URLVRATI . "");

} else {

    $error_msg .= 'Greska pri izmeni <br>';
}

echo $error_msg;
//echo $m = json_encode($error_msg);


?>