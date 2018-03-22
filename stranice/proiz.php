<div class="body-content">
    <div class="container">
        <div class="row">

            <div class="col-md-9 details-page">

                <?php
                     require RB_ROOT . '/parts/section/detail/product-details.php';
                ?>

                <!--<div class="">
                    <?php
                /*  require RB_ROOT . '/parts/section/detail/galerijaKomitent.php';
                */ ?>
                    </div>-->

                <div class="row blog col-md-12 pozadinasiva1 marginadole10">

                    <?php require RB_ROOT . '/parts/section/blog/blog-comments.php' ?>

                    <div class="col-md-7 ">
                        <?php
                        require RB_ROOT . '/parts/section/blog/blog-write-comments.php';
                        ?>
                    </div>
                    <div class="col-md-5 ">
                        <?php
                        require RB_ROOT . '/parts/section/blog/review-link.php';
                        ?>
                    </div>
                </div>

                <div class="up-sell-products wow fadeInUp">
                    <?php
                    if ($tagArt) {
                        require RB_ROOT . '/parts/section/detail/upsell-products.php';
                    } ?>
                </div>


                <!-- /.up-sell-products -->
            </div>
            <!-- /.details-page -->

            <div class='col-md-3 sidebar no-padding'><!--wow fadeInUp ovo kada izbacimo onda nema onde bele slike-->


                <div class="col-md-12 col-sm-6 col-xs-12">
                    <div class="sidebar-module-container">
                        <div class="related-product clearfix">
                            <?php
                             require RB_ROOT . '/parts/widgets/sidebar/sidebar-comparision.php';
                             //require RB_ROOT . '/parts/widgets/sidebar/praznoProiz.php';
                             require RB_ROOT . '/parts/widgets/sidebar/sidebar-advertisement.php';
                             require RB_ROOT . '/parts/widgets/sidebar/related-products.php';
                            ?>
                        </div>
                    </div>
                </div>


                <div class="col-md-12 col-sm-6 col-xs-12">
                    <?php require RB_ROOT . '/parts/widgets/sidebar/news-letter.php'; ?>
                </div>
                <!-- /.col -->

                <div class="col-md-12 col-sm-6 col-xs-12 outer-top-vs"><!--wow fadeIn" data-wow-delay="0.2s-->
                    <?php require RB_ROOT . '/parts/widgets/sidebar/clients-say.php'; ?>
                </div>
                <!-- /.col -->

                <div class="col-md-12 col-sm-6 col-xs-12">
                    <?php require RB_ROOT . '/parts/widgets/sidebar/blog-single-fashion.php'; ?>
                </div>
                <!-- /.col -->

                <div class="col-md-12 col-sm-6 col-xs-12">
                    <?php  require RB_ROOT . '/parts/widgets/sidebar/single-banner.php'; ?>
                </div>

                <div class="col-md-12 col-sm-6 col-xs-12">
                    <?php require RB_ROOT . '/parts/widgets/sidebar/product-tags.php'; ?>
                </div>


                <!-- /.sidebar-module-container -->
            </div>
            <!-- /.sidebar -->

        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</div><!-- /.body-content -->