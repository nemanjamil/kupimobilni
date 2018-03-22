<!-- ============================================== SINGLE BANNER ============================================== -->
<?php
if ($KategorijaArtikalaIdOS) {
    $bareUpi = "CALL sliderBaner('$KategorijaArtikalaIdOS','1')";

} else {
    $bareUpi = "CALL sliderBaner('1','1')";
}


$slajderKat  = $db->rawQueryOne($bareUpi);

$sliderKatArr = '';

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

$srednja_slika = $fileName . '_mala.' . $ext;


$lok = DCROOT.$lokrel.'/'.$srednja_slika;
if (file_exists($lok)) {
$slikaBanerV = $lokrel.'/'.$srednja_slika;
} else {
$slikaBanerV = '/assets/images/sliders/1.jpg';
}



if (file_exists($srednja_slika)) {

$sliderKatArr .= '<div class="single-banner wow fadeIn" data-wow-delay="0.2s">';
$sliderKatArr .= '<a href="'.$BanerUrl.'">';
$sliderKatArr .= '<div class="content"><span class="line-1">'.$jsonlang[228][$jezikId].'<span class="line-2"> </span></span></div>';
$sliderKatArr .= '<div class="image">';
$sliderKatArr .= '<img src="'.$slikaBanerV.'" alt="'.$BanerNaziv.'" alt="'.$BanerNaziv.'">';
$sliderKatArr .= '</div>';
$sliderKatArr .= '</a>';
$sliderKatArr .= '</div><!-- /.single-banner -->';

echo $sliderKatArr;
}

?>

<!-- ============================================== SINGLE BANNER : END ============================================== -->
