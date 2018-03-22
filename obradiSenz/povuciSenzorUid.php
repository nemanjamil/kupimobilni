<?php
//$postdata = file_get_contents("php://input");
// ostavio sam POST a skinuo GET
$postdata = $_GET;



if (!empty($postdata)) {
    $tp = $postdata;
} else {
    // ako nema upste podataka
    $o['tag'] = 'senzorUid';
    $o['success'] = false;
    $o['error'] = 1;  // stavio sam svuda 1
    $o['error_msg'] =  "No Data";

    echo json_encode($o,JSON_UNESCAPED_UNICODE);
    die;
}

$tp = json_encode($tp); // ovo nam nece trebati jer dobijamo JSON kada se salje POST
$someObject = json_decode($tp);

// hvatamo varijable
$id = (int) trim($someObject->id);
$tag = trim($someObject->tag);


if (!$id) {
    $o['tag'] = 'senzorUid';
    $o['success'] = false;
    $o['error'] = 2;  // stavio sam svuda 1
    $o['error_msg'] =  "No ID";
    echo json_encode($o,JSON_UNESCAPED_UNICODE);
    die;
}


$cols = Array ("LS.IdListaSenzora", "LS.SenzorSifra","K.ImeKulture","K.IdKulture","LSS.ImeLokSamo","LSS.IdLokSamo");

$db->join("kulturalokacija KL","KL.IdKulturaLokacija = LS.PripadaKulLok");
$db->join("kulture K","KL.PovKulture = K.IdKulture");
$db->join("lokalnasu LSS","LSS.IdLokSamo = KL.PovLokSamouprava");
$db->where("LS.PripadaKomitentu",$id);


$users = $db->get ("listasenzora LS", null, $cols);


if ($db->count > 0) {

    $arrayFull = array();
    $a = array();

    $o['tag'] = 'senzorUid';
    $o['success'] = true;
    $o['error'] = 0;
    $o['uid'] = $id;




    foreach ($users as $user) {

        $IdListaSenzora = $user['IdListaSenzora'];
        $SenzorSifra = $user['SenzorSifra'];
        $ImeKulture = $user['ImeKulture'];
        $IdKulture = $user['IdKulture'];
        $ImeLokSamo = $user['ImeLokSamo'];
        $IdLokSamo = $user['IdLokSamo'];

        $u['IdListaSenzora'] = $IdListaSenzora;
        $u['SenzorSifra'] = $SenzorSifra;
        $u['ImeKulture'] = $ImeKulture;
        $u['IdKulture'] = $IdKulture;
        $u['LokacijaIme'] = $ImeLokSamo;
        $u['LokacijaId'] = $IdLokSamo;


        // ubacivenje u array
        array_push($a,$u);

        // $o['senzorV2'][$IdListaSenzora] = $SenzorSifra;


    }
    $o['senzor'] = $a;

    array_push($arrayFull,$o);


} else {

    $arrayFull['tag'] = 'senzorUid';
    $arrayFull['success'] = false;
    $arrayFull['error'] = 3;
    $arrayFull['error_msg'] =  "Nema podataka za dati ID";

}


echo json_encode($arrayFull,JSON_UNESCAPED_UNICODE);
die;


?>
