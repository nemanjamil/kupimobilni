<?php


$ArtikalIdSmall = $keyArt['ArtikalId'];
$ArtikalNaAkcijiSmall = $keyArt['ArtikalNaAkciji'];
$top1Small = $keyArt['top1'];
$top2Small = $keyArt['top2'];
$top3Small = $keyArt['top3'];
$ArtikalNazivSmall = $keyArt['OpisArtikla'];
$ArtikalMPCenaSmall = $keyArt['ArtikalMPCena'];
$ArtikalVPCenaSmall = $keyArt['ArtikalVPCena'];
$KategorijaArtikalaNazivSmall = $keyArt['NazivKategorije'];
$KategorijaArtikalaLinkSmall = $keyArt['KategorijaArtikalaLink'];
$KategorijaArtikalId = $keyArt['KategorijaArtikalId'];
$BrendImeSmall = $keyArt['BrendIme'];
$BrendId = $keyArt['BrendId'];
$KomitentiValutaSmall = $keyArt['KomitentiValuta'];
$ValutaValutaSmall = $keyArt['ValutaValuta'];
$MarzaMarzaSmall = $keyArt['MarzaMarza'];
$odnosKursArtSmall = $keyArt['odnosKursArt'];
$pravaMpSmall = $keyArt['pravaMp'];
$pravaVpSmall = $keyArt['pravaVp'];
$ArtikalLinkSmall = $keyArt['ArtikalLink'];
$ArtikalKratakOpisSmall = $keyArt['ArtikalKratakOpis'];
$ArtikalStanjeSmall = $keyArt['ArtikalStanje'];
$slikaMain = $keyArt['slikaMain'];
$TipUnit = $keyArt['TipUnit'];
$TipUnitcelo = $keyArt['TipUnitCelo'];
$IdUnit = $keyArt['IdUnit'];
$pozovite = $jsonlang[117][$jezikId];
$ArtikalKratakOpis = $keyArt['OpisKratakOpis'];
$MinimalnaKolArt = $keyArt['MinimalnaKolArt'];
$dani = $keyArt['dani'];
$KomitentKolona = $keyArt['KomitentKolona'];
$ocenaut = $keyArt['ocenaut'];
$ArtikalBrPregleda = (int) $keyArt['ArtikalBrPregleda'];



$ArtikalIdSmall = (int)$ArtikalIdSmall;

if (!$ArtikalIdSmall) {
    echo 'Ne postoji Artiklal ID';
    die;
}

$nakasd = $common->stanjeOpis($ArtikalStanjeSmall, $ArtikalMPCenaSmall, $valutasession, $jsonlang[229][$jezikId], $jsonlang[117][$jezikId], $jsonlang[116][$jezikId], $pravaVpSmall, $pravaMpSmall, $userTip, $dani);
require(DCROOT . '/stranice/cenaPrikazVarijable.php');

// mozeda cemo da stavimo $id = $ArtikalIdSmall;
// require(DCROOT.'/stranice/artBrPregleda.php');


$lokFolder = $common->locationslika($ArtikalIdSmall);
$urlArtiklaLinkSmall = DPROOT . '/' . $ArtikalLinkSmall . '/' . $ArtikalIdSmall;
$ext = pathinfo($slikaMain, PATHINFO_EXTENSION);
$fileName = pathinfo($slikaMain, PATHINFO_FILENAME);
$mala_slika = $lokFolder . '/' . $fileName . '_mala.' . $ext;
$slikaMala = DPROOT . $common->nemaSlikeBezCrte($mala_slika);


$products['ArtikalId'] = $ArtikalIdSmall;
$products['ArtikalNaziv'] = $ArtikalNazivSmall;
$products['ArtikalKratakOpis'] = base64_encode($ArtikalKratakOpis);
//$products['OpisArtikliTekstovi'] = base64_encode($OpisArtikliTekstovi); ako budemo dodavali
$products['ArtikalNaAkciji'] = $ArtikalNaAkcijiSmall;
$products['urlArtiklaLink'] = $urlArtiklaLinkSmall;
$products['cenaPrikaz'] = $cenaPrikaz;
$products['cenaPrikazBroj'] = $cenaPrikazBroj;
$products['cenaSamoBrojFormat'] = $cenaSamoBrojFormat;
$products['cenaPrikazExt'] = $cenaPrikazExt;
$products['pozovite'] = $pozovite;
$products['BrendIme'] = $BrendImeSmall;
$products['BrendId'] = $BrendId;
$products['TipUnit'] = $TipUnit;
$products['TipUnitCelo'] = $TipUnitcelo;
$products['IdUnit'] = $IdUnit;
$products['MinimalnaKolArt'] = $MinimalnaKolArt;
$products['slikaMain'] = $slikaMala;
$products['stanje'] = ($ArtikalStanjeSmall) ? 1 : 0;
$products['codeVendor'] = $common->vendorCode($KomitentKolona, $ArtikalIdSmall);
$products['mozedasekupi'] = $mozedasekupi;
$products['ocenaut'] = $ocenaut;
$products['ArtikalBrPregleda'] = $ArtikalBrPregleda;
$products['KategorijaArtiklaNaziv'] = $KategorijaArtikalaNazivSmall;
$products['KategorijaArtikalId'] = $KategorijaArtikalId;
$products['KategorijaArtikalaLink'] = $KategorijaArtikalaLinkSmall;


/*
 * KADA KORISTIMO KORPU
 * */
$KolTempArt = (int) $keyArt['KolTempArt'];
if ($KolTempArt) {
    $ukupnaKolArt += $KolTempArt;
    $cenaPoArtKol = $pravaVpSmall * $KolTempArt;
    $ukupnaKorpa += $cenaPoArtKol;

    $products['korpa']['KorpaKolTempArt'] = $KolTempArt;
    $products['korpa']['KorpaCenaPoArtKol'] = $cenaPoArtKol;
}

/*
* Specifikacije artikala
* */


require('specJsonListaArt.php');
$products['spec'] = $sec;


/*
 * Ovaj HTML nisam uspeo da ubacim u JSON
 * TO CU SA BASE64!!!!
 * $products['OpisArtikliTekstovi'] = $OpisArtikliTekstovi;
 * */

require('listaArtikalaSlike.php');


array_push($f, $products);


?>