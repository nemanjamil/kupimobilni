<?php


$data = Array (
    'MenjanArtikal' => $MenjanArtikal,
    'BrojDokle' => $i,
    'Ukupno' => $kolikoimachild,
    'VremePoc' => $date,
    'VremeKraj' => date("Y-m-d H:i:s")
);
$db->where ('IdCronXml', $kojijevendor);
if ($db->update ('cronzaxml', $data)) {
    $pokazi .= $db->count . ' records were updated';
} else {
    $pokazi .= 'update failed: ' . $db->getLastError();
}

?>