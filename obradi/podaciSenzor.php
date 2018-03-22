<?php


$cols = Array("PN.notSifraSenzora");
$db->join("listasenzora LS", "LS.SenzorSifra = PN.notSifraSenzora");
$db->join("komitenti K", "K.KomitentId = LS.PripadaKomitentu");
$db->join("kulturalokacija KL", "KL.IdKulturaLokacija = LS.PripadaKulLok");
$db->where("PN.vremeNotifikacije ", $vremeTest, '>=');
$db->where("PN.poslatMail", 0);
$db->where("K.KomitentId", $Kid);
$db->where("KL.IdKulturaLokacija", $IdKulturaLokacija);
$db->groupBy('PN.notSifraSenzora');
$linkListSenzoraSifra = $db->get("podacinotifikacija PN", null, $cols);




if ($linkListSenzoraSifra) {

    foreach ($linkListSenzoraSifra AS $key => $value):


    $notSifraSenzora = $value['notSifraSenzora'];

    require('cssMailAndroid/listaSenzoraPoKulturi.php');
    require('listaSenzorPodaci.php');

    endforeach;


}


?>