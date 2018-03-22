<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 26. 08. 2015.
 * Time: 17:43
 */

if (isset($id)) {

    $db->where("BrendId", $id);
    $db->delete('brendovi');

    $db->where("BrendId", $id);
    $db->delete('brendoviime');

    $db->where("BrendId", $id);
    $db->delete('brendoviopis');

//var_dump($db);
//die;
    $error_msg["ok"] = 'Obrisan brend sa id: ' . $id;
    header("Location:$url");
} else {
    $error_msg["error"] = 'Greska pri brisanju brenda';
}
echo $m = json_encode($error_msg);

?>