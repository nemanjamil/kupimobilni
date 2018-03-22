<?php




$spC = '';

/* /var/www/masine/stranice/opisivacstrane.php linijna 92
 * BREND*/
if ($brendArtUpit){
    $spC = 'AND A.ArtikalBrendId = '.$brendArtUpit;
}

/*KRAJ BREND*/



if ($specPodaci) {
    foreach ($specPodaci as $key => $val) {

        $iSpec = 0;
        $spC .= " AND (";
        foreach ($val as $k => $v) {

            if (!$iSpec) {
                $spC .= "(SELECT idGrupeSpecPove ($key, A.ArtikalId)) = $k";
            } else {
                $spC .= " OR (SELECT idGrupeSpecPove ($key, A.ArtikalId)) = $k";
            }
            $iSpec++;

        }
        $spC .= ") ";
    }
    $iSpec = ''; // resetujemo brojac
}

switch ($kontrole['sortKontrole']) {
    case 1:
        $spC .= ' ORDER by A.ArtikalBrPregleda DESC';
        break;
    case 2:
        $spC .= ' ORDER BY A.ArtikalMpCena ASC';
        break;
    case 3:
        $spC .= ' ORDER BY A.ArtikalMpCena DESC';
        break;
    case 4:
        $spC .= ' ORDER BY ANN.OpisArtikla ASC';
        break;
    case 5:
        $spC .= ' ORDER BY ANN.OpisArtikla DESC';
        break;
    case 6:
        $spC .= ' ORDER by A.ArtikalId DESC';
        break;

    default:
        $spC .= ' ORDER by A.ArtikalBrPregleda DESC';
}

$poCLimKur = ($currentpage - 1) * $konPokKont;
if ($konPokKont) {
    $spC .= " LIMIT $poCLimKur,$konPokKont";
}


$upitArtArray1 = "
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
        THEN getkursorg * (ArtikalMPCena - mpjac) * MarzaMarza * (PorezVrednost / 100 + 1)
        ELSE getkursorg * (ArtikalMPCena - mpjac) * MarzaMarza
          END
    )  AS DECIMAL (12, 3)) AS pravaMpNeRabat,
CAST(
    (
      CASE
        WHEN KomitentUPdv = 1
        THEN getkursorg * (ArtikalVPCena - vpjac) * MarzaVP * (PorezVrednost / 100 + 1)
        ELSE getkursorg * (ArtikalVPCena - vpjac) * MarzaVP
      END
   )  AS DECIMAL (12, 3)) AS  pravaVpNeRabat


FROM (
SELECT
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
    CAST(
          (SELECT  IF($KomiRabatKupi> 0, MA.MarzaVP-((MA.MarzaVP-1)/100*10), MA.MarzaVP)) AS DECIMAL(5,3)
	) AS MarzaVP,
	CAST(
        (SELECT  IF($KomiRabatKupi> 0, MA.MarzaMarza-((MA.MarzaMarza-1)/100*10), MA.MarzaMarza)) AS DECIMAL(5,3)
	) AS MarzaMarza,

    GetKurs (KomitentiValuta, $valutasession) AS getkursorg,
    CAST( (A.ArtikalBrOcena / A.ArtikalBrKlikova)	AS SIGNED ) AS ocenaut,
    DATEDIFF(A.ArtikalDostupnoOd, NOW()) as dani,
    (SELECT IF(K.KomitentRabat>0,K.KomitentRabat,0)/100*A.ArtikalVPCena) AS vpjac,
    (SELECT IF(K.KomitentRabat>0,K.KomitentRabat,0)/100*A.ArtikalMPCena) AS mpjac,
    (SELECT ImeSlikeArtikliSlike FROM  artiklislike WHERE IdArtikliSlikePov = A.ArtikalId AND MainArtikliSlike = 1 LIMIT 1 )   AS ImeSlikeArtikliSlike

  FROM
    artikli A
    LEFT JOIN artikalnazivnew ANN
      ON ANN.ArtikalId = A.ArtikalId AND  ANN.IdLanguage = $jezikId
    LEFT JOIN artiklikratakopisnew AKO
      ON AKO.IdArtiklaAkon = A.ArtikalId AND  AKO.IdLanguageAkon = $jezikId
    LEFT JOIN artiklitekstovinew ATN
      ON ATN.ArtikalId = A.ArtikalId AND  ATN.LanguageId = $jezikId

    JOIN kategorijeartikala KA
      ON KA.KategorijaArtikalaId = A.KategorijaArtikalId
    JOIN kategorijeartikalanaslov KAN
      ON KAN.IdKategorije = KA.KategorijaArtikalaId AND KAN.IdLanguage = $jezikId

    JOIN pdvkategzemlja PKZ
      ON PKZ.IdKategPdvKatZem = KA.KategorijaArtikalaId
    JOIN pdvlistaporeza PLP
      ON PLP.IdPdvListaPoreza = PKZ.PdvKategZemlja

    JOIN unit UN
      ON UN.IdUnit = A.TipKatUnitArt
    JOIN tipunitnew TUN
      ON TUN.IdTipUnit = UN.IdUnit AND TUN.IdLanguage = $jezikId

    JOIN brendovi BR
      ON BR.BrendId = A.ArtikalBrendId
    LEFT JOIN brendoviime BI
      ON BI.BrendId = BR.BrendId AND BI.IdLanguage = $jezikId
    JOIN komitenti K
      ON K.KomitentId = A.ArtikalKomitent
    JOIN valuta V
      ON V.ValutaId = K.KomitentiValuta
    JOIN marza MA
      ON MA.MarzaId = A.ArtikalMarzaId

WHERE A.KategorijaArtikalId = $KategorijaArtikalaIdOS
  AND A.ArtikalAktivan >= 1
  AND A.ArtikalStanje >= 1
  AND (IdZemljePdvKatZem=K.KomitentiZemlja)
  AND (SELECT   vidljivMpUser (A.KategorijaArtikalId,$tipUsera)) = 1
  " . $spC . " ) AS T1)
  AS T2;
";




?>