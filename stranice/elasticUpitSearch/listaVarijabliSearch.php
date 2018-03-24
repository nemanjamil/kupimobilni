<?php
$i = 0;
$vredPrikaz = '';
if ($ArtSearchArtikal) {
    foreach ($ArtSearchArtikal as $product => $keyArt):

        $ArtikalId = $keyArt['ArtikalId'];
        $KategorijaArtikalId = $keyArt['KategorijaArtikalId'];
        $ArtikalNaziv = $keyArt['OpisArtikla'];
        $OpisKratakOpis = $keyArt['OpisKratakOpis'];
        $OpisArtTekst = $keyArt['OpisArtTekst'];
        $OpisArtTekst = $common->limit_text_obican($OpisArtTekst,200);
        $ArtikalMPCena = $keyArt['ArtikalMPCena'];
        $ArtikalVPCena = $keyArt['ArtikalVPCena'];
        $KategorijaArtikalaNaziv = $keyArt['NazivKategorije'];
        $KategorijaArtikalaLink = $keyArt['KategorijaArtikalaLink'];
        $BrendIme = $keyArt['BrendIme'];
        $KomitentiValuta = $keyArt['KomitentiValuta'];
        $ValutaValuta = $keyArt['ValutaValuta'];
        $MarzaMarza = $keyArt['MarzaMarza'];
        $odnosKursArt = $keyArt['odnosKursArt'];
        $pravaMp = $keyArt['pravaMp'];
        $pravaVp = $keyArt['pravaVp'];
        $ArtikalLink = $keyArt['ArtikalLink'];
        $ArtikalNaAkciji = $keyArt['ArtikalNaAkciji'];
        $ArtikalStanje = $keyArt['ArtikalStanje'];
        $ocenaut = $keyArt['ocenaut'];
        $ImeSlikeArtikliSlike = $keyArt['ImeSlikeArtikliSlike'];

        $lokFolder = $common->locationslika($ArtikalId);
        $urlArtiklaLink = '/' . $ArtikalLink . '/' . $ArtikalId;

        $ext = pathinfo($ImeSlikeArtikliSlike, PATHINFO_EXTENSION);
        $fileName = pathinfo($ImeSlikeArtikliSlike, PATHINFO_FILENAME);

        $mala_slika = $lokFolder . '/' . $fileName . '_mala.' . $ext;
        $srednja_slika = $lokFolder . '/' . $fileName . '_srednja.' . $ext;
        $velika_slika = $lokFolder . '/' . $ImeSlikeArtikliSlike;

        $srednja_slika = $common->nemaSlike($srednja_slika);

        $nakasd = $common->stanjeOpisSveId($ArtikalStanje, $ArtikalMPCena, $sesValuta, $jsonlang[229][$jezikId], $jsonlang[117][$jezikId], $jsonlang[116][$jezikId], $pravaVp, $pravaMp, $tipUsera, $dani);
        $cenaSamoBrojFormat = $nakasd['cenaSamoBrojFormat'];
        $cenaPrikazExt = $nakasd['cenaPrikazExt'];


        // ovo koristimo kada pravimo restApi za Android za JSON
        /*$products[$i]['ArtikalId'] = $ArtikalId;
        $products[$i]['ArtikalNaziv'] = $ArtikalNaziv;
        $products[$i]['OpisKratakOpis'] = $OpisKratakOpis;
        $products[$i]['velika_slika'] = $velika_slika;
        $products[$i]['srednja_slika'] = $srednja_slika;
        $products[$i]['urlArtiklaLink'] = $urlArtiklaLink;
        $products[$i]['ImeSlikeArtikliSlike'] = $ImeSlikeArtikliSlike;
        $products[$i]['ocenaut'] = $ocenaut;
        $products[$i]['Jedinica'] = $jsonlang[263][$jezikId];
        $products[$i]['Najmanje'] = $jsonlang[106][$jezikId];//umesto

        $products[$i]['opisDetaljnije'] = $jsonlang[76][$jezikId];
        $products[$i]['compare'] = $jsonlang[74][$jezikId];
        $products[$i]['BrendIme'] = $BrendIme;
        $products[$i]['brendPrevod'] = $jsonlang[348][$jezikId];
        $products[$i]['ArtikalStanje'] = $ArtikalStanje;
        $products[$i]['jezikId'] = $jezikId;
        $products[$i]['ArtikalNaAkciji'] = $ArtikalNaAkciji;*/

        require('listaArtikliSearchHtml.php');


        $i++;
    endforeach;


}