<?php

$cols = Array ("ArtikalVPCena", "ArtikalMPCena","KategorijaArtikalId");
$db->where ("ArtikalId", $id);
$user = $db->getOne ("artikli");

$ArtikalVPCena = $user['ArtikalVPCena'];
$ArtikalMPCena = $user['ArtikalMPCena'];
$KategorijaArtikalIdArt = (int) $user['KategorijaArtikalId'];

if (!$KategorijaArtikalIdArt) {

    $m['tag'] = 'povezaniArtikliNaArtiklu';
    $m['success'] = false;
    $m['error'] = 2;
    $m['error_msg'] = "Nema Kategorije Artikala";
    echo $json =  json_encode($m, JSON_UNESCAPED_UNICODE);


}

$cenaminus = $ArtikalMPCena - ((PROCPOVEZANIART / 100)* $ArtikalMPCena );
$cenaplus = $ArtikalMPCena + ((PROCPOVEZANIART / 100)* $ArtikalMPCena );


require(DCROOT.'/obradiApp/sortiLimitPara.php');

$footArtiPoc = "
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
    SELECT
    A.ArtikalId,
    A.KategorijaArtikalId,
    A.ArtikalMPCena,
    A.ArtikalVPCena,
    A.ArtikalLink,
    A.ArtikalStanje,
    A.ArtikalNaAkciji,
    A.ArtikalBrendId,
    A.MinimalnaKolArt,
    ANN.OpisArtikla,
    AKO.OpisKratakOpis,
    KA.KategorijaArtikalaLink,
    KAN.NazivKategorije,
    BI.BrendIme,
    BR.BrendLink,
    BR.BrendId,
    K.KomitentiValuta,
    K.KomitentKolona,
    V.ValutaValuta,
    TUN.TipUnit,
    TUN.TipUnitCelo,
    K.KomitentUPdv,
    PLP.PorezVrednost,
    CAST(
		(SELECT  IF( ".INSTALIRANAAPP." > 0, MA.MarzaVP-((MA.MarzaVP-1)/100 * ".POPUSTAPP."), MA.MarzaVP)) AS DECIMAL(5,3)
	) AS MarzaVP,
	CAST(
		(SELECT  IF(".INSTALIRANAAPP." > 0, MA.MarzaMarza-((MA.MarzaMarza-1)/100 * ".POPUSTAPP."), MA.MarzaMarza)) AS DECIMAL(5,3)
	) AS MarzaMarza,
    CAST( (A.ArtikalBrOcena / A.ArtikalBrKlikova)	AS SIGNED ) AS ocenaut,
    DATEDIFF(A.ArtikalDostupnoOd, NOW()) as dani,
    (SELECT IF(K.KomitentRabat>0,K.KomitentRabat,0)/100*A.ArtikalVPCena) AS vpjac,
    (SELECT IF(K.KomitentRabat>0,K.KomitentRabat,0)/100*A.ArtikalMPCena) AS mpjac,
    (SELECT ImeSlikeArtikliSlike FROM  artiklislike WHERE IdArtikliSlikePov = A.ArtikalId AND MainArtikliSlike = 1 LIMIT 1 )   AS slikaMain

  FROM
    artikli A
    JOIN artikalnazivnew ANN
      ON ANN.ArtikalId = A.ArtikalId AND  ANN.IdLanguage = $jezikId
    LEFT JOIN artiklikratakopisnew AKO
      ON AKO.IdArtiklaAkon = A.ArtikalId AND  AKO.IdLanguageAkon = $jezikId

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

WHERE
  A.ArtikalAktivan >= 1
  AND A.ArtikalId != $id
  AND A.KategorijaArtikalId = $KategorijaArtikalIdArt
  AND (A.ArtikalMPCena BETWEEN $cenaminus AND $cenaplus)
  AND (IdZemljePdvKatZem=K.KomitentiZemlja)
  AND (SELECT   vidljivMpUser (A.KategorijaArtikalId,$userTip)) = 1
   $spC
 ) AS T1)
  AS T2;
";

$keyArtAr = $db->rawQuery($footArtiPoc);


$i = 0;
$dp = '';
if ($keyArtAr) {

    $m['tag'] = 'povezaniArtikliNaArtiklu';
    $m['success'] = true;
    $m['error'] = 0;
    $m['error_msg'] = "Nema Errora";


    require('jsonArikliPovezani.php');

    $m['artikli'] = $f;

} else {
    $m['tag'] = 'povezaniArtikliNaArtiklu';
    $m['success'] = false;
    $m['error'] = 1;
    $m['error_msg'] = "Nema Artikala";

}


echo $json =  json_encode($m, JSON_UNESCAPED_UNICODE);

/*$fp = fopen(DCROOT.'/cron/crongotovoMob/preporuka-nedelje-cron.json', 'w+');
fwrite($fp, $json);
fclose($fp);*/

?>

