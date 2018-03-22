<?php
/**
 * Created by PhpStorm.
 * User: Nikola
 * Date: 17.11.2015.
 * Time: 13.24
 */


$IdPodaciKulTipLok = $common->clearvariable($_POST[IdPodaciKulTipLok]);
$IdSenzorKulPodLok = $common->clearvariable($_POST[IdSenzorKulPodLok]);
$OdPodaciIdeal = $common->clearvariable($_POST[OdPodaciIdeal]);
$DoPodaciIdeal = $common->clearvariable($_POST[DoPodaciIdeal]);
$OdZutoIdeal = $common->clearvariable($_POST[OdZutoIdeal]);
$DoZutoIdeal = $common->clearvariable($_POST[DoZutoIdeal]);



//$insert_query od  senzorkullokpodaci
$update_query = Array(
    //'IdSenzorKulPodLok' => $IdSenzorKulPodLok,
    'OdPodaciIdeal' => $OdPodaciIdeal,
    'DoPodaciIdeal' => $DoPodaciIdeal,
    'OdZutoIdeal' => $OdZutoIdeal,
    'DoZutoIdeal' => $DoZutoIdeal
);



if (isset($naziv)) {
//  $db->setTrace (true);

    $db->where('IdPodaciKulTipLok', $IdPodaciKulTipLok);
    $db->update('podacikultiplok', $update_query);


//  var_dump($db->trace);


} else {
    $error_msg["error"] = 'Nije odabrana kultura';
}

echo $error_msg;

header("Location:$url");

?>