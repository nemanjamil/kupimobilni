<?php

if (!$id) {

    $m['tag'] = 'breadCrumpodIdKategFull';
    $m['success'] = false;
    $m['error'] = 1;
    $m['error_msg'] = "Nema Id Kategorije";
    echo json_encode($m, JSON_UNESCAPED_UNICODE);
    die;
}

if (!$jezikId) {

    $m['tag'] = 'breadCrumpodIdKategFull';
    $m['success'] = false;
    $m['error'] = 2;
    $m['error_msg'] = "Nema Id from Language. Go to -> languageApp ";
    echo json_encode($m, JSON_UNESCAPED_UNICODE);
    die;
}




$m['tag'] = 'breadCrumpodIdKategFull';
$m['success'] = true;
$m['error'] = 0;
$m['error_msg'] = "Nema Errora";



/*
 * BreadCrump od Kategorije
 * */
require('breadCrumpOdIdKateg.php');
$m['breadCrump'] = $breadC;




echo json_encode($m, JSON_UNESCAPED_UNICODE);
die;


?>

