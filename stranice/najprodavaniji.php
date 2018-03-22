<?php
/**
 * Project: masine
 * Created by PhpStorm.
 * User: Nikola
 * Date: 22. 02. 2016.
 * Time: 11:23
 */
?>

<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="/"><?php echo $jsonlang[27][$jezikId]; ?></a></li>
                <li class='active'><?php echo $jsonlang[89][$jezikId]; ?></li>
            </ul>
        </div>

        <!-- /.breadcrumb-inner -->
    </div>
    <!-- /.container -->
</div>

<div class="col-md-12 centriraj blog-post wow fadeInUp animated">
    <h2><?php echo $jsonlang[89][$jezikId]; ?></h2>

</div>
<div class="clearfix"></div>


<div class="container">

    <div id="myTabContent" class="tab-content">
        <div class="tab-pane active" id="grid-container">
            <div class="category-product inner-vs">
                <div class="products grid-v1">
                    <?php
                    // ovde je lista artikala
                    require RB_ROOT . '/parts/section/category/category-najprodavaniji.php';


                    ?>

                </div>

            </div>

        </div>
        <!--<div class="tab-pane outer-top-vs active" id="list-container">
                        <div class="category-product ">

                                <?php /*require RB_ROOT . '/parts/section/category/category-v1-list-agro.php'; */?>

                        </div>
                   </div>-->
        <!-- /.tab-pane #list-container -->
    </div>

</div>