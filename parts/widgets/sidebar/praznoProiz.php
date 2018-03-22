<?php if ($OpisVerKomit) { ?>
    <!-- ============================================== RELATED PRODUCTS============================================== -->
    <div class="">
        <!--<h5 class="section-titleSSS" style="border-bottom: 1px silver solid">Verifikacija</h5>-->
        <h3 class="section-title" style="border-bottom: 1px silver solid"><?php echo $jsonlang[264][$jezikId]; ?></h3>

        <div class="minvisinaSS">


            <div><?php echo $jsonlang[181][$jezikId]; ?></div>

            <?php if ($OpisVerKomit) { ?>
                <div class="client-info media odvojKategBaner">
                    <!--<div class="media-left">
                        <img src="/assets/images/testimonial/1.jpg" alt="" class="img-responsive" title="Ovo predstavlja nasu ocenu porizvodjaca">
                    </div>-->
                    <!--<div class="media-body client-name">
					<h6>Direkno iz baste</h6>
					<span class="client-company"><?php /*echo $OpisVerKomit; */ ?> <span class="bojacrvenasajt"> </span></span>
				</div>-->

                    <div class="odvojKategBaner"></div>
                    <div class="clearfix">

                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <a href="/assets/images/slikice/assessment.jpg" target="_blank"><img
                                    src="/assets/images/slikice/assessment.jpg" alt="" class="img-responsive"></a>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="okvirKockaEner visinaKockaEner <?php echo $BojaVeriKomi ?> pull-right">
                                <span><?php echo $OcenaVeriKomi; ?></span></div>
                            <div class="strelicaEner pull-right <?php echo $BojaVeriKomi ?>Str"></div>
                        </div>

                    </div>
                    <div class="odvojKategBaner"></div>

                    <h6><?php echo $jsonlang[245][$jezikId]; ?> <a
                            href="/ocenjivanje"><?php echo $jsonlang[247][$jezikId]; ?> </a> <?php echo $jsonlang[248][$jezikId]; ?>
                    </h6>

                </div>
            <?php } ?>


            <div>
            </div>

        </div>
    </div><!-- /.related-products -->
    <div class="odvojKategBaner clearfix"></div>
<?php } ?>



<?php

if ($LokSamoText) { ?>

    <div>
        <h3 class="section-title" style="border-bottom: 1px silver solid"><?php echo $jsonlang[157][$jezikId]; ?></h3>
        <h6><?php echo $jsonlang[158][$jezikId]; ?></h6>

        <div class="client-info media">
            <div class="media-left col-sm-6 col-xs-6">
                <!--<a href="<?php /*echo $LokSamoText; */ ?>">--><img
                    src="/<?php echo LSSLIKE . '/'.$IdLokSamo.'/' .$SlikaLokSamo ?>"
                    alt="" class="img-responsive"><!--</a>-->
            </div>
            <div class="media-body client-name col-sm-6 col-xs-6">
               <h6><?php echo $jsonlang[161][$jezikId]; ?></h6>         <a target="_blank" href="<?php echo $LinkLokSamoa;  ?>">       <span class="client-company"><?php echo $LokSamoText; ?> - <span
                        class="bojacrvenasajt"><?php echo $jsonlang[163][$jezikId]; ?></span></a></span>
            </div>
        </div>
    </div>
    <div class="odvojKategBaner clearfix"></div>

<?php } ?>
