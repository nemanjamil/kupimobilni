<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 16. 08. 2015.
 * Time: 11:43
 */


$IdKulLokPodaci = $common->clearvariable($_POST[IdKulLokPodaci]);

if (isset($IdKulLokPodaci)) {

    $db->where("IdKulLokPodaci", $id);
    $db->delete('senzorkullokpodaci');
//var_dump($db);
//die;
    $error_msg["ok"] = 'Obrisana kultura sa id: ' . $id;
    header("Location:$url");
} else {
    $error_msg["error"] = 'Greska pri brisanju kulture';
}
echo $m = json_encode($error_msg);
?>