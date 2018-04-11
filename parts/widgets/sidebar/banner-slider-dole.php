<!-- ============================================== BANNER SLIDER GORE ============================================== -->
<div class="banner-slider wow fadeIn"> <!--data-wow-delay="0.2s"-->
    <?php
    $colsd = Array ("B.*");/*, "KAN.NazivKategorije"*/
    $db->where("B.BanerLokacija",1);
    $db->where("B.BanerAktivan",1);
    $datad = $db->get ("baneri B", null, $colsd);
if($datad){
    foreach ($datad as $filed => $linkd) {

        $BanerIdD = $linkd['BanerId'];
        $BanerNazivD = $linkd['BanerNaziv'];

        $BanerKategorijaArtiklaId = $linkd['BanerKategorijaArtiklaId'];
        $KategorijaArtikalaNaziv = $linkd['NazivKategorije'];

        $BanerLinkD = $linkd['BanerLink'];
        $BanerSlikaD = $linkd['BanerSlika'];
        $BanerAktivanD = $linkd['BanerAktivan'];
        $BanerOpisD = $linkd['BanerOpis'];

        $BanerUrlD = $linkd['BanerUrl'];

        $lokrelD = $common->locationslikaOstalo(BANERSLIKELOK,$BanerIdD);

        $extD = pathinfo($BanerSlikaD, PATHINFO_EXTENSION);
        $fileNameD = pathinfo($BanerSlikaD, PATHINFO_FILENAME);

        $mala_slikaD = $fileNameD .'.'.  $extD;


        $lokD = DCROOT.$lokrelD.'/'.$mala_slikaD;

        if (file_exists($lokD)) {

            $BanerSlikaDole.='<div class="item">
		<div class="banner-outer">
			<div class="text">
				<!--<h4>new design</h4>-->
				<h2>'.$BanerOpisD.'</h2>
				<a class="shop-now" href="/'.$BanerUrlD.'">Shop now ></a>
			</div>
			<img src="'.$lokrelD.'/'.$mala_slikaD.'" alt="#" class="img-responsive">
		</div>
	</div>';

        }
    }
}
    echo  $BanerSlikaDole;
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



