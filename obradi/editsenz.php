<?php

$IdListaSenzora = $common->isEmpty($_POST['IdListaSenzora'],FILTER_SANITIZE_NUMBER_INT);
$PripadaKomitentu = $common->isEmpty($_POST['PripadaKomitentu'],FILTER_SANITIZE_NUMBER_INT);
$SenzorSifra = $common->isEmpty($_POST['SenzorSifra'],FILTER_SANITIZE_STRING);

if (!$IdListaSenzora) { echo 'Ne postoji IdListaSenzora'; die; }
if (!$PripadaKomitentu) { echo 'Ne postoji $PripadaKomitentu'; die; }
if (!$SenzorSifra) { echo 'Ne postoji $SenzorSifra'; die; }

//$insert_query od  KulturaLokacija
$update_query = Array(
    'KomitentId' => $PripadaKomitentu,
    'SenzorSifra' => $SenzorSifra
);


if (isset($IdListaSenzora)) {
    $db->where('IdListaSenzora', $IdListaSenzora);
    $db->update('listasenzora', $update_query);
} else {
    $error_msg["error"] = 'Nije odabrana kultura';
}


 header("Location:$url");

?>