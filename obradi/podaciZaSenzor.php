<?php


$cols = Array("K.ImeKulture","ST.senzorTipIme", "LSU.ImeLokSamo", "KL.NazivKulturaLokacija", "SKL.NazivKulLokPod", "PKL.*");
$db->join("kulturalokacija KL", "KL.IdKulturaLokacija = LS.PripadaKulLok");
$db->join("kulture K", "KL.PovKulture = K.IdKulture");
$db->join("lokalnasu LSU", "KL.PovLokSamouprava = LSU.IdLokSamo");
$db->join("senzorkullokpodaci SKL", "SKL.IdKultureKulLok = LS.PripadaKulLok");
$db->join("senzortip ST", "ST.IdSenzorTip = SKL.IdTipKulTipLok");
$db->join("podacikultiplok PKL", "PKL.IdSenzorKulPodLok = SKL.IdKulLokPodaci");
$db->where("LS.SenzorSifra", $idSifra);
$link = $db->get("listasenzora LS", null, $cols);

foreach ($link as $k=> $v):

    $links[$v['IdPodaciKulTipLok']] = $v;

    $data = Array("idSenzorTemp" => $idSifra,
        "vredSenzorTemp" => $temperature
    );
    $id = $db->insert('senzortemp', $data);


endforeach;


?>