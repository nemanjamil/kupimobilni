<!-- ============================================== MENU VERTICAL ============================================== -->
<div class="menu-bar animate-dropdown outer-bottom-xs">
    <div class="menu-verticle">
        <div class="head"><i class="fa fa-bars"></i><?php echo $jsonlang[21][$jezikId]; ?></div>
        <nav class="yamm navbar" role="navigation">

            <ul class="nav">

                <?php
                /*
                 * '' - kategorija parent // moze da stavi i (NULL)
                 * 1 active
                 * 1 vidljiv za MP - 1 ako je vidljiv --- 0 ako nije vidljiv
                 * 0 limit pocetak
                 * 4 limit kraj,4
                 */

                //require('kategorijeSaLeveUpit.php');

                if ($jezikId == 5)
                {
                //require_once('cron/crongotovo/kategorijecron-create.php');
                require_once('kategorije-mika-lat.php');
                }
                else
                {
                //require_once('cron/crongotovo/kategorijecron-create-cir.php');
                require_once('kategorije-mika-cir.php');

                }


                ?>




                <!--<li class="dropdown menu-item no-menu">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">old products <span class="menu-label new-menu hidden-xs">new</span></a>
                </li>-->

            </ul><!-- /.nav -->

        </nav><!-- /.yamm -->
    </div><!-- /.menu-verticle -->
</div><!-- /.menu-bar -->
<!-- ============================================== MENU VERTICAL : END ============================================== -->