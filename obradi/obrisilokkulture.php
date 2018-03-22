<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 16. 08. 2015.
 * Time: 11:43
 */

if (isset($id)) {

    $db->where("IdKulturaLokacija", $id);
    $db->delete('kulturalokacija');

    $error_msg["ok"] = 'Obrisana loakcija kulture sa id: ' . $id;
    header("Location:$url");
} else {
    $error_msg["error"] = 'Greska pri brisanju lokacije kulture';
}
echo $m = json_encode($error_msg);

?>