<?php
$mainSlikaArt = ($prvaSlika == 1) ? 1 : 0;

$db->where('IdArtikliSlikePov', $ArtikalIdUpit);
$upitSlikePoId = $db->getOne('artiklislike');
$IdArtikliSlike = $upitSlikePoId['IdArtikliSlike'];

if ($IdArtikliSlike) {
    $mainSlika = 0;
} else {
    $mainSlika = 1;
}

$dataSlika = Array(
    'IdArtikliSlikePov' => $ArtikalIdUpit,
    'ImeSlikeArtikliSlike' => $linkslikeMojabaza,
    'MainArtikliSlike' => $mainSlika
);
$idLinkSlike = $db->insert('artiklislike', $dataSlika);

$pokazi .= '<li>Id Slike koji je ubacen : ' . $idLinkSlike . '</li>';

if (!$idLinkSlike) {
    echo 'insert failed Link SLIKE: ' . $db->getLastError();
    $db->rollback();
} else {
    $db->commit();
}

?>