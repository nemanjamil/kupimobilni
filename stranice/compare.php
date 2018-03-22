<!-- ========================================= CONTENT ========================================= -->
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="/"><?php echo $jsonlang[27][$jezikId]; ?></a></li>
                <li class='active'><?php echo $jsonlang[74][$jezikId]; ?></li>
            </ul>
        </div>
        <!-- /.breadcrumb-inner -->
    </div>
    <!-- /.container -->
</div><!-- /.breadcrumb -->

<?php
$cols = Array ("AN.ArtikalId", "AN.OpisArtikla", "A.ArtikalLink" );
$db->join("artikli A", "A.ArtikalId = C.ArtCompareId");
$db->join("artikalnazivnew AN", "C.ArtCompareId = AN.ArtikalId  AND  AN.IdLanguage = $jezikId");
$db->where("C.KomitentCompareId", $KomitentId);
$KompaDB = $db->get ("compare C", Array (0, 10), $cols);
if ($KompaDB) {
?>
<div class="body-content contact-us">
    <div class="container wow fadeInUp">
        <div class="row ">
            <div class="title">
                <h1><?php echo $jsonlang[74][$jezikId]; ?></h1>

                <p class="tag-line"><?php echo $jsonlang[199][$jezikId]; ?></p>
            </div>
            <!-- /.title -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
    <div class="container">
        <div class="row contact-us minvisina">
    <?php

    foreach ($KompaDB as $k => $v):
        $nazivKompre = $v['OpisArtikla'];
        $idKompare = $v['ArtikalId'];
        $ArtikalLinkKompare = $v['ArtikalLink'];
        $linkKoma = '/' . $ArtikalLinkKompare . '/' . $idKompare;


            $comparearr .= '<div class="col-md-6 col-xs-12 col-sm-6 col-lg-6 details wow fadeInUp" data-wow-delay="0.2s">';
                $comparearr .= '<h3><a target="_blank" href="' . $linkKoma . '">' . $nazivKompre . '</a></h3>';



// ARTIKLI SLIKE

    $cols = Array ("IdArtikliSlike", "ImeSlikeArtikliSlike");
    $db->where('IdArtikliSlikePov',$idKompare);
    $db->where('MainArtikliSlike',1);
    $db->orderBy("MainArtikliSlike","DESC");
    $slikeArtikla = $db->get ("artiklislike", Array(0,1), $cols);
    $lokFolder = $common->locationslika($idKompare);
    $slSve = '';
    $sli = 1;
        $comparearr .= '<div id="owl-single-productXXX">';

            foreach($slikeArtikla as $sl => $vs):
                $ImeSlikeArtikliSlike = $vs['ImeSlikeArtikliSlike'];
                $IdArtikliSlike = $vs['IdArtikliSlike'];
                $ext = pathinfo($ImeSlikeArtikliSlike, PATHINFO_EXTENSION);
                $fileName = pathinfo($ImeSlikeArtikliSlike, PATHINFO_FILENAME);
                $mala_slika = $lokFolder . '/' . $fileName . '_mala.' . $ext;
                $srednja_slika = $lokFolder . '/' . $fileName . '_srednja.' . $ext;
                $velika_slika = $lokFolder . '/' . $ImeSlikeArtikliSlike;

                $comparearr .= '<div class="single-product-gallery-item" id="slide'.$sli.'">';
                $comparearr .= '<a data-lightbox="imagegroupart" data-title="Gallery" href="'.$velika_slika.'">';
                $comparearr .= '<img class="img-responsive" alt="" src="'.$srednja_slika.'" data-echo="'.$srednja_slika.'" />';
                $comparearr .= '</a>';
                $comparearr .= '</div>';
                $sli++;
            endforeach;

            $comparearr .= '</div>';

            $sli = '';

// KRAJ ARTIKLI SLIKE


// SPECIFIKACIJE

                $co = Array("SG.*");
                $db->join("specifikacijagrupe SG", "SG.IdSpecGrupe = SAP.IdSpecArtikalGrupaPove");
                $db->where("SAP.IdSpecArtikalPov", $idKompare);
                $specGrupe = $db->get ("specartikalpov SAP", null, $co);
              if ($specGrupe) {
                  $comparearr .= '<div class="row border">';
                    $comparearr .= '<div class="col-xs-12 col-sm-12 col-md-12">';
                        $comparearr .= '<table class="table ">';

                            $comparearr .= '<tbody>';

                            $sd ='';
                            foreach ($specGrupe as $k => $v):
                                $IdSpecGrupe = $v['IdSpecGrupe'];
                                $ImeSpecGrupe =$v['Grupe'.$jezik];

                               // $co = Array("SV.IdSpecVrednosti","SV.IdSpecVrednostiIme");
                                 $co = Array("SV.*");
                                $db->join("specvrednosti SV", "SV.IdSpecVrednosti = SAP.IdSpecArtikalPovIme");
                                $db->where("SAP.IdSpecArtikalPov", $idKompare);
                                $db->where("SAP.IdSpecArtikalGrupaPove", $IdSpecGrupe);
                                $specGrupeVre = $db->getOne("   specartikalpov SAP", null, $co);

                                $comparearr .='<tr>';
                                    $comparearr .='<td>'.$ImeSpecGrupe.'</td>';
                                    $comparearr .='<td>=></td>';
                                    $comparearr .='<td>'.$specGrupeVre['Vre'.$jezik].'</td>';
                                $comparearr .='</tr>';

                            endforeach;


                  $comparearr .='</tbody>';
                  $comparearr .='</table>';
                  $comparearr .='</div>';

                  $comparearr .='</div>';
              }

// KRAJ  SPECIFIKACIJE


                //$comparearr .= '<div>asd</div>';

            $comparearr .= '</div>';


    endforeach;

    echo $comparearr;
        ?>


        </div>
    </div>
    <!-- /.container -->
</div>

    <?php } ?>