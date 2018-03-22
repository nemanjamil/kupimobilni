<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 28. 08. 2015.
 * Time: 17:03
 */
//var_dump($id);
$idImail = $common->clearvariable($_POST[id]);

if (isset($idImail)) {

    $db->where("idImail", $id);
    $db->delete('email');
//var_dump($db);

    $error_msg["ok"] = 'Obrisan mail sa id: ' . $id;
    header("Location:$url");
} else {
    $error_msg["error"] = 'Greska pri brisanju mail-a';
}
echo $m = json_encode($error_msg);

?>