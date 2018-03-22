<?php
$mainSlikaArt = ($prvaSlika==1) ? 1 : 0;

$dataSlika = Array (
    'IdArtikliSlikePov' => $idArt,
    'ImeSlikeArtikliSlike' => $linkslikeMojabaza,
    'MainArtikliSlike' => $mainSlikaArt
);


$idLinkSlike = $db->insert ('artiklislike', $dataSlika);
$pokazi .= '<li>Id Slike koji je ubacen : ' . $idLinkSlike . '</li>';

if (!$idLinkSlike) {
    echo 'insert failed Link SLIKE: ' . $db->getLastError();
    $db->rollback();
} else {
    $db->commit();
}

?>