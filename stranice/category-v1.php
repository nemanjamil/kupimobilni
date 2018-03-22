<!-- ========================================= CONTENT ========================================= -->

<div class="gray-bg-pattern bounceInUp">
<div class="container">
    <div class="row category-v1 outer-bottom-sm category-page">
        <div class="col-md-3 col-sm-12 sidebar">

            <div class="col-md-12 col-sm-12 col-xs-12 clearfix" style="padding: 0px" > <!--wow fadeInUp data-wow-delay="0.2s"-->
                <?php require RB_ROOT.'/parts/widgets/sidebar/by-category.php' ?>
            </div><!-- /.col -->


            <!--<h3 class="section-title"><?php /*echo $KategorijaArtikalaNaziv; */?></h3>
            <div class="sidebar-filter">
               <?php
/*                    require RB_ROOT . '/parts/widgets/sidebar/sidebar-manufactures.php';
                */?>
            </div>-->
            <!-- /.sidebar-filter -->
            <div class="col-md-12 col-sm-12 sidebar clearfix hidden-xs">
                <p><br></p>
            </div>

            <div class="clearfix"></div>


            <?php // require RB_ROOT.'/parts/widgets/sidebar/product-tags.php' ?>
            <?php require RB_ROOT . '/parts/widgets/sidebar/sidebar-comparision.php' ?>
            <?php // require RB_ROOT . '/parts/widgets/sidebar/sidebar-advertisement.php' ?>
            <?php require RB_ROOT . '/parts/widgets/sidebar/informacije.php' ?>

        </div>
        <!-- /.sidebar -->




        <div class=" col-md-9 col-sm-12 outer-bottom-sm category-content">

            <?php require RB_ROOT . '/parts/section/category/category-page-slider.php' ?>


            <?php require RB_ROOT . '/parts/section/category/listaKategorijeBaneri.php' ?>


            <?php require RB_ROOT.'/parts/section/fashion/fashion-v4-banner-2x.php' ?>
            <div class="clearfix"></div>
            <div class="odvojKategBaner"></div>
            <div class="clearfix"></div>

            <?php require RB_ROOT.'/parts/section/fashion/weekly-featured-v1.php'; ?>

            <div class="clearfix"></div>

            <div>
                <h3><?php echo $KategorijaOpis; ?></h3>
                <p><?php echo $OpisKatTekst; ?></p>
            </div>

            <?php //require RB_ROOT.'/parts/section/fashion/product-slider.php'; ?>

            <?php  // require RB_ROOT.'/parts/section/fashion/fashion-v4-banner-1x.php' ?>



            <?php // require RB_ROOT. '/parts/section/our-brands.php'; ?>
            <!-- /.search-result-container -->

        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div><!-- /.container -->
</div>

<!-- ========================================= CONTENT : END========================================= -->