<!-- ========================================== SECTION – HERO ========================================= -->

<?php
$bareUpi = "CALL sliderBaner('$KategorijaArtikalaIdOS','5')";
$slajder  = $db->rawQuery($bareUpi);

if ($slajder) {
?>
<div class="fashion-v1-slider hero-style-1" id="hero">
	<div class="big-slider owl-main owl-carousel owl-inner-nav owl-ui-lg" id="owl-main">

        <?php
        $sliderArr = '';
        foreach($slajder as $k =>$v):
            $BanerNaziv = $v['BanerNaziv'];
            $BanerLink = $v['BanerLink'];
            $BanerSlika = $v['BanerSlika'];
            $BanerOpis = $v['BanerOpis'];
            $BanerUrl = $v['BanerUrl'];
            $BanerId = $v['BanerId'];
            $BanerDodatniOpis = $v['BanerDodatniOpis'];



            $lokrel = $common->locationslikaOstalo(BANERSLIKELOK,$BanerId);

            $ext = pathinfo($BanerSlika, PATHINFO_EXTENSION);
            $fileName = pathinfo($BanerSlika, PATHINFO_FILENAME);

            $velika_slika = $fileName .'.'. $ext;


            $lok = DCROOT.$lokrel.'/'.$velika_slika;
            if (file_exists($lok)) {
                $slikaBanerV = $lokrel.'/'.$velika_slika;
            } else {
                $slikaBanerV = 'assets/images/sliders/2.jpg';
            }


            $sliderArr .= '<div class="slider-2 item" style="background-image: url('.$slikaBanerV.');">';
                $sliderArr .= '<div class="container">';
                    $sliderArr .= '<div class="slide-text-2 caption vertical-center text-left">';
                        $sliderArr .= '<h3 class="fadeInDown-1">'.$BanerOpis.'</h3>';
                        $sliderArr .= '<h1 class="fadeInDown-2">'.$BanerNaziv.'</h1>';
                        $sliderArr .= '<h2 class="fadeInDown-3">'.$BanerDodatniOpis.'</h2>';
                        $sliderArr .= '<a href="'.$BanerUrl.'" class="btn btn-primary fadeInDown-4">Pogledaj</a>';
                    $sliderArr .= '</div>';
                $sliderArr .= '</div>';
            $sliderArr .= '</div>';
        endforeach;

        echo $sliderArr;
        $sliderArr = '';
        ?>


	</div><!-- /.big-slider -->
</div><!-- /.fashion-v1-slider -->
<?php } ?>

<!-- ========================================= SECTION – HERO : END ========================================= -->

