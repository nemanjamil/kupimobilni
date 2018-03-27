<?php
/**
 * Project: masinealati
 * Created by PhpStorm.
 * User: Nikola
 * Date: 21. 09. 2016.
 * Time: 20:06
 */
if (isset($string)) {

    $db->where("imestanja", $string);
    $db->delete('setovanjevarijabli');

//var_dump($db);
//die;
    $error_msg["ok"] = 'Obrisana varijabla sa : ' . $string;
    header("Location:$url");
} else {
    $error_msg["error"] = 'Greska pri brisanju VARIJABLE';
}
echo $m = json_encode($error_msg);


header("Location:" . URLVRATI . "");