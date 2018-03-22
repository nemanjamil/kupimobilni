<div id="wrapper" class="rimbus">


    <?php
    require RB_ROOT . '/stranice/header-v5.php';

    // uvlacimo stranicu  // ovde treba da stavimo body content pa : contact-us, d
    if ($stranica) {

        echo '<div class="body-content  outer-top-xs-nema"><!-- /.body-content -->'; //outer-top-xs outer-top-sm
        require RB_ROOT . '/stranice/breadcrump.php';

        // ovo dobijamo iz /stranice/opisivacstrane.php
        if ($KategorijaArtikalaIdOS) {
            // uvucemo stranicu kategorije

            if ($imaPodkat) {

                require RB_ROOT.'/stranice/category-v1.php';

            } else {
                // ovde je lista artikala

                switch ($stranica) {

                    case "proiz":
                        require 'stranice/proiz.php';
                        break;
                    case "kategorija":
                        require 'stranice/category-v1-nemaPodKat.php';
                        break;

                    default:
                        require 'stranice/category-v1-nemaPodKat.php?e=nestoJefail';
                }
            }

        } else {

            if (file_exists('stranice/' . $stranica . '.php')) {
                require 'stranice/' . $stranica . '.php';
            } else {
                require 'stranice/error.php';
            }

        }
        echo '</div>';

    } else {
        // ako ne postoji stranica onda ide pocetna
        require_once RB_ROOT . '/pages/fashion-v5.php';
    }

    // uvlacimo footer
    /*$footer_style = isset( $_GET['f'] ) ? $_GET['f'] : 1;*/
    require RB_ROOT . '/stranice/footer-v2.php';
    ?>
</div>