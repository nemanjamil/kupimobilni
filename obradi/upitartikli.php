<?php

// prevent direct access
require 'proveriAjaxDeny.php';


if (empty($_GET)) {
    echo 'Nisu pronadjeni POST parametri!';
    die;
}

$postic = $_GET;
//var_dump($postic);


// get what user typed in autocomplete input
$term = trim($_GET['term']);

$a_json = array();
$a_json_row = array();

$a_json_invalid = array(array("id" => "#", "value" => $term, "label" => "Only letters and digits are permitted..."));
$json_invalid = json_encode($a_json_invalid);

// replace multiple spaces with one
$term = preg_replace('/\s+/', ' ', $term);

// SECURITY HOLE ***************************************************************
// allow space, any unicode letter and digit, underscore and dash
/*if(preg_match("/[^\040\pL\pN_-]/u", $term)) {
    print $json_invalid;
    exit;
}*/
// *****************************************************************************

$parts = explode(' ', $term);
$p = count($parts);


$cols = Array ("A.ArtikalId", "A.ArtikalLink","ANN.OpisArtikla");
$db->join("artikalnazivnew ANN","ANN.ArtikalId=A.ArtikalId");
$db->where ("ANN.OpisArtikla LIKE  '%$term%'");
$users = $db->get ("artikli A", null, $cols);
if ($db->count > 0) {
    foreach ($users as $row) {

        $ArtikalId = $row['ArtikalId'];
        $ArtikalLink = $row['ArtikalLink'];
        $OpisArtikla = $row['OpisArtikla'];

        $a_json_row["ArtikalId"] = $ArtikalId;
        $a_json_row["ArtikalLink"] = $ArtikalLink;
        $a_json_row["OpisArtikla"] = $OpisArtikla;
        $a_json_row["miki"] =  $_GET['miki'];
        array_push($a_json, $a_json_row);

    }
}
$json = json_encode($a_json);
print $json;


?>

