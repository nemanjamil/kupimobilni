<!-- ========================================= CONTENT ========================================= -->
<!--<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li class='active'><a href="/"><?php /*echo $jsonlang[27][$jezikId]; */?></a></li>
            </ul>
        </div>
    </div>
</div>-->

<div class="body-content">
    <div class="container">
        <div class="row blog minvisina">

            <div class="col-md-3 sidebar">

                <?php require RB_ROOT. '/parts/navigation/sidebar/menu-vertical.php'; ?>

                <?php /*require RB_ROOT.'/parts/widgets/sidebar/blog-category.php' */?>
                <?php require RB_ROOT.'/parts/widgets/sidebar/informacije.php'?>
                <?php /*require RB_ROOT.'/parts/widgets/sidebar/archive.php' */?>
                <?php /*require RB_ROOT.'/parts/widgets/sidebar/product-tags.php' */?>
                <?php /*require RB_ROOT.'/parts/widgets/sidebar/gallery.php' */?>
            </div><!-- /.sidebar -->

            <div class="col-md-9">
                <?php require RB_ROOT.'/parts/section/blog/blog-post.php' ?>
                <div class="blog-pagination wow fadeInUp">
                    <?php
                    // ovde mozemo nesto da upisemo
                    // require RB_ROOT.'/parts/section/category/pagination.php'
                    // ?>

                </div><!-- /.pagination -->
            </div><!-- /.col -->


        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.body-content -->
<!-- ========================================= CONTENT : END========================================= -->

