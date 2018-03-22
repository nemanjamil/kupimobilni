<?php
/*
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 26. 08. 2015.
 * Time: 17:43
 */

//var_dump($id);
$OpisRekONama = $common->clearvariable($_POST[string]);

if (isset($OpisRekONama)) {

    $db->where("idRekOnam", $id);
    $db->delete('rekonama');
//var_dump($db);
//die;
    $error_msg["ok"] = 'Obrisan komentar sa id: ' . $id;
    header("Location:$url");
} else {
    $error_msg["error"] = 'Greska pri brisanju komentara';
}
echo $m = json_encode($error_msg);

?>