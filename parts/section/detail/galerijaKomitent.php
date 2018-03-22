<!-- ========================================== UPSELL PRODUCTS ========================================= -->
<?php

$cols = Array("IdKomitentiSlike", "ImeSlikeKomitentiSlike", "MainKomitentiSlike");
$db->where("IdKomitentiSlikePov", $KomitentIdUser);
$galerijaKomitent = $db->get('komitentislike', null, $cols);


if ($galerijaKomitent) {
    ?>
    <h3 class="section-title">Galerija Komitent - <?php echo $usersKomitent['KomitentIme'].' '.$usersKomitent['KomitentPrezime']; ?></h3>
    <div class="featured-product">
        <?php
        $delay = 0;
        foreach ($galerijaKomitent as $key => $val):

            $slikaV = $val['ImeSlikeKomitentiSlike'];
            $IdKomitentiSlike = $val['IdKomitentiSlike'];
            $MainKomitentiSlike = $val['MainKomitentiSlike'];
            $artAktMainSl = ($MainKomitentiSlike) ? 'checked' : '';


            $lokDoslike = $common->locationslikaOstaloGalKomitent(KOMSLIKE, $KomitentIdUser);
            $ext = pathinfo($slikaV, PATHINFO_EXTENSION);
            $fileName = pathinfo($slikaV, PATHINFO_FILENAME);
            $mala_slika = $lokDoslike.'/'.$fileName . '_mala.' . $ext;
            $srednja_slika = $lokDoslike.'/'.$fileName . '_srednja.' . $ext;
            $velika_slika = $lokDoslike.'/'.$fileName .'.'. $ext;



            ?>
            <div class="item category-product">
                <div class="products grid-v1" "><!--wow fadeInUp data-wow-delay="<?php //echo (float)($delay / 10); ?>-->

                    <div class="product">
                        <div class="product-image">

                            <a href="<?php echo $velika_slika; ?>" data-lightbox="image-povArtx">
                                <div class="image">

                                    <img src="assets/images/blank.gif" data-echo="<?php echo $srednja_slika; ?>"
                                         class="img-responsive" alt="<?php echo $slikaV; ?>">
                                </div>

                                <div class="hover-effect"><i class="fa fa-search"></i></div>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
            <?php
            $delay++;
        endforeach;
         ?>

    </div>
<?php } ?>
