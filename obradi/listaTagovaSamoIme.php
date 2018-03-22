<?php
/**
 * Created by PhpStorm.
 * User: NemanjaMilivojevic
 * Date: 3.8.15.
 * Time: 16.20
 */
// prevent direct access
$isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND
strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
if(!$isAjax) {
    $user_error = 'Access denied - not an AJAX request...';
    trigger_error($user_error, E_USER_ERROR);
}


$cols = Array("TagoviId", "TagoviIme", "TagoviGrupa","TagoviIme,CONCAT('baza') AS baza");
$db->where("tagovi.TagoviIme LIKE '%$string%'");
$user = $db->get("tagovi", null, $cols);


$i = 0;

foreach ($user as $key => $value) {

  $m[$i]['value'] .= $value['TagoviId'];
  $m[$i]['name'] .= $value['TagoviIme'];
  $m[$i]['continent'] .= $value['baza'];

  $i++;

}

echo json_encode($m, JSON_UNESCAPED_SLASHES |JSON_HEX_APOS |JSON_HEX_QUOT);
/*
echo '[ "Amsterdam Baza",
    "London Baza ime",
    "Paris Baza ime",
    "Washington Baza ime",
    "New York Baza ime",
    "Los Angeles Baza ime",
    "Sydney Baza ime",
    "Melbourne Baza ime",
    "Canberra Baza ime",
    "Beijing Baza ime",
    "New Delhi Baza ime",
    "Kathmandu Baza ime",
    "Cairo Baza Baza",
    "Cape Town Baza ime",
    "Kinshasa Baza ime"
]';*/

?>

