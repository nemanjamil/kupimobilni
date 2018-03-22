<!-- ========================================== PRODUCT INFO ========================================= -->
<div class="product-info-panel clearfix" style="border-bottom: 1px solid #DEDEDE;"><!--wow fadeInUp-->

    <!-- Nav tabs -->

    <!--Proizvod opis / review / nacin kupovine / kategorija-->
    <ul class="nav nav-tabs" role="tablist">
        <!-- OPIS -->
        <li role="presentation" class="active"><a href="#description" aria-controls="description" role="tab"
                                                  data-toggle="tab"><?php echo $jsonlang[109][$jezikId]; ?></a></li>


        <li role="presentation"><a href="#review" aria-controls="review" role="tab"
                                   data-toggle="tab"><?php echo $jsonlang[111][$jezikId]; ?></a></li>

        <?php
       /* if ($OcenaVeriKomi) {

           echo '<li role="presentation"><a href="#product-komitent" aria-controls="product-komitent" role="tab"
                                       data-toggle="tab">'. $jsonlang[113][$jezikId].'</a></li>';

        }*/
        ?>

        <li role="presentation" class="hidden-xs"><a href="#product-comment" aria-controls="product-comment" role="tab"
                                                     data-toggle="tab"><?php echo $jsonlang[175][$jezikId]; ?></a></li>

        <li role="presentation" class="hidden-xs"><a href="#product-tags" aria-controls="product-tags" role="tab"
                                                     data-toggle="tab">
                <span
                    itemprop="category"><?php echo $common->limit_text_obican_mb($KategorijaArtikalaNaziv, 30);  /*$jsonlang[176][$jezikId]=opis kategorije*/; ?></span></a>
        </li>

        <li role="presentation"><a href="#product-komentari" aria-controls="product-komentari" role="tab"
                                   data-toggle="tab"><span itemprop="category"><?php echo $jsonlang[415][$jezikId]; ?></span></a></li>

    </ul>
    <!-- /.nav-tabs -->

    <!-- Tab panes -->
    <div class="tab-content clearfix">

        <!-- OPIS -->
        <div role="tabpanel" class="tab-pane fade in active" id="description">
            <div>
                <?php
                require_once('specPodaciArt.php');
                ?>
            </div>

        </div>

        <div role="tabpanel" class="tab-pane fade" id="review">
            <?php
            require RB_ROOT . '/parts/section/blog/review.php';
            ?>
        </div>


        <?php
        // id -> product-komitent
        require('ocenaVeriKomiTent.php');
        ?>
        <div role="tabpanel" class="tab-pane fade hidden-xs" id="product-tags">
            <div class="minvisinaMala">
                <?php echo $OpisKatTekst; ?>
            </div>
        </div>

        <div role="tabpanel" class="tab-pane fade hidden-xs" id="product-komentari">
            <div><?php require RB_ROOT . '/parts/section/blog/blog-comments.php' ?></div>
        </div>


        <div role="tabpanel" class="tab-pane fade hidden-xs" id="product-comment">
            <p><?php require RB_ROOT . '/parts/section/blog/tabelaFaq.php'; ?></p>
        </div>

    </div>
    <!-- /.tab-content -->
</div>
<!-- /.product-info-panel -->
<!-- ========================================== PRODUCT INFO : END ========================================= -->