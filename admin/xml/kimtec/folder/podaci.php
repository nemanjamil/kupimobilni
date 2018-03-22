<?php
// uzimamo podatke iz XML-a
include($documentrootAdmin . '/xml/' . $folder . '/folder/xmlpodaci.php');

if ($ProductName) {
$pokazi .= '<br />';

$cols = Array("A.ArtikalId", "A.ArtikalSifra", "A.CodeBosch", "A.codelumen",
    "A.codevermax", "A.codeagro","A.codetsmod","ASL.ImeSlikeArtikliSlike");
$db->where($codetip, $sifra);
$users = $db->getOne("artikli A", null, $cols);
$ArtikalId = $users['ArtikalId'];
$ArtikalSifra = $users['ArtikalSifra'];
$CodeBosch = $users['CodeBosch'];
$codelumen = $users['codelumen'];
$codevermax = $users['codevermax'];
$CodeAgro = $users['codeagro'];

$ImeSlikeArtikliSlike = $users['ImeSlikeArtikliSlike'];


if ($db->count > 0) {

    $pokazi .= '<div style="background-color: darkgreen;color: white">Ima Artikal kod nas u bazi</div>';
    include($documentrootAdmin . '/xml/'.$folder.'/folder/akoima.php');


} else {

    $pokazi .= '<div style="background-color: red">Nema artikal kod nas u bazi</div>';
    include($documentrootAdmin . '/xml/' . $folder . '/folder/akonema.php');

}

// Apdejutuj kategoriju
$imeKolone = 'codekimtec'; // na dodatnoj opremi
$extId = $ProductCode;
require $documentrootAdmin.'/xml/agro/folder/kategUpdateAgro.php';
} else {
    $log->lwrite('Ne postoji naziv artikla '.$ProductName.' sifra :'.$ProductCode);
}
?>