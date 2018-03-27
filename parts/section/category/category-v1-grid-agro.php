<!-- ========================================== CATEGORY-V1-GRID ========================================= -->
<?php
$delay = 0;
$products = '';

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
// * (V.PdvZemljValuta/100 + 1)

$upitArtArray = "
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


WHERE A.KategorijaArtikalId = '$KategorijaArtikalaIdOS'
  AND A.ArtikalAktivan >= 1
  AND (IdZemljePdvKatZem=K.KomitentiZemlja)
  AND (SELECT   vidljivMp (A.KategorijaArtikalId)) = 1
  ".$spC." ) AS T1) AS T2
";

$upitArtKat = $db->rawQuery($upitArtArray);
if ($upitArtKat) {
    foreach ($upitArtKat as $product => $keyArt):

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
        $OpisArtikliTekstovi = $keyArt['OpisArtikliTekstovi' . $jezik];


        $ImeSlikeArtikliSlike = $keyArt['slikaMain'];

        $lokFolder = $common->locationslika($ArtikalId);

        $urlArtiklaLink = '/' . $ArtikalLink . '/' . $ArtikalId;

        $ext = pathinfo($ImeSlikeArtikliSlike, PATHINFO_EXTENSION);
        $fileName = pathinfo($ImeSlikeArtikliSlike, PATHINFO_FILENAME);

        $mala_slika = $lokFolder . '/' . $fileName . '_mala.' . $ext;
        $srednja_slika = $lokFolder . '/' . $fileName . '_srednja.' . $ext;
        $velika_slika = $lokFolder . '/' . $ImeSlikeArtikliSlike;

        $srednja_slika = $common->nemaSlike($srednja_slika);


        // $cenaPrikaz = ($tipUsera >= 3) ? $common->formatCenaExt($pravaVp, $sesValuta) : $common->formatCenaExt($pravaMp, $sesValuta);
        if ($ArtikalStanje > 0) {
            $mozedase = '';
            $cenaPrikaz = ($tipUsera >= 3) ? $common->formatCenaExt($pravaVp, $sesValuta) : $common->formatCenaExt($pravaMp, $sesValuta);
        } else {
            $mozedase = 'disabled="disabled"';
        }

        ?>

        <div class="col-sm-4 col-md-3 col-xs-12 inner-bottom-xs"> <!-- sirinaArt wow fadeInUp data-wow-delay="-->
            <?php /*echo (float)($delay / 10); */
            ?><!--s"-->
            <div class="products grid-v1">

                <div class="product">
                    <div class="product-image col-sm-12 col-xs-5 visinaSlikeKat">
                        <a href="<?php echo $urlArtiklaLink; ?>"> <!--data-lightbox="image-1"-->
                            <div class="image">
                                <img src="<?php echo $srednja_slika; ?>" class="img-responsive"
                                     alt="<?php echo $ArtikalNaziv; ?>">
                            </div>

                            <?php if ($NaAkciji == 6): ?><div class="tag"><div class="tag-text sale">sale</div></div><?php endif; ?>
                            <?php if ($NaAkciji == 7): ?><div class="tag"><div class="tag-text new">new</div></div><?php endif; ?>
                            <?php if ($NaAkciji == 8): ?><div class="tag"><div class="tag-text hot">hot</div></div><?php endif; ?>

                            <div class="hover-effect"><i class="fa fa-search"></i></div>
                        </a>
                    </div>
                    <!-- /.product-image -->


                    <div class="product-info col-sm-12 col-xs-7">
                        <h3 class="name"><a href="<?php echo $urlArtiklaLink; ?>"><?php echo $ArtikalNaziv; ?></a></h3>

                        <!--<div class="star-rating" title="Rated 4.50 out of 5">
                            <span style="width:90%"><strong class="rating">1</strong> out of 5</span>
                        </div>-->

                        <div class="product-price">
                            <?php if ($pravaMp > '0') { ?>

                                <ins>
                                    <span class="amount"><?php echo $cenaPrikaz; ?></span>
                                </ins>
                            <?php } else { ?>
                                <ins>
                                    <span class="amount"><?php echo $cenaPrikaz = $jsonlang[117][$jezikId] ?></span>
                                </ins>

                            <?php }

                            if ('2' == '1'):?>
                                <del><span class="amount">$ 011</span></del>
                            <?php endif; ?>
                        </div>
                        <!-- /.product-price -->

                    </div>
                    <!-- /.book-details -->


                    <div class="cart animate-effect col-sm-12 col-xs-12 hidden-xs">
                        <div class="action">
                            <ul class="list-unstyled">
                                <li class="add-cart-button">
                                    <a class="btn btn-primary"
                                       href="<?php echo $urlArtiklaLink; ?>"><?php echo $jsonlang[76][$jezikId]; ?></a>
                                </li>

                                <!--<li>
								<a class="btn btn-primary whislist" href="#" title="<?php /*echo $jsonlang[84][$jezikId]; */
                                ?>">
									<i class="icon fa fa-heart"></i>
								</a>
							</li>-->


                                <li>
                                    <a class="btn btn-primary compare dodajkompare" href="#"
                                       data-id="<?php echo $ArtikalId; ?>" title="<?php echo $jsonlang[74][$jezikId]; ?>">
                                        <i class="fa fa-exchange"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.action -->
                    </div>
                    <!-- /.cart -->
                </div>

            </div>
            <!-- /.products -->
        </div><!-- /.item -->
        <?php $delay++; ?>
    <?php endforeach;
} else {
    echo '<div class="col-sm-8 col-md-8 wow fadeInUp"> ' . $jsonlang[75][$jezikId] . '</div>';

}
?>
<!-- ========================================== CATEGORY-V1-GRID : END ========================================= -->