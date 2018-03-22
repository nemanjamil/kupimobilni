<section class="blog-slider latest-news-slider"><!--wow fadeIn" data-wow-delay="0.2s-->
    <h3 class="section-title"><?php echo $jsonlang[123][$jezikId]; ?></h3>

    <div class="blog-slider-outer outer-top-xs">
        <div class="blog-single">

            <?php
            if ($jezik == 'srblat') {
                require_once('cron/crongotovo/blog-single-fashion-cron-lat.php');
            } else {
                require_once('cron/crongotovo/blog-single-fashion-cron-cir.php');
            }

            ?>
        </div>
        <!-- /.owl-carousel -->
    </div>
    <!-- /.blog-slider-outer -->
</section><!-- /.blog-slider -->
