<!-- ============================================== BANNER SLIDER GORE ============================================== -->
<div class="banner-slider wow fadeIn"> <!--data-wow-delay="0.2s"-->
<?php
    $cols = Array ("B.*");/*, "KAN.NazivKategorije"*/
    $db->where("B.BanerLokacija",0);
    $db->where("B.BanerAktivan",1);
    $data = $db->get ("baneri B", null, $cols);
if($data){
foreach ($data as $file => $link) {

        $BanerId = $link['BanerId'];
        $BanerNaziv = $link['BanerNaziv'];

        $BanerKategorijaArtiklaId = $link['BanerKategorijaArtiklaId'];
        $KategorijaArtikalaNaziv = $link['NazivKategorije'];

        $BanerLink = $link['BanerLink'];
        $BanerSlika = $link['BanerSlika'];
        $BanerAktivan = $link['BanerAktivan'];
        $BanerOpis = $link['BanerOpis'];

        $BanerUrl = $link['BanerUrl'];

        $lokrel = $common->locationslikaOstalo(BANERSLIKELOK,$BanerId);

        $ext = pathinfo($BanerSlika, PATHINFO_EXTENSION);
        $fileName = pathinfo($BanerSlika, PATHINFO_FILENAME);

        $mala_slika = $fileName .'.'.  $ext;


        $lok = DCROOT.$lokrel.'/'.$mala_slika;

if (file_exists($lok)) {

$BanerSlikaGore.='<div class="item">
		<div class="banner-outer">
			<div class="text">
				<!--<h4>new design</h4>-->
				<h2>'.$BanerOpis.'</h2>
				<a class="shop-now" href="'.$BanerUrl.'">Shop now ></a>
			</div>
			<img src="'.$lokrel.'/'.$mala_slika.'" alt="#" class="img-responsive">
		</div>
	</div>';

        }
    }
}
    echo  $BanerSlikaGore;

?>


	<!--<div class="item">
		<div class="banner-outer">
			<div class="text">
				<h4>new design</h4>
				<h2>fashion</h2>
				<a class="shop-now" href="#">Shop now ></a>
			</div>
			<img src="assets/images/banners/4.jpg" alt="#" class="img-responsive">
		</div>
	</div>
	<div class="item">
        <div class="banner-outer">
            <div class="text">
                <h4>new design</h4>
                <h2>fashion</h2>
                <a class="shop-now" href="#">Shop now ></a>
            </div>
            <img src="assets/images/banners/4.jpg" alt="#" class="img-responsive">
        </div>
    </div>
	<div class="item">
		<div class="banner-outer">
			<div class="text">
				<h4>new design</h4>
				<h2>fashion</h2>
				<a class="shop-now" href="#">Shop now ></a>
			</div>
			<img src="assets/images/banners/4.jpg" alt="#" class="img-responsive">
		</div>
	</div>-->


</div> <!-- /.banner-slider -->
<!-- ============================================== BANNER SLIDER : END ============================================== -->



