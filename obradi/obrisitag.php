<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 12. 08. 2015.
 * Time: 20:13
 */
//var_dump($_POST);

if (isset($_POST['TagoviIme'])) {
    $nazivtag = filter_input(INPUT_POST, 'TagoviIme', FILTER_SANITIZE_NUMBER_INT);
} else {
    $nazivtag = '';
}

$nazivtag = $common->clearvariable($_POST[nazivtag]);
$TagoviId = $common->clearvariable($_POST[TagoviId]);


if (isset($nazivtag)) {
    $updatetag = Array(
        "TagoviIme" => "$nazivtag"
    );

//$db->startTransaction();
    $db->where("TagoviId", $id);
    $db->delete('tagovi');
//$db->commit();
//var_dump($db);
//die;

    $error_msg["ok"] = 'Obrisan tag id: ' . $id;
} else {
    $error_msg["error"] = 'Greska pri izmeni taga';
}


echo $m = json_encode($error_msg);

header("Location:$url");
?>