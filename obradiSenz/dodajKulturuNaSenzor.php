<?php
if (isset($_POST['id'])) { $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT); } else { $id = ''; }
if (isset($_POST['br'])) { $br = filter_var($_POST['br'], FILTER_SANITIZE_NUMBER_INT); } else { $br = ''; }
if (isset($_POST['komId'])) { $komId = filter_var($_POST['komId'], FILTER_SANITIZE_NUMBER_INT); } else { $komId = ''; }

require DCROOT."/obradi/snimiTxt.php";
$log->lfile(DCROOT.'/logovi/basta.txt');
$log->lwrite('Dodaj Kulturu na Senzoru : id : '.$id.'; br : '.$br);

if (!$id) {
    $o['tag'] = 'dodajKulturuNaSenzor';
    $o['success'] = false;
    $o['error'] = 1;
    $o['error_msg'] = "Nema id Senzora";
    echo json_encode($o, JSON_UNESCAPED_UNICODE);
    die;
}

if (!$br) {
    $o['tag'] = 'dodajKulturuNaSenzor';
    $o['success'] = false;
    $o['error'] = 2;
    $o['error_msg'] = "Nema id kulture";
    echo json_encode($o, JSON_UNESCAPED_UNICODE);
    die;
}
if (!$komId) {
    $o['tag'] = 'dodajKulturuNaSenzor';
    $o['success'] = false;
    $o['error'] = 3;
    $o['error_msg'] = "Nema id komId od KomitentID kome pripada senzor";
    echo json_encode($o, JSON_UNESCAPED_UNICODE);
    die;
}


$data = Array(
    'IdListaSenzora' => $id,
    'IdKulture' => $br,
    'KomitentId' => $komId
);


$db->startTransaction();

if (!$db->insert('kulturasenzor', $data)) {
    $db->rollback();
    $o['tag'] = 'dodajKulturuNaSenzor';
    $o['success'] = false;
    $o['error'] = 0;  // stavio sam svuda 1
    $o['error_msg'] = "Nije dobro povezano";
} else {
    $db->commit();
    $o['tag'] = 'dodajKulturuNaSenzor';
    $o['success'] = true;
    $o['error'] = 1;
    $o['error_msg'] = "Sve ok";
}

echo json_encode($o, JSON_UNESCAPED_UNICODE);


?>