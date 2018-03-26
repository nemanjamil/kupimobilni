<?php

$limitUpit = 15;
$brojAkcije = "";
$footArtiPoc = "CALL listaArtikalaRazno($limitUpit,$valutasession,$jezikId,$KomitentId,'');";


$keyArtAr = $db->rawQuery($footArtiPoc);

$i = 0;
$dp = '';
    if ($keyArtAr) {
        foreach ($keyArtAr as $k => $keyArt) {

            $KategorijaArtikalaIdOS = $keyArt['KategorijaArtikalId'];


            $ArtikalId = $keyArt['ArtikalId'];
            $ArtikalNaAkciji = $keyArt['ArtikalNaAkciji'];
            $top1 = $keyArt['top1'];
            $top2 = $keyArt['top2'];
            $top3 = $keyArt['top3'];
            $ArtikalNaziv = $keyArt['OpisArtikla'];
            $ArtikalMPCena = $keyArt['ArtikalMPCena'];
            $ArtikalVPCena = $keyArt['ArtikalVPCena'];
            $KategorijaArtikalaNaziv = $keyArt['NazivKategorije'];
            $KategorijaArtikalaLink = $keyArt['KategorijaArtikalaLink'];
            $BrendIme = $keyArt['BrendIme'];
            $KomitentiValuta = $keyArt['KomitentiValuta'];
            $ValutaValuta = $keyArt['ValutaValuta'];
            $MarzaMarza = $keyArt['MarzaMarza'];
            $odnosKursArt = $keyArt['odnosKursArt'];
            $pravaMp = $keyArt['pravaMp'];
            $pravaVp = $keyArt['pravaVp'];
            $ArtikalLink = $keyArt['ArtikalLink'];
            $OpisKratakOpis = $keyArt['OpisKratakOpis'];
            $ArtikalStanje = $keyArt['ArtikalStanje'];
            $ImeSlikeArtikliSlike = $keyArt['ImeSlikeArtikliSlike'];
            $pozovite = $jsonlang[117][$jezikId];
            $opisDetaljnije = $jsonlang[117][$jezikId];


            $urlArtiklaLink = '/' . $ArtikalLink . '/' . $ArtikalId;

            if ($ArtikalStanje > 0) {
                $cenaPrikaz = ($tipUsera >= 3) ? $common->formatCena($pravaVp, $sesValuta) : $common->formatCena($pravaMp, $sesValuta);
            } else {
                $mozedase = 'disabled="disabled"';
            }


            $ImeSlikeArtikliSlike = $keyArt['slikaMain'];

            $lokFolder = $common->locationslika($ArtikalId);

            $urlArtiklaLink = '/' . $ArtikalLink . '/' . $ArtikalId;

            $ext = pathinfo($ImeSlikeArtikliSlike, PATHINFO_EXTENSION);
            $fileName = pathinfo($ImeSlikeArtikliSlike, PATHINFO_FILENAME);

            $mala_slika = $lokFolder . '/' . $fileName . '_mala.' . $ext;
            $srednja_slika = $lokFolder . '/' . $fileName . '_srednja.' . $ext;
            $maloVeca_slika = $lokFolder . '/' . $fileName . '_maloVeca.' . $ext;
            $velika_slika = $lokFolder . '/' . $ImeSlikeArtikliSlike;

            $maloVeca_slika = $common->nemaSlike($maloVeca_slika);

            $i++;
            if ($i>15){ continue; }

            $oldPrice = '';

            $dp .= '<div class="item category-product col-sm-6 col-md-4">';
            $dp .= '<div class="products grid-v3 wow fadeInUp animated" data-wow-delay="0s" style="visibility: visible; animation-delay: 0s; animation-name: fadeInUp;">';
            $dp .= '<div class="product">';
            $dp .= '<div class="product-image">';
            $dp .= '<a href="' . $urlArtiklaLink . '">';
            $dp .= '<div class="image">';
            $dp .= '<img src="' . $maloVeca_slika . '" class="img-responsive" alt="' . $ArtikalNaziv . '">';
            $dp .= '</div>';

            if ($NaAkciji == 6):
                $dp .= '<div class="tag">';
                $dp .= '<div class="tag-text sale">sale</div></div>';
            endif;

            if ($NaAkciji == 7):
                $dp .= '<div class="tag">';
                $dp .= '<div class="tag-text new">new</div></div>';
            endif;

            if ($NaAkciji == 8):
                $dp .= '<div class="tag">';
                $dp .= '<div class="tag-text hot">hot</div></div>';
            endif;

            $dp .= '<div class="hover-effect">
					<ul class="action-buttons">
						<li class="add-cart-button">
					        <button class="btn btn-primary dodajuKorpuPocetna" data-id="' . $ArtikalId . '" data-kol="1" ><i class="fa fa-shopping-cart"></i></button>
					    </li>
						<li class="view-product"><a class="btn btn-primary" href="' . $urlArtiklaLink . '"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
						<li><button class="btn btn-primary compare dodajkompare" data-id="' . $ArtikalId . '" title="Uporedi"><i class="fa fa-exchange"></i></button></li>
					</ul>
			</div>';
            $dp .= '</a>';
            $dp .= '</div>';

            $dp .= '<div class="product-info">';
            $dp .= '<h3 class="name"><a href="' . $urlArtiklaLink . '">' . $ArtikalNaziv . '</a></h3>';

            $dp .= '<div class="star-rating" title="Rated 4.50 out of 5">';
            $dp .= '<span style="width:90%"><strong class="rating">4.50</strong> out of 5</span>';
            $dp .= '</div>';

            $dp .= '<div class="product-price">';

            if ($pravaMp > '0') {
                $dp .= '<ins>';
                $dp .= '<span class="amount">' . $cenaPrikaz . '</span>';
                $dp .= '</ins>';
            } else {
                $dp .= '<ins>';
                $dp .= '<span class="availability">Pozovite</span>';
                $dp .= '</ins>';
            }

            if ($oldPrice):
                $dp .= '<del><span class="amount">' . $cenaPrikaz . '</span></del>';
            endif;

            $dp .= '</div>';

            $dp .= '</div>';

            $dp .= '</div>';
            $dp .= '</div>';
            $dp .= '</div>';
        }
    }



$fp = fopen(DCROOT.'/cron/crongotovo/preporuka-nedelje-cron.php', 'w+');
fwrite($fp, $dp);
fclose($fp);
