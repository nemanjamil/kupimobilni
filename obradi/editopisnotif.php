<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 10. 12. 2015.
 * Time: 09:55
 */

$IdSenNotNotifikacija = $common->clearvariable($_POST[IdSenNotNotifikacija]);
$IdSenNotSenzor = $common->clearvariable($_POST[IdSenNotSenzor]);
$IdSenNotVecaManja = $common->clearvariable($_POST[IdSenNotVecaManja]);
$OpisSenNot = $common->clearvariable($_POST[OpisSenNot]);

if (isset($IdSenNotNotifikacija)) {
    $updatespec = Array(
        "IdSenNotNotifikacija" => "$IdSenNotNotifikacija",
        "IdSenNotSenzor" => "$IdSenNotSenzor",
        "IdSenNotVecaManja" => "$IdSenNotVecaManja",
        "OpisSenNot" => "$OpisSenNot"
    );

    $db->where("idSenNoti", $id);
    $db->update('opissenzornotifikacija', $updatespec);

//$error_msg["ok"] = 'Izmenjen tag novo ime';
    header("Location:/admin/opisnotif");
//    header("Location: " . URLVRATI . "/?e=$error_msg");

} else {
    $error_msg["error"] = 'Greska pri izmeni opisa';
}

echo $m = json_encode($error_msg);
?>