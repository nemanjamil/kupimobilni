<?php

// prvo dobijamo sve kulture
$cols = Array("KS.IdKulturaSenzor","K.IdKulture", "K.ImeKulture");
$db->join("kulturasenzor KS", "KS.IdListaSenzora = LS.IdListaSenzora");
$db->join("kulture K", "K.IdKulture = KS.IdKulture");
$db->where("LS.SenzorSifra", $idSifra);
$link = $db->get("listasenzora LS", null, $cols);


if ($link) {


    $log->lwrite($opisSenzora);
    $log->lwrite('');
    foreach ($link AS $k => $v) {

        $IdKulture = $v['IdKulture'];
        $ImeKulture = $v['ImeKulture'];
        $IdKulturaSenzor = $v['IdKulturaSenzor'];

        $cols = Array("PKT.OdPodaciIdeal","PKT.DoPodaciIdeal", "PKT.OdZutoIdeal","PKT.DoZutoIdeal");
        $db->join("podacikultiplok PKT", "PKT.IdKulLokPodaci = SKL.IdKulLokPodaci");
        $db->where("SKL.IdKulture",$IdKulture);
        $db->where("SKL.IdKulLokPodaci",$tipSenzora);
        $podaci = $db->get("senzorkullokpodaci SKL", null, $cols);

        $OdPodaciIdeal = $podaci[0]['OdPodaciIdeal'];
        $DoPodaciIdeal = $podaci[0]['DoPodaciIdeal'];
        $OdZutoIdeal = $podaci[0]['OdZutoIdeal'];
        $DoZutoIdeal = $podaci[0]['DoZutoIdeal'];


        if (!$OdPodaciIdeal || !$DoPodaciIdeal || !$OdZutoIdeal || !$DoZutoIdeal) {
            // ovde treba da posalje mail da nema setovanih podataka
        }


        require "upucajPodatkezaSenzor.php";

    }
} else {
    $o['tag'] = 'upucavenjaSenzora';
    $o['success'] = false;
    $o['error'] = 1;
    $o['error_msg'] =  "Nije upucana ".$opisSenzora.' zato sto ne postoji kultura za dati SENZOR. MORA POSTOJATI KULTURA';
    $o['error_podaci'] =  "Id -> ".$idSifra." ; Vrednost ".$vrednostPodatak;
    $o['error_msg_opis'] =  $db->getLastError();
    echo json_encode($o,JSON_UNESCAPED_UNICODE);
    $log->lwrite($opisSenzora.' => Ne postoji Kultura za dati SENZOR '.$idSifra);
    die;
}