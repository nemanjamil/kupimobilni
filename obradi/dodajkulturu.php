<?php

$ImeKulture = $common->isEmpty($_POST['naziv'], FILTER_SANITIZE_STRING);
if (!$ImeKulture) {
    echo 'Ne postoji Ime kultre';
    die;
}

$ImeSlikeKulture = $ImeKulture;

if (isset($ImeKulture)) {
    $insertData = Array(
        'ImeKulture' => $ImeKulture

    );

    $idubacenog = $db->insert('kulture', $insertData);

//ubacujemo slike//
    if ($idubacenog) {

        $error_msg = 'Insert : ' . $db->count . ' red';


        // ako je sve u redu onda ubacujemo sliku
        $slika = $_FILES;
        $imeslike = $ImeSlikeKulture;
        $idba = $idubacenog;
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


        if ($idubacenog && $idNaslovTekst && $idTekstOpis) {
            $db->commit();
        } else {
            $db->rollback();
        }


        header("Location:admin/kulture");

    } else {
        $error_msg["error"] = 'Greska pri dodavanju kulture';
    }


} else {
    $error_msg["error"] = 'Nema naziva';
}

//echo $error_msg;

header("Location:$url");

?>