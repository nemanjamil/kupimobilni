<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 10. 12. 2015.
 * Time: 10:45
 */

$IdSenNotNotifikacija = $common->clearvariable($_POST[IdSenNotNotifikacija]);

if (isset($IdSenNotNotifikacija)) {

    $db->where("idSenNoti", $id);
    $db->delete('opissenzornotifikacija');

    $error_msg["ok"] = 'Obrisan senzor sa id: ' . $id;
    header("Location:$url");
} else {
    $error_msg["error"] = 'Greska pri brisanju senzora';
}
echo $m = json_encode($error_msg);

?>