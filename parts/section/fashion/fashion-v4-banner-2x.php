<!-- ============================================== FASHION-V4 BANNER-2X ============================================== -->
<div class="banner-2x row outer-xs wow fadeInUp">

    <?php
    $bareUpi = "CALL sliderBaner('$KategorijaArtikalaIdOS','1')";
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

    $srednja_slika = $fileName . '_470.' . $ext;


    $lok = DCROOT.$lokrel.'/'.$srednja_slika;
    if (file_exists($lok)) {
        $slikaBanerV = $lokrel.'/'.$srednja_slika;
    } else {
        $slikaBanerV = '/assets/images/sliders/1.jpg';
    }


    $sliderKatArr .= '<div class="col-md-7 col-sm-6 col-xs12 wow fadeInUp" data-wow-delay="0.2s">';
        $sliderKatArr .= '<div class="banner">';
            $sliderKatArr .= '<a href="'.$BanerUrl.'">';
                $sliderKatArr .= '<div class="banner-1">';

                    $sliderKatArr .= '<div class="image">';
                        $sliderKatArr .= '<img src="'.$slikaBanerV.'" alt="'.$BanerNaziv.'" class="img-responsive">';
                    $sliderKatArr .= '</div>';

                    $sliderKatArr .= '<div class="content">';
                        $sliderKatArr .= '<h3>'.$BanerNaziv.'</h3>';
                        $sliderKatArr .= '<span>'.$BanerOpis.'</span>';
                    $sliderKatArr .= '</div>';

                $sliderKatArr .= '</div>';
            $sliderKatArr .= '</a>';
        $sliderKatArr .= '</div>';
    $sliderKatArr .= '</div>';

        echo $sliderKatArr;
        $sliderKatArr = '';

       }

/// krak provog slajda

$bareUpi = "CALL sliderBaner('$KategorijaArtikalaIdOS','1')";
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


    $lokrel = $common->locationslikaOstalo(BANERSLIKELOK, $BanerId);

    $ext = pathinfo($BanerSlika, PATHINFO_EXTENSION);
    $fileName = pathinfo($BanerSlika, PATHINFO_FILENAME);

    $srednja_slika = $fileName . '_370.' . $ext;


    $lok = DCROOT . $lokrel . '/' . $srednja_slika;
    if (file_exists($lok)) {
        $slikaBanerV = $lokrel . '/' . $srednja_slika;
    } else {
        $slikaBanerV = '/assets/images/banners/6.jpg';
    }


    $sliderKatArr .= '<div class="col-md-5 col-sm-6 col-xs12 wow fadeInUp" data-wow-delay="0.4s">';
        $sliderKatArr .= '<div class="banner">';
            $sliderKatArr .= '<a href="'.$BanerUrl.'">';
                $sliderKatArr .= '<div class="banner-2">';
                    $sliderKatArr .= '<div class="image">';
                        $sliderKatArr .= '<img src="'.$slikaBanerV.'" alt="'.$BanerNaziv.'" class="img-responsive">';
                    $sliderKatArr .= '</div>';
                    $sliderKatArr .= '<div class="content">';
                        $sliderKatArr .= '<span>'.$BanerDodatniOpis.'</span>';
                        $sliderKatArr .= '<h2>'.$BanerNaziv.'</h2>';
                        $sliderKatArr .= '<span>'.$BanerOpis.'</span>';
                    $sliderKatArr .= '</div>';

                $sliderKatArr .= '</div>';
            $sliderKatArr .= '</a>';
        $sliderKatArr .= '</div>';
    $sliderKatArr .= '</div>';

    echo $sliderKatArr;
}
//    $sliderKatArr .= '</div>';
    ?>
