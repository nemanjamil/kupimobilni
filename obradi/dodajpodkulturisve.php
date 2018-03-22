<?php
/**
 * Created by PhpStorm.
 * User: Nikola
 * Date: 14.11.2015.
 * Time: 15.54
 */


$IdSenzorKulPodLok = $common->clearvariable($_POST[IdSenzorKulPodLok]);
$OdPodaciIdeal = $common->clearvariable($_POST[OdPodaciIdeal]);
$DoPodaciIdeal = $common->clearvariable($_POST[DoPodaciIdeal]);
$OdZutoIdeal = $common->clearvariable($_POST[OdZutoIdeal]);
$DoZutoIdeal = $common->clearvariable($_POST[DoZutoIdeal]);


//$insert_query od  PodaciKulTipLok
$insert_query = Array(
    'IdSenzorKulPodLok' => $IdSenzorKulPodLok,
    'OdPodaciIdeal' => $OdPodaciIdeal,
    'DoPodaciIdeal' => $DoPodaciIdeal,
    'OdZutoIdeal' => $OdZutoIdeal,
    'DoZutoIdeal' => $DoZutoIdeal
);

//var_dump($insert_query);

if (isset($IdSenzorKulPodLok)) {
  //  $db->setTrace (true);
    $db->startTransaction();
    $db->insert('podacikultiplok', $insert_query);
    $db->commit();
//  var_dump($db->trace);

} else {
    $error_msg["error"] = 'Nije odabrana kultura';
}

echo $error_msg;

header("Location:$url");
?>