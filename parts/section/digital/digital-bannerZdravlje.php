<!-- ============================================== DIGITAL BANNER ============================================== -->
<div class="container banner-non-link wow fadeInUp">

    <?php
        $idKateg = 3;
        $od = 0;
        $do = 30;
        $kategZdr = $kategorije->listaZdravljeKategorija($idKateg,$od,$do,$jezik);
        echo $kategZdr;
    ?>



</div><!-- /.container -->
<!-- ============================================== DIGITAL BANNER : END ============================================== -->
