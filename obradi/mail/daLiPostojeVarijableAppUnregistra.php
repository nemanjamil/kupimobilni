<?php


$artikalID = (int) $k->artikalID;
$cena = $k->cena;
$kolicina = $k->kolicina;


if (!$artikalID) {
    $m['tag'] = 'kupovinaKorpaUnregistered';
    $m['success'] = false;
    $m['error'] = 20;
    $m['error_msg'] = "Nema artikalID";
    echo json_encode($m, JSON_UNESCAPED_UNICODE);
    die;
}

if (!$cena) {
    $m['tag'] = 'kupovinaKorpaUnregistered';
    $m['success'] = false;
    $m['error'] = 21;
    $m['error_msg'] = "Nema cene artikal ".$artikalID;
    echo json_encode($m, JSON_UNESCAPED_UNICODE);
    die;
}


if (!$kolicina) {
    $m['tag'] = 'kupovinaKorpaUnregistered';
    $m['success'] = false;
    $m['error'] = 23;
    $m['error_msg'] = "Nema kolicina artikal ".$artikalID;
    echo json_encode($m, JSON_UNESCAPED_UNICODE);
    die;
}


?>