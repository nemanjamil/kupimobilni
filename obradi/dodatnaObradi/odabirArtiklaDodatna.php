<?php

$cols = Array ("*");
$db->where ("A.ArtikalId", $idArt);
$db->join("artikalnazivnew AN", "AN.ArtikalId = A.ArtikalId");
$db->join("artiklitekstovinew AT", "AT.ArtikalId = A.ArtikalId","LEFT");
$art = $db->getOne("artikli A", NULL, $cols);
if (!$db->count > 0) {
    echo 'Nema datog artikla u bazi AGRO';
    die;
}

$IdArtikliTekstovi = $art['IdArtikliTekstovi'];
$ArtNazsrblat = $art['ArtNazsrblat'];
$CodeBoschLink = $art['CodeBoschLink'];
$CodeBosch = $art['CodeBosch'];

$url_artikla = $common->friendly_convert($ArtNazsrblat);
?>