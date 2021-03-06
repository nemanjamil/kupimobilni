<?php

//if(isset($_GET['od'])) {  $od = filter_var($_GET['od'], FILTER_SANITIZE_NUMBER_INT); } else { $od = 0; }
//if(isset($_GET['do'])) {  $do = filter_var($_GET['do'], FILTER_SANITIZE_NUMBER_INT); } else { $do = 5; }

/*
 * Kada budemo setovali POST
 * if(isset($_POST['od'])) {  $od = filter_var($_POST['od'], FILTER_SANITIZE_NUMBER_INT); } else { $od = 0; }
 * if(isset($_POST['do'])) {  $do = filter_var($_POST['do'], FILTER_SANITIZE_NUMBER_INT); } else { $do = 5; }
 * if (isset($_GET['valutasession'])) {  $valutasession = filter_var($_GET['valutasession'], FILTER_SANITIZE_STRING); } else { $valutasession = '';  }
*/



if (!$id) {

    $m['tag'] = 'artikliNaAkciji';
    $m['success'] = false;
    $m['error'] = 2;
    $m['error_msg'] = "Nema Id za tip Akcije";
    echo json_encode($m, JSON_UNESCAPED_UNICODE);
    die;
}

if (!$jezikId) {

    $m['tag'] = 'artikliNaAkciji';
    $m['success'] = false;
    $m['error'] = 3;
    $m['error_msg'] = "Nema Id jezika za tip Akcije";
    echo json_encode($m, JSON_UNESCAPED_UNICODE);
    die;

}

require(DCROOT.'/obradiApp/sortiLimitPara.php');


$footArtiPocsuper = "
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
    UN.IdUnit,
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
  AND (IdZemljePdvKatZem=K.KomitentiZemlja)
  AND (SELECT   vidljivMpUser (A.KategorijaArtikalId,$userTip)) = 1
  AND A.ArtikalNaAkciji = $id
  $spC ) AS T1)
  AS T2;
";


/*$footArtiPocsuper = "
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
FROM (
SELECT
A.ArtikalId,
A.ArtikalNaAkciji,
A.top1,
A.top2,
A.top3,
A.KategorijaArtikalId,
A.MinimalnaKolArt,
AKO.OpisKratakOpis,
ANN.OpisArtikla,
TUN.TipUnit,
TUN.TipUnitCelo,
BR.BrendIme,
A.ArtikalMPCena,
A.ArtikalVPCena,
A.ArtikalLink,
A.ArtikalStanje,
K.KomitentiValuta,
MA.MarzaMarza,
MA.MarzaVP,
KAN.NazivKategorije,
KA.KategorijaArtikalaLink,
KA.MinimalnaKol,
K.KomitentUPdv,
PKZ.PdvKategZemlja,
PLP.PorezVrednost,
DATEDIFF(A.ArtikalDostupnoOd, NOW()) AS dani,
(SELECT IF(K.KomitentRabat>0,K.KomitentRabat,0)/100*A.ArtikalVPCena) AS vpjac,
(SELECT IF(K.KomitentRabat>0,K.KomitentRabat,0)/100*A.ArtikalMPCena) AS mpjac,
(SELECT ImeSlikeArtikliSlike FROM  artiklislike WHERE IdArtikliSlikePov = A.ArtikalId AND MainArtikliSlike = '1' LIMIT 1 )   AS slikaMain

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
JOIN brendovi BR
  ON BR.BrendId = A.ArtikalBrendId
JOIN pdvlistaporeza PLP
  ON PLP.IdPdvListaPoreza = PKZ.PdvKategZemlja
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

WHERE
A.ArtikalAktivan >= 1
AND   (SELECT   vidljivMp (A.KategorijaArtikalId)) = 1
AND A.ArtikalNaAkciji = $id
AND (IdZemljePdvKatZem=K.KomitentiZemlja)
ORDER BY A.top1 ASC
LIMIT $od,$do ) AS T1
";*/

$keyArtAr = $db->rawQuery($footArtiPocsuper);


$item = 0;
$broj = 0;
$i = 0;
$f = array();
if ($keyArtAr) {
    foreach ($keyArtAr as $k => $keyArt):


        include('listaArtikala.php');


    endforeach;

    $m['tag'] = 'artikliNaAkciji';
    $m['success'] = true;
    $m['error'] = 0;
    $m['error_msg'] = "Nema Errora";

    $m['artikli'] = $f;

} else {

    $m['tag'] = 'artikliNaAkciji';
    $m['success'] = false;
    $m['error'] = 1;
    $m['error_msg'] = "Nema Artikala na Akciji";

}
echo json_encode($m, JSON_UNESCAPED_UNICODE);
die;


?>


