<?php

$pokazi .= '<div style="border: 1px solid #000000; padding: 10px;background-color: lightgreen">';


// $db->setTrace (true);

$linkDodatnaJson = 'http://dodatnaoprema.com/koment.php?akcija=getIdBrendAndIdKateg&id=' . $extId;
$content = file_get_contents($linkDodatnaJson);
$data = json_decode($content);

$pokazi .= '<li> Koji link dohvatamo : ' . $linkDodatnaJson . '</li>';

$el = $data->Elements;
$StatusCode = $data->StatusCode;
$kat_link = $el->kat_link;
$ArtikalIdDodatna = $el->ArtikalId;
$KategorijaArtiklaIdDodatna = $el->KategorijaArtiklaId;
$linkDoArtOrg = $el->linkDoArt;
$bIdDodatna = $el->bId;
$bImeDodatna = $el->bIme;
$brand_linkDodatna = $el->brand_link;
$opis64 = $el->opisb64;
$opis64deco = base64_decode($opis64);

if ($StatusCode) {

    $db->where("KategorijaArtikalaLink", $kat_link);
    $kateg = $db->getOne("KategorijeArtikala");
    $KategorijaArtikalaId = $kateg['KategorijaArtikalaId'];


    $pokazi .= '<div style="border: 1px solid #000000; padding: 10px;background-color: lightblue">';
    $pokazi .= '<br/>$idUbacenogart : ' . $idArti0;
    $pokazi .= '<br/>$ArtikalId : ' . $ArtikalId;
    $pokazi .= '<br>URL ARTIKLA <a target="_blank" href="http://dodatnaoprema.com/urtArtikla/utlArt/' . $ArtikalIdDodatna . '">' . $ArtikalIdDodatna . '</a>';
    $pokazi .= '<br/>$sifra $extId : ' . $extId;
    $pokazi .= '<br/>$ArtikalIdDodatna : ' . $ArtikalIdDodatna;
    $pokazi .= '<br/>$KategorijaArtikalaId : ' . $KategorijaArtikalaId;
    $pokazi .= '<br/>$KategorijaArtiklaIdDodatna : ' . $KategorijaArtiklaIdDodatna;
    $pokazi .= '<br/>$idArti0 : ' . $idArti0;
    $pokazi .= '<br/>$kat_link : ' . $kat_link;
    $pokazi .= '<br/>$linkDoArtOrg : ' . $linkDoArtOrg;
    $pokazi .= '<br/>$linkDoArt : ' . $linkDoArt;
    $pokazi .= '<br/>$bIdDodatna : ' . $bIdDodatna;
    $pokazi .= '<br/>$bImeDodatna : ' . $bImeDodatna;
    $pokazi .= '<br/>$brand_linkDodatna : ' . $brand_linkDodatna;
    $pokazi .= '<br/>$opis64deco : ' . $opis64deco;
    $pokazi .= '</div>';


    if ($KategorijaArtikalaId) {
        $pokazi .= 'Ima kategorije';
        $pokazi .= '<br/>';


        $idArti0 = ($idUbacenogart) ? $idUbacenogart : $ArtikalId;
        require($documentrootAdmin . '/xml/centralniXml/proveraBrendaDod.php');

        $data = Array(
            'KategorijaArtikalId' => $KategorijaArtikalaId,
            'ArtikalIdDodatna' => $ArtikalIdDodatna
        );
        $db->where('code3g', $sifra);
        if ($db->update('Artikli', $data)) {
            $pokazi .= $db->count . ' records were updated';
        } else {
            echo $pokazi .= 'update failed: ' . $db->getLastError();
            die;
        }


            require($documentrootAdmin . '/xml/centralniXml/opisTekstArtikla.php');


    } else {
        echo $pokazi .= 'nema kategorije kod nas u bazi : ' . $kat_link;
        $log->lwrite('ERROR : kategUpdateDodatna  : nema kategorije kod nas u bazi : ' . $kat_link);
        // die;
    }
} else {
    $pokazi .= '<div style="border: 1px solid #000000; padding: 40px;background-color: red">';
    $pokazi .= 'Status CODE FALSE';
    $log->lwrite('ERROR : kategUpdate 120 StatusCode : FALSE ' . $StatusCode . ', $ArtikalIdDodatna : ' . $ArtikalIdDodatna . ', ArtikalMasine : ' . $ArtikalId . '; link : ' . $linkDodatnaJson);

    if ($kat_link) {
        $data = Array(
            'KategorijaArtikalaLink' => $kat_link
        );
        $db->where('KategorijaArtikalaId', $KategorijaArtikalaId);
        if ($db->update('KategorijeArtikala', $data)) {
            $pokazi .= '<div>KategorijeArtikala ' . $db->count . ' records were updated</div>';
        } else {
            echo $pokazi .= 'KategorijeArtikala update failed: ' . $db->getLastError();
            die;
        }

        $log->lwrite('ERROR : kategUpdate KATEG LINK UPDATE  : KategorijaArtikalaLink ' . $kat_link . ' WHERE : KategorijaArtikalaId  ' . $KategorijaArtikalaId);
        die;

    } else {
        $log->lwrite('Ne postoji kat_link sa dodatneopreme $KategorijaArtiklaIdDodatna : ' . $KategorijaArtiklaIdDodatna);
    }

    $pokazi .= '</div>';
}
usleep(500000); // 0.5 sec


$pokazi .= '</div>';

?>