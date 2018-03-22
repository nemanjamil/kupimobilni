<?php
//$postdata = file_get_contents("php://input");
// ostavio sam POST a skinuo GET
$postdata = $_GET;

if (!empty($postdata)) {
    $tp = $postdata;
} else {
    // ako nema upste podataka
    $o['tag'] = 'izmeniPodatkeSenzorId';
    $o['success'] = false;
    $o['error'] = 1;  // stavio sam svuda 1
    $o['error_msg'] = "No Data";

    echo json_encode($o, JSON_UNESCAPED_UNICODE);
    die;
}

$tp = json_encode($tp); // ovo nam nece trebati jer dobijamo JSON kada se salje POST
$someObject = json_decode($tp);

$string = filter_var($someObject->string, FILTER_SANITIZE_STRING);
$id = filter_var($someObject->id, FILTER_SANITIZE_NUMBER_INT);
$br = filter_var($someObject->br, FILTER_SANITIZE_NUMBER_INT);


if (!$string) {
    $o['tag'] = 'izmeniPodatkeSenzorId';
    $o['success'] = false;
    $o['error'] = 2;  // stavio sam svuda 1
    $o['error_msg'] = "No sting";
    echo json_encode($o, JSON_UNESCAPED_UNICODE);
    die;
}

if (!$id) {
    $o['tag'] = 'izmeniPodatkeSenzorId';
    $o['success'] = false;
    $o['error'] = 3;  // stavio sam svuda 1
    $o['error_msg'] = "No ID Komitent";
    echo json_encode($o, JSON_UNESCAPED_UNICODE);
    die;
}

if (!$br) {
    $o['tag'] = 'izmeniPodatkeSenzorId';
    $o['success'] = false;
    $o['error'] = 4;  // stavio sam svuda 1
    $o['error_msg'] = "No BR Kultura";
    echo json_encode($o, JSON_UNESCAPED_UNICODE);
    die;
}

$data = Array(
    'PripadaKulLok' => $br,
    'PripadaKomitentu' => $id
);

$db->where('SenzorSifra', $string);
if ($db->update('listasenzora', $data)) {


    $o['tag'] = 'izmeniPodatkeSenzorId';
    $o['success'] = true;
    $o['error'] = 0;
    $o['error_msg'] = "Sve je upucano kako treba " . $db->count;

    /*
     * Ovde bi sada trebalo izbrisati sve podatke za dati senzor i datu kulturu
     */
   /* $db->where('idSenzorTemp', $string);
    if($db->delete('senzortemp')) {
        $o['senzortemp'] = "obrisano senzortemp";
    } else {
        $o['senzortemp'] = "Nije obrisan senzortemp";
    }


    $db->where('IdSenzorSvetlost', $string);
    if($db->delete('senzorsvetlosti')) {
        $o['senzorsvetlosti'] = "obrisano senzortemp";
    } else {
        $o['senzorsvetlosti'] = "Nije obrisan senzortemp";
    }

    $db->where('IdSenzorMoisture', $string);
    if($db->delete('senzormoisture')) {
        $o['senzormoisture'] = "obrisano senzortemp";
    } else {
        $o['senzormoisture'] = "Nije obrisan senzortemp";
    }

    $db->where('idSenzorVlaznosti', $string);
    if($db->delete('senzorvlaznosti')) {
        $o['senzorvlaznosti'] = "obrisano senzortemp";
    } else {
        $o['senzorvlaznosti'] = "Nije obrisan senzortemp";
    }


    $db->where('notSifraSenzora', $string);
    if($db->delete('podacinotifikacija')) {
        $o['podacinotifikacija'] = "obrisano senzortemp";
    } else {
        $o['podacinotifikacija'] = "Nije obrisan senzortemp";
    }*/


} else {

    $o['tag'] = 'izmeniPodatkeSenzorId';
    $o['success'] = false;
    $o['error'] = 5;
    $o['error_msg'] = "update failed";
    $o['error_msg_opis'] = $db->getLastError();
}



echo json_encode($o, JSON_UNESCAPED_UNICODE);
die;


?>
