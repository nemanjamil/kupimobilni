<?php
/**
 * Created by PhpStorm.
 * User: NemanjaMilivojevic
 * Date: 23.8.15.
 * Time: 17.33
 */

$bodyMail .= '<tr>';
    $bodyMail .= '<td align="center" valign="top">';

        $bodyMail .= '<table border="0" cellpadding="0" cellspacing="0" width="100%">';
            $bodyMail .= '<tr>';
                $bodyMail .= '<td align="center" valign="top">';

                    $bodyMail .= '<table border="0" cellpadding="0" cellspacing="0" width="600" class="flexibleContainer">';
                        $bodyMail .= '<tr>';
                            $bodyMail .= '<td valign="top" width="600" class="flexibleContainerCell">';



                                        $cols = Array ("K.KomitentId", "K.KomitentNaziv", "K.KomitentIme", "K.KomitentPrezime","K.KomitentMesto","K.KomitentiSlika");
                                        $db->join("artikli A", "A.ArtikalId = TA.IdArtTempArt");
                                        $db->join("komitenti K", "K.KomitentId = A.ArtikalKomitent");
                                        $db->where("TA.KomiTempArt",$KomitentId);
                                        $db->groupBy ("K.KomitentId");
                                        $prodavci = $db->get ("tempart TA", null, $cols);




                                        if ($prodavci) {
                                            foreach ($prodavci as $k=>$v):
                                                $KomitentIdkomi = $v['KomitentId'];
                                                $KomitentNaziv = $v['KomitentNaziv'];
                                                $KomitentIme = $v['KomitentIme'];
                                                $KomitentPrezime = $v['KomitentPrezime'];
                                                $KomitentMesto = $v['KomitentMesto'];
                                                $KomitentiSlika = $v['KomitentiSlika'];

                                                $lokrel = $common->locationslikaOstaloKomitent(KOMSLIKE,$KomitentIdkomi);

                                                $ext = pathinfo($KomitentiSlika, PATHINFO_EXTENSION);
                                                $fileName = pathinfo($KomitentiSlika, PATHINFO_FILENAME);

                                                $mala_slika = $fileName . '_mala.' . $ext;


                                                $lok = DCROOT.$lokrel.'/'.$mala_slika;
                                                if (file_exists($lok)) {
                                                    $sliKom = '<img class="img-responsive" src="'.DPROOT.$lokrel.'/'.$mala_slika.'" alt="">';
                                                } else {
                                                    $sliKom = '<img src="'.DPROOT.'/assets/images/products/98.jpg" class="img-responsive" alt="">';
                                                }


                                                // POCETAK sada uzimamo listi artiklala od prodavca

                                                $cols = Array ("A.ArtikalId", "ANN.OpisArtikla", "A.ArtikalLink");
                                                $db->join("artikli A", "A.ArtikalId = TA.IdArtTempArt");
                                                $db->join("artikalnazivnew ANN", "ANN.ArtikalId = A.ArtikalId AND ANN.IdLanguage = $jezikId");

                                                $db->where("TA.KomiTempArt",$KomitentId);
                                                $db->where("A.ArtikalKomitent",$KomitentIdkomi);

                                                $artikliProd = $db->get ("tempart TA", null, $cols);

                                                // KRAJ sada uzimamo listi artiklala od prodavca

                                                $bodyMail .= '<tr>';
                                                $bodyMail .= '<td align="center" valign="top">';

                                                $bodyMail .= '<table border="0" cellpadding="0" cellspacing="0" width="100%">';
                                                    $bodyMail .= '<tr>';
                                                        $bodyMail .= '<td align="center" valign="top">';

                                                            $bodyMail .= '<table border="0" cellpadding="0" cellspacing="0" width="600" class="flexibleContainer">';
                                                                $bodyMail .= '<tr>';
                                                                $bodyMail .= '<td valign="top" width="600" class="flexibleContainerCell">';

                                                                $bodyMail .= '<table border="0" cellpadding="0" cellspacing="0" width="100%" class="nestedContainer">';
                                                                $bodyMail .= '<tr>';
                                                                $bodyMail .= '<td align="center" valign="top" class="nestedContainerCell">';




                                                                    $bodyMail .= '<table align="Left" border="0" cellpadding="0" cellspacing="0" width="258" class="flexibleContainer">';
                                                                        $bodyMail .= '<tr>';
                                                                            $bodyMail .= '<td valign="top" class="textContent">';
                                                                                $bodyMail .= '<h3 style="text-transform: uppercase">'.$KomitentNaziv.'</h3>';


                                                                                $bodyMail .= '<div>'.$jsonlang[140][$jezikId].' : '.$KomitentIme.'  '.$KomitentPrezime.'</div>';
                                                                                $bodyMail .= '<div>'.$jsonlang[276][$jezikId].' : '.$KomitentMesto.'</div>';
                                                                                $bodyMail .= '<div>'.$sliKom.'</div>';




                                                                            $bodyMail .= '</td>';
                                                                        $bodyMail .= '</tr>';
                                                                    $bodyMail .= '</table>';



                                                                $bodyMail .= '<table align="Left" border="0" cellpadding="0" cellspacing="0" width="258" class="flexibleContainer">';
                                                                        $bodyMail .= '<tr>';
                                                                        $bodyMail .= '<td valign="top" class="textContent">';
                                                                        $bodyMail .= '<h3 style="text-transform: uppercase">'.$jsonlang[423][$jezikId].'</h3>';


                                                                            $bodyMail .= '<ul>';
                                                                            if ($artikliProd) {
                                                                                foreach ($artikliProd as $k=>$v):

                                                                                    $ArtikalId = $v['ArtikalId'];
                                                                                    $ArtikalNaziv = $v['OpisArtikla'];
                                                                                    $ArtikalLink = $v['ArtikalLink'];
                                                                                    $bodyMail .= '<li><a target="_blank" href="'.DPROOT.'/'.$ArtikalLink.'/'.$ArtikalId.'">'.$ArtikalNaziv.'</a></li>';

                                                                                endforeach;
                                                                            }
                                                                            $bodyMail .= '</ul>';

                                                                        $bodyMail .= '</td>';
                                                                        $bodyMail .= '</tr>';
                                                                    $bodyMail .= '</table>';




                                                /* $bodyMail .= '<table align="Right" border="0" cellpadding="0" cellspacing="0" width="260" class="flexibleContainer">';
                                                     $bodyMail .= '<tr>';
                                                         $bodyMail .= '<td valign="top" class="textContentLast">';
                                                             $bodyMail .= '<div>'.$jsonlang[275][$jezikId].'</div>';
                                                             $bodyMail .= '<ul>';

                                                             if ($artikliProd) {
                                                                 foreach ($artikliProd as $k=>$v):

                                                                     $ArtikalId = $v['ArtikalId'];
                                                                     $ArtikalNaziv = $v['OpisArtikla'];
                                                                     $ArtikalLink = $v['ArtikalLink'];

                                                                     $bodyMail .= '<li><a target="_blank" href="'.DPROOT.'/'.$ArtikalLink.'/'.$ArtikalId.'">'.$ArtikalNaziv.'</a></li>';

                                                                 endforeach;
                                                             }

                                                             $bodyMail .= '</ul>';
                                                         $bodyMail .= '</td>';
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
                                                $bodyMail .= '</table>';

                                                $bodyMail .= '</td>';
                                                $bodyMail .= '</tr>';


                                            endforeach;

                                        }