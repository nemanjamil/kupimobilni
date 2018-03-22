<?php
/**
 * Project: masine
 * Created by PhpStorm.
 * User: Nikola
 * Date: 08. 02. 2016.
 * Time: 12:27
 */

$PosaoIme = $common->clearvariable($_POST[PosaoIme]);

if (isset($PosaoIme)) {

    $db->where("PosaoId", $id);
    $db->delete('posao');
//var_dump($db);
//die;
    $error_msg["ok"] = 'Obrisana prijava sa id: ' . $id;
    header("Location:$url");
} else {
    $error_msg["error"] = 'Greska pri brisanju prijave';
}
echo $m = json_encode($error_msg);