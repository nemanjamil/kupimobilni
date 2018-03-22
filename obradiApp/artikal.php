<?php
$upitArtArray = "CALL infoproizApp($id,'$valutasession', $jezikId, $userId);";

if (!$id) {

    $m['tag'] = 'artikal';
    $m['success'] = false;
    $m['error'] = 1;
    $m['error_msg'] = "Nema Id Artikla";
    echo json_encode($m, JSON_UNESCAPED_UNICODE);
    die;
}

//require(DCROOT.'/stranice/vidljivMp.php');
/*$upitArtArray = "
 SELECT *,
(CASE WHEN KomitentUPdv = 1 THEN
((SELECT GetKurs (KomitentiValuta, $valutasession))) *

(ArtikalMPCena - mpjac) *
MarzaMarza * (PorezVrednost/100 + 1)
ELSE ((SELECT GetKurs (KomitentiValuta, $valutasession))) *
(ArtikalMPCena - mpjac)
* MarzaMarza END) AS pravaMp,

(CASE WHEN KomitentUPdv = 1 THEN ((SELECT GetKurs (KomitentiValuta, $valutasession))) *
(ArtikalVPCena - vpjac)
  * MarzaVP * (PorezVrednost/100 + 1)
 ELSE ((SELECT GetKurs (KomitentiValuta, $valutasession))) *
 (ArtikalVPCena -  vpjac)  * MarzaVP END) AS pravaVp
FROM ( SELECT
  A.ArtikalId,
  A.KategorijaArtikalId,
  A.ArtikalMPCena,
  A.ArtikalVPCena,
  A.ArtikalLink,
  A.ArtikalStanje,
  A.ArtikalDostupnoOd,
  A.ArtikalAktivan,
  A.ArtikalBrPregleda,
  A.MinimalnaKolArt,
  A.ArtikalNaAkciji,
  DATEDIFF(A.ArtikalDostupnoOd, NOW()) as dani,
  ROUND((A.ArtikalBrOcena/A.ArtikalBrKlikova),0) AS ocenaut,
  ANN.OpisArtikla,
  TUN.TipUnit,
  TUN.TipUnitCelo,
  ATT.OpisArtTekst,
  AKO.OpisKratakOpis,
  KAN.NazivKategorije,
  KAT.TekstKategorije,
  KA.KategorijaArtikalaLink,
  BR.BrendIme,
  K.KomitentiValuta,
  K.KomitentId,
  K.KomitentKolona,
  K.KomitentUPdv,
  V.ValutaValuta,
  MA.MarzaMarza,
  VK.OpisVerKomit,
  VK.OcenaVeriKomi,
  VK.BojaVeriKomi,
  LS.SlikaLokSamo,
  LS.IdLokSamo,
  LS.LinkLokSamo,
  LSTN.LokSamoNaslov,
  MA.MarzaVP,
  PLP.PorezVrednost,
  (SELECT IF(K.KomitentRabat>0,K.KomitentRabat,0)/100*A.ArtikalVPCena) AS vpjac,
  (SELECT IF(K.KomitentRabat>0,K.KomitentRabat,0)/100*A.ArtikalMPCena) AS mpjac,
  (SELECT COUNT(IdRecenzije) AS dalirec FROM recenzije WHERE ProizvodRecenzije = '$id' AND KomentarAktivanRecenzije = '1') AS vidimikirec
  FROM
  artikli A
    JOIN artikalnazivnew ANN
        ON ANN.ArtikalId = A.ArtikalId AND  ANN.IdLanguage = $jezikId
    LEFT JOIN artiklitekstovinew ATT
        ON ATT.ArtikalId = A.ArtikalId AND  ATT.LanguageId = $jezikId
    LEFT JOIN artiklikratakopisnew AKO
        ON AKO.IdArtiklaAkon = A.ArtikalId AND  AKO.IdLanguageAkon = $jezikId

    JOIN kategorijeartikala KA
        ON KA.KategorijaArtikalaId = A.KategorijaArtikalId
    JOIN kategorijeartikalanaslov KAN
        ON KAN.IdKategorije = KA.KategorijaArtikalaId AND KAN.IdLanguage = $jezikId
    JOIN kategorijeartikalatekst KAT
        ON KAT.IdKategorije = KA.KategorijaArtikalaId AND KAT.IdLanguage = $jezikId

    JOIN pdvkategzemlja PKZ
      ON PKZ.IdKategPdvKatZem = KA.KategorijaArtikalaId
   JOIN pdvlistaporeza PLP
      ON PLP.IdPdvListaPoreza = PKZ.PdvKategZemlja
    JOIN brendovi BR
        ON BR.BrendId = A.ArtikalBrendId
    JOIN komitenti K
        ON K.KomitentId = A.ArtikalKomitent
    JOIN valuta V
        ON V.ValutaId = K.KomitentiValuta
    JOIN marza MA
        ON MA.MarzaId = A.ArtikalMarzaId
    JOIN unit UN
        ON UN.IdUnit = A.TipKatUnitArt
    JOIN tipunitnew TUN
      ON TUN.IdTipUnit = UN.IdUnit AND TUN.IdLanguage = $jezikId
    LEFT JOIN verikomitent VK
        ON VK.IdVerKomi = K.VerifikovanDib
    LEFT JOIN lokalnasu LS
        ON LS.IdLokSamo = K.VerifikovanLS
    LEFT JOIN loksamotextnew LSTN
        ON LSTN.IdLokSamo = LS.IdLokSamo AND LSTN.IdLanguage = $jezikId
WHERE A.ArtikalId = $id
  AND A.ArtikalAktivan >= 1
  AND (IdZemljePdvKatZem=K.KomitentiZemlja)
  $userUpit
  ) AS T1
";*/

$keyArt = $db->rawQueryOne($upitArtArray);


if ($keyArt) {



    $m['tag'] = 'artikal';
    $m['success'] = true;
    $m['error'] = 0;
    $m['error_msg'] = "Nema Errora";


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
    $IdUnit = $keyArt['IdUnit'];
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
    $MinimalnaKolArt = $keyArt['MinimalnaKolArt'];




    $urlArtiklaLink = '/' . $ArtikalLink . '/' . $ArtikalId;

    $nakasd = $common->stanjeOpis($ArtikalStanje, $ArtikalMPCena, $sesValuta, $jsonlang[229][$jezikId], $jsonlang[117][$jezikId], $jsonlang[116][$jezikId], $pravaVp, $pravaMp, $tipUsera, $dani);

    require(DCROOT.'/stranice/cenaPrikazVarijable.php');


    // $ImeSlikeArtikliSlike = $keyArt['slikaMain'];

    $lokFolder = $common->locationslika($ArtikalId);

    $urlArtiklaLink = DPROOT . '/' . $ArtikalLink . '/' . $ArtikalId;

    $ext = pathinfo($ImeSlikeArtikliSlike, PATHINFO_EXTENSION);
    $fileName = pathinfo($ImeSlikeArtikliSlike, PATHINFO_FILENAME);


    $products['ArtikalId'] = $ArtikalId;
    $products['ArtikalNaziv'] = $ArtikalNaziv;
    $products['ArtikalKratakOpis'] = $ArtikalKratakOpis;
    $products['OpisArtikliTekstovi'] = base64_encode($OpisArtikliTekstovi);
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
    $products['IdUnit'] = (int) $IdUnit;
    $products['MinimalnaKolArt'] = $MinimalnaKolArt;
    $products['slikaMain'] = $slikaMala;
    $products['stanje'] = ($ArtikalStanje) ? 1 : 0;
    $products['codeVendor'] = $common->vendorCode($KomitentKolona, $ArtikalId);
    $products['mozedaseKupi'] = $mozedasekupi;
    $products['ocenaut'] = $ocenaut;
    $products['KategorijaArtiklaNaziv'] = $KategorijaArtikalaNaziv;
    $products['KategorijaArtikalId'] = $KategorijaArtikalaIdOS;
    $products['KategorijaArtikalaLink'] = $KategorijaArtikalaLink;

    /*
    * Specifikacije artikala
    * */
    $ArtikalIdSmall = $ArtikalId;
    require('specJsonListaArt.php');
    $products['spec'] = $sec;


    /*
     * Stanje opis
     * */
    /*$nakasd = $common->stanjeOpis($ArtikalStanje, $ArtikalMPCena, $sesValuta, $jsonlang[229][$jezikId], $jsonlang[117][$jezikId], $jsonlang[116][$jezikId], $pravaVp, $pravaMp, $tipUsera, $dani);
    $cenaPrikaz = $nakasd['cenaPrikaz'];
    $cenaPrikazBroj = $nakasd['cenaPrikazBroj'];
    $stanjeProiz = $nakasd['stanjeProiz'];
    $mozedase = $nakasd['mozedase'];

    $products['cenaPrikaz'] = $cenaPrikaz;
    $products['cenaPrikazBroj'] = $cenaPrikazBroj;
    $products['stanjeProiz'] = $stanjeProiz;
    $products['mozedase'] = $mozedase;*/


    /*
     * Broj pregleda
     * // ovde treba dodati artikla br pregleda na Applikaciji
     * */
    $dataBrPregleda = Array ('ArtikalBrPregleda' => $ArtikalBrPregleda+1);
    $db->where ('ArtikalId', $id);
    $db->update ('artikli', $dataBrPregleda);


    include('jedanArtikalSlike.php');


    $m['artikal'] = $products;



} else {
    $m['tag'] = 'artikal';
    $m['success'] = false;
    $m['error'] = 2;
    $m['error_msg'] = "Nema datoj Artikla u bazi ili Nemate mogucnost pristupa datog artikla TipKorisnika = ".$userTip;

}

echo json_encode($m, JSON_UNESCAPED_UNICODE);
die;


?>


