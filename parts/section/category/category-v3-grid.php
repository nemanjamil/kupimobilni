<!-- ========================================== CATEGORY-V3-GRID ========================================= -->
<?php
$delay = 0;

$spC = '';


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
        $spC .= 'ORDER by A.ArtikalBrPregleda DESC';
        break;
    case 2:
        $spC .= 'ORDER BY A.ArtikalMpCena ASC';
        break;
    case 3:
        $spC .= 'ORDER BY A.ArtikalMpCena DESC';
        break;
    case 4:
			$spC .= 'ORDER BY AN.OpisArtikla ASC';
        break;
    case 5:
        $spC .= 'ORDER by A.ArtikalId DESC';
        break;

    default:
        $spC .= 'ORDER by A.ArtikalBrPregleda DESC';
}





$poCLimKur = ($currentpage - 1) * $konPokKont;
if ($konPokKont) {
    $spC .= " LIMIT $poCLimKur,$konPokKont";
}



$upitArtArray = "SELECT *,
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
  A.KategorijaArtikalId,
  A.ArtikalMPCena,
  A.ArtikalVPCena,
  A.ArtikalLink,
  A.ArtikalNaAkciji,
    AN.OpisArtikla,
    KAN.NazivKategorije,
  KA.KategorijaArtikalaLink,
  BI.BrendIme,
  K.KomitentiValuta,
  V.ValutaValuta,
  MA.MarzaMarza,
  K.KomitentUPdv,
  PLP.PorezVrednost,
  MarzaVP,
(SELECT IF(K.KomitentRabat>0,K.KomitentRabat,0)/100*A.ArtikalVPCena) AS vpjac,
(SELECT IF(K.KomitentRabat>0,K.KomitentRabat,0)/100*A.ArtikalMPCena) AS mpjac,
  (SELECT ImeSlikeArtikliSlike FROM  artiklislike WHERE IdArtikliSlikePov = A.ArtikalId AND MainArtikliSlike = 1 LIMIT 1 )   AS ImeSlikeArtikliSlike

  FROM
  artikli A
  JOIN artikalnazivnew AN
	ON AN.ArtikalId = A.ArtikalId AND AN.IdLanguage = $jezikId
  JOIN kategorijeartikala KA
    ON KA.KategorijaArtikalaId = A.KategorijaArtikalId
  JOIN kategorijeartikalanaslov KAN
    ON KAN.IdKategorije = A.KategorijaArtikalId  AND KAN.IdLanguage = $jezikId
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
  JOIN tagoviartikli TA
    ON TA.IdTagoviArtikli = A.ArtikalId
  JOIN tagovi TAG
    ON TAG.TagoviId = TA.IdOdTagovaArt
  JOIN pdvkategzemlja PKZ
      ON PKZ.IdKategPdvKatZem = KA.KategorijaArtikalaId
  JOIN pdvlistaporeza PLP
      ON PLP.IdPdvListaPoreza = PKZ.PdvKategZemlja

WHERE
  TAG.TagoviId = '$id'
  AND A.ArtikalAktivan >= 1
  AND (IdZemljePdvKatZem=K.KomitentiZemlja)
  AND (SELECT   vidljivMp (A.KategorijaArtikalId)) = 1
  " . $spC . ") AS T1
";


$upitArtKat = $db->rawQuery($upitArtArray);
if ($upitArtKat) {
    foreach ($upitArtKat as $product => $keyArt):

        $ArtikalId = $keyArt['ArtikalId'];
        $KategorijaArtikalId = $keyArt['KategorijaArtikalId'];
        $ArtikalNaziv = $keyArt['OpisArtikla'];
        $ArtikalMPCena = $keyArt['ArtikalMPCena'];
        $ArtikalVPCena = $keyArt['ArtikalVPCena'];
        $KategorijaArtikalaNaziv = $keyArt['NazivKategorije'];
        $KategorijaArtikalaLink = $keyArt['KategorijaArtikalaLink'];
        $BrendIme = $keyArt['BrendIme'];
        $KomitentiValuta = $keyArt['KomitentiValuta'];
        $ValutaValuta = $keyArt['ValutaValuta'];
        $MarzaMarza = $keyArt['MarzaMarza'];
        $odnosKursArt = $keyArt['odnosKursArt'];
        $pravaMp = $keyArt['pravaMp'];
        $pravaVp = $keyArt['pravaVp'];
        $ArtikalLink = $keyArt['ArtikalLink'];
        $NaAkciji = $keyArt['ArtikalNaAkciji'];

        $ImeSlikeArtikliSlike = $keyArt['ImeSlikeArtikliSlike'];

        $lokFolder = $common->locationslika($ArtikalId);

        $urlArtiklaLink = '/' . $ArtikalLink . '/' . $ArtikalId;

        $ext = pathinfo($ImeSlikeArtikliSlike, PATHINFO_EXTENSION);
        $fileName = pathinfo($ImeSlikeArtikliSlike, PATHINFO_FILENAME);

        $mala_slika = $lokFolder . '/' . $fileName . '_mala.' . $ext;
        $srednja_slika = $lokFolder . '/' . $fileName . '_srednja.' . $ext;
        $velika_slika = $lokFolder . '/' . $ImeSlikeArtikliSlike;


        $cenaPrikaz = ($tipUsera >= 3) ? $common->formatCenaExt($pravaVp, $sesValuta) : $common->formatCenaExt($pravaMp, $sesValuta);


        $products[$i]['ArtikalId'] = $ArtikalId;
        $products[$i]['ArtikalNaziv'] = $ArtikalNaziv;
        $products[$i]['NaAkciji'] = $ArtikalNaAkciji;
        $products[$i]['velika_slika'] = $velika_slika;
        $products[$i]['srednja_slika'] = $srednja_slika;
        $products[$i]['urlArtiklaLink'] = $urlArtiklaLink;
        $products[$i]['cenaPrikaz'] = $cenaPrikaz;
        $products[$i]['ImeSlikeArtikliSlike'] = $ImeSlikeArtikliSlike;
        $products[$i]['opisDetaljnije'] = $jsonlang[76][$jezikId];
        $products[$i]['wishlist'] = $jsonlang[84][$jezikId];
        $products[$i]['compare'] = $jsonlang[74][$jezikId];

        $i++;

    endforeach;

    $delay = 0;
    foreach ($products as $product):
        ?>

        <div class="col-sm-4 col-md-3 wow fadeInUp" data-wow-delay="<?php echo (float)($delay / 10); ?>s">
            <div class="products grid-v2">
                <?php

                echo $common->displayProduct(
                    $product['ArtikalId'],
                    $product['ArtikalNaziv'],
                    $product['NaAkciji'],
                    $product['velika_slika'],
                    $product['srednja_slika'],
                    $product['urlArtiklaLink'],
                    $product['cenaPrikaz'],
                    $product['ImeSlikeArtikliSlike'],
                    $product['opisDetaljnije'],
                    $product['wishlist'],
                    $product['compare'],
                    $product['pozovite'],
                    $product['pravaMp']
                )
                ?>
            </div>
            <!-- /.products -->
        </div><!-- /.item -->
        <?php $delay++; ?>
    <?php endforeach;

}
?>
<!-- ========================================== CATEGORY-V3-GRID : END========================================= -->
	