<?php

$cols = Array("K.KomitentNaziv, K.KomitentIme, K.KomitentPrezime, K.KomitentUserName, K.KomitentId, K.KomitentiSlika", "KO.OpisKomitent", "LS.ImeLokSamo", "Z.ImeZemlja", "TU.OpisTipUsera$jezik", "K.KomitentUPdv");
                $db->where("K.KomitentId", $KomitentIdUser);
                $db->where("KO.IdLanguage", $jezikId);
                $db->join("komitentiopisnew KO", "KO.KomitentId = K.KomitentId", "LEFT");
                $db->join("lokalnasu LS", "LS.IdLokSamo = K.VerifikovanLS", "LEFT");
                $db->join("zemlja Z", "Z.IdZemlja = LS.ZemljaLokSamo", "LEFT");
                $db->join("tipusera TU", "TU.IdTipUsera = K.KomitentTipUsera", "LEFT");
                $komitent = $db->getOne("komitenti K",$cols);


                $KomitentNazivKom = $komitent['KomitentNaziv'];
                $KomitentImeKom = $komitent['KomitentIme'];
                $KomitentPrezimeKom = $komitent['KomitentPrezime'];
                $ImeLokSamoKom = $komitent['ImeLokSamo'];
                $ImeZemljaKom = $komitent['ImeZemlja'];
                $komitentOpisKom = $komitent['KomOpis'.$jezik];
                $KomitentiSlikaKom = $komitent['KomitentiSlika'];
                $KomitentiUserNameKom = $komitent['KomitentUserName'];
                $KomitentIdKom = $komitent['KomitentId'];
                $TipUsera = $komitent['OpisTipUsera'.$jezik];
                $KomitentUPdv = $komitent['KomitentUPdv'];

                            $lokrel = $common->locationslikaOstaloKomitent(KOMSLIKE, $KomitentIdKom);

                            $ext = pathinfo($KomitentiSlikaKom, PATHINFO_EXTENSION);
                            $fileName = pathinfo($KomitentiSlikaKom, PATHINFO_FILENAME);

                            $mala_slika = $fileName . '_srednja.' . $ext;


                            $lok = DCROOT . $lokrel . '/' . $mala_slika;
                            if (file_exists($lok)) {
                                $slikaKomitent = '<img  class="img-responsive" src="' . $lokrel . '/' . $mala_slika . '" alt="">';
                            }

                            if ($KomitentUPdv == '1') {
                                $porezpdv = '<p>'.$jsonlang[290][$jezikId].'</p>';
                            }


                $komArra .= '<p>'.$jsonlang[114][$jezikId].'</p>';
                //$komArra .= '<h3>'.$KomitentNazivKom.'</h3>';
                $komArra .= '<h3>'.$KomitentImeKom.' '.$KomitentPrezimeKom.'</h3>';
                $komArra .= '<p>'.$ImeLokSamoKom.'</p>';
                $komArra .= '<p>'.$ImeZemljaKom.'</p>';
                $komArra .= '<p>'.$TipUsera.'</p>';
                $komArra .= '<p>'.$porezpdv.'</p>';
                $komArra .= '<p>'.$komitentOpisKom.'</p>';


                ?>
<div class="clearfix odvojKategBaner"></div>

<div class="col-xs-6 col-sm-6 col-md-4">
    <?php echo  $slikaKomitent; ?>
</div>
<div class="col-xs-6 col-sm-6 col-md-8">
    <?php echo $komArra; ?>
</div>
