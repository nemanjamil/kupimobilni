<?php

$data = Array (
    'elSearch' => 1,
);
$db->where ('ArtikalId', $ArtikalId);
if ($db->update ('artikli', $data)) {
    $infoUpdate = $db->count . ' records were updated '.$ArtikalId;
    //$log->lwrite($infoUpdate);
} else {
    $infoUpdate =  'update failed: ' . $db->getLastError();
    //$log->lwrite($infoUpdate);
}


?>