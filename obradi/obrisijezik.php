<?php
/**
 * Project: masinealati
 * Created by PhpStorm.
 * User: Nikola
 * Date: 21. 09. 2016.
 * Time: 20:06
 */
if (isset($id)) {

    $db->where("IdLanguage", $id);
    $db->delete('languagejezik');

//var_dump($db);
//die;
    $error_msg["ok"] = 'Obrisan jezik sa id: ' . $id;
    header("Location:$url");
} else {
    $error_msg["error"] = 'Greska pri brisanju jezika';
}
echo $m = json_encode($error_msg);


header("Location:" . URLVRATI . "");