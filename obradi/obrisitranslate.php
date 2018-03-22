<?php
/**
 * Created by PhpStorm.
 * User: ITCluster Serbia
 * Date: 27.4.2016.
 * Time: 14:19
 */


$IdTranslate = $common->clearvariable($_GET[id]);

if (isset($IdTranslate)) {

    $db->where("IdTranslate", $IdTranslate);
    $db->delete('translate');

//var_dump($db);
//die;
    $error_msg["ok"] = 'Obrisan translate sa id: ' . $IdTranslate;
    header("Location:$url");
} else {
    $error_msg["error"] = 'Greska pri brisanju Prevoda';
}
echo $m = json_encode($error_msg);



header ( "Location:".URLVRATI."");