<?php

$vredPrikaz .= '<div class="category-product-inner" itemscope itemtype="http://schema.org/Product">';
$vredPrikaz .= '<div class="product-item-list-v1">';


$vredPrikaz .= $common->displayListProductSearch(
    $ArtikalId,
    $ArtikalNaziv,
    $OpisKratakOpis,
    $OpisArtTekst,
    $ArtikalNaAkciji,
    $srednja_slika,
    $urlArtiklaLink,
    $ocenaut,
    $jsonlang[76][$jezikId],
    $jsonlang[74][$jezikId],
    $BrendIme,
    $jsonlang[348][$jezikId],
    $ArtikalStanje,
    $jsonlang[116][$jezikId],
    $jezikId,
    $jsonlang[106][$jezikId],
    $KategorijaArtikalaNaziv,
    $KategorijaArtikalaLink,
    $jsonlang[426][$jezikId],
    $jsonlang[117][$jezikId],
    $cenaSamoBrojFormat,
    $cenaPrikazExt,
    $pravaMp


);

/*$vredPrikaz .= $common->displayListProductSearch(
    $proizvod['ArtikalId'],
    $proizvod['ArtikalNaziv'],
    $proizvod['OpisKratakOpis'],
    $proizvod['OpisArtTekst'],
    $proizvod['ArtikalNaAkciji'],
    $proizvod['velika_slika'],
    $proizvod['srednja_slika'],
    $proizvod['urlArtiklaLink'],
    $proizvod['ocenaut'],
    $proizvod['Jedinica'],
    $proizvod['compare'],
    $proizvod['BrendIme'],
    $proizvod['brendPrevod'],
    $proizvod['ArtikalStanje'],
    $proizvod['jezikId']
);*/

$vredPrikaz .= '</div>';
$vredPrikaz .= '</div>';

?>

