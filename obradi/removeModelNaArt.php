<?php


if (isset($_POST['id'])) { $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);} else {  $id = ''; }
if (isset($_POST['br'])) { $br = filter_input(INPUT_POST, 'br', FILTER_SANITIZE_NUMBER_INT);} else {  $br = ''; }

require '/obradi/proveriAjaxDeny.php';


// ako  ne postoji ID
if(!$id) {
    $m['success'] = false;
    $m['error'] = 3;
    $m['error_msg'] = 'Nema ID';
    echo $m = json_encode($m, JSON_UNESCAPED_UNICODE);
    die;
}

// ako  ne postoji ID
if(!$br) {
    $m['success'] = false;
    $m['error'] = 4;
    $m['error_msg'] = 'Nema BR';
    echo $m = json_encode($m, JSON_UNESCAPED_UNICODE);
    die;
}


$db->where('ArtikalId', $id);
$db->where('ModelId', $br);
if($db->delete('modeli_artikli')) {

    $m['success'] = true;
    $m['error'] = 0;
    $m['error_msg'] = "Obrisano"; // .$id;

} else {
    $m['success'] = false;
    $m['error'] = 0;
    $m['error_msg'] = "Nije Obrisano"; // .$id;
}

echo $m = json_encode($m, JSON_UNESCAPED_UNICODE);
