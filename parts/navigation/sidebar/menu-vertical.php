<!-- ============================================== MENU VERTICAL ============================================== -->
<div class="fashion-category">
    <h3 class="section-title"><?php echo $jsonlang[21][$jezikId]; ?></h3>
    <div class="by-category">
        <ul>
                <?php
                if ($jezikId == 5)
                {
                    require_once('cron/crongotovo/kategorijecron-create-kupimobilni.php');
                }
                else
                {
                    require_once('cron/crongotovo/kategorijecron-create-cir-kupimobilni.php');
                }


                ?>


        </ul>
    </div>
</div>


<!-- ============================================== MENU VERTICAL : END ============================================== -->

