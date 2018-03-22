<?php
$postdata = file_get_contents("php://input");

if (!empty($postdata))
{
    $tp = $postdata;
} else {
    $tp = 'prazno';
}

$data = Array ("OpisRekONama" => $tp,
	"KomitRekOnama" => 1
);
$id = $db->insert ('rekonama', $data);
if($id) {
	echo 'stranica / user was created. Id=' . $id;
} else {
	echo 'stranica nesto ne radi';
}

?>