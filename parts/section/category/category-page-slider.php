<!-- ========================================== CATEGORY PAGE SLIDER ========================================= -->

<?php
$bareUpi = "CALL sliderBaner('$KategorijaArtikalaIdOS',1)";
$slajderKat  = $db->rawQueryOne($bareUpi);

$sliderKatArr = '';
if ($slajderKat) {
$BanerNaziv = $slajderKat['BanerNaziv'];
$BanerLink = $slajderKat['BanerLink'];
$BanerSlika = $slajderKat['BanerSlika'];
$BanerOpis = $slajderKat['BanerOpis'];
$BanerUrl = $slajderKat['BanerUrl'];
$BanerId = $slajderKat['BanerId'];
$BanerDodatniOpis = $slajderKat['BanerDodatniOpis'];


    $lokrel = $common->locationslikaOstalo(BANERSLIKELOK,$BanerId);

    $ext = pathinfo($BanerSlika, PATHINFO_EXTENSION);
    $fileName = pathinfo($BanerSlika, PATHINFO_FILENAME);

    $srednja_slika = $fileName . '_srednja.' . $ext;


    $lok = DCROOT.$lokrel.'/'.$srednja_slika;
    if (file_exists($lok)) {
        $slikaBanerV = $lokrel.'/'.$srednja_slika;
    } else {
        $slikaBanerV = 'assets/images/banners/1.jpg';
    }


    /*$lok = DCROOT.$lokrel.'/'.$srednja_slika;
    if (file_exists($lok)) {
        $slikaBanerV = '/' . BANERSLIKELOK . '/' . $BanerSlika;
    } else {
        $slikaBanerV = 'assets/images/sliders/2.jpg';
    }*/




    $sliderKatArr .= '<div class="clearfix"></div>';


        $sliderKatArr .= '<div id="category" class="gird-v1-banner wow fadeIn hidden-xs">';
            $sliderKatArr .= '<div class="item">';
                                $sliderKatArr .= '<div class="image">';
                                    $sliderKatArr .= '<a href="'.$BanerUrl.'"><img src="'.$slikaBanerV.'" alt="" class="img-responsive"></a>';
                                $sliderKatArr .= '</div>';

                                $sliderKatArr .= '<div class="container-fluid">';
                                    $sliderKatArr .= '<div class="caption vertical-top hidden-xs">'; /*ovde smo stavili da se ne vidi tekst na XS zato sto bezi font. Treba srediti font da se vidi*/
                                            $sliderKatArr .= '<div class="small-text wow fadeIn" data-wow-delay="0.2s">'.$BanerDodatniOpis.'</div>';
                                            $sliderKatArr .= '<div class="big-text wow fadeIn" data-wow-delay="0.4s">'.$BanerNaziv.'</div>';
                                            $sliderKatArr .= '<div class="bottom-line wow fadeIn" data-wow-delay="0.6s">'.$BanerOpis.'</div>';
                                     $sliderKatArr .= '</div>';
                               $sliderKatArr .= '</div>';
        $sliderKatArr .= '</div>';
    $sliderKatArr .= '</div>';

    echo $sliderKatArr;
    $sliderKatArr = '';

}

?>

<!-- ========================================= CATEGORY PAGE SLIDER : END ========================================= -->