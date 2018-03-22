<?php


$IdSenzorKulPodLok = filter_var($_POST['IdSenzorKulPodLok'], FILTER_VALIDATE_INT);
$OdPodaciIdeal = filter_var($_POST['OdPodaciIdeal'], FILTER_VALIDATE_INT);
$DoPodaciIdeal = filter_var($_POST['DoPodaciIdeal'], FILTER_VALIDATE_INT);
$OdZutoIdeal = filter_var($_POST['OdZutoIdeal'], FILTER_VALIDATE_INT);
$DoZutoIdeal = filter_var($_POST['DoZutoIdeal'], FILTER_VALIDATE_INT);

// 1. Dobijamo koje je Ime za Datu Kulturu
$imeKulture = $senzori->idImeOdIdKulture($id);

// 2. Dobijamo koje je ime Senzore od odabranog senzora
$imeTipSenzori = $senzori->getImeOdIdSenzora($IdSenzorKulPodLok);

if (!$imeKulture && !$imeTipSenzori) {
    echo 'Ne postoji -> '.$imeKulture.' ili '.$imeTipSenzori;
    die;
}

$db->startTransaction();

// 3. Ubacimo u tabelu senzorkullokpodaci i da dobijemo ID
// Ali prvo proveravamo da li postoji u bazi
$db->where ("IdKulture", $id);
$db->where ("IdTipKulTipLok", $IdSenzorKulPodLok);
$podaciSenzor = $db->getOne ("senzorkullokpodaci");
$IdKulLokPodaci = $podaciSenzor['IdKulLokPodaci'];
if (!$IdKulLokPodaci) {

    $data = Array (
        'NazivKulLokPod' => $imeKulture.' '.$imeTipSenzori,
        'IdKulture' => $id,
        'IdTipKulTipLok' => $IdSenzorKulPodLok
    );

    $IdKulLokPodaci = $db->insert('senzorkullokpodaci', $data); // setQueryOption (Array('LOW_PRIORITY', 'IGNORE'))->
    if ($IdKulLokPodaci) {
        //echo 'user was created. Id=' . $id;
    } else {
        echo 'insert failed: Vec Postoji u bazi ' . $db->getLastError();
        die;
    }

}

/*
 * 4. Ubacujemo podatke u PodaciKulTipLok
 * */
$insert_query = Array(
    'IdKulLokPodaci' => $IdKulLokPodaci,
    'OdPodaciIdeal' => $OdPodaciIdeal,
    'DoPodaciIdeal' => $DoPodaciIdeal,
    'OdZutoIdeal' => $OdZutoIdeal,
    'DoZutoIdeal' => $DoZutoIdeal
);

$idPK = $db->insert ('podacikultiplok', $insert_query);
if (!$idPK) {
    echo 'insert failed: ' . $db->getLastError();
    die;
}

if (!$idPK) {
    echo 'Error while saving, cancel new record';
    $db->rollback();
    die;
} else {
    //OK
    $db->commit();
}

 header("Location:$url");
?>