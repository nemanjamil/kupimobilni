<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 18. 08. 2015.
 * Time: 00:42
 */

$komitenttipusera = $common->clearvariable($_POST['komitenttipusera']);

//----VP-----
if (isset($_POST['komitentfirma'])) {  $komitentfirma = filter_input(INPUT_POST, 'komitentfirma', FILTER_SANITIZE_STRING); } else {   $komitentfirma = ''; }
if (isset($_POST['komitentpib'])) {  $komitentpib = filter_input(INPUT_POST, 'komitentpib', FILTER_SANITIZE_NUMBER_INT); } else {   $komitentpib = ''; }
if (isset($_POST['KomitentUPdv'])) {  $KomitentUPdv = filter_input(INPUT_POST, 'KomitentUPdv', FILTER_SANITIZE_NUMBER_INT); } else {   $KomitentUPdv = ''; }
if (isset($_POST['komitentmatbr'])) {  $komitentmatbr = filter_input(INPUT_POST, 'komitentmatbr', FILTER_SANITIZE_NUMBER_INT); } else {   $komitentmatbr = ''; }
if (isset($_POST['komitentfirmaadresa'])) {  $komitentfirmaadresa = filter_input(INPUT_POST, 'komitentfirmaadresa', FILTER_SANITIZE_STRING); } else {   $komitentfirmaadresa = ''; }
if (isset($_POST['KomiRabatKupi'])) {  $KomiRabatKupi = $common->isEmpty($_POST['KomiRabatKupi'],FILTER_SANITIZE_NUMBER_INT); } else {   $KomiRabatKupi = NULL; }
if (isset($_POST['InstaliranAppAnd'])) {  $InstaliranAppAnd = $common->isEmpty($_POST['InstaliranAppAnd'],FILTER_SANITIZE_NUMBER_INT); } else {   $InstaliranAppAnd = 0; }


//----/VP-----
$komitentime = $common->clearvariable($_POST[komitentime]);
$komitentnaziv = $common->friendly_convert($komitentime);
$komitentprezime = $common->clearvariable($_POST[komitentprezime]);
$komitentmesto = $common->clearvariable($_POST[komitentmesto]);
$komitentadresa = $common->clearvariable($_POST[komitentadresa]);
$komitentposbroj = $common->clearvariable($_POST[komitentposbroj]);
$komitenttelefon = $common->clearvariable($_POST[komitenttelefon]);
$komitentmobtel = $common->clearvariable($_POST[komitentmobtel]);
$komitentemail = $common->clearvariable($_POST[komitentemail]);
$komitentusername = $common->clearvariable($_POST[komitentusername]);
$komitentactive = $common->clearvariable($_POST[komitentactive]);
$komitentivaluta = $common->clearvariable($_POST[komitentivaluta]);
$komitentrabat = $common->clearvariable($_POST[komitentrabat]);

$KomitentiZemlja = $common->clearvariable($_POST[KomitentiZemlja]);
$VerifikovanLS = $common->clearvariable($_POST[VerifikovanLS]);
$VerifikovanDib = $common->clearvariable($_POST[VerifikovanDib]);

if (!$VerifikovanLS)
    $VerifikovanLS = NULL;

if (!$VerifikovanDib)
    $VerifikovanDib = NULL;


$komitentpassword = $common->clearvariable($_POST[komitentpassword]);
$komitentpassword = filter_input(INPUT_POST, 'komitentpassword', FILTER_SANITIZE_STRING);
$random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
$komitentpassword = hash('sha512', $komitentpassword . $random_salt);


$lat = $common->clearvariable($_POST['lat']);
$lng = $common->clearvariable($_POST['lng']);

if (isset($komitentnaziv)) {

    $updatekomitent = Array(
        'KomitentTipUsera' => $komitenttipusera,
        'KomitentEmail' => $komitentemail,
        /*'KomitentPassword' => $komitentpassword,
        'KomitentSalt' => $random_salt,*/
        'KomitentUPdv' => $KomitentUPdv,
        'KomitentFirma' => $komitentfirma,
        'KomitentPib' => $komitentpib,
        'KomitentMatBr' => $komitentmatbr,
        'KomitentNaziv' => $komitentnaziv,
        'KomitentFirmaAdresa' => $komitentfirmaadresa,

        'KomitentIme' => $komitentime,
        'KomitentPrezime' => $komitentprezime,
        'KomitentMesto' => $komitentmesto,
        'KomitentAdresa' => $komitentadresa,
        'KomitentPosBroj' => $komitentposbroj,
        'KomitentTelefon' => $komitenttelefon,
        'KomitentMobTel' => $komitentmobtel,
        'KomitentUserName' => $komitentusername,
        'KomitentActive' => $komitentactive,
        'KomitentiValuta' => $komitentivaluta,
        'KomitentRabat' => $komitentrabat,
        'KomiRabatKupi' => $KomiRabatKupi,

        'KomitentiZemlja' => $KomitentiZemlja,
        'VerifikovanDib' => $VerifikovanDib,
        'VerifikovanLS' => $VerifikovanLS,
        'InstaliranAppAnd' => $InstaliranAppAnd,


        'lat' => $lat,
        'lng' => $lng
    );

        $db->where('KomitentId', $id);
        $idUbacenogart = $db->update('komitenti', $updatekomitent);


        require('KomitentOpisNew.php');




        // ako je sve u redu onda ubacujemo sliku
        $slika = $_FILES;
        $imeslike = $komitentusername;
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


        $ubacisliku->ubacislikuKomitent($slika, $imeslike, $idba, $table, $kolona, $location, $nazivInputPolja, $idkolone, $w, $h, $preview, $orgSlika);


        // sada ubacujemo Galeriju
        $slika = $_FILES;
        $imeslike = $komitentusername;
        $idba = $id;
        $table = 'komitentislike';
        $kolona = 'ImeSlikeKomitentiSlike';
        $location = KOMSLIKE;
        $nazivInputPolja = 'slikeGalerija';
        $idkolone = 'IdKomitentiSlike';
        $w = '800';
        $h = '800';
        $preview = '1'; //ako pravimo thumb sliku _mala (80, 110) i _srednja  250, 340
        $orgSlika = ''; // da li zelimo da snimimo i originalnu sliku

        $ubacisliku->ubacislikuGalKom($slika, $imeslike, $idba, $table, $kolona, $location, $nazivInputPolja, $idkolone, $w, $h, $preview, $orgSlika);


} else {

    $error_msg .= 'Greska pri izmeni <br>';
}


header("Location: " . URLVRATI . "");



?>