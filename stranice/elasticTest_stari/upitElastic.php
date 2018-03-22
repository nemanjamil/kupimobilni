<?php
/**
 * Created by PhpStorm.
 * User: nemanja
 * Date: 1.10.16.
 * Time: 20.17
 */

$upit = "SELECT
    *,
    IF(0 > 0,
        CAST(pravaMpNeRabat * (100 - 0) / 100 AS DECIMAL (12 , 2 )),
        pravaMpNeRabat) AS pravaMp,
    IF(0 > 0,
        CAST(pravaVpNeRabat * (100 - 0) / 100 AS DECIMAL (12 , 2 )),
        pravaVpNeRabat) AS pravaVp
FROM
    (SELECT
        *,
            CAST((CASE
                    WHEN KomitentUPdv = 1 THEN getkursorg * (ArtikalMPCena - mpjac) * MarzaMarza * (PorezVrednost / 100 + 1)
                    ELSE getkursorg * (ArtikalMPCena - mpjac) * MarzaMarza
                END)
                AS DECIMAL (12 , 3 )) AS pravaMpNeRabat,
            CAST((CASE
                    WHEN KomitentUPdv = 1 THEN getkursorg * (ArtikalVPCena - vpjac) * MarzaVP * (PorezVrednost / 100 + 1)
                    ELSE getkursorg * (ArtikalVPCena - vpjac) * MarzaVP
                END)
                AS DECIMAL (12 , 3 )) AS pravaVpNeRabat
    FROM
        (SELECT
        A.ArtikalId,
            A.KategorijaArtikalId,
            A.ArtikalMPCena,
            A.ArtikalVPCena,
            A.ArtikalLink,
            A.ArtikalStanje,
            A.ArtikalNaAkciji,
            A.ArtikalBrendId,
            A.ArtikalBrPregleda,
            ANN.OpisArtikla,
            AKO.OpisKratakOpis,
            ATN.OpisArtTekst,
            KA.KategorijaArtikalaLink,
            KAN.NazivKategorije,
            BI.BrendIme,
            BR.BrendLink,
            K.KomitentiValuta,
            V.ValutaValuta,
            TUN.TipUnit,
            TUN.TipUnitCelo,
            K.KomitentUPdv,
            PLP.PorezVrednost,
            CAST((SELECT IF(0 > 0, MA.MarzaVP - ((MA.MarzaVP - 1) / 100 * 10), MA.MarzaVP))
                AS DECIMAL (5 , 3 )) AS MarzaVP,
            CAST((SELECT IF(0 > 0, MA.MarzaMarza - ((MA.MarzaMarza - 1) / 100 * 10), MA.MarzaMarza))
                AS DECIMAL (5 , 3 )) AS MarzaMarza,
            GETKURS(KomitentiValuta, 'din') AS getkursorg,
            CAST((A.ArtikalBrOcena / A.ArtikalBrKlikova) AS SIGNED) AS ocenaut,
            DATEDIFF(A.ArtikalDostupnoOd, NOW()) AS dani,
            (SELECT IF(K.KomitentRabat > 0, K.KomitentRabat, 0) / 100 * A.ArtikalVPCena) AS vpjac,
            (SELECT IF(K.KomitentRabat > 0, K.KomitentRabat, 0) / 100 * A.ArtikalMPCena) AS mpjac,
            (SELECT
                    ImeSlikeArtikliSlike
                FROM
                    artiklislike
                WHERE
                    IdArtikliSlikePov = A.ArtikalId
                        AND MainArtikliSlike = 1
                LIMIT 1) AS ImeSlikeArtikliSlike
    FROM
        artikli A
    JOIN artikalnazivnew ANN ON ANN.ArtikalId = A.ArtikalId
        AND ANN.IdLanguage = 5
    LEFT JOIN artiklikratakopisnew AKO ON AKO.IdArtiklaAkon = A.ArtikalId
        AND AKO.IdLanguageAkon = 5
    LEFT JOIN artiklitekstovinew ATN ON ATN.ArtikalId = A.ArtikalId
        AND ATN.LanguageId = 5
    JOIN kategorijeartikala KA ON KA.KategorijaArtikalaId = A.KategorijaArtikalId
    JOIN kategorijeartikalanaslov KAN ON KAN.IdKategorije = KA.KategorijaArtikalaId
        AND KAN.IdLanguage = 5
    JOIN pdvkategzemlja PKZ ON PKZ.IdKategPdvKatZem = KA.KategorijaArtikalaId
    JOIN pdvlistaporeza PLP ON PLP.IdPdvListaPoreza = PKZ.PdvKategZemlja
    JOIN unit UN ON UN.IdUnit = A.TipKatUnitArt
    JOIN tipunitnew TUN ON TUN.IdTipUnit = UN.IdUnit
        AND TUN.IdLanguage = 5
    JOIN brendovi BR ON BR.BrendId = A.ArtikalBrendId
    LEFT JOIN brendoviime BI ON BI.BrendId = BR.BrendId
        AND BI.IdLanguage = 5
    JOIN komitenti K ON K.KomitentId = A.ArtikalKomitent
    JOIN valuta V ON V.ValutaId = K.KomitentiValuta
    JOIN marza MA ON MA.MarzaId = A.ArtikalMarzaId
    WHERE
            ANN.OpisArtikla LIKE \"%Prizma sa drz%\"
            AND (IdZemljePdvKatZem = K.KomitentiZemlja)
            AND (SELECT VIDLJIVMPUSER(A.KategorijaArtikalId, 0)) = 1
    ORDER BY A.ArtikalBrPregleda DESC
    LIMIT 0 , 20) AS T1) AS T2; ";

$upitArtKat = $db->rawQuery($upit);

var_dump($upitArtKat);
die;
/*A.KategorijaArtikalId = 1623
AND A.ArtikalAktivan >= 1*/

