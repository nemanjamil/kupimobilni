<?php
/**
 * Created by PhpStorm.
 * User: Nikola
 * Date: 16.11.2015.
 * Time: 11.24
 */

$naziv = $common->clearvariable($_POST[naziv]);
$IdKulLokPodaci = $common->clearvariable($_POST[IdKulLokPodaci]);
$IdKultureKulLok = $common->clearvariable($_POST[IdKultureKulLok]);
$senzorTipIme = $common->clearvariable($_POST[senzorTipIme]);



//$insert_query od  senzorkullokpodaci
$update_query = Array(
    'IdKultureKulLok' => $IdKultureKulLok,
    'IdTipKulTipLok' => $senzorTipIme,
    'NazivKulLokPod' => $naziv
);

if (isset($naziv)) {
//  $db->setTrace (true);

    $db->where('IdKulLokPodaci', $IdKulLokPodaci);
    $db->update('senzorkullokpodaci', $update_query);


//   var_dump($db->trace);

} else {
    $error_msg["error"] = 'Nije odabrana kultura';
}

echo $error_msg;

header("Location:admin/podacikulture");

?>