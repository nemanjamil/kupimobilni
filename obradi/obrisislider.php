<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 14. 08. 2015.
 * Time: 17:43
 */
//var_dump($id);
$BanerNaziv = $common->clearvariable($_POST[banernaziv]);

if (isset($BanerNaziv)) {

    $db->where("BanerId", $id);
    $db->delete('baneri');
//var_dump($db);
//die;
    $error_msg["ok"] = 'Obrisan baner id: ' . $id;
    header("Location:$url");
} else {
    $error_msg["error"] = 'Greska pri brisanju taga';
}
echo $m = json_encode($error_msg);

?>