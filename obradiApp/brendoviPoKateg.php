<?php



if (!$id) {

    $m['tag'] = 'brendoviUkateg';
    $m['success'] = false;
    $m['error'] = 1;
    $m['error_msg'] = "Nema Id Kategorije";
    echo json_encode($m, JSON_UNESCAPED_UNICODE);
    die;
}

if (!$userId) {

    $m['tag'] = 'brendoviUkateg';
    $m['success'] = false;
    $m['error'] = 2;
    $m['error_msg'] = "Nema Id Korisnika";
    echo json_encode($m, JSON_UNESCAPED_UNICODE);
    die;
}




    require('brendoviUkateg.php');


if (!$brendovi) {

    $m['tag'] = 'brendoviUkateg';
    $m['success'] = false;
    $m['error'] = 3;
    $m['error_msg'] = "Nema Brendova";
    echo json_encode($m, JSON_UNESCAPED_UNICODE);
    die;

} else {
    $m['tag'] = 'brendoviUkateg';
    $m['success'] = true;
    $m['error'] = 0;
    $m['error_msg'] = "Nema Errora";
    $m['brendovi'] = $brendovi;
}




echo json_encode($m, JSON_UNESCAPED_UNICODE);
die;


?>


