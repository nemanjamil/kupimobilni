<!-- ============================================== SIDEBAR ADVERTISEMENT ============================================== -->
<?php
if($KategorijaArtikalaIdOS){$kateg = $KategorijaArtikalaIdOS;}else{$kateg = 2;};

$bareUpi = "CALL sliderBaner($kateg,1)";
$slajderKat  = $db->rawQueryOne($bareUpi);
$sliderKatArr = '';
if ($slajderKat) {
	$BanerNaziv = $slajderKat['BanerNaziv'];
	$BanerLink = $slajderKat['BanerLink'];
	$BanerSlika = $slajderKat['BanerSlika'];
	$BanerOpis = $slajderKat['BanerOpis'];
	$BanerUrl = $slajderKat['BanerUrl'];
	$BanerId = $slajderKat['BanerId'];


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


	$sliderKatArr .= '<div class="sidebar-advertisment">'; /*wow fadeIn"  data-wow-delay="0.2s"*/
	$sliderKatArr .= '<a href="'.$BanerUrl.'"><img class="imge-responsive" src="'.$slikaBanerV.'" alt="'.$BanerNaziv.'"></a>';
		$sliderKatArr .= '<div class="content-text">';
		$sliderKatArr .= '<span>'.$BanerOpis.'</span>';
	    $sliderKatArr .= '<h3>'.$BanerNaziv.'</h3>';
	$sliderKatArr .= '</div>';
	$sliderKatArr .= '</div>';

	echo $sliderKatArr;
	$sliderKatArr = '';

 } ?>
<!-- ============================================== SIDEBAR ADVERTISEMENT : END ============================================== -->
