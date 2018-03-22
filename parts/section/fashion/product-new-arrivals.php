<?php
$katpotrosni = KATPOTROSNIMATERIJAL;
$podaIn = $db->rawQueryOne("SELECT svePodkat($katpotrosni) as svePodk");
$podIn = rtrim($podaIn['svePodk'], ",");

$podInUpitu = ($podIn) ? 'AND KA.KategorijaArtikalaId IN (' . $podIn . ')' : '';


$products = array();

$footArtiPoc = "
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
ANN.OpisArtikla,
AKO.OpisKratakOpis,
UN.TipUnit,
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
JOIN komitenti K
  ON K.KomitentId = A.ArtikalKomitent
JOIN valuta V
  ON V.ValutaId = K.KomitentiValuta
JOIN marza MA
  ON MA.MarzaId = A.ArtikalMarzaId

JOIN unit UN
ON UN.IdUnit = KA.TipKatUnit

WHERE
A.ArtikalAktivan >= 1
AND   (SELECT   vidljivMp (A.KategorijaArtikalId)) = 1
$podInUpitu
AND (IdZemljePdvKatZem=K.KomitentiZemlja)
ORDER BY A.top1 ASC
LIMIT 18 ) AS T1";

$keyArtAr = $db->rawQuery($footArtiPoc);

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
    $KategorijaArtikalaNaziv = $keyArt['Kat' . $jezik];
    $KategorijaArtikalaLink = $keyArt['KategorijaArtikalaLink'];
    $BrendIme = $keyArt['BrendIme'];
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
    $products[$item][$i]['ArtikalNaziv'] = $ArtikalNaziv;
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

    if ($broj == 5) {
        $item++;
        $broj = 0;
    } else {
        $broj++;
    }
    $i++;

endforeach;

?>

<!-- ============================================== PRODUCT NEW ARRIVALS ============================================== -->
<div class="product-item-small">
    <h3 class="section-title"><?php echo $jsonlang[378][$jezikId]; ?></h3>

    <div class="product-item-small-owl">

        <?php

        $listaSmall = '';

        foreach ($products as $produc):

            echo '<div class="item">';

            foreach ($produc as $product):


                echo $common->displayProductSuper(
                    $product['ArtikalId'],
                    $product['ArtikalNaziv'],
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


            echo '</div>';


        endforeach; ?>

        <!-- item -->
        <!--<div class="item">
             <div class="row products-small">
                 <div class="col-md-4 col-xs-4 product-image">
                     <a href="#"><img src="assets/images/products/98.jpg" class="img-responsive" alt=""></a>
                 </div>
                 <div class="col-md-8 col-xs-8 product-info">
                     <h5><a href="#">Product name #01</a></h5>

                     <div class="star-rating" title="Rated 4.50 out of 5">
                         <span style="width:90%"><strong class="rating">4.50</strong> out of 5</span>
                     </div>

                     <div class="product-price">
                         <ins><span class="amount">$369,99</span></ins>
                         <del><span class="amount">$400,99</span></del>
                     </div>

                 </div>
                 <div class="row products-small">
                 <div class="col-md-4 col-xs-4 product-image">
                     <a href="#"><img src="assets/images/products/98.jpg" class="img-responsive" alt=""></a>
                 </div>
                 <div class="col-md-8 col-xs-8 product-info">
                     <h5><a href="#">Product name #01</a></h5>

                     <div class="star-rating" title="Rated 4.50 out of 5">
                         <span style="width:90%"><strong class="rating">4.50</strong> out of 5</span>
                     </div>

                     <div class="product-price">
                         <ins><span class="amount">$369,99</span></ins>
                         <del><span class="amount">$400,99</span></del>
                     </div>

                 </div>
                 <div class="row products-small">
                 <div class="col-md-4 col-xs-4 product-image">
                     <a href="#"><img src="assets/images/products/98.jpg" class="img-responsive" alt=""></a>
                 </div>
                 <div class="col-md-8 col-xs-8 product-info">
                     <h5><a href="#">Product name #01</a></h5>

                     <div class="star-rating" title="Rated 4.50 out of 5">
                         <span style="width:90%"><strong class="rating">4.50</strong> out of 5</span>
                     </div>

                     <div class="product-price">
                         <ins><span class="amount">$369,99</span></ins>
                         <del><span class="amount">$400,99</span></del>
                     </div>

                 </div>
             </div>
             -->
        <!-- /item -->

        <!-- item -->
        <!--<div class="item">
             <div class="row products-small">
                 <div class="col-md-4 col-xs-4 product-image">
                     <a href="#"><img src="assets/images/products/98.jpg" class="img-responsive" alt=""></a>
                 </div>
                 <div class="col-md-8 col-xs-8 product-info">
                     <h5><a href="#">Product name #01</a></h5>

                     <div class="star-rating" title="Rated 4.50 out of 5">
                         <span style="width:90%"><strong class="rating">4.50</strong> out of 5</span>
                     </div>

                     <div class="product-price">
                         <ins><span class="amount">$369,99</span></ins>
                         <del><span class="amount">$400,99</span></del>
                     </div>

                 </div>
                 <div class="row products-small">
                 <div class="col-md-4 col-xs-4 product-image">
                     <a href="#"><img src="assets/images/products/98.jpg" class="img-responsive" alt=""></a>
                 </div>
                 <div class="col-md-8 col-xs-8 product-info">
                     <h5><a href="#">Product name #01</a></h5>

                     <div class="star-rating" title="Rated 4.50 out of 5">
                         <span style="width:90%"><strong class="rating">4.50</strong> out of 5</span>
                     </div>

                     <div class="product-price">
                         <ins><span class="amount">$369,99</span></ins>
                         <del><span class="amount">$400,99</span></del>
                     </div>

                 </div>
                 <div class="row products-small">
                 <div class="col-md-4 col-xs-4 product-image">
                     <a href="#"><img src="assets/images/products/98.jpg" class="img-responsive" alt=""></a>
                 </div>
                 <div class="col-md-8 col-xs-8 product-info">
                     <h5><a href="#">Product name #01</a></h5>

                     <div class="star-rating" title="Rated 4.50 out of 5">
                         <span style="width:90%"><strong class="rating">4.50</strong> out of 5</span>
                     </div>

                     <div class="product-price">
                         <ins><span class="amount">$369,99</span></ins>
                         <del><span class="amount">$400,99</span></del>
                     </div>

                 </div>
             </div>
             -->
        <!-- /item -->

        <!-- item -->
        <!--<div class="item">
             <div class="row products-small">
                 <div class="col-md-4 col-xs-4 product-image">
                     <a href="#"><img src="assets/images/products/98.jpg" class="img-responsive" alt=""></a>
                 </div>
                 <div class="col-md-8 col-xs-8 product-info">
                     <h5><a href="#">Product name #01</a></h5>

                     <div class="star-rating" title="Rated 4.50 out of 5">
                         <span style="width:90%"><strong class="rating">4.50</strong> out of 5</span>
                     </div>

                     <div class="product-price">
                         <ins><span class="amount">$369,99</span></ins>
                         <del><span class="amount">$400,99</span></del>
                     </div>

                 </div>
                 <div class="row products-small">
                 <div class="col-md-4 col-xs-4 product-image">
                     <a href="#"><img src="assets/images/products/98.jpg" class="img-responsive" alt=""></a>
                 </div>
                 <div class="col-md-8 col-xs-8 product-info">
                     <h5><a href="#">Product name #01</a></h5>

                     <div class="star-rating" title="Rated 4.50 out of 5">
                         <span style="width:90%"><strong class="rating">4.50</strong> out of 5</span>
                     </div>

                     <div class="product-price">
                         <ins><span class="amount">$369,99</span></ins>
                         <del><span class="amount">$400,99</span></del>
                     </div>

                 </div>
                 <div class="row products-small">
                 <div class="col-md-4 col-xs-4 product-image">
                     <a href="#"><img src="assets/images/products/98.jpg" class="img-responsive" alt=""></a>
                 </div>
                 <div class="col-md-8 col-xs-8 product-info">
                     <h5><a href="#">Product name #01</a></h5>

                     <div class="star-rating" title="Rated 4.50 out of 5">
                         <span style="width:90%"><strong class="rating">4.50</strong> out of 5</span>
                     </div>

                     <div class="product-price">
                         <ins><span class="amount">$369,99</span></ins>
                         <del><span class="amount">$400,99</span></del>
                     </div>

                 </div>
             </div>
             -->
        <!-- /item -->

    </div>
</div>
<!-- ============================================== NOVI PROIZVOD : END ============================================== -->