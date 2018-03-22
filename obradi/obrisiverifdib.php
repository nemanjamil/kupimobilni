<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 14. 08. 2015.
 * Time: 17:43
 */
//var_dump($id);
$OcenaVeriKomi = $common->clearvariable($_POST[string]);

if (isset($OcenaVeriKomi)) {

    $db->where("IdVerKomi", $id);
    $db->delete('verikomitent');

//var_dump($db);
//die;
    $error_msg["ok"] = 'Obrisana verifikacija sa id: ' . $id;
    header("Location:$url");
} else {
    $error_msg["error"] = 'Greska pri brisanju Verifikacije';
}
echo $m = json_encode($error_msg);

?>