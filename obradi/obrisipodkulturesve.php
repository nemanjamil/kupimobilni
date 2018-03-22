<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 16. 08. 2015.
 * Time: 11:43
 */


if (isset($id)) {

    $db->where("IdPodaciKulTipLok", $id);
    $db->delete('podacikultiplok');

    $error_msg["ok"] = 'Obrisani podaci sa id: ' . $id;
    header("Location:$url");
} else {
    $error_msg["error"] = 'Greska pri brisanju podataka';
}
echo $m = json_encode($error_msg);

?>