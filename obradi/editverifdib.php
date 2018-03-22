<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 12. 08. 2015.
 * Time: 15:22
 */
//var_dump($_POST);
//die;


$OcenaVeriKomi = $common->clearvariable($_POST[string]);
$IdVerKomi = $common->clearvariable($_POST[id]);
$OpisVerKomit = $common->clearvariable($_POST[naziv]);


if (isset($OcenaVeriKomi)) {
    $updatever = Array(
        "OcenaVeriKomi" => "$OcenaVeriKomi",
        "OpisVerKomit" => "$OpisVerKomit"
    );

//var_dump($updatever);
//die;

    $db->where("IdVerKomi", $id);
    $db->update('verikomitent', $updatever);
//var_dump($db);

//die;

    //$error_msg["ok"] = 'Izmenjen tag novo ime';
    header("Location:admin/verifikacijadirektno");

} else {
    $error_msg["error"] = 'Greska pri izmeni taga';
}


echo $m = json_encode($error_msg);


?>