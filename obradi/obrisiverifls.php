<?php
/*
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 26. 08. 2015.
 * Time: 17:43
 */

//var_dump($id);
$ImeLokSamo = $common->clearvariable($_POST[naziv]);

if (isset($ImeLokSamo)) {

    $db->where("IdLokSamo", $id);
    $db->delete('lokalnasu');

//var_dump($db);
//die;
    $error_msg["ok"] = 'Obrisana samouprava sa id: ' . $id;
    header("Location:$url");
} else {
    $error_msg["error"] = 'Greska pri brisanju Lokalne Su';
}
echo $m = json_encode($error_msg);

?>