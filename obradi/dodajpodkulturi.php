<?php
/**
 * Created by PhpStorm.
 * User: Nikola
 * Date: 14.11.2015.
 * Time: 15.54
 */
$IdKultureKulLok = $common->clearvariable($_POST[IdKultureKulLok]);
$senzorTipIme = $common->clearvariable($_POST[senzorTipIme]);
$naziv = $common->clearvariable($_POST[naziv]);



//$insert_query od  SenzorKulLokPodac
$insert_query = Array(
    'IdKultureKulLok' => $IdKultureKulLok,
    'IdTipKulTipLok' => $senzorTipIme,
    'NazivKulLokPod' => $naziv
);

//var_dump($insert_query);

if (isset($naziv)) {
    $db->setTrace (true);
    $db->startTransaction();

    $idUbacenogsen = $db->insert('senzorkullokpodaci', $insert_query);

    $db->commit();
//    var_dump($db->trace);

} else {
    $error_msg["error"] = 'Nije odabrana kultura';
}

echo $error_msg;

header("Location:$url");
?>