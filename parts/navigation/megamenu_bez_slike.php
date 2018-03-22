<!-- ============================================== MEGAMENU ============================================== -->
<div class="yamm-content">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="row">
                <?php

                if ($jezikId == 1) {

                    require('cron/crongotovo/kategorije-megamenu-cir-cron.php');

                } else {

                    require('cron/crongotovo/kategorije-megamenu-lat-cron.php');

                }

                ?>

            </div>

        </div>

    </div>
</div>
<!-- ============================================== MEGAMENU : END ============================================== -->
