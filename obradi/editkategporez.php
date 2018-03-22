<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 24.11.15.
 * Time: 16.48
 */

$IdPdvKategZemlja = $common->clearvariable($_POST[IdPdvKategZemlja]);
$IdKategPdvKatZem = $common->clearvariable($_POST[IdKategPdvKatZem]);
$IdZemljePdvKatZem = $common->clearvariable($_POST[IdZemljePdvKatZem]);
$PdvKategZemlja = $common->clearvariable($_POST[PdvKategZemlja]);

$update_query = Array(
    'IdKategPdvKatZem' => $IdKategPdvKatZem,
    'IdZemljePdvKatZem' => $IdZemljePdvKatZem,
    'PdvKategZemlja' => $PdvKategZemlja
);

if (isset($naziv)) {
//  $db->setTrace (true);
    $db->where('IdPdvKategZemlja', $IdPdvKategZemlja);
    $db->update('pdvkategzemlja', $update_query);
//   var_dump($db->trace);
} else {
    $error_msg["error"] = 'Nije odabran neki od podataka';
}

echo $error_msg;

header("Location:admin/pdvkateg");
?>