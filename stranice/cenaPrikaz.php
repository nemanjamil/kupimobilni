<?php
$nakasd = $common->stanjeOpisSveId($ArtikalStanje, $ArtikalMPCena, $sesValuta, $jsonlang[229][$jezikId], $jsonlang[117][$jezikId], $jsonlang[116][$jezikId], $pravaVp, $pravaMp, $tipUsera, $dani);
require(DCROOT.'/stranice/cenaPrikazVarijable.php');

/*if ($ArtikalStanje > 0) {
    $mozedase = 1;
    $cenaPrikaz = ($tipUsera >= REGISTROVANVP) ? $common->formatCenaSamoBroj($pravaVp, $sesValuta) : $common->formatCenaSamoBroj($pravaMp, $sesValuta);
    $cenaPrikazExt = $common->formatCenaExt($pravaVp, $sesValuta);
    //$cenaBroj = ($tipUsera >= REGISTROVANVP) ? number_format($pravaVp, 2, ",", ".") : number_format($pravaMp, 2, ",", ".");
} else {
    $mozedase = 0;
    $cenaPrikaz = $jsonlang[117][$jezikId];
    $cenaBroj = NULL;
}*/

$lokFolder = $common->locationslika($ArtikalId);
$urlArtiklaLink = '/' . $ArtikalLink . '/' . $ArtikalId;

$ext = pathinfo($slikaMain, PATHINFO_EXTENSION);
$fileName = pathinfo($slikaMain, PATHINFO_FILENAME);

$mala_slika = $lokFolder . '/' . $fileName . '_mala.' . $ext;
$srednja_slika = $lokFolder . '/' . $fileName . '_srednja.' . $ext;
$velika_slika = $lokFolder . '/' . $slikaMain;

$slikaMala = DPROOT.$common->nemaSlikeBezCrte($mala_slika);
$srednja_slika = DPROOT.$common->nemaSlikeBezCrte($srednja_slika);
$velika_slika = DPROOT.$common->nemaSlikeBezCrte($velika_slika);

?>