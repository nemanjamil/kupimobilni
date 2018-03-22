<?php
/**
 * Project: masine
 * Created by PhpStorm.
 * User: Nikola
 * Date: 17. 03. 2016.
 * Time: 15:31
 */

$dpp = '';
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
    MA.MarzaMarza,
    TUN.TipUnit,
    TUN.TipUnitCelo,
    K.KomitentUPdv,
    PLP.PorezVrednost,
    MarzaVP,
    CAST( (A.ArtikalBrOcena / A.ArtikalBrKlikova)	AS SIGNED ) AS ocenaut,
    DATEDIFF(A.ArtikalDostupnoOd, NOW()) as dani,
    (SELECT IF(K.KomitentRabat>0,K.KomitentRabat,0)/100*A.ArtikalVPCena) AS vpjac,
    (SELECT IF(K.KomitentRabat>0,K.KomitentRabat,0)/100*A.ArtikalMPCena) AS mpjac,
    (SELECT ImeSlikeArtikliSlike FROM  artiklislike WHERE IdArtikliSlikePov = A.ArtikalId AND MainArtikliSlike = 1 LIMIT 1 )   AS slikaMain

  FROM
    artikli A
    JOIN artikalnazivnew ANN
      ON ANN.ArtikalId = A.ArtikalId AND  ANN.IdLanguage = $jez
    LEFT JOIN artiklikratakopisnew AKO
      ON AKO.IdArtiklaAkon = A.ArtikalId AND  AKO.IdLanguageAkon = $jez

    JOIN kategorijeartikala KA
      ON KA.KategorijaArtikalaId = A.KategorijaArtikalId
    JOIN kategorijeartikalanaslov KAN
      ON KAN.IdKategorije = KA.KategorijaArtikalaId AND KAN.IdLanguage = $jez

    JOIN pdvkategzemlja PKZ
      ON PKZ.IdKategPdvKatZem = KA.KategorijaArtikalaId
    JOIN pdvlistaporeza PLP
      ON PLP.IdPdvListaPoreza = PKZ.PdvKategZemlja

    JOIN unit UN
      ON UN.IdUnit = A.TipKatUnitArt
    JOIN tipunitnew TUN
      ON TUN.IdTipUnit = UN.IdUnit AND TUN.IdLanguage = $jez

    JOIN brendovi BR
      ON BR.BrendId = A.ArtikalBrendId
    LEFT JOIN brendoviime BI
      ON BI.BrendId = BR.BrendId AND BI.IdLanguage = $jez
    JOIN komitenti K
      ON K.KomitentId = A.ArtikalKomitent
    JOIN valuta V
      ON V.ValutaId = K.KomitentiValuta
    JOIN marza MA
      ON MA.MarzaId = A.ArtikalMarzaId

WHERE
  A.ArtikalAktivan >= 1
  AND (IdZemljePdvKatZem=K.KomitentiZemlja)
  AND (SELECT   vidljivMpUser (A.KategorijaArtikalId,$tipUsera)) = 1
  AND A.ArtikalNaAkciji = $varijablaAlati
  ORDER BY A.top1 ASC
  LIMIT 18 ) AS T1)
  AS T2";

$keyArtAr = $db->rawQuery($footArtiPoc);

$item = 0;
$broj = 0;
$i = 0;
// da ga anuliram posto si ga vec negde pamtio.
$products = '';

if ($keyArtAr) {

    $item = 0;
    $broj = 0;
    $i = 0;
    foreach ($keyArtAr as $k => $keyArt):

        $ArtikalId = $keyArt['ArtikalId'];
        $KategorijaArtikalaIdOS = $keyArt['KategorijaArtikalId'];
        $ArtikalNaAkciji = $keyArt['ArtikalNaAkciji'];
        $top1 = $keyArt['top1'];
        $top2 = $keyArt['top2'];
        $top3 = $keyArt['top3'];
        $ArtikalNaziv = $keyArt['OpisArtikla'];
        $ArtikalMPCena = $keyArt['ArtikalMPCena'];
        $ArtikalVPCena = $keyArt['ArtikalVPCena'];
        $KomitentiValuta = $keyArt['KomitentiValuta'];
        $ValutaValuta = $keyArt['ValutaValuta'];
        $MarzaMarza = $keyArt['MarzaMarza'];
        $odnosKursArt = $keyArt['odnosKursArt'];
        $pravaMp = $keyArt['pravaMp'];
        $pravaVp = $keyArt['pravaVp'];
        $ArtikalLink = $keyArt['ArtikalLink'];
        $ArtikalKratakOpis = $keyArt['ArtikalKratakOpis'];
        $ArtikalStanje = $keyArt['ArtikalStanje'];
        $ImeSlikeArtikliSlike = $keyArt['ImeSlikeArtikliSlike'];


        $urlArtiklaLink = '/' . $ArtikalLink . '/' . $ArtikalId;

        if ($ArtikalStanje > 0) {
            $mozedase = '';
            $cenaPrikaz = ($tipUsera >= 3) ? $common->formatCena($pravaVp, $sesValuta) : $common->formatCena($pravaMp, $sesValuta);
        } else {
            $mozedase = 'disabled="disabled"';
        }


        $ImeSlikeArtikliSlike = $keyArt['slikaMain'];

        $lokFolder = $common->locationslika($ArtikalId);

        $urlArtiklaLink = '/' . $ArtikalLink . '/' . $ArtikalId;

        $ext = pathinfo($ImeSlikeArtikliSlike, PATHINFO_EXTENSION);
        $fileName = pathinfo($ImeSlikeArtikliSlike, PATHINFO_FILENAME);

        $mala_slika = $lokFolder . '/' . $fileName . '_mala.' . $ext;
        $srednja_slika = $lokFolder . '/' . $fileName . '_srednja.' . $ext;
        $velika_slika = $lokFolder . '/' . $ImeSlikeArtikliSlike;

        $mala_slika = $common->nemaSlikeMala($mala_slika);

        $products[$item][$i]['ArtikalId'] = $ArtikalId;
        $products[$item][$i]['OpisArtikla'] = $ArtikalNaziv;
        $products[$item][$i]['NaAkciji'] = $ArtikalNaAkciji;
        $products[$item][$i]['velika_slika'] = $velika_slika;
        $products[$item][$i]['mala_slika'] = $mala_slika;
        $products[$item][$i]['srednja_slika'] = $srednja_slika;
        $products[$item][$i]['urlArtiklaLink'] = $urlArtiklaLink;
        $products[$item][$i]['cenaPrikaz'] = $cenaPrikaz;
        $products[$item][$i]['opisDetaljnije'] = $jsonlang[76][$jezikId];
        $products[$item][$i]['ImeSlikeArtikliSlike'] = $ImeSlikeArtikliSlike;
        $products[$item][$i]['pozovite'] = $jsonlang[117][$jezikId];
        $products[$item][$i]['pravaMp'] = $pravaMp;

        if ($broj==5) {
            $item++;
            $broj = 0;
        } else {
            $broj++;
        }
        $i++;

    endforeach;



		$listaSmall = '';

		foreach($products as $produc):

            $dpp .= '<div class="item">';

            foreach ($produc as $product):



                $dpp .= $common->displayProductSuper(
                    $product['ArtikalId'],
                    $product['OpisArtikla'],
                    $product['NaAkciji'],
                    $product['velika_slika'],
                    $product['mala_slika'],
                    $product['srednja_slika'],
                    $product['urlArtiklaLink'],
                    $product['cenaPrikaz'],
                    $product['ImeSlikeArtikliSlike'],
                    $product['opisDetaljnije'],
                    $product['pozovite'],
                    $product['pravaMp']
                );

            endforeach;


            $dpp .=  '</div>';


        endforeach;


}


$fpa = fopen(DCROOT . '/cron/crongotovo/product-special-'.$naziv.'-cron.php', 'w+');
fwrite($fpa, $dpp);
fclose($fpa);