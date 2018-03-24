<?php
/**
 * Created by PhpStorm.
 * User: NemanjaMilivojevic
 * Date: 23.8.15.
 * Time: 17.33
 */

$cartArtKorlis = '';
$ukupnaKolArt = '';
$ukupnaKorpa = '';


$bodyMail .= '<tr>';
    $bodyMail .= '<td align="center" valign="top">';

        $bodyMail .= '<table border="0" cellpadding="0" cellspacing="0" width="100%">';
            $bodyMail .= '<tr>';
                $bodyMail .= '<td align="center" valign="top">';

                    $bodyMail .= '<table border="0" cellpadding="0" cellspacing="0" width="600" class="flexibleContainer">';
                        $bodyMail .= '<tr>';
                            $bodyMail .= '<td align="center" valign="top" width="600" class="flexibleContainerCell bottomShim">';
                                /*$bodyMail .= '<table border="0" cellpadding="0" cellspacing="0" width="100%" class="nestedContainer">';
                                    $bodyMail .= '<tr>';
                                        $bodyMail .= '<td align="center" valign="top" class="nestedContainerCell">';*/





$bodyMail .= '<table class="table table-bordered shop-table cart" id="artikli" style="width: 100%">';

    $bodyMail .= '<thead>';
        $bodyMail .= '<tr>';

            /*$bodyMail .= '<th class="product-thumbnail item">Image</th>';*/
            $bodyMail .= '<th class="product-name item">'.$jsonlang[244][$jezikId].'</th>';

            $bodyMail .= '<th class="product-quantity item" style="text-align:center ">'.$jsonlang[130][$jezikId].'</th>';
            $bodyMail .= '<th class="product-price item" style="text-align:center ">'.$jsonlang[71][$jezikId].'</th>';
            $bodyMail .= '<th class="product-subtotal" style="text-align:center ">'.$jsonlang[131][$jezikId].'</th>';
        $bodyMail .= '</tr>';
    $bodyMail .= '</thead>';


$bodyMail .= '<tbody>';

			if ($ArtikliKupljeni) {


                foreach($ArtikliKupljeni as $k => $v):
                    $KolTempArt = $v['KolTempArt'];
                    $ArtikalMPCena = $v['ArtikalMPCena'];
                    $pravaMp = $v['pravaMp'];
                    $pravaVp = $v['pravaVp'];
                    $IdArtTempArt = $v['IdArtTempArt'];
                    $artNazivKorpa = $v['OpisArtikla'];
                    $artLinkKorpa = $v['ArtikalLink'];
                    $PdvZemljValuta = $v['PdvZemljValuta'];
                    $PdvOznakaValuta = $v['PdvOznakaValuta'];
                    $ImeZemljeValuta = $v['ImeZemljeValuta'];
                    $MinimalnaKol = $v['MinimalnaKol'];
                    $TipUnit = $v['TipUnit'];
                    $IdTempArtAuto = $v['IdTempArtAuto'];
                    $KomitentIme = $v['KomitentIme'];
                    $KomitentPrezime = $v['KomitentPrezime'];
                    $KomitentMesto = $v['KomitentMesto'];
                    $ArtikalStanje = $v['ArtikalStanje'];



                    $nakasdInfoProiz = $common->stanjeOpisSveId($ArtikalStanje, $ArtikalMPCena, $valutasession, $jsonlang[229][$jezikId], $jsonlang[117][$jezikId], $jsonlang[116][$jezikId], $pravaVp, $pravaMp, $userTip, $dani);
                    require(DCROOT.'/stranice/cenaPrikazVarijableInfoProiz.php');

                    $ukupnaKolArt += $KolTempArt;
                    $cenaPoArtKol = $cenaPrikazBrojInfo*$KolTempArt;

                    $ukupnaKorpa += $cenaPoArtKol;

                    $ImeSlikeArtikliSlike = $v['ImeSlikeArtikliSlike'];
                    $lokFolder =  $common->locationslika($IdArtTempArt);

                    $urlArtiklaLink = '/'.$artLinkKorpa.'/'.$IdArtTempArt;

                    $ext = pathinfo($ImeSlikeArtikliSlike, PATHINFO_EXTENSION);
                    $fileName = pathinfo($ImeSlikeArtikliSlike, PATHINFO_FILENAME);

                    $mala_slika = $lokFolder.'/'.$fileName . '_mala.' . $ext;
                    $srednja_slika = $lokFolder.'/'.$fileName . '_srednja.' . $ext;
                    $velika_slika = $lokFolder.'/'.$ImeSlikeArtikliSlike;

                    $ukupnaKorpapoArt = $common->formatCena($cenaPoArtKol,$valutasession);

                    $pravaCena = $common->formatCena($cenaPrikazBrojInfo,$valutasession);





                    $bodyMail .= '<tr class="okvIzbrisi">';




                    /*$bodyMail .= '<td class="product-thumbnail">';
                    $bodyMail .= '<a target="_blank" class="entry-thumbnail" href="'.$urlArtiklaLink.'">';
                    $bodyMail .= '<img width="140px" src="'.$mala_slika.'" alt="">';
                    $bodyMail .= '</a>';
                    $bodyMail .= '</td>';*/

                    $bodyMail .= '<td class="product-name">';
                    $bodyMail .= '<ul>';
                        $bodyMail .= '<li><b><a target="_blank" class="name" href="'.DPROOT.$urlArtiklaLink.'">'.$artNazivKorpa.'</a></b></li>';
                     //   $bodyMail .= '<li>'.$PdvOznakaValuta.' : <span>'.$PdvZemljValuta.'</span></li>';
                     //    $bodyMail .= '<li>'.$jsonlang[132][$jezikId].' : <span>'.$ImeZemljeValuta.', '.$KomitentMesto.'</span></li>';
                     //    $bodyMail .= '<li>'.$jsonlang[133][$jezikId].' : <span>'.$TipUnit.'</span></li>';
                     //   $bodyMail .= '<li>Porez je uracunat u cenu</span></li>';
                    $bodyMail .= '</ul>';



                    $bodyMail .= '</td>';


                    $bodyMail .= '<td class="product-quantity">';
                    $bodyMail .= '<div class="qty" style="text-align:center ">';

                    $bodyMail .= $KolTempArt;

                    $bodyMail .= '</div>';
                    $bodyMail .= '</td>';

                    $bodyMail .= '<td class="product-price" style="text-align:center "><span class="price">'.$pravaCena.'</span></td>';

                    $bodyMail .= '<td class="product-total" style="text-align:center "><span class="total">'.$ukupnaKorpapoArt.'</span></td>';

                    $bodyMail .= '</tr>';

                endforeach;
            }


$bodyMail .= '</tbody>';
$bodyMail .= '</table>';


$bodyMail .= '<table class="table table-bordered shop-table cart" id="artikli" style="width: 100%">';
$bodyMail .= '<tbody>';
$bodyMail .= '<tr>';
$bodyMail .= '<br>';
$bodyMail .= '<td class="sub-total"><b>'.$jsonlang[277][$jezikId].' :</b></td>';
$bodyMail .= '<td class="sub-amount"><span>'. $common->formatCena($ukupnaKorpa,$valutasession).' </span></td>';
$bodyMail .= '</tr>';

$bodyMail .= '<tr>';
$bodyMail .= '<br>';
$bodyMail .= '<td></td>';
$bodyMail .= '<td class="sub-amount">'.$jsonlang[287][$jezikId].'</td>';
$bodyMail .= '</tr>';

$bodyMail .= '</tbody>';
$bodyMail .= '</table>';
$bodyMail .= '<br>';

$bodyMail .= '<table class="table table-bordered shop-table cart" id="artikli" style="width: 100%">';
    $bodyMail .= '<tbody>';
        $bodyMail .= '<tr>';
            $bodyMail .= '<td>';
            $bodyMail .= '<br>';
                $bodyMail .= '<span class="estimate-title"><b>'.$jsonlang[278][$jezikId].' </b></span>';

                $upikPr = "SELECT GetKurs (1, '$valutasession') * ".TROSKOVIPREVOZA." as cenaPrevoz";
                $kPrevoz = $db->rawQueryOne($upikPr);
                $cprev = $kPrevoz['cenaPrevoz'];
                $cenaPrevoz = $common->formatCena($cprev, $valutasession);

                $bodyMail .= '<p>'.$jsonlang[279][$jezikId].'<b> '. $cenaPrevoz. ' ' . $valutasessionUpperXXX . '</b>  <br> '.$jsonlang[280][$jezikId].'  - '. $jsonlang[283][$jezikId] . '</p>';

            $bodyMail .= '</td>';
        $bodyMail .= '</tr>';
    $bodyMail .= '</tbody>';
$bodyMail .= '</table>';



$bodyMail .= '<table class="table table-bordered shop-table cart" id="artikli" style="width: 100%">';
    $bodyMail .= '<tbody>';
        $bodyMail .= '<tr style="background-color: #d6e9c6;font-weight: bold">';
            $bodyMail .= '<td class="grand-total"><span><h2>'.$jsonlang[281][$jezikId].'</h2></span></td>';
            $bodyMail .= '<td  class="total-amount"><span><h2>'.$common->formatCena($ukupnaKorpa + $cprev,$valutasession).'</h2></span></td>';
$bodyMail .= '</tr>';
    $bodyMail .= '</tbody>';
$bodyMail .= '</table>';




                            /*            $bodyMail .= '</td>';
                                    $bodyMail .= '</tr>';
                                $bodyMail .= '</table>';*/
                            $bodyMail .= '</td>';
                        $bodyMail .= '</tr>';
                    $bodyMail .= '</table>';

                $bodyMail .= '</td>';
            $bodyMail .= '</tr>';
        $bodyMail .= '</table>';

    $bodyMail .= '</td>';
$bodyMail .= '</tr>';