<?php
foreach ($keyArtAr as $k => $keyArt) {


    $ArtikalId = $keyArt['ArtikalId'];
    $KategorijaArtikalaIdOS = $keyArt['KategorijaArtikalId'];
    $ArtikalNaziv = $keyArt['OpisArtikla'];
    $ArtikalMPCena = $keyArt['ArtikalMPCena'];
    $ArtikalVPCena = $keyArt['ArtikalVPCena'];
    $ArtikalNaAkciji = $keyArt['ArtikalNaAkciji'];
    $KategorijaArtikalaNaziv = $keyArt['NazivKategorije'];
    $KategorijaArtikalaLink = $keyArt['KategorijaArtikalaLink'];
    $BrendIme = $keyArt['BrendIme'];
    $BrendId = $keyArt['BrendId'];
    $KomitentiValuta = $keyArt['KomitentiValuta'];
    $ValutaValuta = $keyArt['ValutaValuta'];
    $MarzaMarza = $keyArt['MarzaMarza'];
    $odnosKursArt = $keyArt['odnosKursArt'];
    $pravaMp = $keyArt['pravaMp'];
    $pravaVp = $keyArt['pravaVp'];
    $ArtikalLink = $keyArt['ArtikalLink'];
    $ArtikalKratakOpis = $keyArt['OpisKratakOpis'];
    $ArtikalStanje = $keyArt['ArtikalStanje'];
    $ImeSlikeArtikliSlike = $keyArt['ImeSlikeArtikliSlike'];
    $OpisArtikliTekstovi = $keyArt['OpisArtTekst'];
    $TipUnit = $keyArt['TipUnit'];
    $TipUnitcelo = $keyArt['TipUnitCelo'];
    $MinimalnaKolArt = $keyArt['MinimalnaKolArt'];
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
    $slikaMain = $keyArt['slikaMain'];


    require(DCROOT.'/stranice/cenaPrikaz.php');

    $i++;
    if ($i > 100) {
        continue;
    }


    $products['ArtikalId'] = $ArtikalId;
    $products['ArtikalNaziv'] = $ArtikalNaziv;
    $products['ArtikalKratakOpis'] = $ArtikalKratakOpis;
    //$products['OpisArtikliTekstovi'] = base64_encode($OpisArtikliTekstovi);
    $products['ArtikalNaAkciji'] = $ArtikalNaAkciji;
    $products['urlArtiklaLink'] = $urlArtiklaLink;
    $products['link'] = $ArtikalLink;
    $products['cenaPrikaz'] = $cenaPrikaz;
    $products['cenaPrikazBroj'] = $cenaPrikazBroj;
    $products['cenaSamoBrojFormat'] = $cenaSamoBrojFormat;
    $products['cenaPrikazExt'] = $cenaPrikazExt;
    $products['pozovite'] = $pozovite;
    $products['BrendIme'] = $BrendIme;
    $products['BrendId'] = $BrendId;
    $products['TipUnit'] = $TipUnit;
    $products['TipUnitCelo'] = $TipUnitcelo;
    $products['MinimalnaKolArt'] = $MinimalnaKolArt;
    $products['slikaMain'] = $slikaMala;
    $products['stanje'] = ($ArtikalStanje) ? 1 : 0;
    $products['codeVendor'] = $common->vendorCode($KomitentKolona, $ArtikalId);
    $products['mozedasekupi'] = $mozedasekupi;
    $products['ocenaut'] = $ocenaut;
    $products['KategorijaArtiklaNaziv'] = $KategorijaArtikalaNaziv;
    $products['KategorijaArtikalId'] = $KategorijaArtikalaIdOS;
    $products['KategorijaArtikalaLink'] = $KategorijaArtikalaLink;


    $f[] = $products;


}
?>

