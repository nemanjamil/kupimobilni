<div class="body-content">
    <div class="container">
        <div class="row checkout outer-bottom-sm wow fadeInUp">
            <div class="col-md-9 checkout-steps">

                <?php
                if ($ArtikliKupljeniHead) {
                    ?>
                    <form role="form" class="register-form" enctype="multipart/form-data" method="post"
                          action="/akcija.php?action=kupiArtikal">
                        <div class="panel-group" id="accordion-checkout" role="tablist" aria-multiselectable="true">
                            <h3 class="checkout-title"><?php echo $jsonlang[17][$jezikId]; ?> </h3>

                            <!--<div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingOne">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion-checkout" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    <span class="step">1</span><?php /*echo $jsonlang[39][$jezikId]; */ ?>

                                </a>
                            </h4>
                        </div>


                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel"  aria-labelledby="headingOne">
                            <div class="panel-body">
                                <?php /* require RB_ROOT . '/parts/section/checkout/checkout-method.php' */ ?>
                            </div>
                        </div>

                    </div>-->


                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion-checkout"
                                           href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            <span class="step">1</span><?php echo $jsonlang[50][$jezikId]; ?>
                                            <!--/info o kupcu-->
                                        </a>
                                    </h4>
                                </div>
                                <!-- /.panel-heading -->

                                <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel"
                                     aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <?php require RB_ROOT . '/parts/section/checkout/checkout-billing.php' ?>

                                    </div>
                                </div>
                                <!-- /.panel-collapse -->
                            </div>
                            <!-- /.panel -->


                            <!-- <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingThree">
                            <h4 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion-checkout"   href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <span class="step">3</span><?php /*echo $jsonlang[96][$jezikId]; */ ?>
                                </a>
                            </h4>
                        </div>

                        <div id="collapseThree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree">
                            <div class="panel-body">
                                <?php /*require RB_ROOT . '/parts/section/checkout/checkout-shipping.php' */ ?>

                            </div>
                        </div>

                    </div>-->


                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingFour">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion-checkout"
                                           href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                            <span class="step">2</span><?php echo $jsonlang[52][$jezikId]; ?>
                                            <!--/nacin dostave-->
                                        </a>
                                    </h4>
                                </div>
                                <!-- /.panel-heading -->
                                <div id="collapseFour" class="panel-collapse collapse in" role="tabpanel"
                                     aria-labelledby="headingFour">
                                    <div class="panel-body">
                                        <?php require RB_ROOT . '/parts/section/checkout/checkout-shipping-method.php' ?>

                                    </div>
                                </div>
                                <!-- /.panel-collapse -->
                            </div>
                            <!-- /.panel -->


                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingFive">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion-checkout"
                                           href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                            <span class="step">3</span><?php echo $jsonlang[53][$jezikId]; ?>
                                            <!--/informacije o placanju-->
                                        </a>
                                    </h4>
                                </div>
                                <!-- /.panel-heading -->
                                <div id="collapseFive" class="panel-collapse collapse in" role="tabpanel"
                                     aria-labelledby="headingFive">
                                    <div class="panel-body">
                                        <?php echo $jsonOsn[$jezikId]["NacinPlacanjaOsnPodaci"]; ?>

                                    </div>
                                </div>
                                <!-- /.panel-collapse -->
                            </div>
                            <!-- /.panel -->


                            <!--<div class="panel panel-default" name="collapseSix">
                        <div class="panel-heading" role="tab" id="headingSix">
                            <h4 class="panel-title">
                                <a class="collapsed" data-toggle="collapse"   data-parent="#accordion-checkout"
                                   href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                    <span class="step">6</span><?php /*echo $jsonlang[54][$jezikId]; */ ?>

                                </a>
                            </h4>
                        </div>

                        <div id="collapseSix" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingSix">
                            <div class="panel-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                                squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck
                                quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it
                                squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica,
                                craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur
                                butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth
                                nesciunt you probably haven't heard of them accusamus labore sustainable VHS.

                            </div>
                        </div>

                    </div>-->

                            <?php if (1==2) { ?>


                            <div class="panel panel-default" name="collapseSix">
                                <div class="panel-heading" role="tab" id="headingSeve">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion-checkout"
                                           href="#collapseSeve" aria-expanded="false" aria-controls="collapseSeve">
                                            <span class="step">4</span> <?php echo $jsonlang[113][$jezikId]; ?>

                                        </a>
                                    </h4>
                                </div>


                                <div id="collapseSeve" class="panel-collapse collapse in" role="tabpanel"
                                     aria-labelledby="headingSeve">
                                    <div class="panel-body">

                                        <div class="row">

                                            <div class="col-md-12 col-sm-12 guest-login">
                                                <h5 class="checkout-subtitle">  <?php echo $jsonlang[154][$jezikId]; ?></h5>

                                                <?php
                                                $lisProd .= '';
                                                $cols = Array("K.KomitentId", "K.KomitentNaziv", "K.KomitentIme", "K.KomitentPrezime", "K.KomitentMesto", "K.KomitentiSlika");
                                                $db->join("artikli A", "A.ArtikalId = TA.IdArtTempArt");
                                                $db->join("komitenti K", "K.KomitentId = A.ArtikalKomitent");
                                                $db->where("TA.KomiTempArt", $KomitentId);
                                                $db->groupBy("K.KomitentId");
                                                $prodavci = $db->get("tempart TA", null, $cols);
                                                if ($prodavci) {
                                                    foreach ($prodavci as $k => $v):
                                                        $KomitentIdkomi = $v['KomitentId'];
                                                        $KomitentNaziv = $v['KomitentNaziv'];
                                                        $KomitentIme = $v['KomitentIme'];
                                                        $KomitentPrezime = $v['KomitentPrezime'];
                                                        $KomitentMesto = $v['KomitentMesto'];
                                                        $KomitentiSlika = $v['KomitentiSlika'];

                                                        $lokrel = $common->locationslikaOstaloKomitent(KOMSLIKE, $KomitentIdkomi);

                                                        $ext = pathinfo($KomitentiSlika, PATHINFO_EXTENSION);
                                                        $fileName = pathinfo($KomitentiSlika, PATHINFO_FILENAME);

                                                        $mala_slika = $fileName . '_mala.' . $ext;


                                                        $lok = DCROOT . $lokrel . '/' . $mala_slika;
                                                        if (file_exists($lok)) {
                                                            $sliKom = '<img class="img-responsive" src="' . $lokrel . '/' . $mala_slika . '" alt="">';
                                                        } else {
                                                            $sliKom = '<img src="/assets/images/products/98.jpg" class="img-responsive" alt="">';
                                                        }


                                                        // POCETAK sada uzimamo listi artiklala od prodavca

                                                        $cols = Array("A.ArtikalId", "ANN.OpisArtikla", "A.ArtikalLink");
                                                        $db->join("artikli A", "A.ArtikalId = TA.IdArtTempArt");
                                                        $db->join("artikalnazivnew ANN", "ANN.ArtikalId = A.ArtikalId AND ANN.IdLanguage = $jezikId");
                                                        $db->where("TA.KomiTempArt", $KomitentId);
                                                        $db->where("A.ArtikalKomitent", $KomitentIdkomi);

                                                        $artikliProd = $db->get("tempart TA", null, $cols);

                                                        // KRAJ sada uzimamo listi artiklala od prodavca


                                                        $lisProd .= '<div class="product-item-small">';
                                                        $lisProd .= '<div class="row products-small">';

                                                        $lisProd .= '<div class="col-md-4 col-xs-4 product-image">';
                                                        $lisProd .= '<a href="#">' . $sliKom . '</a>';
                                                        $lisProd .= '</div>';


                                                        $lisProd .= '<div class="col-md-4 col-xs-8 product-info">';

                                                        $lisProd .= '<h5><a href="#">' . $KomitentNaziv . '</a></h5>';

                                                        $lisProd .= '<div>';
                                                        $lisProd .= '<div>' . $jsonlang[113][$jezikId] . ' : <b>' . $KomitentIme . '  ' . $KomitentPrezime . '</b></div>';
                                                        $lisProd .= '<div>' . $jsonlang[132][$jezikId] . ' : <b>' . $KomitentMesto . '</b></div>';
                                                        $lisProd .= '</div>';


                                                        $lisProd .= '</div>';


                                                        $lisProd .= '<div class="col-md-4 col-xs-8 product-info">';
                                                        $lisProd .= '<h5><a href="#">' . $jsonlang[244][$jezikId] . '</a></h5>';

                                                        $lisProd .= '<div class="product-price">';
                                                        if ($artikliProd) {
                                                            foreach ($artikliProd as $k => $v):

                                                                $ArtikalId = $v['ArtikalId'];
                                                                $ArtikalNaziv = $v['OpisArtikla'];
                                                                $ArtikalLink = $v['ArtikalLink'];

                                                                $lisProd .= '<div><a class="amount" target="_blank" href="/' . $ArtikalLink . '/' . $ArtikalId . '"><b>' . $ArtikalNaziv . '</b></a></div>';

                                                            endforeach;
                                                        }


                                                        $lisProd .= '</div>';
                                                        $lisProd .= '</div>';

                                                        $lisProd .= '</div>';
                                                        $lisProd .= '</div>';


                                                    endforeach;

                                                    echo $lisProd;

                                                }


                                                ?>


                                                <!-- --><?php
                                                /*                                        $korpaArt = '';
                                                                                        if ($ArtikliKupljeni) {
                                                                                            foreach ($ArtikliKupljeni as $k => $v):
                                                                                                $KolTempArt = $v['KolTempArt'];
                                                                                                $pravaCena = $v['pravaCena'];
                                                                                                $IdArtTempArt = $v['IdArtTempArt'];
                                                                                                $artNazivKorpa = $v['ArtNaz' . $jezik];
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

                                                                                            endforeach;
                                                                                        }

                                                                            */ ?>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->

                                    </div>
                                </div>

                            </div>
                            <?php } ?>



                            <div class="row">
                                <p></p>

                                <div class="col-md-6 col-sm-6 form-rimbus">
                                    <button class="btn-upper btn btn-primary"
                                            type="submit"><?php echo $jsonlang[156][$jezikId]; ?></button>
                                </div>
                                <!-- /.col -->
                            </div>

                        </div>
                    </form>

                <?php } else {
                    echo '<div class="minvisina">Nema podataka</div>';
                } ?>

                <!-- /.panel-group -->
            </div>
            <!-- /.col -->

            <div class="col-md-3 checkout-sidebar">
                <div class="panel-group">
                    <!--<h3 class="checkout-title"><?php /*echo $jsonlang[21][$jezikId]; */ ?></h3>

                    <div class="panel panel-default">
                        <div class="panel-body">
                            <ul class="nav nav-checkout-progress list-unstyled">
                                <li><a href="#"><?php /*echo $jsonlang[56][$jezikId]; */ ?></a></li>
                                <li><a href="#"><?php /*echo $jsonlang[55][$jezikId]; */ ?></a></li>
                                <li><a href="#collapseSix"><?php /*echo $jsonlang[52][$jezikId]; */ ?></a></li>
                                <li><a href="#"><?php /*echo $jsonlang[53][$jezikId]; */ ?></a></li>
                            </ul>

                        </div>

                    </div>-->
                    <!-- /.panel -->
                </div>
                <!-- /.panel-group -->
            </div>
            <!-- /.checkout-sidebar -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</div><!-- /.body-content -->
