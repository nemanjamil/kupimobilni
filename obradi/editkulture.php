<?php

$IdKulture = $common->isEmpty($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
$ImeKulture = $common->isEmpty($_POST['naziv']);
$ImeSlikeKulture = $common->friendly_convert($ImeKulture);

$scientific = $common->isEmpty($_POST['scientific'], FILTER_SANITIZE_STRING);
$opisKultura = $common->clearvariableTekst($_POST['opisKultura']);
$kulturaVoda = $common->isEmpty($_POST['kulturaVoda'], FILTER_SANITIZE_NUMBER_INT);
$kulturaSun = $common->isEmpty($_POST['kulturaSun'], FILTER_SANITIZE_NUMBER_INT);
$kulturaTemp = $common->isEmpty($_POST['kulturaTemp'], FILTER_SANITIZE_NUMBER_INT);
$kulturaMoisture = $common->isEmpty($_POST['kulturaMoisture'], FILTER_SANITIZE_NUMBER_INT);

if (isset($ImeKulture)) {

    $updatever = Array(
        "ImeKulture" => $ImeKulture,
        "scientific" => $scientific,
        "opisKultura" => $opisKultura,
        "kulturaVoda" => $kulturaVoda,
        "kulturaSun" => $kulturaSun,
        "kulturaTemp" => $kulturaTemp,
        "kulturaMoisture" => $kulturaMoisture,
    );

    $db->where("IdKulture", $id);
    $db->update('kulture', $updatever);


    // ako je sve u redu onda ubacujemo sliku
    $slika = $_FILES;
    $imeslike = $ImeSlikeKulture;
    $idba = $id;
    $table = 'kulture';
    $kolona = 'SlikaKulture';
    $location = '/assets/images/kulture';
    $nazivInputPolja = 'slikeMultipleKulture';
    $idkolone = 'IdKulture';
    $w = '80';
    $h = '80';
    $preview = '1'; //ako pravimo thumb sliku _mala (80, 110) i _srednja  250, 340
    $orgSlika = '0'; // da li zelimo da snimimo i originalnu sliku

    $ubacisliku->ubacislikuKulture($slika, $imeslike, $idba, $table, $kolona, $location, $nazivInputPolja, $idkolone, $w, $h, $preview, $orgSlika);

    // ako je sve  ok onda imamo sva tri id-a, i tek onda odradi commit

    header("Location: $url");

} else {
    echo 'Ne postoji IME KUTURE';
    die;
}


?>