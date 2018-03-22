<?php
if(isset($_POST['id'])) {  $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT); } else { $id = ''; }
if(isset($_POST['br'])) {  $br = filter_var($_POST['br'], FILTER_SANITIZE_NUMBER_INT); } else { $br = ''; }

require DCROOT."/obradi/snimiTxt.php";
$log->lfile(DCROOT.'/logovi/basta.txt');
$log->lwrite('Obrisi Senzor : id : '.$id.'; br : '.$br);

if (!$id) {
    $o['tag'] = 'obrisiSenzorId';
    $o['success'] = false;
    $o['error'] = 3;  // stavio sam svuda 1
    $o['error_msg'] =  "Nema Senzor ID";
    echo json_encode($o,JSON_UNESCAPED_UNICODE);
    die;
}

if (!$br) {
    $o['tag'] = 'obrisiSenzorId';
    $o['success'] = false;
    $o['error'] = 4;  // stavio sam svuda 1
    $o['error_msg'] =  "Nema Komitent ID";
    echo json_encode($o,JSON_UNESCAPED_UNICODE);
    die;
}


$cols = Array("LS.IdListaSenzora");
$db->where("LS.IdListaSenzora", $id);
$db->where("LS.KomitentId", $br);
$link = $db->get("listasenzora LS", null, $cols);
$daliImauLS = $link[0]['IdListaSenzora'];

if ($daliImauLS) {


    $db->where('SenzorZaArtikal', $daliImauLS);
    if($db->delete('senzorizaartikal')) {
        $o['obrisaniIzArtikala'] = 1;
    } else {
        $o['obrisaniIzArtikala'] = 0;
    }


    // brisemo sve senzore$
    $db->where('IdListaSenzora', $id);
    $db->where('KomitentId', $br);
    if($db->delete('listasenzora')) {

        $o['tag'] = 'obrisiSenzorId';
        $o['success'] = true;
        $o['error'] = 0;  // stavio sam svuda 1
        $o['error_msg'] =  "Obrisan senzor";


    } else {
        $o['tag'] = 'obrisiSenzorId';
        $o['success'] = false;
        $o['error'] = 2;  // stavio sam svuda 1
        $o['error_msg'] =  "Nije uspesno obrisan senzor";
    }

} else {

    $o['tag'] = 'obrisiSenzorId';
    $o['success'] = false;
    $o['error'] = 1;  // stavio sam svuda 1
    $o['error_msg'] =  "Nema datog senzora koji pripada komitentu";

}

echo json_encode($o,JSON_UNESCAPED_UNICODE);

?>