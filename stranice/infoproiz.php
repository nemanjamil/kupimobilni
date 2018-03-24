<?php
/**
 * Created by PhpStorm.
 * User: NemanjaMilivojevic
 * Date: 17.8.15.
 * Time: 18.34
 */

// da imamo raw queru upit
//require('infoproizRawQuery.php');

$upitArtArray = "CALL infoproizAdvance($id,'$valutasession', $jezikId, $KomitentId);";
$keyArt = $db->rawQueryOne($upitArtArray);

if ($keyArt) {

    $ArtikalId = $keyArt['ArtikalId'];
    $KategorijaArtikalaIdOS = $keyArt['KategorijaArtikalId'];
    $ArtikalNaziv = $keyArt['OpisArtikla'];
    $ArtikalMPCena = $keyArt['ArtikalMPCena'];
    $ArtikalVPCena = $keyArt['ArtikalVPCena'];
    $KategorijaArtikalaNaziv = $keyArt['NazivKategorije'];
    $KategorijaArtikalaLink = $keyArt['KategorijaArtikalaLink'];
    $BrendIme = $keyArt['BrendIme'];
    $ProizvodjacIme = $keyArt['ProizvodjacIme'];
    $KomitentiValuta = $keyArt['KomitentiValuta'];
    $ValutaValuta = $keyArt['ValutaValuta'];
    $MarzaMarza = $keyArt['MarzaMarza'];
    $odnosKursArt = $keyArt['odnosKursArt'];

        $pravaMp = $keyArt['pravaMp'];
        $pravaVp = $keyArt['pravaVp'];
        $pravaMpApp = $keyArt['pravaMpApp'];
        $pravaVpApp = $keyArt['pravaVpApp'];


    $ArtikalLink = $keyArt['ArtikalLink'];
    $ArtikalKratakOpis = $keyArt['OpisKratakOpis'];
    $ArtikalStanje = $keyArt['ArtikalStanje'];
    $ImeSlikeArtikliSlike = $keyArt['ImeSlikeArtikliSlike'];
    $OpisArtikliTekstovi = $keyArt['OpisArtTekst'];
    $TipUnit = $keyArt['TipUnit'];
    $TipUnitcelo = $keyArt['TipUnitCelo'];
    $MinimalnaKol = $keyArt['MinimalnaKolArt'];
    $OpisVerKomit = $keyArt['OpisVerKomit'];
    $OcenaVeriKomi = $keyArt['OcenaVeriKomi'];
    $ImeLokSamoa = $keyArt['ImeLokSamo'];
    $IdLokSamo = $keyArt['IdLokSamo'];
    $ocenaut = $keyArt['ocenaut'];
    $KomitentIdArtikal = $keyArt['KomitentId'];
    $BojaVeriKomi = $keyArt['BojaVeriKomi'];
    $SlikaLokSamo = $keyArt['SlikaLokSamo'];
    $LinkLokSamoa = $keyArt['LinkLokSamo'];
    $ArtikalDostupnoOd = $keyArt['ArtikalDostupnoOd'];
    $ArtikalAktivan = $keyArt['ArtikalAktivan'];
    $OpisKatTekst = $keyArt['TekstKategorije'];
    $LokSamoText = $keyArt['LokSamoNaslov'];
    $dani = $keyArt['dani'];
    $ArtikalBrPregleda = $keyArt['ArtikalBrPregleda'];
    $porez = $keyArt['KomitentUPdv'];
    $vidimikirec = $keyArt['vidimikirec'];
    $KomitentKolona = $keyArt['KomitentKolona'];
    $NaAkciji = $keyArt['ArtikalNaAkciji'];
    $urlArtiklaLink = '/' . $ArtikalLink . '/' . $ArtikalId;

    $title = $ArtikalNaziv;
    $kratakOpis = $ArtikalKratakOpis;

    $nakasdInfoProiz = $common->stanjeOpisSveId($ArtikalStanje, $ArtikalMPCena, $sesValuta, $jsonlang[229][$jezikId], $jsonlang[117][$jezikId], $jsonlang[116][$jezikId], $pravaVp, $pravaMp, $tipUsera, $dani);
    require(DCROOT.'/stranice/cenaPrikazVarijableInfoProiz.php');

    require(DCROOT.'/stranice/artBrPregleda.php');


    // koja je top kategorija
    // ako artikal ne pripada sajtu / kategoriji onda se izbaci error strana
    // TODO [nikola]
    //require "daLiMozeDaSeVidiKateg.php";

    /*$cols = Array("ANN.OpisArtikla","SP.linkslike","PA.ArtikalIdPoklon");
    $db->join("artikli A", "A.ArtikalId = PA.ArtikalIdPoklon");
    $db->join("artikalnazivnew ANN", "ANN.ArtikalId = A.ArtikalId AND ANN.IdLanguage = $jezikId");
    $db->join("artiklislike AS", "AS.IdArtikliSlikePov = A.ArtikalId");
    $db->where("PA.ArtikalIdGlavni", $ArtikalId);
    $linksPoklon = $db->get("poklonartikli PA", null, $cols);

    if ($linksPoklon) {
        foreach ($linksPoklon AS $kp => $vp) {
            $comma_separatedPoklon[] = $vp['ArtikalIdPoklon'];
        }
    }*/


} else {
    //echo 'Nemate pravo da vidite ovaj artikal. Registrujete se kao VP kupac';
    //die;
    $stranica = 'error';
}

?>