<?php


/*$upitKartHead = "SELECT
                            TA.IdTempArtAuto,TA.KolTempArt, TA.IdArtTempArt, A.ArtikalLink, A.MinimalnaKolArt,A.ArtikalStanje, A.ArtikalMPCena,
                            A.ArtikalVPCena,ANN.OpisArtikla, PLP.PorezVrednost,
                            V.PdvOznakaValuta,V.ImeZemljeValuta,UN.IdUnit,TUN.TipUnit,TUN.TipUnitCelo,K.KomitentMesto,
                            K.KomitentUPdv,K.KomitentIme,K.KomitentPrezime,K.KomitentiValuta,
                            CAST(
                              (SELECT  IF($KomiRabatKupi> 0, MA.MarzaVP-((MA.MarzaVP-1)/100*10), MA.MarzaVP)) AS DECIMAL(5,3)
                            ) AS MarzaVP,
                            CAST(
                              (SELECT  IF($KomiRabatKupi> 0, MA.MarzaMarza-((MA.MarzaMarza-1)/100*10), MA.MarzaMarza)) AS DECIMAL(5,3)
                            ) AS MarzaMarza,
                            (SELECT IF(K.KomitentRabat>0,K.KomitentRabat,0)/100*A.ArtikalVPCena) AS vpjac,
                            (SELECT IF(K.KomitentRabat>0,K.KomitentRabat,0)/100*A.ArtikalMPCena) AS mpjac,
                            (SELECT ImeSlikeArtikliSlike FROM  artiklislike WHERE IdArtikliSlikePov = A.ArtikalId AND MainArtikliSlike = 1 LIMIT 1 )   AS ImeSlikeArtikliSlike

							FROM tempart TA
							JOIN artikli A
								ON A.ArtikalId = TA.IdArtTempArt
							JOIN artikalnazivnew ANN
								ON ANN.ArtikalId = A.ArtikalId AND  ANN.IdLanguage = $jezikId
                            JOIN kategorijeartikala KA
                                ON KA.KategorijaArtikalaId = A.KategorijaArtikalId
							JOIN pdvkategzemlja PKZ
								ON PKZ.IdKategPdvKatZem = KA.KategorijaArtikalaId
							JOIN pdvlistaporeza PLP
								ON PLP.IdPdvListaPoreza = PKZ.PdvKategZemlja
							JOIN komitenti K
								ON K.KomitentId = A.ArtikalKomitent
							JOIN valuta V
								ON V.ValutaId = K.KomitentiValuta
							JOIN marza MA
								ON MA.MarzaId = A.ArtikalMarzaId
                            JOIN
                                unit UN ON UN.IdUnit = KA.TipKatUnit
							JOIN tipunitnew TUN
      							ON TUN.IdTipUnit = UN.IdUnit AND TUN.IdLanguage = $jezikId
							WHERE TA.KomiTempArt = $KomitentId  AND (IdZemljePdvKatZem=K.KomitentiZemlja)";

$upitArtArrayHead = "
SELECT
  *,
  IF ( $KomiRabatKupi > 0,  CAST(pravaMpNeRabat * (100-$KomiRabatKupi)/100 AS DECIMAL (12, 2)),  pravaMpNeRabat) AS pravaMp,
  IF ( $KomiRabatKupi > 0,  CAST(pravaVpNeRabat * (100-$KomiRabatKupi)/100 AS DECIMAL (12, 2)),  pravaVpNeRabat) AS pravaVp
  FROM (
SELECT *,
CAST(
    (
      CASE
        WHEN KomitentUPdv = 1
        THEN ( (SELECT  GetKurs (KomitentiValuta, $valutasession)) ) * (ArtikalMPCena - mpjac) * MarzaMarza * (PorezVrednost / 100 + 1)
        ELSE ( (SELECT   GetKurs (KomitentiValuta, $valutasession))) * (ArtikalMPCena - mpjac) * MarzaMarza
          END
    )  AS DECIMAL (12, 3)) AS pravaMpNeRabat,
CAST(
    (
      CASE
        WHEN KomitentUPdv = 1
        THEN ( (SELECT  GetKurs (KomitentiValuta, $valutasession))    ) * (ArtikalVPCena - vpjac) * MarzaVP * (PorezVrednost / 100 + 1)
        ELSE ( (SELECT   GetKurs (KomitentiValuta, $valutasession))    ) * (ArtikalVPCena - vpjac) * MarzaVP
      END
   )  AS DECIMAL (12, 3)) AS  pravaVpNeRabat


FROM (

$upitKartHead

) AS T1)
  AS T2;
";*/
$pred2 = "SELECT
      TA.IdArtTempArt,
      TA.KolTempArt,
      TA.KomiTempArt,
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
      UN.IdUnit,
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
        (SELECT  IF(1> 0, MA.MarzaVP-((MA.MarzaVP-1)/100*".POPUSTAPP."), MA.MarzaVP)) AS DECIMAL(5,3)
	) AS MarzaVPApp,
	CAST(
        (SELECT  IF(1> 0, MA.MarzaMarza-((MA.MarzaMarza-1)/100*".POPUSTAPP."), MA.MarzaMarza)) AS DECIMAL(5,3)
	) AS MarzaMarzaApp,

      GetKurs (KomitentiValuta, $valutasession) AS getkursorg,
      PLP.PorezVrednost,
      (SELECT  COUNT(IdRecenzije) AS dalirec   FROM  recenzije  WHERE ProizvodRecenzije = A.ArtikalId AND KomentarAktivanRecenzije = '1') AS vidimikirec,
      (SELECT  IF(K.KomitentRabat > 0, K.KomitentRabat, 0 ) / 100 * A.ArtikalVPCena) AS vpRabat,
      (SELECT  IF(K.KomitentRabat > 0, K.KomitentRabat, 0 ) / 100 * A.ArtikalMPCena) AS mpRabat,
      A.ArtikalMPCena,
      A.ArtikalVPCena

    FROM tempart TA
          JOIN artikli A ON A.ArtikalId = TA.IdArtTempArt
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

    WHERE
    TA.KomiTempArt = $userId
    AND A.ArtikalAktivan >= 1
    AND (IdZemljePdvKatZem = K.KomitentiZemlja )
    AND  (SELECT  vidljivMpUser (A.KategorijaArtikalId, $userTip)) = 1";

$pred1 = "SELECT
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
  ( $pred2 )
    AS T1";

$upitArtArrayHead = "SELECT
*,

  IF ( $KomiRabatKupi > 0,  CAST(pravaMpNeRabatApp * (100-$KomiRabatKupi)/100 AS DECIMAL (12, 2)),  pravaMpNeRabatApp) AS pravaMp,
  IF ( $KomiRabatKupi > 0,  CAST(pravaVpNeRabatApp * (100-$KomiRabatKupi)/100 AS DECIMAL (12, 2)),  pravaVpNeRabatApp) AS pravaVp

  FROM (
  $pred1
      )
    AS T2;";

/*IF ( $KomiRabatKupi > 0,  CAST(pravaMpNeRabat * (100-$KomiRabatKupi)/100 AS DECIMAL (12, 2)),  pravaMpNeRabat) AS pravaMp,
  IF ( $KomiRabatKupi > 0,  CAST(pravaVpNeRabat * (100-$KomiRabatKupi)/100 AS DECIMAL (12, 2)),  pravaVpNeRabat) AS pravaVp,*/
?>

