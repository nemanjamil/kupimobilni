<?php


if (isset($_POST['id'])) { $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);} else {  $id = ''; }
if (isset($_POST['br'])) { $br = filter_input(INPUT_POST, 'br', FILTER_SANITIZE_NUMBER_INT);} else {  $br = ''; }

require 'proveriAjaxDeny.php';


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


$data = Array ("ArtikalId" => $id,   "ModelId" => $br );
$id = $db->insert ('modeli_artikli', $data);
if ($id) {

    $m['success'] = true;
    $m['error'] = 0;
    $m['error_msg'] = "Dodat Model"; // .$id;

} else {

    $m['success'] = false;
    $m['error'] = 1;
    $m['error_msg'] = $db->getLastError();

}

echo $m = json_encode($m, JSON_UNESCAPED_UNICODE);
