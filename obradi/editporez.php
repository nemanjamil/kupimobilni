<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 24.11.15.
 * Time: 16.47
 */

$IdPdvListaPoreza = $common->clearvariable($_POST[IdPdvListaPoreza]);

$PorezVrednost = $common->clearvariable($_POST[naziv]);


//$insert_query od  KulturaLokacija
$update_query = Array(

    'PorezVrednost' => $PorezVrednost
);


if (isset($PorezVrednost)) {
//  $db->setTrace (true);

    $db->where('IdPdvListaPoreza', $IdPdvListaPoreza);
    $db->update('pdvlistaporeza', $update_query);

} else {
    $error_msg["error"] = 'Nije odabrana prava vrednost';
}

echo $error_msg;

header("Location:admin/pdvlista");

?>