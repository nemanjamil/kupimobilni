<!-- ========================================== UPSELL PRODUCTS ========================================= -->
<?php
//var_dump($tagArt);
foreach ($tagArt as $sd) {
    $re[] = $sd['TagoviId'];
}
if ($re){
$arraCsv = $common->array_2_csv_sa_dodatkomnavodnika($re);
}
/*$db->setTrace(true);
$cols = Array("IdTagoviArtikli");
$db->where('IdOdTagovaArt', $re, 'IN');
$db->groupBy("IdTagoviArtikli");
$sdTag = $db->get("tagoviartikli", null, $cols);
var_dump($db->trace);*/
// * (V.PdvZemljValuta/100 + 1)
// * (V.PdvZemljValuta/100 + 1)
$pova = "SELECT
A.ArtikalId,
A.KategorijaArtikalId,
AN.*,
A.ArtikalMPCena,
A.ArtikalVPCena,
A.ArtikalLink,
A.ArtikalStanje,
K.KomitentiValuta,
MA.MarzaMarza,
MA.MarzaVP,
ROUND((A.ArtikalBrOcena/A.ArtikalBrKlikova),0) AS ocenaut,
( (SELECT GetKurs (KomitentiValuta, $sesValuta))  ) * A.ArtikalMPCena * MA.MarzaMarza  AS pravaMp,
( (SELECT GetKurs (KomitentiValuta, $sesValuta))  ) * A.ArtikalVPCena *  MA.MarzaVP  AS pravaVp,
(SELECT ImeSlikeArtikliSlike FROM  artiklislike WHERE IdArtikliSlikePov = ArtikalId AND MainArtikliSlike = 1 LIMIT 1 )   AS slikaMain
 FROM tagoviartikli TA

JOIN artikli A
	ON A.ArtikalId = TA.IdTagoviArtikli
JOIN ArtikalNaziv AN
	ON AN.IdArtikalNaziv = A.ArtikalId
JOIN komitenti K
	ON K.KomitentId = A.ArtikalKomitent
JOIN valuta V
	ON V.ValutaId = K.KomitentiValuta
JOIN marza MA
	ON MA.MarzaId = A.ArtikalMarzaId

WHERE

   TA.IdOdTagovaArt IN ($arraCsv)
AND A.ArtikalAktivan >= 1
AND   (SELECT   vidljivMp (A.KategorijaArtikalId)) = 1
  GROUP BY TA.IdTagoviArtikli
  ORDER BY RAND () DESC
  LIMIT 10";


$keyArtAr = $db->rawQuery($pova);


if ($keyArtAr) {
    ?>
    <h3 class="section-title"><?php echo $jsonlang[118][$jezikId]; ?></h3>
    <div class="featured-product">
        <?php
        $delay = 0;
        foreach ($keyArtAr as $k => $keyArt):

            $ArtikalId = $keyArt['ArtikalId'];
            $KategorijaArtikalaIdOS = $keyArt['KategorijaArtikalId'];
            $ArtikalNaziv = $keyArt['ArtNaz' . $jezikId];
            $ArtikalMPCena = $keyArt['ArtikalMPCena'];
            $ArtikalVPCena = $keyArt['ArtikalVPCena'];
            $KategorijaArtikalaNaziv = $keyArt['KategorijaArtikalaNaziv'];
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
            $ocenaut = $keyArt['ocenaut'];



            $urlArtiklaLink = '/' . $ArtikalLink . '/' . $ArtikalId;

            if ($ArtikalStanje > 0) {
                $mozedase = '';
                $cenaPrikaz = ($tipUsera >= 3) ? $common->formatCenaExt($pravaVp, $sesValuta) : $common->formatCenaExt($pravaMp, $sesValuta);
            } else {
                $mozedase = 'disabled="disabled"';
                $cenaPrikaz = $jsonlang[117][$jezikId];
            }


            $ImeSlikeArtikliSlike = $keyArt['slikaMain'];

            $lokFolder = $common->locationslika($ArtikalId);

            $urlArtiklaLink = '/' . $ArtikalLink . '/' . $ArtikalId;

            $ext = pathinfo($ImeSlikeArtikliSlike, PATHINFO_EXTENSION);
            $fileName = pathinfo($ImeSlikeArtikliSlike, PATHINFO_FILENAME);

            $mala_slika = $lokFolder . '/' . $fileName . '_mala.' . $ext;
            $srednja_slika = $lokFolder . '/' . $fileName . '_srednja.' . $ext;
            $velika_slika = $lokFolder . '/' . $ImeSlikeArtikliSlike;


            ?>
            <div class="item category-product">
                <div class="products grid-v1"> <!--wow fadeInUp" data-wow-delay="--><?php /*echo (float)($delay / 10); */?>

                    <div class="product">
                        <div class="product-image">
                            <a href="<?php echo $urlArtiklaLink; ?>">
                               <!-- <a href="<?php /*echo $velika_slika; */?>" data-lightbox="image-povArt">-->
                                <div class="image">
                                    <img src="<?php echo $srednja_slika; ?>"  class="img-responsive" alt="<?php echo $ArtikalNaziv; ?>">
                                    <!--<img src="assets/images/blank.gif" data-echo="<?php /*echo $srednja_slika; */?>"  class="img-responsive" alt="">-->
                                </div>
                                <!-- /.image -->

                                <?php if ($is_new): ?>
                                    <div class="tag">
                                    <div class="tag-text new"><?php echo $jsonlang[87][$jezikId]; ?></div>
                                    </div><?php endif; ?>
                                <?php if ($is_sale): ?>
                                    <div class="tag">
                                    <div class="tag-text sale"><?php echo $jsonlang[109][$jezikId]; ?></div>
                                    </div><?php endif; ?>
                                <?php if ($is_hot): ?>
                                    <div class="tag">
                                    <div class="tag-text hot"><?php echo $jsonlang[115][$jezikId]; ?></div>
                                    </div><?php endif; ?>
                                <div class="hover-effect"><i class="fa fa-search"></i></div>
                            </a>
                        </div>
                        <!-- /.product-image -->


                        <div class="product-info">
                            <h3 class="name"><a href="<?php echo $urlArtiklaLink; ?>"><?php echo $ArtikalNaziv; ?></a>
                            </h3>

                            <!--<div class="star-rating" title="Rated 4.50 out of 5">
                                <span style="width:90%"><strong class="rating">4.50</strong> out of 5</span>
                            </div>-->
                            <div class="clearfix">
                                <?php
                                for($irp=1;$irp<=5;$irp++) {
                                $cekstar = ($irp==$ocenaut)? 'checked':'';
                                echo '<input class="starri required" '.$cekstar.' type="radio" name="zvezdicaUpsel-'.$ArtikalId.'" value="'.$irp.'"/>';
                                }
                                $irp=1;
                                ?>
                            </div>


                            <div class="product-price">
                                <ins>
                                    <span class="amount"><?php echo $cenaPrikaz; ?></span>
                                </ins>
                                <?php if ($oldPrice): ?>
                                    <del><span class="amount">$ <?php echo $oldPrice; ?></span></del>
                                <?php endif; ?>
                            </div>
                            <!-- /.product-price -->

                        </div>
                        <!-- /.book-details -->


                        <div class="cart animate-effect">
                            <div class="action">
                                <ul class="list-unstyled">
                                    <li class="add-cart-button">
                                        <a class="btn btn-primary"
                                           href="<?php echo $urlArtiklaLink; ?>"><?php echo $jsonlang[76][$jezikId]; ?></a>
                                    </li>

                                    <li>
                                        <a class="btn btn-primary whislist" href="#"
                                           title="<?php echo $jsonlang[15][$jezikId]; ?>">
                                            <i class="icon fa fa-heart"></i>
                                        </a>
                                    </li>

                                    <li>
                                        <a class="btn btn-primary compare" href="#"
                                           title="<?php echo $jsonlang[74][$jezikId]; ?>">
                                            <i class="fa fa-exchange"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.action -->
                        </div>
                        <!-- /.cart -->
                    </div>
                    <!-- /.product -->
                </div>
                <!-- /.products -->
            </div><!-- /.item -->
            <?php
        endforeach;
        $delay++; ?>
        <?php /*endforeach;*/ ?>
    </div><!-- /.fashion-featured -->
<?php } ?>
<!-- ========================================== UPSELL PRODUCTS : END ========================================= -->