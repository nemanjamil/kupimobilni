<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 31. 08. 2015.
 * Time: 10:35
 */
//var_dump($_POST);
//die;


$idRekOnam = $common->clearvariable($_POST[id]);
$OpisRekONama = $common->clearvariable($_POST[string]);

if (isset($idRekOnam)) {
    $updateonama = Array(
        "OpisRekONama" => "$OpisRekONama"

    );

    $db->where("idRekOnam ", $id);
    $db->update('rekonama', $updateonama);
//var_dump($db);

    header("Location:admin/reklionama");

} else {
    $error_msg["error"] = 'Greska pri izmeni komentara';
}


echo $m = json_encode($error_msg);


?>