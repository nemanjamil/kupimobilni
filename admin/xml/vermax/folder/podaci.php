<?php
// uzimamo podatke iz XML-a
include($documentrootAdmin.'/xml/vermax/folder/xmlpodaci.php');

if ($naziv) {
$pokazi .= '<br/>';

$cols = Array ("A.ArtikalId", "A.ArtikalSifra", "A.CodeBosch","ASL.ImeSlikeArtikliSlike");
$db->where($codetip,$sifra);
$users = $db->getOne("artikli A", null, $cols);


$ArtikalId = $users['ArtikalId'];
$ArtikalSifra = $users['ArtikalSifra'];
$CodeBosch = $users['codevermax'];
$ImeSlikeArtikliSlike = $users['ImeSlikeArtikliSlike'];



if ($db->count > 0) {

    $pokazi .= '<div style="background-color: darkgreen;color: white">Ima Artikal kod nas u bazi</div>';
    include('akoima.php');


} else {

    $pokazi .= '<div style="background-color: red">Nema artikal kod nas u bazi</div>';
    include('akonema.php');

}


/* Apdejutuj kategoriju  VERMAX */
$imeKolone = 'codevermax'; // na dodatnoj opremi
$extId = $sifra;
require $documentrootAdmin.'/xml/agro/folder/kategUpdateAgro.php';

} else {
    $log->lwrite('Ne postoji naziv artikla '.$naziv.' sifra :'.$sifra);
}

?>