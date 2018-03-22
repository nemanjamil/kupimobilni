<?php
/**
 * Created by PhpStorm.
 * User: nemanja
 * Date: 8.9.16.
 * Time: 17.49
 */

$pokazi .= '<div style="border: 1px solid #000000; padding: 10px;background-color: lightgreen">';


// $db->setTrace (true);
if (!$extId) {
    echo 'Ne postoji ExId';
    die;
}
if (!$imeKolone) {
    echo 'Ne postoji imeKolone';
    die;
}

$extId = strtr(base64_encode($extId), '+/=', '-_,');

$linkDodatnaJson = 'http://dodatnaoprema.com/koment.php?akcija=getIdBrendAndIdKategFull&id=' . $extId . '&kolona=' . $imeKolone . '&kolonalink=' . $codetipLinkDodatna;

$pokazi .= '<div style="border: 1px solid #000000; padding: 10px;background-color: lightgreen">' . $linkDodatnaJson . '</div>';

$content = file_get_contents($linkDodatnaJson);
$data = json_decode($content);

$el = $data->Elements;
$StatusCode = $data->StatusCode;
$kat_link = $el->kat_link;
$ArtikalIdDodatna = $el->ArtikalId;
$KategorijaArtiklaIdDodatna = $el->KategorijaArtiklaId;
$linkDoArtOrg = $el->linkDoArt;
$linkDoArt = base64_decode(strtr($linkDoArtOrg, '-_,', '+/='));
// da ubacilmo linkdoArtiklaNadrugom sajtu
$bIdDodatna = $el->bId;
$bImeDodatna = $el->bIme;
$brand_linkDodatna = $el->brand_link;


if ($StatusCode) {

    $db->where("KategorijaArtikalaLink", $kat_link);
    $kateg = $db->getOne("kategorijeartikala");
    $KategorijaArtikalaId = $kateg['KategorijaArtikalaId'];

    $idArti0 = ($idUbacenogart) ? $idUbacenogart : $ArtikalId;

    if (!$idArti0) {
        $pokazi .= '<div style="border: 1px solid #000000; padding: 10px;background-color: lightgreen">Ne postoiji ID $idArti0</div>';
        die;
    }


    $pokazi .= '<div style="border: 1px solid #000000; padding: 10px;background-color: lightgreen">';
    $pokazi .= '<br/>$idUbacenogart : ' . $idArti0;
    $pokazi .= '<br/>$ArtikalId : ' . $ArtikalId;
    $pokazi .= '<br>URL ARTIKLA <a target="_blank" href="http://dodatnaoprema.com/urtArtikla/utlArt/' . $ArtikalIdDodatna . '">' . $ArtikalIdDodatna . '</a>';
    $pokazi .= '<br/>$sifra : ' . $sifra;
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
    $pokazi .= '</div>';


    if ($KategorijaArtikalaId) {
        $pokazi .= 'Ima kategorije';
        $pokazi .= '<br/>';


        /*
         * Proveravamo da li postoji brend kod nas u bazi
         * */
        require($documentrootAdmin . '/xml/centralniXml/proveraBrendaDod.php');


        if ($codetipLinkDodatna) {
            $data = Array(
                'KategorijaArtikalId' => $KategorijaArtikalaId,
                'ArtikalIdDodatna' => $ArtikalIdDodatna,
                $codetipLink => $linkDoArt,
            );
        } else {
            $data = Array(
                'KategorijaArtikalId' => $KategorijaArtikalaId,
                'ArtikalIdDodatna' => $ArtikalIdDodatna,
            );
        }

        $db->where('ArtikalId', $idArti0);
        if ($db->update('artikli', $data)) {
            $pokazi .= '<div>' . $db->count . ' records were updated</div>';
        } else {
            echo $pokazi .= 'update failed: ' . $db->getLastError();
            die;
        }

    } else {
        $pokazi .= '<div style="border: 1px solid #000000; padding: 40px;background-color: red">';
        $pokazi .= 'nema kategorije kod nas u bazi : ' . $kat_link;
        $pokazi .= '</div>';
        echo $pokazi;
        $log->lwrite('ERROR : kategUpdateDodatna  : nema kategorije kod nas u bazi : ' . $kat_link);
        die;
    }
// print_r ($db->trace);
} else {
    $pokazi .= '<div style="border: 1px solid #000000; padding: 40px;background-color: red">';
    $pokazi .= 'Status CODE FALSE';
    $log->lwrite('ERROR : kategUpdate 120 StatusCode : FALSE ' . $StatusCode . ', $ArtikalIdDodatna : ' . $ArtikalIdDodatna . ', ArtikalMasine : ' . $ArtikalId . '; link : ' . $linkDodatnaJson);

    if ($kat_link) {
        $data = Array(
            'KategorijaArtikalaLink' => $kat_link
        );
        $db->where('KategorijaArtikalaId', $KategorijaArtikalaId);
        if ($db->update('kategorijeartikala', $data)) {
            $pokazi .= '<div>kategorijeartikala ' . $db->count . ' records were updated</div>';
        } else {
            echo $pokazi .= 'kategorijeartikala update failed: ' . $db->getLastError();
            die;
        }

        $log->lwrite('ERROR : kategUpdate KATEG LINK UPDATE  : KategorijaArtikalaLink ' . $kat_link . ' WHERE : KategorijaArtikalaId  ' . $KategorijaArtikalaId);
        die;

    } else {
        $log->lwrite('Ne postoji kat_link sa dodatneopreme $KategorijaArtiklaIdDodatna : ' . $KategorijaArtiklaIdDodatna);
    }
}
sleep(1);


$pokazi .= '</div>';

?>