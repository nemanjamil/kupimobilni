<?php

if (!$id) {
    $o['tag'] = 'dodajsenzor';
    $o['success'] = false;
    $o['error'] = 1;  // stavio sam svuda 1
    $o['error_msg'] =  "Nema ID";
    echo json_encode($o,JSON_UNESCAPED_UNICODE);
    die;
}

if (!$br) {
    $o['tag'] = 'dodajsenzor';
    $o['success'] = false;
    $o['error'] = 2;  // stavio sam svuda 1
    $o['error_msg'] =  "Nema br";
    echo json_encode($o,JSON_UNESCAPED_UNICODE);
    die;
}

if (!$string) {
    $o['tag'] = 'dodajsenzor';
    $o['success'] = false;
    $o['error'] = 3;  // stavio sam svuda 1
    $o['error_msg'] =  "Nema string";
    echo json_encode($o,JSON_UNESCAPED_UNICODE);
    die;
}

$cols = Array("K.KomitentId");
$db->where("K.KomitentId", $id);
$link = $db->get("komitenti K", null, $cols);
$KomitentIdIma = $link[0]['KomitentId'];
if (!$KomitentIdIma) {
    $o['tag'] = 'dodajsenzor';
    $o['success'] = false;
    $o['error'] = 4;  // stavio sam svuda 1
    $o['error_msg'] =  "Ne postoji komitent";
    echo json_encode($o,JSON_UNESCAPED_UNICODE);
    die;
}

$cols = Array("KL.IdKulturaLokacija");
$db->where("KL.IdKulturaLokacija", $br);
$link = $db->get("kulturalokacija KL", null, $cols);
$KomitentIdIma = $link[0]['IdKulturaLokacija'];
if (!$KomitentIdIma) {
    $o['tag'] = 'dodajsenzor';
    $o['success'] = false;
    $o['error'] = 5;  // stavio sam svuda 1
    $o['error_msg'] =  "Ne postoji Kultura i Lokacija";
    echo json_encode($o,JSON_UNESCAPED_UNICODE);
    die;
}


$data = Array (
    'SenzorSifra' => $string,
    'PripadaKulLok' => $br,
    'PripadaKomitentu' => $id
);

$id = $db->insert ('listasenzora', $data);
if ($id) {
    $o['tag'] = 'dodajsenzor';
    $o['success'] = true;
    $o['error'] = 0;  // stavio sam svuda 1
    $o['error_msg'] =  "DodatSenzor -> id : ".$id;
}
else {
    $o['tag'] = 'dodajsenzor';
    $o['success'] = false;
    $o['error'] = 1;  // stavio sam svuda 1
    $o['error_msg'] =  "Nije dodat senzor";
    $o['error_msg_opis'] =  $db->getLastError();

}

echo json_encode($o,JSON_UNESCAPED_UNICODE);


?>