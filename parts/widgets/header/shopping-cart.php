<!-- ============================================== SHOPPING CART ============================================== -->
<ul class="dropdown-menu fadeIn animated">
	<li>
        <?php
        $cartArtKorlis = '';
        $ukupnaKolArt = '';
        $ukupnaKorpa = '';
        if ($ArtikliKupljeni) {
            foreach($ArtikliKupljeni as $k => $v):
                $KolTempArt = $v['KolTempArt'];
                $pravaCena = $v['pravaCena'];
                $IdArtTempArt = $v['IdArtTempArt'];
                $artNazivKorpa = $v['ArtNaz'.$jezik];
                $artLinkKorpa = $v['ArtikalLink'];



                $ukupnaKolArt += $KolTempArt;
                $cenaPoArtKol = $pravaCena*$KolTempArt;

                $ukupnaKorpa += $cenaPoArtKol;

                $ukupnaKorpapoArt = $common->formatCena($cenaPoArtKol,$valutasession);

                $ImeSlikeArtikliSlike = $v['ImeSlikeArtikliSlike'];
                $lokFolder =  $common->locationslika($IdArtTempArt);

                $urlArtiklaLink = '/'.$ArtikalLink.'/'.$IdArtTempArt;

                $ext = pathinfo($ImeSlikeArtikliSlike, PATHINFO_EXTENSION);
                $fileName = pathinfo($ImeSlikeArtikliSlike, PATHINFO_FILENAME);

                $mala_slika = $lokFolder.'/'.$fileName . '_mala.' . $ext;
                $srednja_slika = $lokFolder.'/'.$fileName . '_srednja.' . $ext;
                $velika_slika = $lokFolder.'/'.$ImeSlikeArtikliSlike;



        $cartArtKorlis .= '<div class="cart-item product-summary inner-bottom-20 okvIzbrisi">';
            $cartArtKorlis .= '<div class="row">';

                            $cartArtKorlis .= '<div class="col-xs-4">';
                                $cartArtKorlis .= '<div class="image">';
                                    $cartArtKorlis .= '<a href="/'.$artLinkKorpa.'/'.$IdArtTempArt.'" class="img-responsive">';
                                        $cartArtKorlis .= '<img class="img-responsive" src="'.$mala_slika.'"	alt="">';
                                    $cartArtKorlis .= '</a>';
                                $cartArtKorlis .= '</div>';
                            $cartArtKorlis .= '</div>';

                            $cartArtKorlis .= '<div class="col-xs-7 padding-no">';
                                $cartArtKorlis .= '<h3 class="name"><a href="/'.$artLinkKorpa.'/'.$IdArtTempArt.'">'.$artNazivKorpa.'</a></h3>';
                                        $cartArtKorlis .= '<div class="star-rating" title="Rated 4.50 out of 5">';
                                            $cartArtKorlis .= '<span style="width:90%"></span>';
                                        $cartArtKorlis .= '</div>';
                                         $cartArtKorlis .= '<div class="price">'.$ukupnaKorpapoArt.'</div>';
                            $cartArtKorlis .= '</div>';

                            $cartArtKorlis .= '<div class="col-xs-1 action">';
                                $cartArtKorlis .= '<a href="#" class="izbaciIzKorpe" data-name="'.$IdArtTempArt.'"><i class="fa fa-trash"></i></a>';
                            $cartArtKorlis .= '</div>';

            $cartArtKorlis .= '</div>';
        $cartArtKorlis .= '</div>';



            endforeach;
            echo $cartArtKorlis;
        }
        ?>



		
		<div class="clearfix"></div>
		<div class="clearfix cart-total">
			<div class="clearfix"></div>
			<a href="/cart" class="btn btn-upper btn-primary btn-block"><?php echo $jsonlang[17][$jezikId]; ?></a>
		</div><!-- /.cart-total-->
	</li>
</ul><!-- /.dropdown-menu-->
<!-- ============================================== SHOPPING CART : END ============================================== -->