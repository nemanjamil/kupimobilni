<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 24.11.15.
 * Time: 16.45
 */
$IdKategPdvKatZem = $common->clearvariable($_POST[IdKategPdvKatZem]);
$IdZemljePdvKatZem = $common->clearvariable($_POST[IdZemljePdvKatZem]);
$PdvKategZemlja = $common->clearvariable($_POST[PdvKategZemlja]);



//$insert_query od  SenzorKulLokPodac
$insert_query = Array(
    'IdKategPdvKatZem' => $IdKategPdvKatZem,
    'IdZemljePdvKatZem' => $IdZemljePdvKatZem,
    'PdvKategZemlja' => $PdvKategZemlja
);

//var_dump($insert_query);

if (isset($naziv)) {
    $db->setTrace (true);
    $db->startTransaction();
    $db->insert('pdvkategzemlja', $insert_query);
    $db->commit();
//    var_dump($db->trace);

} else {
    $error_msg["error"] = 'Nije odabrana zemlja, kategorija ili vrednost poreza';
}

echo $error_msg;

header("Location:$url");
?>