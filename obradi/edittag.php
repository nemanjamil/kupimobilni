<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 12. 08. 2015.
 * Time: 15:22
 */
//var_dump($_POST);

$nazivtag = $common->clearvariable($_POST[nazivtag]);
$TagoviId = $common->clearvariable($_POST[TagoviId]);
if (isset($nazivtag)) {
    $updatetag = Array(
        "TagoviIme" => "$nazivtag"
    );

    $db->where("TagoviId", $id);
    $db->update('tagovi', $updatetag);
//var_dump($db);

//die;

    //$error_msg["ok"] = 'Izmenjen tag novo ime';
    header("Location:admin/tagovi");

} else {
    $error_msg["error"] = 'Greska pri izmeni taga';
}


echo $m = json_encode($error_msg);


?>