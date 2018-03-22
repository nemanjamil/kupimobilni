<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 24.11.15.
 * Time: 16.44
 */


$PorezVrednost = $common->clearvariable($_POST[PorezVrednost]);

if (isset($PorezVrednost)) {
    $insertData = Array(
        'PorezVrednost' => $PorezVrednost

    );


   $db->insert('pdvlistaporeza', $insertData);


} else {
    $error_msg["error"] = 'Nema naziva';
}

echo $error_msg;

header("Location:$url");

?>