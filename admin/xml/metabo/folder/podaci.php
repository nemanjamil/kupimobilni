<?php
// uzimamo podatke iz XML-a
include('xmlpodaci.php');

$pokazi .= '<br />';

$cols = Array ("A.ArtikalId", "A.ArtikalSifra", "A.CodeBosch", "A.codelumen","A.codevermax","ASL.ImeSlikeArtikliSlike");
$db->where($codetip,$sifra);
$users = $db->getOne("artikli A", null, $cols);

$ArtikalId = $users['ArtikalId'];
$ArtikalSifra = $users['ArtikalSifra'];
$CodeBosch = $users['CodeBosch'];
$codelumen = $users['codelumen'];
$codevermax = $users['codevermax'];
$ImeSlikeArtikliSlike = $users['ImeSlikeArtikliSlike'];



if ($db->count > 0) {

    $pokazi .= '<div style="background-color: darkgreen;color: white">Ima Artikal kod nas u bazi</div>';
    include('akoima.php');


} else {

    $pokazi .= '<div style="background-color: red">Nema artikal kod nas u bazi</div>';
    include('akonema.php');

}




?>