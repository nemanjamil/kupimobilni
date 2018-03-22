<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 28. 08. 2015.
 * Time: 17:03
 */
//var_dump($id);
$IdVesti = $common->clearvariable($_POST[id]);

if (isset($IdVesti)) {

    $db->where("IdVesti", $id);
    $db->delete('vesti');

//var_dump($db);

    $error_msg["ok"] = 'Obrisana vest sa id: ' . $id;
    header("Location:$url");
} else {
    $error_msg["error"] = 'Greska pri brisanju vest-i';
}
echo $m = json_encode($error_msg);

?>