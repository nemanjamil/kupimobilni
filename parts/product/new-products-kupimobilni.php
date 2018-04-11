<!-- ============================================== NEW PRODUCTS KUPIMOBILNI============================================== -->
<div class="featured-product">
    <?php
    $delay = 0;
    $limitUpit = 3;
    $brojAkcije = "";
    $upitArtArray = "CALL listaArtikalaRazno($limitUpit,$valutasession,$jezikId,$KomitentId,'2');";


    $keyArtArWeekly = $db->rawQuery($upitArtArray);
    foreach ($keyArtArWeekly as $k => $keyArtWeekly):

        $ArtikalIdSmall = $keyArtWeekly['ArtikalId'];
        $ArtikalNaAkcijiSmall = $keyArtWeekly['ArtikalNaAkciji'];
        $top1Small = $keyArtWeekly['top1'];
        $top2Small = $keyArtWeekly['top2'];
        $top3Small = $keyArtWeekly['top3'];
        $ArtikalNazivSmall = $keyArtWeekly['OpisArtikla'];
        $OpisKratakOpis = $keyArtWeekly['OpisKratakOpis'];
        $ArtikalMPCenaSmall = $keyArtWeekly['ArtikalMPCena'];
        $ArtikalVPCenaSmall = $keyArtWeekly['ArtikalVPCena'];
        $KategorijaArtikalaNazivSmall = $keyArtWeekly['NazivKategorije'];
        $KategorijaArtikalaLinkSmall = $keyArtWeekly['KategorijaArtikalaLink'];
        $BrendImeSmall = $keyArtWeekly['BrendIme'];
        $KomitentiValutaSmall = $keyArtWeekly['KomitentiValuta'];
        $ValutaValutaSmall = $keyArtWeekly['ValutaValuta'];
        $MarzaMarzaSmall = $keyArtWeekly['MarzaMarza'];
        $odnosKursArtSmall = $keyArtWeekly['odnosKursArt'];
        $pravaMpSmall = $keyArtWeekly['pravaMp'];
        $pravaVpSmall = $keyArtWeekly['pravaVp'];
        $ArtikalLinkSmall = $keyArtWeekly['ArtikalLink'];
        $ArtikalKratakOpisSmall = $keyArtWeekly['ArtikalKratakOpis'];
        $ArtikalStanjeSmall = $keyArtWeekly['ArtikalStanje'];
        $ImeSlikeArtikliSlikeSmall = $keyArtWeekly['ImeSlikeArtikliSlike'];
        $pozovite = $jsonlang[117][$jezikId];
        //$OpisArtikliTekstovi = $keyArtWeekly['OpisArtikliTekstovi' . $jezik];
        $ocena = $keyArtWeekly['ocenaut'];


        $urlArtiklaLinkSmall = '/' . $ArtikalLinkSmall . '/' . $ArtikalIdSmall;

        if ($ArtikalStanjeSmall > 0) {
            $mozedase = '';
            $nakasd = $common->stanjeOpisSveId($ArtikalStanjeSmall, $ArtikalMPCenaSmall, $sesValuta, $jsonlang[229][$jezikId], $jsonlang[117][$jezikId], $jsonlang[116][$jezikId], $pravaVpSmall, $pravaMpSmall, $tipUsera);
            require(DCROOT.'/stranice/cenaPrikazVarijable.php');

            $cenaPrikazSmall = $cenaSamoBrojFormat. ' '.$cenaPrikazExt;


        } else {
            $mozedase = 'disabled="disabled"';
            $cenaPrikazSmall = $jsonlang[117][$jezikId];
        }


        $ImeSlikeArtikliSlikeSmall = $keyArtWeekly['slikaMain'];

        $lokFolder = $common->locationslika($ArtikalIdSmall);

        $urlArtiklaLinkSmall = '/' . $ArtikalLinkSmall . '/' . $ArtikalIdSmall;

        $ext = pathinfo($ImeSlikeArtikliSlikeSmall, PATHINFO_EXTENSION);
        $fileName = pathinfo($ImeSlikeArtikliSlikeSmall, PATHINFO_FILENAME);

        $mala_slika = $lokFolder . '/' . $fileName . '_mala.' . $ext;
        $srednja_slika = $lokFolder . '/' . $fileName . '_srednja.' . $ext;
        $velika_slika = $lokFolder . '/' . $ImeSlikeArtikliSlike;

        $srednja_slika = $common->nemaSlike($srednja_slika);

        $products[$item][$i]['ArtikalId'] = $ArtikalIdSmall;
        $products[$item][$i]['ArtikalNaziv'] = $ArtikalNazivSmall;
        $products[$item][$i]['NaAkciji'] = $ArtikalNaAkcijiSmall;
        $products[$item][$i]['mala_slika'] = $mala_slika;
        $products[$item][$i]['srednja_slika'] = $srednja_slika;
        $products[$item][$i]['urlArtiklaLink'] = $urlArtiklaLinkSmall;
        $products[$item][$i]['cenaPrikaz'] = $cenaPrikazSmall;
        $products[$item][$i]['ImeSlikeArtikliSlike'] = $ImeSlikeArtikliSlikeSmall;
        $products[$item][$i]['pravaMpSmall'] = $pravaMpSmall;
        $products[$item][$i]['pozovite'] = $pozovite;
        $products[$item][$i]['OpisArtikliTekstovi'] = $OpisArtikliTekstovi;
        $products[$item][$i]['$ocena'] = $ocena;
        $products[$item][$i]['ArtikalStanjeSmall'] = $ArtikalStanjeSmall;
        $products[$item][$i]['BrendImeSmall'] = $BrendImeSmall;


        if ($broj == 2) {
            $item++;
            $broj = 0;
        } else {
            $broj++;
        }

        $i++;


//var_dump($products);



        ?>
        <div class="item category-product">
            <div class="products grid-v3 wow fadeInUp nopaddingnomargin" data-wow-delay="<?php echo (float)($delay/50);?>s">

                <div class="product">
                    <div class="product-image">
                        <a href="<?php echo $urlArtiklaLinkSmall; ?>"> <!--data-lightbox="image-1"-->
                            <div class="image">
                                <img src="<?php echo $srednja_slika; ?>" class="img-responsive" alt="<?php echo $ArtikalNazivSmall; ?>">
                            </div>
                            <?php if ($ArtikalNaAkcijiSmall == 6): ?><div class="tag"><div class="tag-text sale">sale</div></div><?php endif; ?>
                            <?php if ($ArtikalNaAkcijiSmall == 7): ?><div class="tag"><div class="tag-text new">new</div></div><?php endif; ?>
                            <?php if ($ArtikalNaAkcijiSmall == 8): ?><div class="tag"><div class="tag-text hot">hot</div></div><?php endif; ?>

                        </a>
                    </div>
                    <!-- /.product-image -->

                    <div class="product-info">
                        <h3 class="name"><a href="<?php echo $urlArtiklaLinkSmall; ?>"><?php echo $ArtikalNazivSmall; ?></a></h3>
                    </div>
                    <!-- /.book-details -->
                    <!-- /.cart -->
                </div>





            </div>
        </div>
        <?php
        $delay++; endforeach;
    ?>

</div><!-- /.fashion-featured -->
<!-- ============================================== NEW PRODUCTS : END ============================================== -->