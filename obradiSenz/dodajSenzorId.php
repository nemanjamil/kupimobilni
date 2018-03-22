<?php
//$postdata = file_get_contents("php://input");

/*echo '<br/> GET';
var_dump($_GET);*/


if(isset($_POST['id'])) {  $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT); } else { $id = ''; }
if(isset($_POST['string'])) {  $string = filter_var($_POST['string'], FILTER_SANITIZE_STRING); } else { $string = ''; }

require DCROOT."/obradi/snimiTxt.php";
$log->lfile(DCROOT.'/logovi/basta.txt');
$log->lwrite('OK Podaci koji je pokupto OD Posta -> id : '.$id.'; string: '.$string);


if (!$id) {
    $o['tag'] = 'dodajsenzor';
    $o['success'] = false;
    $o['error'] = 1;  // stavio sam svuda 1
    $o['error_msg'] = "Nema ID";
    echo json_encode($o, JSON_UNESCAPED_UNICODE);
    die;
}

if (!$string) {
    $o['tag'] = 'dodajsenzor';
    $o['success'] = false;
    $o['error'] = 3;  // stavio sam svuda 1
    $o['error_msg'] = "Nema string";
    echo json_encode($o, JSON_UNESCAPED_UNICODE);
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
    $o['error_msg'] = "Ne postoji komitent";
    echo json_encode($o, JSON_UNESCAPED_UNICODE);
    die;
}

/*$cols = Array("KL.IdKulturaLokacija");
$db->where("KL.IdKulturaLokacija", $br);
$link = $db->get("kulturalokacija KL", null, $cols);
$KomitentIdIma = $link[0]['IdKulturaLokacija'];
if (!$KomitentIdIma) {
    $o['tag'] = 'dodajsenzor';
    $o['success'] = false;
    $o['error'] = 5;  // stavio sam svuda 1
    $o['error_msg'] = "Ne postoji Kultura i Lokacija";
    echo json_encode($o, JSON_UNESCAPED_UNICODE);
    die;
}*/


$data = Array(
    'SenzorSifra' => $string,
    'KomitentId' => $id
);
$id = $db->insert('listasenzora', $data);

if ($id) {
    $o['tag'] = 'dodajsenzor';
    $o['success'] = true;
    $o['error'] = 0;  // stavio sam svuda 1
    $o['error_msg'] = "DodatSenzor -> id : " . $id;
} else {
    $o['tag'] = 'dodajsenzor';
    $o['success'] = false;
    $o['error'] = 1;  // stavio sam svuda 1
    $o['error_msg'] = "Nije dodat senzor";
    $o['error_msg_opis'] = $db->getLastError();

}

echo json_encode($o, JSON_UNESCAPED_UNICODE);


?>