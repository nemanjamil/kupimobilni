<!-- ========================================== CATEGORY-V1-GRID ========================================= -->
<?php
$delay = 0;
$products = '';

/*$spC = '';


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
    $iSpec = '';
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
        $spC .= 'ORDER BY A.ArtikalNaziv ASC';
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
// * (V.PdvZemljValuta/100 + 1)*/
/*
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
  AKO.OpisArtikliTekstovi$jezik,
  A.ArtikalNaziv,
  A.ArtikalMPCena,
  A.ArtikalVPCena,
  A.ArtikalLink,
  A.ArtikalStanje,
  A.ArtikalNaAkciji,
  AN.ArtNaz$jezik,
  KA.Kat$jezik,
  KA.KategorijaArtikalaLink,
  BR.BrendIme,
  K.KomitentiValuta,
  V.ValutaValuta,
  MA.MarzaMarza,

  K.KomitentUPdv,
  PLP.PorezVrednost,
  MarzaVP,
(SELECT IF(K.KomitentRabat>0,K.KomitentRabat,0)/100*A.ArtikalVPCena) AS vpjac,
(SELECT IF(K.KomitentRabat>0,K.KomitentRabat,0)/100*A.ArtikalMPCena) AS mpjac,
  (SELECT ImeSlikeArtikliSlike FROM  artiklislike WHERE IdArtikliSlikePov = ArtikalId AND MainArtikliSlike = '1' LIMIT 1 )   AS ImeSlikeArtikliSlike

  FROM
  artikli A
  JOIN ArtikalNaziv AN
	ON AN.IdArtikalNaziv = A.ArtikalId
  JOIN kategorijeartikala KA
    ON KA.KategorijaArtikalaId = A.KategorijaArtikalId
 JOIN pdvkategzemlja PKZ
      ON PKZ.IdKategPdvKatZem = KA.KategorijaArtikalaId
   JOIN pdvlistaporeza PLP
      ON PLP.IdPdvListaPoreza = PKZ.PdvKategZemlja
       JOIN ArtikliTekstovi AKO
      ON AKO.IdArtikliTekstovi = A.ArtikalId
  JOIN brendovi BR
    ON BR.BrendId = A.ArtikalBrendId
  JOIN komitenti K
    ON K.KomitentId = A.ArtikalKomitent
  JOIN valuta V
    ON V.ValutaId = K.KomitentiValuta
  JOIN marza MA
    ON MA.MarzaId = A.ArtikalMarzaId

WHERE A.KategorijaArtikalId = '$KategorijaArtikalaIdOS'
  AND A.ArtikalAktivan >= 1
  AND (IdZemljePdvKatZem=K.KomitentiZemlja)
  AND (SELECT   vidljivMp (A.KategorijaArtikalId)) = 1
  ".$spC." ) AS T1
";*/
$upitArtKat = $db->rawQuery($upitArtArray1);

if ($upitArtKat) {
    foreach ($upitArtKat as $product => $keyArt):

        $ArtikalId = $keyArt['ArtikalId'];
        $KategorijaArtikalId = $keyArt['KategorijaArtikalId'];
        $ArtikalNaziv = $keyArt['OpisArtikla'];
        $OpisKratakOpis = $keyArt['OpisKratakOpis'];
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
        $ArtikalStanje = $keyArt['ArtikalStanje'];
        $ocenaut = $keyArt['ocenaut'];
        $ImeSlikeArtikliSlike = $keyArt['ImeSlikeArtikliSlike'];

        $lokFolder = $common->locationslika($ArtikalId);
        $urlArtiklaLink = '/' . $ArtikalLink . '/' . $ArtikalId;

        $ext = pathinfo($ImeSlikeArtikliSlike, PATHINFO_EXTENSION);
        $fileName = pathinfo($ImeSlikeArtikliSlike, PATHINFO_FILENAME);

        $mala_slika = $lokFolder . '/' . $fileName . '_mala.' . $ext;
        $srednja_slika = $lokFolder . '/' . $fileName . '_srednja.' . $ext;
        $velika_slika = $lokFolder . '/' . $ImeSlikeArtikliSlike;

        $srednja_slika = $common->nemaSlike($srednja_slika);

        $nakasd = $common->stanjeOpisSveId($ArtikalStanje, $ArtikalMPCena, $sesValuta, $jsonlang[229][$jezikId], $jsonlang[117][$jezikId], $jsonlang[116][$jezikId], $pravaVp, $pravaMp, $tipUsera, $dani);

        $cenaSamoBrojFormat = $nakasd['cenaSamoBrojFormat'];
        $cenaPrikazExt = $nakasd['cenaPrikazExt'];

        ?>

        <div class="col-sm-6 col-md-6 col-xs-12 ">
            <div class="products grid-v1 clearfix mojasenka" itemscope itemtype="http://schema.org/Product">

                <div class="product clearfix">
                    <div class="hidden"><span itemprop="mpn"><?php echo $ArtikalId; ?></span></div>
                    <div class="product-image col-md-5 col-xs-5 visinaSlikeKat paddingdesno5">
                        <div>
                            <a href="<?php echo $urlArtiklaLink; ?>"> <!--data-lightbox="image-1"-->
                                <div class="image">
                                    <img itemprop="image" src="<?php echo $srednja_slika; ?>" class="img-responsive"
                                         alt="<?php echo $ArtikalNaziv; ?>">
                                </div>

                                <?php if ($NaAkciji == 6): ?><div class="ribbon-wrapper-tag-kateg"><div class="ribbon-tag ribbon-tag-red">AKCIJA</div></div><?php endif; ?>
                                <?php if ($NaAkciji == 7): ?><div class="ribbon-wrapper-tag-kateg"><div class="ribbon-tag ribbon-tag-green">POPUST</div></div><?php endif; ?>
                                <?php if ($NaAkciji == 8): ?><div class="ribbon-wrapper-tag-kateg"><div class="ribbon-tag ribbon-tag-blue">HIT PONUDA</div></div><?php endif; ?>

<!--
                                <?php /*if ($NaAkciji == 6): */?><div class="tag"><div class="tag-text sale">sale</div></div><?php /*endif; */?>
                                <?php /*if ($NaAkciji == 7): */?><div class="tag"><div class="tag-text new">new</div></div><?php /*endif; */?>
                                <?php /*if ($NaAkciji == 8): */?><div class="tag"><div class="tag-text hot">hot</div></div>--><?php /*endif; */?>

                                <div class="hover-effect"><i class="fa fa-search"></i></div>
                            </a>
                        </div>

                    </div>

                    <div class="product-info col-md-7 no-padding col-xs-7 visina2uredu">
                        <h3 class="name nemaMargineTop"><a href="<?php echo $urlArtiklaLink; ?>"><span
                                    itemprop="name"><?php echo $ArtikalNaziv; ?></span></a></h3>

                        <?php

                        $dp = '';

                        $dp .= '';
                        // if ($ArtikalKratakOpis):
                        $dp .= '<div class="product-short-desc">';
                        if ($OpisKratakOpis) {
                            $dp .= '<div class="small" itemprop="description">' . $common->limit_text_obican($OpisKratakOpis, 100) . '</div>';
                        } else {
                            $dp .= '';
                        }
                        $dp .= '<div class="small"> <span itemprop="brand">' . $jsonlang[348][$jezikId] . ' : ' . '<b>' . $BrendIme . '</b></span></div>';

                        $hovBack = ($ArtikalStanje) ? 'bg-success' : 'bg-danger';
                        $hovBackIme = ($ArtikalStanje) ? 'Ima' : 'Nema';

                        $dp .= '<div class="small">' . $jsonlang[106][$jezikId] . '  : <span class="status  ">' . $hovBackIme . '</span></div>'; // ' . $hovBack . '
                        $dp .= '<div class="small">Ocena : <span class="status">';

                        $dp .= '<div class="cart animate-effect" data-ime="'.$ArtikalId.'">
                            <span itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
                                <span itemprop="ratingValue" hidden>'.$ocenaut.'</span>';


                                for ($i = 1; $i <= 5; $i++) {
                                    $cekstar = ($i == $ocenaut) ? 'checked' : '';
                                    $dp .= '<input class="starri required" ' . $cekstar . ' type="radio" name="test-3A-rating-' . $ArtikalId . '" value="' . $i . '"/>';
                                }


                                $dp .= '<span itemprop="reviewCount" hidden>'.$ocenaut.'</span>
                            </span>
                        </div>';

                        $dp .= '</span></div>';
                        $dp .= '</div>';

                        echo $dp;


                        ?>

                        <!--<div class="cart animate-effect pull-left" data-ime="<?php /*echo $ArtikalId; */?>">
                            <span itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
                                <span itemprop="ratingValue" hidden><?php /*echo $ocenaut; */?></span>
                                <?php
/*                                $starArr = '';
                                for ($i = 1; $i <= 5; $i++) {
                                    $cekstar = ($i == $ocenaut) ? 'checked' : '';
                                    $starArr .= '<input class="starri required" ' . $cekstar . ' type="radio" name="test-3A-rating-' . $ArtikalId . '" value="' . $i . '"/>';
                                }
                                echo $starArr;
                                */?>
                                <span itemprop="reviewCount" hidden><?php /*echo $ocenaut; */?></span>
                            </span>
                        </div>-->

                        <div class="product-price">
                            <?php require('specArtKategorija.php') ?>
                        </div>


                        <div class="product-price"><span itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                            <?php if ($pravaMp > '0') { ?>


                                <ins>
                                    <span class="amount font17 boldirano bojaplavasajt" itemprop="price"><?php echo $cenaSamoBrojFormat; ?></span>
                                    <span itemprop="priceCurrency" class="boldirano bojaplavasajt"><?php echo $cenaPrikazExt; ?></span>
                                </ins>
                            <?php } else { ?>
                                <ins>
                                    <span class="amount "><?php echo $cenaPrikaz = $jsonlang[117][$jezikId] ?></span>
                                </ins>

                            <?php }

                            if ('2' == '1'):?>
                                <del><span class="amount">$ 011</span></del>
                            <?php endif; ?></span>
                        </div>



                        <!-- /.product-price -->

                        <!--<div class=" no-padding cart animate-effect col-sm-12 col-xs-12 hidden-xs">
                            <div class="action">
                                <ul class="list-unstyled">
                                    <li class="add-cart-button">
                                        <a class="btn btn-primary"
                                           href="<?php /*echo $urlArtiklaLink; */
                        ?>"><?php /*echo $jsonlang[76][$jezikId]; */
                        ?></a>
                                    </li>




                                    <li>
                                        <a class="btn btn-primary compare dodajkompare" href="#"
                                           data-id="<?php /*echo $ArtikalId; */
                        ?>" title="<?php /*echo $jsonlang[74][$jezikId]; */
                        ?>">
                                            <i class="fa fa-exchange"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </div>
-->
                    </div>

                </div>
            </div>
        </div>

        <?php


        $delay++;
    endforeach;

} else {
    echo '<div class="col-sm-8 col-md-8 wow fadeInUp"> ' . $jsonlang[75][$jezikId] . '</div>';

}
?>
<!-- ========================================== CATEGORY-V1-GRID : END ========================================= -->