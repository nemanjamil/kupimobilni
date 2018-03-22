<?php

$data = Array (
    'ImeSlikeArtikliSlike' => $linkslikeMojabaza
);

$db->where ('IdArtikliSlike', $idLinkSlike);
if ($db->update ('artiklislike', $data)) {
    echo $db->count . ' records were updated';
} else {
    echo 'update failed: ' . $db->getLastError();
    die;
}

?>

