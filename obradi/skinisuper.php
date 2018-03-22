<?php
/**
 * Project: masine
 * Created by PhpStorm.
 * User: Nikola
 * Date: 28. 01. 2016.
 * Time: 16:34
 */



$ArtikalId = $common->clearvariable($_POST[$id]);


if (isset($ArtikalId)) {
    $updatever = Array(
        "ArtikalNaAkciji" => "0"
    );

//var_dump($updatever);
//die;

    $db->where("ArtikalId", $id);
    $db->update('artikli', $updatever);
//var_dump($db);

//die;

    //$error_msg["ok"] = 'Izmenjen tag novo ime';
    header("Location:$url");

} else {
    $error_msg["error"] = 'Greska pri dodavanju super ponude';
}


echo $m = json_encode($error_msg);

