<?php

if (!$id) {

    $m['tag'] = 'kategorijePoId';
    $m['success'] = false;
    $m['error'] = 1;
    $m['error_msg'] = "Nema Id Kategorije";
    echo json_encode($m, JSON_UNESCAPED_UNICODE);
    die;
}

if (!$jezikId) {

    $m['tag'] = 'kategorijePoId';
    $m['success'] = false;
    $m['error'] = 2;
    $m['error_msg'] = "Nema Id from Language. Go to -> languageApp ";
    echo json_encode($m, JSON_UNESCAPED_UNICODE);
    die;
}

$m['tag'] = 'kategorijePoId';
$m['success'] = true;
$m['error'] = 0;
$m['error_msg'] = "Nema Errora";



/*
 * BreadCrump od Kategorije
 * */
require('breadCrumpOdIdKateg.php');
$m['breadCrump'] = $breadC;


/*
 * Lista podkategorija
 * */
//$per = array();
$o = $klasaApp->podkategorijeOdKat($id,$userId,$jezikId);
if ($o) {
    //array_push($per, $o);
    $m['kategorije'] = $o;
} else {
    $m['kategorije'] = [];
}





echo json_encode($m, JSON_UNESCAPED_UNICODE);
die;


?>

