<?php
if(isset($_POST['id'])) {  $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT); } else { $id = ''; }
if(isset($_POST['br'])) {  $br = filter_var($_POST['br'], FILTER_SANITIZE_NUMBER_INT); } else { $br = ''; }
if (isset($_POST['komId'])) { $komId = filter_var($_POST['komId'], FILTER_SANITIZE_NUMBER_INT); } else { $komId = ''; }

require DCROOT."/obradi/snimiTxt.php";
$log->lfile(DCROOT.'/logovi/basta.txt');
$log->lwrite('Obrisi Kulturu na Senzoru : id : '.$id.'; br : '.$br);

if (!$id) {
    $o['tag'] = 'obrisiKulturuNaSenzoru';
    $o['success'] = false;
    $o['error'] = 2;
    $o['error_msg'] =  "Nema Senzor ID";
    echo json_encode($o,JSON_UNESCAPED_UNICODE);
    die;
}

if (!$br) {
    $o['tag'] = 'obrisiKulturuNaSenzoru';
    $o['success'] = false;
    $o['error'] = 3;
    $o['error_msg'] =  "Nema Kultura ID";
    echo json_encode($o,JSON_UNESCAPED_UNICODE);
    die;
}

if (!$komId) {
    $o['tag'] = 'dodajKulturuNaSenzor';
    $o['success'] = false;
    $o['error'] = 4;
    $o['error_msg'] = "Nema id komId od KomitentID kome pripada senzor";
    echo json_encode($o, JSON_UNESCAPED_UNICODE);
    die;
}

    // brisemo sve senzore$
    $db->where('IdListaSenzora', $id);
    $db->where('IdKulture', $br);
    $db->where('KomitentId', $komId);
    if($db->delete('kulturasenzor')) {

        $o['tag'] = 'obrisiKulturuNaSenzoru';
        $o['success'] = true;
        $o['error'] = 0;  // stavio sam svuda 1
        $o['error_msg'] =  "Obrisana Kultura na senzoru";

    } else {
        $o['tag'] = 'obrisiKulturuNaSenzoru';
        $o['success'] = false;
        $o['error'] = 1;  // stavio sam svuda 1
        $o['error_msg'] =  "Nije uspesno obrisana kultura na senzoru";
    }


echo json_encode($o,JSON_UNESCAPED_UNICODE);

?>