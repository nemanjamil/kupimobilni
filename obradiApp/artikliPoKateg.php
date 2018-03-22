<?php



if (!$id) {

    $m['tag'] = 'artikliPoKateg';
    $m['success'] = false;
    $m['error'] = 1;
    $m['error_msg'] = "Nema Id Kategorije";
    echo json_encode($m, JSON_UNESCAPED_UNICODE);
    die;
}

require(DCROOT.'/obradiApp/sortiLimitPara.php');

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
    A.ArtikalBrPregleda,
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
    CAST( (A.ArtikalBrOcena / A.ArtikalBrKlikova)	AS SIGNED ) AS ocenaut,
    DATEDIFF(A.ArtikalDostupnoOd, NOW()) as dani,
    CAST(
        (SELECT  IF( ".INSTALIRANAAPP." > 0, MA.MarzaVP-((MA.MarzaVP-1)/100 * ".POPUSTAPP."), MA.MarzaVP)) AS DECIMAL(5,3)
    ) AS MarzaVP,
    CAST(
        (SELECT  IF(".INSTALIRANAAPP." > 0, MA.MarzaMarza-((MA.MarzaMarza-1)/100 * ".POPUSTAPP."), MA.MarzaMarza)) AS DECIMAL(5,3)
    ) AS MarzaMarza,

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
  A.KategorijaArtikalId = $id
  AND A.ArtikalAktivan >= 1
  AND (IdZemljePdvKatZem=K.KomitentiZemlja)
  AND (SELECT   vidljivMpUser (A.KategorijaArtikalId,$userTip)) = 1
  $spC ) AS T1)
  AS T2;
";

$keyArtAr = $db->rawQuery($upitArtArray1);

$item = 0;
$broj = 0;
$i = 0;
$f = array();
if ($keyArtAr) {
    foreach ($keyArtAr as $k => $keyArt):


        include('listaArtikala.php');


    endforeach;

    $m['tag'] = 'artikliPoKateg';
    $m['success'] = true;
    $m['error'] = 0;
    $m['error_msg'] = "Nema Errora";

    require('brendoviUkateg.php');
    $m['brendovi'] = $brendovi;

    require('specPoKategoriji.php');
    $m['specKateg'] = $specPoKategArr;

    $m['artikli'] = $f;

} else {

    $m['tag'] = 'artikliPoKateg';
    $m['success'] = false;
    $m['error'] = 1;
    $m['error_msg'] = "Nema artikala u datoj Kategoriji ili nemate pristup datoj kategoriji";

}
echo json_encode($m, JSON_UNESCAPED_UNICODE);
die;


?>


