<?php


if (isset($_GET['upitsearch'])) {  $qq = filter_var($_GET['upitsearch'], FILTER_SANITIZE_STRING); } else { $qq = VALUTA;  }

require(DCROOT . '/stranice/separatedComa.php');

$spC = "ORDER by A.ArtikalBrPregleda DESC LIMIT 0,24";


$upitArtArray = "SELECT
*,

  IF ( $KomiRabatKupi > 0,  CAST(pravaMpNeRabatApp * (100-$KomiRabatKupi)/100 AS DECIMAL (12, 2)),  pravaMpNeRabatApp) AS pravaMp,
  IF ( $KomiRabatKupi > 0,  CAST(pravaVpNeRabatApp * (100-$KomiRabatKupi)/100 AS DECIMAL (12, 2)),  pravaVpNeRabatApp) AS pravaVp

  FROM (
      SELECT
      *,
    CAST(
        (
      CASE
        WHEN KomitentUPdv = 1
        THEN getkursorg * (ArtikalMPCena - mpRabat) * MarzaMarza * (PorezVrednost / 100 + 1)
        ELSE  getkursorg * (ArtikalMPCena - mpRabat) * MarzaMarza
          END
    )  AS DECIMAL (12, 2)) AS pravaMpNeRabat,
CAST(
    (
      CASE
        WHEN KomitentUPdv = 1
        THEN getkursorg * (ArtikalVPCena - vpRabat) * MarzaVP * (PorezVrednost / 100 + 1)
        ELSE  getkursorg * (ArtikalVPCena - vpRabat) * MarzaVP
      END
   )  AS DECIMAL (12, 2)) AS  pravaVpNeRabat ,

   CAST(
       (
      CASE
        WHEN KomitentUPdv = 1
        THEN getkursorg * (ArtikalMPCena - mpRabat) * MarzaMarzaApp * (PorezVrednost / 100 + 1)
        ELSE  getkursorg * (ArtikalMPCena - mpRabat) * MarzaMarzaApp
          END
    )  AS DECIMAL (12, 2)) AS pravaMpNeRabatApp,
CAST(
    (
      CASE
        WHEN KomitentUPdv = 1
        THEN getkursorg * (ArtikalVPCena - vpRabat) * MarzaVPApp * (PorezVrednost / 100 + 1)
        ELSE  getkursorg * (ArtikalVPCena - vpRabat) * MarzaVPApp
      END
   )  AS DECIMAL (12, 2)) AS  pravaVpNeRabatApp

  FROM
  (SELECT
      A.ArtikalId,
      A.KategorijaArtikalId,
      A.ArtikalLink,
      A.ArtikalStanje,
      A.ArtikalDostupnoOd,
      A.ArtikalAktivan,
      A.ArtikalBrPregleda,
      A.MinimalnaKolArt,
      A.ArtikalNaAkciji,
      DATEDIFF(A.ArtikalDostupnoOd, NOW()) AS dani,
      CAST( (A.ArtikalBrOcena / A.ArtikalBrKlikova)	AS SIGNED ) AS ocenaut,
      ANN.OpisArtikla,
      ATT.OpisArtTekst,
      AKO.OpisKratakOpis,
      KAN.NazivKategorije,
      KAT.TekstKategorije,
      KA.KategorijaArtikalaLink,
      TUN.TipUnit,
      TUN.TipUnitCelo,
      BI.BrendIme,
      BR.BrendId,
      K.KomitentiValuta,
      K.KomitentId,
      K.KomitentKolona,
      K.KomitentUPdv,
      V.ValutaValuta,
      VK.OpisVerKomit,
      VK.OcenaVeriKomi,
      VK.BojaVeriKomi,
      LS.SlikaLokSamo,
      LS.IdLokSamo,
      LS.LinkLokSamo,
      LSTN.LokSamoNaslov,
      CAST(
          (SELECT  IF($KomiRabatKupi> 0, MA.MarzaVP-((MA.MarzaVP-1)/100*10), MA.MarzaVP)) AS DECIMAL(5,3)
	) AS MarzaVP,
	CAST(
        (SELECT  IF($KomiRabatKupi> 0, MA.MarzaMarza-((MA.MarzaMarza-1)/100*10), MA.MarzaMarza)) AS DECIMAL(5,3)
	) AS MarzaMarza,

	CAST(
        (SELECT  IF(1> 0, MA.MarzaVP-((MA.MarzaVP-1)/100*10), MA.MarzaVP)) AS DECIMAL(5,3)
	) AS MarzaVPApp,
	CAST(
        (SELECT  IF(1> 0, MA.MarzaMarza-((MA.MarzaMarza-1)/100*10), MA.MarzaMarza)) AS DECIMAL(5,3)
	) AS MarzaMarzaApp,

      GetKurs (KomitentiValuta, $valutasession) AS getkursorg,
      PLP.PorezVrednost,

      (SELECT  IF(K.KomitentRabat > 0, K.KomitentRabat, 0 ) / 100 * A.ArtikalVPCena) AS vpRabat,
      (SELECT  IF(K.KomitentRabat > 0, K.KomitentRabat, 0 ) / 100 * A.ArtikalMPCena) AS mpRabat,
      A.ArtikalMPCena,
      A.ArtikalVPCena
    FROM
      artikli A
	      JOIN artikalnazivnew ANN  ON ANN.ArtikalId = A.ArtikalId AND ANN.IdLanguage = $jezikId
	      LEFT JOIN artiklitekstovinew ATT  ON ATT.ArtikalId = A.ArtikalId AND ATT.LanguageId = $jezikId
	      LEFT JOIN artiklikratakopisnew AKO   ON AKO.IdArtiklaAkon = A.ArtikalId AND AKO.IdLanguageAkon = $jezikId

	      JOIN kategorijeartikala KA      ON KA.KategorijaArtikalaId = A.KategorijaArtikalId
	      JOIN kategorijeartikalanaslov KAN  ON KAN.IdKategorije = KA.KategorijaArtikalaId  AND KAN.IdLanguage = $jezikId
	      JOIN kategorijeartikalatekst KAT ON KAT.IdKategorije = KA.KategorijaArtikalaId AND KAT.IdLanguage = $jezikId

	      JOIN pdvkategzemlja PKZ ON PKZ.IdKategPdvKatZem = KA.KategorijaArtikalaId
	      JOIN pdvlistaporeza PLP ON PLP.IdPdvListaPoreza = PKZ.PdvKategZemlja
	      JOIN brendovi BR ON BR.BrendId = A.ArtikalBrendId
	      LEFT JOIN brendoviime BI ON BI.BrendId = BR.BrendId AND BI.IdLanguage = $jezikId
	      JOIN komitenti K ON K.KomitentId = A.ArtikalKomitent
	      JOIN valuta V ON V.ValutaId = K.KomitentiValuta
	      JOIN marza MA ON MA.MarzaId = A.ArtikalMarzaId

	      JOIN unit UN ON UN.IdUnit = A.TipKatUnitArt
	      JOIN tipunitnew TUN ON TUN.IdTipUnit = UN.IdUnit AND TUN.IdLanguage = $jezikId

	      LEFT JOIN verikomitent VK  ON VK.IdVerKomi = K.VerifikovanDib
	      LEFT JOIN lokalnasu LS ON LS.IdLokSamo = K.VerifikovanLS
	      LEFT JOIN loksamotextnew LSTN ON LSTN.IdLokSamo = LS.IdLokSamo AND LSTN.IdLanguage = $jezikId

    WHERE  A.ArtikalAktivan >= 1
        AND MATCH (ANN.OpisArtikla)  AGAINST ('$comma_separated' IN NATURAL LANGUAGE MODE)
        AND (IdZemljePdvKatZem=K.KomitentiZemlja)
        AND (SELECT   vidljivMpUserId (A.KategorijaArtikalId,$userId)) = 1
        $spC )
    AS T1)
    AS T2;";


$f = array();

$upitArtKat = $db->rawQuery($upitArtArray);
if ($upitArtKat) {

    $m['tag'] = 'searchAndr';
    $m['success'] = true;
    $m['error'] = 0;
    $m['error_msg'] = "Nema Errora";

    foreach ($upitArtKat as $product => $keyArt):

        include('listaArtikala.php');

        $m['artikli'] = $f;

    endforeach;
} else {
    $m['tag'] = 'searchAndr';
    $m['success'] = false;
    $m['error'] = 1;
    $m['error_msg'] = 'Nema Podataka';
    echo json_encode($m, JSON_UNESCAPED_UNICODE);
    die;
}

echo $json = json_encode($m, JSON_UNESCAPED_UNICODE);

?>