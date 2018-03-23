<?php
// uzimamo podatke iz XML-a
include('xmlpodaci.php');

//$brendLocal = $db->rawQuery("SELECT komBrenduPripada($brendId) as brendLocal");
$brendLocal = $db->ObjectBuilder()->rawQuery("SELECT komBrenduPripada($brendId) as brendLocal");
$brendLocalId = $brendLocal[0]->brendLocal;


if ($naziv) {
    $pokazi .= '<br/>';

    $cols = Array("A.ArtikalId", "A.ArtikalSifra", "A.code3g", "ASL.ImeSlikeArtikliSlike");
    $db->where($codetip, $sifra);
    $users = $db->getOne("artikli A", null, $cols);


    $ArtikalId = $users['ArtikalId'];
    $ArtikalSifra = $users['ArtikalSifra'];
    $CodeBosch = $users['code3g'];
    $ImeSlikeArtikliSlike = $users['ImeSlikeArtikliSlike'];

    $pokazi .= '<div style="background-color: #0016b0;color: white">$ArtikalId : '.$ArtikalId.'</div>';

    if ($db->count > 0) {
        $pokazi .= '<div style="background-color: darkgreen;color: white">Ima Artikal kod nas u bazi</div>';
        //include($documentrootAdmin . '/xml/centralniXml/akoima.php');

    } else {

        $pokazi .= '<div style="background-color: red">Nema artikal kod nas u bazi</div>';
        //include($documentrootAdmin . '/xml/centralniXml/akonema.php');

    }

} else {
    $log->lwrite('Ne postoji naziv artikla ' . $naziv . ' sifra :' . $sifra);
}

?>