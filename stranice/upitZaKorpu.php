<?php



$upitKartHead = "SELECT
                            TA.IdTempArtAuto,TA.KolTempArt, TA.IdArtTempArt, A.ArtikalLink, A.MinimalnaKolArt,A.ArtikalStanje, A.ArtikalMPCena,
                            A.ArtikalVPCena,ANN.OpisArtikla, PLP.PorezVrednost,
                            V.PdvOznakaValuta,V.ImeZemljeValuta,UN.IdUnit,TUN.TipUnit,TUN.TipUnitCelo,K.KomitentMesto,
                            K.KomitentUPdv,K.KomitentIme,K.KomitentPrezime,K.KomitentiValuta,K.KomitentRabat AS RabatKomitenta,K.KomiRabatKupi,
                            CAST(
                              (SELECT  IF($KomiRabatKupi> 0, MA.MarzaVP-((MA.MarzaVP-1)/100*".POPUSTAPP."), MA.MarzaVP)) AS DECIMAL(5,3)
                            ) AS MarzaVP,
                            CAST(
                              (SELECT  IF($KomiRabatKupi> 0, MA.MarzaMarza-((MA.MarzaMarza-1)/100*".POPUSTAPP."), MA.MarzaMarza)) AS DECIMAL(5,3)
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
        THEN ( (SELECT  GetKurs ($KomitentiValuta, $valutasession))    ) * (ArtikalVPCena - vpjac) * MarzaVP * (PorezVrednost / 100 + 1)
        ELSE ( (SELECT   GetKurs ($KomitentiValuta, $valutasession))    ) * (ArtikalVPCena - vpjac) * MarzaVP
      END
   )  AS DECIMAL (12, 3)) AS  pravaVpNeRabat


FROM (

$upitKartHead

) AS T1)
  AS T2;
";

?>