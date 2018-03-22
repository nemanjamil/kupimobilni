<?php
$SenzorSifra = $common->isEmpty($_POST['SenzorSifra'], FILTER_SANITIZE_STRING);
$PripadaKomitentu = $common->isEmpty($_POST['PripadaKomitentu'], FILTER_SANITIZE_NUMBER_INT);

if (!$SenzorSifra) {
    echo 'Ne postoji Senzor Sifra';
    die;
}

if (!$PripadaKomitentu) {
    echo 'Ne postoji Id Komitenta';
    die;
}


    $data = Array(
        'KomitentId' => $PripadaKomitentu,
        'SenzorSifra' => $SenzorSifra
    );

    $db->startTransaction();
    $db->insert('listasenzora', $data);
    $db->commit();



header("Location: " . URLVRATI);

?>

