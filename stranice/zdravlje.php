<!-- ========================================= CONTENT ========================================= -->
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="/"><?php echo $jsonlang[27][$jezikId] ?></a></li>
                <li class='active'><?php echo $jsonlang[265][$jezikId] ?></li>
            </ul>
        </div>
        <!-- /.breadcrumb-inner -->
    </div>
    <!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content contact-us">
    <div class="container wow fadeInUp">
        <div class="row ">
            <div class="title">
                <h1><?php echo $jsonOsn[$jezikId]['zdravljeNaslov']; ?></h1>

                <p class="tag-line">
                    <?php echo $jsonOsn[$jezikId]['zdravljeOpis']; ?></p>
            </div>
            <!-- /.title -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->


    <div class="container category-product">
        <div class="row">

            <div class="clearfix"></div>
            <?php require RB_ROOT . '/parts/section/digital/digital-bannerZdravlje.php' ?>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->

<!--    <div class="container">
        <div class="row contact-us">
            <div class="col-md-6 details wow fadeInUp" data-wow-delay="0.2s">
                <h3 style="text-align: center"><?php /*echo $jsonOsn[$jezikId]['zdravljeTbNaslov1']; */?></h3>

                <p style="text-align: justify"> <?php /*echo $jsonOsn[$jezikId]['zdravljeTbOpis1']; */?></p>
            </div>


            <div class="col-md-6 details wow fadeInUp" data-wow-delay="0.2s">
                <h3 style="text-align: center"><?php /*echo $jsonOsn[$jezikId]['zdravljeTbNaslov2']; */?></h3>

                <p style="text-align: justify"> <?php /*echo $jsonOsn[$jezikId]['zdravljeTbOpis2']; */?></p>
            </div>

        </div>

    </div>-->

    <!-- /.container -->
</div><!-- /.body-content -->
<!-- ========================================= CONTENT : END========================================= -->