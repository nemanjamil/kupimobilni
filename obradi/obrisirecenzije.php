<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 19. 01. 2016.
 * Time: 14:57
 */

if (isset($id)) {

    $db->where("IdRecenzije", $id);
    $db->delete('recenzije');

//var_dump($db);
//die;

    $error_msg["ok"] = 'Obrisan brend sa id: ' . $id;
    header("Location:$url");
} else {
    $error_msg["error"] = 'Greska pri brisanju brenda';
}
echo $m = json_encode($error_msg);

?>