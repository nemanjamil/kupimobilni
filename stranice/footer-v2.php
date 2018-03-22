<!-- ============================================== FOOTER-v2 ============================================== -->
<footer>
    <div class="footer-v2" itemscope itemtype="http://schema.org/Organization">
        <div class="footer-outer-1">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-3 company-info">
                        <div class="logo">
                            <img height="75px" class="img-responsive" src="/assets/images/logoShone.png" alt="">
                        </div>
                        <p><?php echo $jsonOsn[$jezikId]["OpisOsnPodaci"]; ?></p>

                        <div class="social-network">
                            <h4 class="title"><?php echo $jsonlang[93][$jezikId]; ?></h4>

                            <div class="footer-social">
                                <ul class="social-links list-unstyled list-inline">
                                    <li><a href="<?php echo $jsonOsn[$jezikId]["FbOsnPodaci"]; ?>" target="_blank" class="link"><span
                                                class="icon facebook"><i class="fa fa-facebook"></i></span></a></li>
                                    <!--<li><a href="<?php /*echo $jsonOsn[$jezikId]["GoogleOsnPodaci"]; */?>" class="link"><span
                                                class="icon google-plus"><i class="fa fa-google-plus"></i></span></a>
                                    </li>-->
                                    <li><a href="<?php echo $jsonOsn[$jezikId]["TwitterOsnPodaci"]; ?>" target="_blank" class="link" ><span
                                                class="icon twitter"><i class="fa fa-twitter"></i></span></a></li>

                                    <!--<li><a href="<?php /*echo $jsonOsn[$jezikId]["YoutubeOsnPodaci"]; */?>" class="link"><span class="icon google-plus"><i class="fa fa-youtube"></i></span></a></li>
                                    <li><a href="<?php /*echo $jsonlang[93][$jezikId]; */?>" class="link"><span class="icon pinterest"><i class="fa fa-pinterest"></i></span></a></li>-->

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3 foot-menu information">
                        <div class="foot-menu-outer">
                            <div class="foot-title">
                                <h4 class="title"><?php echo $jsonlang[260][$jezikId]; ?></h4>
                            </div>
                            <div class="list-links">
                                <ul class="foot-link list-unstyled">
                                    <li><a href="/kako-naruciti"><?php echo $jsonlang[257][$jezikId]; ?></a></li>
                                    <li><a href="/info-o-dostavi"><?php echo $jsonlang[52][$jezikId]; ?></a></li>
                                    <li><a href="/nacin-placanja"><?php echo $jsonlang[258][$jezikId]; ?></a></li>
                                    <li><a href="/uslovi-koriscenja"><?php echo $jsonlang[102][$jezikId]; ?></a></li>
                                    <!--<li><a href="/zajednicko-dobro"><?php /*echo $jsonlang[269][$jezikId]; */?></a></li>-->
                                    <!--<li><a target="_blank" href="http://dodatnaoprema.com/">dodatnaoprema.com</a></li>-->
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-3 foot-menu information">
                        <div class="foot-menu-outer">
                            <div class="foot-title">
                                <h4 class="title"><?php echo $jsonlang[94][$jezikId]; ?></h4>
                            </div>
                            <div class="list-links">
                                <ul class="foot-link list-unstyled">
                                    <!--<li><a href="/market"><?php /*echo $jsonlang[190][$jezikId]; */ ?></a></li>-->
                                    <!-- <li><a href="/saveti"><?php /*echo $jsonlang[191][$jezikId]; */ ?></a></li>-->
                                    <li><a href="/o-nama"><?php echo $jsonlang[95][$jezikId]; ?></a></li>
                                    <li><a href="/reklamacije-i-prituzbe"><?php echo $jsonlang[259][$jezikId]; ?></a></li>
                                    <li><a href="/prodajna-mesta"><?php echo $jsonlang[427][$jezikId]; ?></a></li>
                                    <li><a href="/contact-us"><?php echo $jsonlang[58][$jezikId]; ?></a></li>
                                    <!--<li><a href="/ocenjivanje"><?php /*echo $jsonlang[250][$jezikId]; */?></a></li>-->
                                    <!--<li><a href="/proizvodnja"><?php /*echo $jsonlang[103][$jezikId]; */?></a></li>-->
                                    <!--<li><a href="/customSearchCat"><?php /*echo $jsonlang[195][$jezikId]; */?></a></li>-->
                                    <!--<li><a href="/moja-prodaja-masine"><?php /*echo $jsonlang[249][$jezikId]; */?></a></li>-->


                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="contact more-info">
                            <div class="contact-outer">
                                <div class="foot-title">
                                    <h4 class="title"><?php echo $jsonlang[58][$jezikId]; ?></h4>
                                </div>
                                <div class="location media">
									<span class="map icon media-left">
										<i class="fa fa-map-marker"></i>
									</span>

                                    <div class="content media-body">
                                        <address>
                                            <span itemprop="name"><?php echo $jsonOsn[$jezikId]["ImeFirmeOsnPodaci"]; ?></span>
                                            <br>
                                            <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                                                <span itemprop="streetAddress"><?php echo $jsonOsn[$jezikId]["UlicaiBrOsnPodaci"];?></span> ,
                                                <span itemprop="postalCode"><?php echo $jsonOsn[$jezikId]["PosBrOsnPodaci"]; ?></span>
                                                <span itemprop="addressLocality"><?php echo $jsonOsn[$jezikId]["GradOsnPodaci"]; ?></span>
                                            </div>
                                        </address>
                                    </div>
                                </div>
                                <div class="phone-no media">
									<span class="phone icon media-left">
										<i class="fa fa-phone"></i>
									</span>
									<span class="content media-body">
										<span itemprop="telephone" class="contact-no"><?php echo $jsonOsn[$jezikId]["TelefonOsnPodaci"]; ?> </span>
										<span itemprop="telephone" class="contact-no"><?php echo $jsonOsn[$jezikId]["MobTelOsnPodaci"]; ?> </span>
									</span>
                                </div>
                                <div class="email-id media">
									<span class="mail icon media-left">
										<i class="fa fa-envelope"></i>
									</span>
									<span class="content media-body">
										<a href="mailto:<?php echo $jsonOsn[$jezikId]["EmailOsnPodaci"]; ?>" class="email"> <span itemprop="email"><?php echo $jsonOsn[$jezikId]["EmailOsnPodaci"]; ?></span> </a>
									</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /.footer-outer-1 -->

        <div class="footer-outer-2 outer-top-vs">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <ul class="footer-bottom payment-link list-unstyled list-inline">
                            <li> copyright <i class="fa fa-copyright"></i> 2017
                                <a href="http://itclusterserbia.com/"> ITCluster Serbia </a>&nbsp; all the rights
                                reserved.
                            </li>
                            <li>Made in <span style="color: white">Srbija</span>.</li>
                            <!--<li><a href="http://dodatnaoprema.com/" target="_blank">dodatnaoprema.com</a></li>-->
                        </ul>
                    </div>
                    <!--<div class="col-xs-12 col-sm-5 col-md-6 payment-card">
                        <ul class="payment-link list-unstyled list-inline">
                            <li><a href="#"><img src="assets/images/payments/6.png" alt="#"></a></li>
                            <li><a href="#"><img src="assets/images/payments/7.png" alt=""></a></li>
                            <li><a href=""><img src="assets/images/payments/8.png" alt=""></a></li>
                            <li><a href=""><img src="assets/images/payments/9.png" alt=""></a></li>
                            <li><a href=""><img src="assets/images/payments/10.png" alt=""></a></li>
                        </ul>
                    </div>-->
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /.footer-outer-2 -->
    </div>
</footer>
<!-- ============================================== FOOTER-v2 : END ============================================== -->