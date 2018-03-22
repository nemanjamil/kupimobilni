<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 31. 08. 2015.
 * Time: 10:35
 */
//var_dump($_POST);


$IdKomentari = $common->clearvariable($_POST[id]);
$KomentarKomentari = $common->clearvariable($_POST[string]);
$ImeKomentar = $common->clearvariable($_POST[ImeKomentar]);
$ActiveKomentar = $common->clearvariable($_POST[ActiveKomentar]);
$UserKomentari = $common->clearvariable($_POST[UserKomentari]);

if (isset($IdKomentari)) {
    $updatecoment = Array(
        "KomentarKomentari" => "$KomentarKomentari",
        "ImeKomentar" => "$ImeKomentar",
        "ActiveKomentar" => "$ActiveKomentar",
        "UserKomentari" => "$UserKomentari"
    );

    $db->where("IdKomentari ", $id);
    $db->update('komentari', $updatecoment);
//var_dump($db);

    header("Location:admin/komentari");

} else {
    $error_msg["error"] = 'Greska pri izmeni komentara';
}


echo $m = json_encode($error_msg);


?>