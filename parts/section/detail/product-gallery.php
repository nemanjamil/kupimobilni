<!-- ========================================== PRODUCT GALLERY ========================================= -->
<div class="product-item-holder size-big single-product-gallery small-gallery">

<!--    <?php /*if ($NaAkciji == 6): */?><div class="tag"><div class="tag-text sale">sale</div></div><?php /*endif; */?>
    <?php /*if ($NaAkciji == 7): */?><div class="tag"><div class="tag-text new">new</div></div><?php /*endif; */?>
    <?php /*if ($NaAkciji == 8): */?><div class="tag"><div class="tag-text hot">hot</div></div>--><?php /*endif; */?>

    <?php if ($NaAkciji == 6): ?><div class="ribbon-wrapper-tag"><div class="ribbon-tag ribbon-tag-red">AKCIJA</div></div><?php endif; ?>
    <?php if ($NaAkciji == 7): ?><div class="ribbon-wrapper-tag"><div class="ribbon-tag ribbon-tag-green">POPUST</div></div><?php endif; ?>
    <?php if ($NaAkciji == 8): ?><div class="ribbon-wrapper-tag"><div class="ribbon-tag ribbon-tag-blue">HIT PONUDA</div></div><?php endif; ?>



    <?php
    //    IdArtikliSlike  IdArtikliSlikePov  ImeSlikeArtikliSlike  ActiveArtikliSlike  MainArtikliSlike
    $cols = Array("IdArtikliSlike", "ImeSlikeArtikliSlike");
    $db->where('IdArtikliSlikePov', $id);
    $db->orderBy("MainArtikliSlike", "DESC");
    $slikeArtikla = $db->get("artiklislike", null, $cols);
    $lokFolder = $common->locationslika($ArtikalId);

    $slSve = '';
    $sli = 1;
    if (!$slikeArtikla) {
        $velika_slika = $common->nemaSlike('');
    }
    ?>

    <div id="owl-single-product" class="mojasenka"> <!-- style="overflow-y: scroll;max-height: 200px" -->


        <?php
        if ($slikeArtikla) {
            foreach ($slikeArtikla as $sl => $vs):
                $ImeSlikeArtikliSlike = $vs['ImeSlikeArtikliSlike'];
                $IdArtikliSlike = $vs['IdArtikliSlike'];
                $ext = pathinfo($ImeSlikeArtikliSlike, PATHINFO_EXTENSION);
                $fileName = pathinfo($ImeSlikeArtikliSlike, PATHINFO_FILENAME);
                $mala_slika = $lokFolder . '/' . $fileName . '_mala.' . $ext;
                $srednja_slika = $lokFolder . '/' . $fileName . '_srednja.' . $ext;
                $maloVeca = $lokFolder . '/' . $fileName . '_maloVeca.' . $ext;

                // Ako ne koristimo dodavanje nove slike onda koristni ovo proveravanje slike
                $maloVeca = $common->nemaSlike($maloVeca);

                /*
                 * OVO SAM DODAO KAO TEST
                 * ZASTO STO NE POSTOJI SADA _maloVeca slika pa je odma pravim.
                 * kada se budu napravile slike onda cemo skinuti sve ove stavke
                 */
                // TAKODJE OVO CEMO VRATITI NAZAD DA ZAKOMENTARISEMO
                    /*if (!is_file(DCROOT.$maloVeca)) {
                        $vslika = DCROOT . $lokFolder . '/' . $fileName . '.' . $ext;
                        if (is_file($vslika)) {
                            $sliVecMalo = DCROOT . $maloVeca;
                            $kanvas = 350;
                            $common->snimiSlikuGD($vslika, $sliVecMalo, $kanvas);

                            $sliVecMaloMalo = DCROOT . $mala_slika;
                            $kanvas = 110;
                            $common->snimiSlikuGD($vslika, $sliVecMaloMalo, $kanvas);

                            $srednja_slikaCan = DCROOT . $srednja_slika;
                            $kanvas = 195;
                            $common->snimiSlikuGD($vslika, $srednja_slikaCan, $kanvas);

                        }
                   }*/
                /*
                 * Kraj TEST
                 */


                $velika_slika = $lokFolder . '/' . $ImeSlikeArtikliSlike;
                $velika_slika = $common->nemaSlike($velika_slika);




                $slSve .= '<div class="maxVisinaProduc single-product-gallery-item borderMoj3 paddinggalerija" id="slide' . $sli . '">';
                //$slSve .='<div class="ribbon-wrapper-green"><div class="ribbon-green">NEWS</div></div>';
                $slSve .= '<a data-lightbox="imagegroupart" data-title="Gallery" href="' . $velika_slika . '">';
                $slSve .= '<img class="img-responsive maxHeightSlika" itemprop="image" alt="" src="' . $maloVeca . '" data-echo="' . $maloVeca . '" />';
                $slSve .= '</a>';
                $slSve .= '</div>';
                $sli++;
            endforeach;

        } else {
            $slSve .= '<div class="maxVisinaProduc single-product-gallery-item" id="slide' . $sli . '">';



            $slSve .= '<a data-lightbox="imagegroupart" data-title="Gallery" href="' . $velika_slika . '">';
            $slSve .= '<img class="img-responsive" alt="" src="' . $velika_slika . '" data-echo="' . $velika_slika . '" />';
            $slSve .= '</a>';
            $slSve .= '</div>';

        }

        echo $slSve;
        $sli = '';
        ?>
    </div>
    <!-- /.single-product-slider -->

    <div class="single-product-gallery-thumbs gallery-thumbs clearfix">
        <div id="owl-single-product-thumbnails">
            <?php
            $slSve = '';
            $sli = 1;
            $doTri = 0;
            if ($slikeArtikla) {
                foreach ($slikeArtikla as $sl => $vs):
                    $ImeSlikeArtikliSlike = $vs['ImeSlikeArtikliSlike'];
                    $IdArtikliSlike = $vs['IdArtikliSlike'];
                    $ext = pathinfo($ImeSlikeArtikliSlike, PATHINFO_EXTENSION);
                    $fileName = pathinfo($ImeSlikeArtikliSlike, PATHINFO_FILENAME);
                    $mala_slika = $lokFolder . '/' . $fileName . '_mala.' . $ext;
                    $mala_slika = $common->nemaSlike($mala_slika);
                    $slSve .= '<div class="item visinaSirinaThumb">';
                    $slSve .= '<a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="' . $doTri . '" href="#slide' . $sli . '">';
                    $slSve .= '<img class="img-responsive maxWidthThumb" alt="" src="' . $mala_slika . '" data-echo="' . $mala_slika . '" />';
                    $slSve .= '</a>';
                    $slSve .= '</div>';
                    $sli++;

                    //if ($doTri==2){ $doTri=0; }else { $doTri++; }
                    $doTri++;
                endforeach;
                echo $slSve;
            }
            $sli = '';
            ?>
        </div>
        <!-- /#owl-single-product-thumbnails -->

    </div>
    <!-- /.gallery-thumbs -->
</div><!-- /.single-product-gallery -->
<!-- ========================================== PRODUCT GALLERY : END ========================================= -->













