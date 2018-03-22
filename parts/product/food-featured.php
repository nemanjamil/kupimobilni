<!-- ============================================== FOOD FEATURED ============================================== -->
<?php
$products = array(
    /*array(
        'product_name' => 'Product name #01',
        'is_new' => true,
        'is_sale' => false,
        'is_hot' => false,
        'productImageURL' => 'assets/images/products/30.jpg'


    ),
    array(
        'product_name' => 'Product name #01',
        'is_new' => false,
        'is_sale' => false,
        'is_hot' => true,
        'productImageURL' => 'assets/images/products/30.jpg'


    )*/

);


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
    CAST(
          (SELECT  IF($KomiRabatKupi> 0, MA.MarzaVP-((MA.MarzaVP-1)/100*10), MA.MarzaVP)) AS DECIMAL(5,3)
    ) AS MarzaVP,
    CAST(
        (SELECT  IF($KomiRabatKupi> 0, MA.MarzaMarza-((MA.MarzaMarza-1)/100*10), MA.MarzaMarza)) AS DECIMAL(5,3)
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
AND   (SELECT   vidljivMp (A.KategorijaArtikalId)) = 1
AND A.ArtikalNaAkciji = 1
AND (IdZemljePdvKatZem=K.KomitentiZemlja)
ORDER BY RAND()
LIMIT 8 ) AS T1)
  AS T2;";
/* nemanjamil
 * 	Promenjeno zato sto treba da izadju artikli na akciji, a ne proizvodi sa najvise pregleda
 *  ORDER BY A.ArtikalBrPregleda DESC
 *	LIMIT 8*/

$keyArtAr = $db->rawQuery($footArtiPoc);
$i = 0;
foreach ($keyArtAr as $k => $keyArt):

    $ArtikalId = $keyArt['ArtikalId'];
    $KategorijaArtikalaIdOS = $keyArt['KategorijaArtikalId'];
    $ArtikalNaAkciji = $keyArt['ArtikalNaAkciji'];
    $ArtikalNaziv = $keyArt['OpisArtikla'];
    $ArtikalMPCena = $keyArt['ArtikalMPCena'];
    $ArtikalVPCena = $keyArt['ArtikalVPCena'];
    $KategorijaArtikalaNaziv = $keyArt['NazivKategorije'];
    $KategorijaArtikalaLink = $keyArt['KategorijaArtikalaLink'];
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

    $products[$i]['ArtikalId'] = $ArtikalId;
    $products[$i]['ArtikalNaziv'] = $ArtikalNaziv;
    $products[$i]['NaAkciji'] = $ArtikalNaAkciji;
    $products[$i]['velika_slika'] = $velika_slika;
    $products[$i]['srednja_slika'] = $srednja_slika;
    $products[$i]['urlArtiklaLink'] = $urlArtiklaLink;
    $products[$i]['cenaPrikaz'] = $cenaPrikaz;
    $products[$i]['opisDetaljnije'] = $jsonlang[76][$jezikId];
    $products[$i]['ImeSlikeArtikliSlike'] = $ImeSlikeArtikliSlike;
    $products[$i]['wishlist'] = $jsonlang[84][$jezikId];
    $products[$i]['compare'] = $jsonlang[74][$jezikId];
    $products[$i]['pozovite'] = $jsonlang[117][$jezikId];
    $products[$i]['pravaMp'] = $pravaMp;

    $i++;

endforeach;

?>

<div class="title">
    <h3><?php echo $jsonlang[228][$jezikId]; ?></h3>
    <hr>
</div>

<div class="featured-product">
    <?php $delay = 0; ?>
    <?php foreach ($products as $product): ?>
        <div class="item category-product">
            <div class="products grid-v2 wow fadeInUp" data-wow-delay="<?php echo (float)($delay / 10); ?>s">
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
    <?php endforeach; ?>
</div><!-- /.fashion-featured -->
<!-- ============================================== FOOD FEATURED : END ============================================== -->