<!-- ============================================== PRODUCT ITEM SMALL ============================================== -->
<?php
$delay = 0;

$limitUpit = 18;
$brojAkcije = 8;
$footArtiPocsuper = "CALL listaArtikalaRazno($limitUpit,$valutasession,$jezikId,$KomitentId,$brojAkcije);";
$keyArtAr = $db->rawQuery($footArtiPocsuper);

$item = 0;
$broj = 0;
$i = 0;
foreach ($keyArtAr as $k => $keyArt):

    $ArtikalIdSmall = $keyArt['ArtikalId'];
    $ArtikalNaAkcijiSmall = $keyArt['ArtikalNaAkciji'];
    $top1Small = $keyArt['top1'];
    $top2Small = $keyArt['top2'];
    $top3Small = $keyArt['top3'];
    $ArtikalNazivSmall = $keyArt['OpisArtikla'];
    $OpisKratakOpis = $keyArt['OpisKratakOpis'];
    $ArtikalMPCenaSmall = $keyArt['ArtikalMPCena'];
    $ArtikalVPCenaSmall = $keyArt['ArtikalVPCena'];
    $KategorijaArtikalaNazivSmall = $keyArt['NazivKategorije'];
    $KategorijaArtikalaLinkSmall = $keyArt['KategorijaArtikalaLink'];
    $BrendImeSmall = $keyArt['BrendIme'];
    $KomitentiValutaSmall = $keyArt['KomitentiValuta'];
    $ValutaValutaSmall = $keyArt['ValutaValuta'];
    $MarzaMarzaSmall = $keyArt['MarzaMarza'];
    $odnosKursArtSmall = $keyArt['odnosKursArt'];
    $pravaMpSmall = $keyArt['pravaMp'];
    $pravaVpSmall = $keyArt['pravaVp'];
    $ArtikalLinkSmall = $keyArt['ArtikalLink'];
    $ArtikalKratakOpisSmall = $keyArt['ArtikalKratakOpis'];
    $ArtikalStanjeSmall = $keyArt['ArtikalStanje'];
    $ImeSlikeArtikliSlikeSmall = $keyArt['ImeSlikeArtikliSlike'];
    $pozovite = $jsonlang[117][$jezikId];
    //$OpisArtikliTekstovi = $keyArt['OpisArtikliTekstovi' . $jezik];
    $ocena = $keyArt['ocenaut'];



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


    $ImeSlikeArtikliSlikeSmall = $keyArt['slikaMain'];

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

//var_dump($KategorijaArtikalaNazivSmall);

    ?>
    <div class="col-sm-6 col-md-6 col-xs-12 inner-bottom-xs">
        <div class="product">
            <div class="product-image col-md-5 col-xs-5 visinaSlikeKat">
                <a href="<?php echo $urlArtiklaLinkSmall; ?>">
                    <div class="image">
                        <img src="<?php echo $srednja_slika; ?>" class="img-responsive"
                             alt="<?php echo $ArtikalNazivSmall;?>">
                    </div>

                    <?php if ($ArtikalNaAkcijiSmall == 6): ?><div class="tag"><div class="tag-text sale">sale</div></div><?php endif; ?>
                    <?php if ($ArtikalNaAkcijiSmall == 7): ?><div class="tag"><div class="tag-text new">new</div></div><?php endif; ?>
                    <?php if ($ArtikalNaAkcijiSmall == 8): ?><div class="tag"><div class="tag-text hot">hot</div></div><?php endif; ?>

                    <div class="hover-effect"><i class="fa fa-search"></i></div>
                </a>
            </div>
            <!-- /.product-image -->


            <div class="product-info col-md-7 no-padding col-xs-7 visina2uredu">
                <h3 class="name nemaMargineTop"><a href="<?php echo $urlArtiklaLinkSmall; ?>"><?php echo $ArtikalNazivSmall; ?></a></h3>

                <?php

                if ($OpisKratakOpis) {
                    echo '<p>'.$OpisKratakOpis.'</p>';
                }
                $dp = '';
                $dp .= '<div class="product-short-desc">';
                $dp .= '<div class="small">' . $jsonlang[348][$jezikId] . ': ' . '<b>' . $BrendImeSmall . '</b></div>';

                $hovBack = ($ArtikalStanjeSmall) ? 'bg-success' : 'bg-danger';
                $hovBackIme = ($ArtikalStanjeSmall) ? 'Ima' : 'Nema';

                $dp .= '<div class="small">'.$jsonlang[106][$jezikId] .'  : <span class="status ' . $hovBack . '">' . $hovBackIme . '</span></div>';
                $dp .= '</div><!-- .product-short-desc -->';
                echo $dp;

                ?>

                <div class="no-padding cart animate-effect col-sm-12 col-xs-12" data-ime="<?php echo $ArtikalIdSmall; ?>">
                    <?php
                    $starArr = '';
                    for ($i = 1; $i <= 5; $i++) {
                        $cekstar = ($i == $ocena) ? 'checked' : '';
                        $starArr .= '<input class="starri required" ' . $cekstar . ' type="radio" name="test-3A-rating-' . $ArtikalIdSmall . '" value="' . $i . '"/>';
                    }
                    echo $starArr;
                    ?>
                </div>


                <div class="product-price">
                    <?php if ($pravaMpSmall > '0') { ?>
                        <ins><span class="amount"><?php echo $cenaPrikazSmall; ?></span></ins>
                    <?php } else { ?>
                        <ins><span class="amount"><?php echo $cenaPrikazSmall = $jsonlang[117][$jezikId] ?></span></ins>
                    <?php }

                    if ('2' == '1'):?>
                        <del><span class="amount">$ 011</span></del>
                    <?php endif; ?>
                </div>
                <!-- /.product-price -->

                <div class=" no-padding cart animate-effect col-sm-12 col-xs-12 hidden-xs">
                    <div class="action">
                        <ul class="list-unstyled">
                            <li class="add-cart-button">
                                <a class="btn btn-primary"
                                   href="<?php echo $urlArtiklaLinkSmall; ?>"><?php echo $jsonlang[76][$jezikId]; ?></a>
                            </li>

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

            </div>
            <!-- /.book-details -->
            <!-- /.cart -->
        </div>

    </div>
    <!-- /.products -->


    <?php



    $delay++;
endforeach;
?>
<!-- ============================================== PRODUCT ITEM SMALL : END ============================================== -->