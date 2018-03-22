<?php
/**
 * Project: masine
 * Created by PhpStorm.
 * User: Nikola
 * Date: 18. 02. 2016.
 * Time: 11:29
 */

?>
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="/"><?php echo $jsonlang[27][$jezikId]; ?></a></li>
                <li class='active'><?php echo $jsonlang[375][$jezikId]; ?></li>
            </ul>
        </div>

        <!-- /.breadcrumb-inner -->
    </div>
    <!-- /.container -->
</div>

<div class="col-md-12 centriraj blog-post wow fadeInUp animated">
    <h2><?php echo $jsonlang[375][$jezikId]; ?></h2>

</div>
<div class="clearfix"></div>

<div class="banner-link"><!--wow fadeInUp-->
    <div class="container">

        <?php
        /*$upitBrend = $db->where("BrendSajt", '2');
        $upitBrend = $db->join("BrendoviIme BI", "BI.BrendId = B.BrendId AND BI.IdLanguage = $jezikId", "LEFT");
        // $upitBrend = $db->join("brendoviopis BO", "BO.BrendId = B.BrendId AND BO.IdLanguage = $jezikId", "LEFT");
        $dataBrend = $db->get('Brendovi B');*/

  $dataBrend = $db->rawQuery('CALL listaBrendovaJezikSvi('.$jezikId.',1)');




        if ($dataBrend) {
            $ik = 1;
            foreach ($dataBrend as $k => $v) {


                $BrendId = $v['BrendId'];
                $BrendIme = $v['BrendIme'];
                //$BrendoviOpis = $v['brendoviopis' . $jezik];
                $BrendLink = $v['BrendLink'];
                $BrendOpis = $v['BrendOpis'];
                $BrendSlika = $v['BrendSlika'];
                $BrendActive = $v['BrendActive'];
                $BrendNaslovna = $v['BrendNaslovna'];
                $BrendShow = $v['BrendShow'];
                $BrendSajt = $v['BrendSajt'];

                $lokrel = $common->locationslikaOstalo(BRENDSLIKELOK, $BrendId);

                $ext = pathinfo($BrendSlika, PATHINFO_EXTENSION);
                $fileName = pathinfo($BrendSlika, PATHINFO_FILENAME);

                //$mala_slika = $fileName . '_172.' . $ext;
                $mala_slika = $fileName . '.' . $ext;

                //$lok = DCROOT . $lokrel . '/' . $mala_slika;
                $lok = DCROOT.'/'.BRENDSLIKELOK.'/'.$mala_slika;

                if (is_file($lok)) {
                    //$slikaBrend = $lokrel . '/' . $mala_slika;
                    $slikaBrend = BRENDSLIKELOK.'/'.$mala_slika;
                } else {
                    $slikaBrend = '/assets/images/banners/2.jpg';
                }

                $araBankat .= '<div class="col-md-6 col-sm-12 banner-3 odvojKategBaner">';
        //ovo
                //$araBankat .= '<h2 class="font21 boldirano"><a class="bojatamnoplava" href="/'.$BrendLink.'/b">'.$BrendIme.'</a></h2>';
                $araBankat .= '<div class="banner-outer borderMoj">';


                $araBankat .= '<div class="text col-md-6 col-xs-12">';
        //ili ovo
                $araBankat .= '<h2 class="font21 boldirano"><a class="bojatamnoplava" href="/' . $BrendLink . '/b">' . $BrendIme . '</a></h2>';
                $araBankat .= '</div>';

                // Slika 172 x 170
                $araBankat .= '<div class="image col-md-6 col-xs-12">';
                $araBankat .= '<a href="/' . $BrendLink . '/b" >';
                $araBankat .= '<img src="' . $slikaBrend . '" alt="#" class="img-responsive">';
                $araBankat .= '</a>';
                $araBankat .= '</div>';


                $araBankat .= '</div>';
                $araBankat .= '</div>';


                if ($ik == 2) {
                    $ik = 1;
                    $araBankat .= '<div class="clearfix"></div>';
                } else {
                    $ik++;
                }

            }
        }
        echo $araBankat;
        ?>


        <!--<div class="col-md-4 col-sm-12 banner-3">
            <div class="banner-outer">
                <a href="#">
                    <div class="text">
                        <h4>new design</h4>
                        <h2>fashion</h2>
                        <span class='shop-now'>Shop now </span>
                    </div>
                    <div class="image">
                         <img src="assets/images/banners/2.jpg" alt="#" class="img-responsive">
                    </div>
                </a>
            </div>
        </div>-->


    </div>
    <!-- /.row -->

</div>

<!-- ============================================== FASHION-V3 BANNER : END ============================================== -->
