<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 24.11.15.
 * Time: 16.54
 */
//var_dump($id);
$IdPdvListaPoreza = $common->clearvariable($_POST[id]);

if (isset($IdPdvListaPoreza)) {

    $db->where("IdPdvListaPoreza", $id);
    $db->delete('pdvlistaporeza');
//var_dump($db);
//die;
    $error_msg["ok"] = 'Obrisana kultura sa id: ' . $id;
    header("Location:$url");
} else {
    $error_msg["error"] = 'Greska pri brisanju kulture';
}
echo $m = json_encode($error_msg);

?>