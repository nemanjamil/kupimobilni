<!-- ============================================== SHOPPING CART ============================================== -->
<?php
$cartArtKorlis = '';
$ukupnaKolArt = '';
$ukupnaKorpa = '';


//echo $ukupnaKorpa = $common->formatCenaExt($ukupnaKorpa,$valutasession);

?>
<div class="table-responsive cart-inner wow fadeInUp" data-wow-delay="0.2s">
	<h3 class="entry-title"><?php echo $jsonlang[22][$jezikId]; ?></h3>
	<form action="#" >
		<table class="table table-bordered shop-table cart">
			<thead>
			<tr>
				<th class="product-remove item"><?php echo $jsonlang[126][$jezikId]; ?></th>
				<th class="product-thumbnail item"><?php echo $jsonlang[127][$jezikId]; ?></th>
				<th class="product-name item"><?php echo $jsonlang[24][$jezikId]; ?></th>
				<!--<th class="product-edit item"><?php /*echo $jsonlang[129][$jezikId]; */?></th>-->
				<th class="product-quantity item"><?php echo $jsonlang[130][$jezikId]; ?></th>
				<th class="product-price item"><?php echo $jsonlang[71][$jezikId]; ?></th>
				<th class="product-subtotal"><?php echo $jsonlang[131][$jezikId]; ?></th>
			</tr>
			</thead><!-- /thead -->
			<tfoot>
				<tr>
					<td colspan="7">
						<div class="shopping-cart-btn">
							<!--<span class="">
								<a href="/" class="btn btn-primary">Continue Shopping</a>
								<a href="#" class="btn btn-primary">OK</a>
							</span>-->
						</div><!-- /.shopping-cart-btn -->
					</td>
				</tr>
			</tfoot>
			<tbody>

			<?php
			$korpaArt = '';


			if ($ArtikliKupljeniHead) {
				foreach($ArtikliKupljeniHead as $k => $v):
					$KolTempArt = $v['KolTempArt'];
					$pravaVp = $v['pravaVp'];
					$IdArtTempArt = $v['IdArtTempArt'];
					$artNazivKorpa = $v['OpisArtikla'];
					$artLinkKorpa = $v['ArtikalLink'];
                    $PdvZemljValuta = $v['PorezVrednost'];
                    $PdvOznakaValuta = $v['PdvOznakaValuta'];
                    $ImeZemljeValuta = $v['ImeZemljeValuta'];
                    $MinimalnaKol = $v['MinimalnaKolArt'];
                    $TipUnit = $v['TipUnit'];
                    $IdTempArtAuto = $v['IdTempArtAuto'];
					$KomitentIme = $v['KomitentIme'];
					$KomitentPrezime = $v['KomitentPrezime'];
					$KomitentMesto = $v['KomitentMesto'];


					$ArtikalStanje = $v['ArtikalStanje'];
					$ArtikalMPCena = $v['ArtikalMPCena'];
					$pravaMp = $v['pravaMp'];
					$pravaVp = $v['pravaVp'];
					$dani = $v['dani'];
					$nakasd = $common->stanjeOpisSveId($ArtikalStanje, $ArtikalMPCena, $sesValuta, $jsonlang[229][$jezikId], $jsonlang[117][$jezikId], $jsonlang[116][$jezikId], $pravaVp, $pravaMp, $tipUsera, $dani);
					require(DCROOT.'/stranice/cenaPrikazVarijable.php');

					$pravaVp = $cenaPrikazBroj;

					$ukupnaKolArt += $KolTempArt;
					$cenaPoArtKol = $pravaVp*$KolTempArt;

					$ukupnaKorpa += $cenaPoArtKol;

                    $ImeSlikeArtikliSlike = $v['ImeSlikeArtikliSlike'];
                    $lokFolder =  $common->locationslika($IdArtTempArt);

                    $urlArtiklaLink = '/'.$artLinkKorpa.'/'.$IdArtTempArt;

                    $ext = pathinfo($ImeSlikeArtikliSlike, PATHINFO_EXTENSION);
                    $fileName = pathinfo($ImeSlikeArtikliSlike, PATHINFO_FILENAME);

                    $mala_slika = $lokFolder.'/'.$fileName . '_mala.' . $ext;
                    $srednja_slika = $lokFolder.'/'.$fileName . '_srednja.' . $ext;
                    $velika_slika = $lokFolder.'/'.$ImeSlikeArtikliSlike;

                    $ukupnaKorpapoArt = $common->formatCenaSamoBrojId($cenaPoArtKol,$valutasession);

                    $imeValute = $common->formatCenaExtId($cenaPrikazBroj,$valutasession);





					$korpaArt .= '<tr class="okvIzbrisi">';
                        $korpaArt .= '<form action="action_page.php" enctype="multipart/form-data" method="post">';

						$korpaArt .= '<td class="product-remove"><a href="#" class="izbaciIzKorpe icon" data-name="'.$IdArtTempArt.'" title="Izbaci iz korpe"><i class="fa fa-trash-o"></i></a></td>';

						$korpaArt .= '<td class="product-thumbnail">';
							$korpaArt .= '<a target="_blank" class="entry-thumbnail" href="'.$urlArtiklaLink.'">';
								$korpaArt .= '<img width="140px" src="'.$srednja_slika.'" alt="">';
							$korpaArt .= '</a>';
						$korpaArt .= '</td>';

						$korpaArt .= '<td class="product-name">';
							$korpaArt .= '<a target="_blank" class="name" href="'.$urlArtiklaLink.'">'.$artNazivKorpa.'</a>';
							$korpaArt .= '<span class="product-size">'.$PdvOznakaValuta.' : <span>'.$PdvZemljValuta.'</span></span>';

					$korpaArt .= '<span class="product-size"> ' . $jsonlang[113][$jezikId] . ' : <span>'.$KomitentIme.'</span></span>';
					$korpaArt .= '<span class="product-color"> ' . $jsonlang[132][$jezikId] . ' : <span>' . $ImeZemljeValuta . ', ' . $KomitentMesto . '</span></span>';
					$korpaArt .= '<span class="product-color"> ' . $jsonlang[133][$jezikId] . ' : <span>' . $TipUnit . '</span></span>';
                    $korpaArt .= '<span class="product-color"><span>'.$jsonlang[287][$jezikId].'</span></span>';
					//$korpaArt .= '<span class="product-color"> ' . $jsonlang[139][$jezikId] . ' </span>';

						$korpaArt .= '</td>';

					//$korpaArt .= '<td class="product-edit"><a href="#" class="edit promeniKolicinuArtCart" data-name="' . $IdTempArtAuto . '" data-idart="' . $IdArtTempArt . '">' . $jsonlang[129][$jezikId] . '</a></td>';

						$korpaArt .= '<td class="product-quantity">';
							$korpaArt .= '<div class="qty">';

                                    $korpaArt .= '<span><input type="number" value="'.$KolTempArt.'" id="kolicinaKarta" placeholder="'.$MinimalnaKol.'" min="'.$MinimalnaKol.'"><span>
                                    <br>'. '<a href="#" class="edit promeniKolicinuArtCart" data-name="' . $IdTempArtAuto . '" data-idart="' . $IdArtTempArt . '">' . $jsonlang[129][$jezikId] . '</a>'.'</span></span>';
					//$korpaArt .= '<a href="#" class="edit promeniKolicinuArtCart" data-name="' . $IdTempArtAuto . '" data-idart="' . $IdArtTempArt . '">' . $jsonlang[129][$jezikId] . '</a>';

							$korpaArt .= '</div>';
						$korpaArt .= '</td>';

						$korpaArt .= '<td class="product-price"><span class="price">'.$cenaSamoBrojFormat.' '.$imeValute.'</span></td>';

						$korpaArt .= '<td class="product-total"><span class="total">'.$ukupnaKorpapoArt.' '.$imeValute.'</span></td>';
                        $korpaArt .= '</form>';
					$korpaArt .= '</tr>';

				endforeach;
			}

            echo $korpaArt;

			?>


			</tbody><!-- /tbody -->
		</table><!-- /table -->
	</form>
</div><!-- /.table-responsive -->
<!-- ============================================== SHOPPING CART : END ============================================== -->