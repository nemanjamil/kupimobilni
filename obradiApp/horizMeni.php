<?php


$m['tag'] = 'horizMeni';
$m['success'] = true;
$m['error'] = 0;
$m['error_msg'] = "Nema Errora";

$miki = array();

$idLanguage = 5;
$m['kategorije'] = $klasaApp->recursiveKategHead(16,$idLanguage, $miki, 1);


echo json_encode($m, JSON_UNESCAPED_UNICODE);
die;


?>

