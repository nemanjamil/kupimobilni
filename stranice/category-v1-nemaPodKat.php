<!-- ========================================= CONTENT ========================================= -->
<div class="container">
    <div class="row category-v1 outer-bottom-sm">
        <div class="col-md-3 col-sm-12 col-xs-12 sidebar">

            <?php
            if ($ParentKategorijaArtikalaId) {
                $upitKategParent = "CALL nadKategorija($ParentKategorijaArtikalaId,$jezikId);";
                $kategParenLinkUpit = $db->rawQuery($upitKategParent);
                $kategParentLink = $kategParenLinkUpit[0]['KategorijaArtikalaLink'];
                $NazivKategorijeParentLink = $kategParenLinkUpit[0]['NazivKategorije'];
            } else {
                $kategParentLink = '';
            }
            ?>

            <?php
            // ovo je kada imamo jednu glavnu kategoriju pa klikcemo na SPECIFIKACIJE
            require RB_ROOT . '/parts/navigation/sidemenu.php';
            ?>

            <div class="col-md-12 col-sm-12 col-xs-12 no-padding"> <!--wow fadeInUp data-wow-delay="0.2s"-->
                <?php require RB_ROOT . '/parts/widgets/sidebar/by-categoryNemaPodKat.php' ?>
                <div class="visina10"></div>
            </div>
            <!-- /.col -->


            <!--
            OVO NE KORISTIMO ZA SADA
            <div class="sidebar-filter col-md-12 col-sm-12 col-xs-12 no-padding hidden-xs">
                <?php
            /*                //require RB_ROOT.'/parts/widgets/sidebar/sidebar-price-slider.php';
                            require RB_ROOT . '/parts/widgets/sidebar/sidebar-manufactures.php';
                            */ ?>
            </div>-->

            <!-- /.sidebar-filter -->
            <div class="col-md-12 col-sm-12 col-xs-12 no-paddingLevoDesno hidden-xs">

                <?php
                //require RB_ROOT.'/parts/widgets/sidebar/product-tags.php';
                require RB_ROOT . '/parts/widgets/sidebar/sidebar-comparision.php';
                require RB_ROOT . '/parts/widgets/sidebar/sidebar-advertisement.php';

                //require RB_ROOT . '/parts/widgets/sidebar/product-hot-deals.php';

                require RB_ROOT . '/parts/widgets/sidebar/best-seller.php';
                ?>

            </div>
        </div>
        <!-- /.sidebar -->


        <div class="col-md-9 col-sm-12 col-xs-12 outer-bottom-sm">


            <!--<p><?php /*echo '<a class="font12" href="/'.$kategParentLink.'"> <strong> < </strong> '.$NazivKategorijeParentLink.'  </a>'; */ ?></p>-->
            <h1 class="section-title text-left"> <?php echo $KategorijaArtikalaNaziv; ?></h1>


            <?php
            //broj pregleda u bazi
            $dataBrPregleda = Array('KategorijeBrojPregleda' => $KategorijeBrojPregleda + 1);
            $db->where('KategorijaArtikalaId', $KategorijaArtikalaIdOS);
            $db->update('kategorijeartikala', $dataBrPregleda);
            ?>

            <?php // require RB_ROOT.'/parts/section/category/category-page-slider.php' ?>

            <div class="controls-product-top outer-top-vs wow fadeInUp clearfix">
                <?php


                // ovde se nalazi paginacija
                $db->where('A.KategorijaArtikalId', $KategorijaArtikalaIdOS);
                $resultsPages = $db->getOne('artikli A', 'count(*) as totalpages_sve');

                $currentpage = ($currentpage) ? $currentpage : 1;

                $konPokKont = $kontrole['limitpostrani'];

                if (!$konPokKont) {
                    $konPokKont = LIMITPOSTRANI;
                }

                $totalpages_sve = $resultsPages['totalpages_sve'];

                require_once('predUpit.php');
                require_once('predUpitBrend.php');

                $pag = '';
                require RB_ROOT . '/parts/section/category/pagination.php';


                require RB_ROOT . '/parts/section/category/controls-product-item.php' ?>
            </div>
            <!-- /.controls-product-top -->

            <div class="search-result-container">
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane activeXXX" id="grid-container">
                        <div class="category-product  inner-vs">
                            <div class="row" id="ovdeUbaci">

                                <?php
                                // ovde je lista artikala
                                //require RB_ROOT . '/parts/section/category/category-v1-grid-agro2uredu.php';
								require RB_ROOT . '/parts/section/category/category-v1-grid-agro3uredu.php';
                                //require RB_ROOT . '/parts/section/category/category-v1-list-agro.php';
                                ?>

                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.category-product -->

                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane outer-top-vs active" id="list-container">
                        <div class="category-product ">

                            <?php require RB_ROOT . '/parts/section/category/category-v1-list-agro.php'; ?>

                        </div>
                    </div>
                    <!-- /.tab-pane #list-container -->
                </div>
                <!-- /.tab-content -->

                <div class="clearfix controls-product-bottom wow fadeInUp">

                    <?php require RB_ROOT . '/parts/section/category/controls-product-item.php' ?>

                </div>
                <!-- /.filters-container -->

            </div>
            <!-- /.search-result-container -->

            <div class="row ">
                <div class="col-md-12 outer-top-xs">
                    <?php
                    echo $OpisKatTekst;
                    ?>
                </div>
            </div>

        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div><!-- /.container -->


<!-- ========================================= CONTENT : END========================================= -->