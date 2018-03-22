<div class="body-content">

    <?php // require RB_ROOT . '/stranice/breadcrump.php'; ?>

    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="/"><?php echo $jsonlang[27][$jezikId]; ?></a></li>
                    <!--<li class='active'>Blog</li>-->
                </ul>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">

            <div class='col-md-3 sidebar wow fadeInUp'>


                <div class="sidebar-module-container">
                    <div class="related-product clearfix">
                        <?php //require RB_ROOT . '/parts/widgets/sidebar/praznoProiz.php' ?>

                        <?php require RB_ROOT . '/parts/widgets/sidebar/sidebar-advertisement.php' ?>
                        <?php require RB_ROOT . '/parts/widgets/sidebar/related-products.php' ?>
                    </div>
                    <!-- /.sidebar-filter -->
                </div>



                <div class="col-md-12 col-sm-6 col-xs-12 outer-top-vs wow fadeIn" data-wow-delay="0.2s">
                    <?php require RB_ROOT . '/parts/widgets/sidebar/clients-say.php'; ?>
                </div>
                <!-- /.col -->


                <!-- /.sidebar-module-container -->
            </div>
            <!-- /.sidebar -->

            <div class=" col-md-9 col-sm-12 outer-bottom-sm">

                <?php  require RB_ROOT.'/parts/section/category/category-page-slider-User.php' ?>
                <div class="clearfix"></div>

                <div class="clearfix">
                    <?php
                    require RB_ROOT . '/parts/section/detail/galerijaKomitent.php';
                    ?>
                </div>


                <div class="controls-product-top outer-top-vs wow fadeInUp">
                    <?php


                /*    // ovde se nalazi paginacija
                    $db->where ('A.KategorijaArtikalId', $KategorijaArtikalaIdOS);
                    $resultsPages = $db->getOne('artikli A','count(*) as totalpages_sve');

                    $currentpage = ($currentpage) ? $currentpage : 1;

                    $konPokKont = $kontrole['limitpostrani'];

                    if (!$konPokKont) { $konPokKont = 20;	}

                    $totalpages_sve = $resultsPages['totalpages_sve'];

                    $pag = '';
                    require RB_ROOT.'/parts/section/category/pagination.php';
                    */

                    //require RB_ROOT.'/parts/section/category/controls-product-item.php' ?>
                </div><!-- /.controls-product-top -->

                <div class="search-result-container">
                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane active " id="grid-container">
                            <div class="category-product  inner-top-xs">
                                <div class="row">

                                    <?php
                                    // ovde je lista artikala
                                    require RB_ROOT . '/parts/section/category/category-prodavac-lista-proizvoda.php';
                                    ?>

                                </div><!-- /.row -->
                            </div><!-- /.category-product -->

                        </div><!-- /.tab-pane -->

                        <div class="tab-pane outer-top-vs"  id="list-container">
                            <div class="category-product ">

                                <?php
                                //require RB_ROOT.'/parts/section/category/category-v1-grid-agro.php';
                                 ?>

                            </div><!-- /.category-product -->
                        </div><!-- /.tab-pane #list-container -->
                    </div><!-- /.tab-content -->

                    <div class="clearfix controls-product-bottom wow fadeInUp">

                        <?php // require RB_ROOT.'/parts/section/category/controls-product-item.php' ?>

                    </div><!-- /.filters-container -->

                </div><!-- /.search-result-container -->

            </div><!-- /.col -->
            <!-- /.details-page -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</div><!-- /.body-content -->