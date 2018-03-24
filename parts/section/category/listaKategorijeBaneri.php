<!-- ============================================== FASHION-V3 BANNER ============================================== -->
<div class="banner-link"><!--wow fadeInUp-->
    <div class="row">

        <?php

        $araBankat .= '';
        /*
         *
         * $kategLista dobijamo iz /var/www/masine/parts/widgets/sidebar/by-category.php
         * */
        if ($kategLista) {
            $ik = 1;
            foreach ($kategLista as $k => $v) {

                // 172 x 170
                $KaNazKatId = $v['KategorijaArtikalaId'];
                $kaNazivNazKatSideBar = $v['NazivKategorije'];
                $KatLinKatSideBar = $v['KategorijaArtikalaLink'];
                $KategorijaArtikalaSlika = $v['KategorijaArtikalaSlika'];
                $KategorijaArtikalaKratak = $v['KategorijaArtikalaKratak'];
                $kolikoImaArt = $v['kolikoImaArt'];
                $daLiImaPodKat = ($v['daLiImaPodKat']) ? '+' : $kolikoImaArt;

                $lokrel = $common->locationslikaOstalo(KATSLIKELOK,$KaNazKatId);
                $ext = pathinfo($KategorijaArtikalaSlika, PATHINFO_EXTENSION);
                $fileName = pathinfo($KategorijaArtikalaSlika, PATHINFO_FILENAME);
                //$mala_slika = $fileName . '_172.' . $ext;

                $mala_slika = $fileName . '.' . $ext;

                //$lok =   $lok = DCROOT.$lokrel.'/'.$mala_slika;
                $lok =   $lok = DCROOT.'/'.KATSLIKELOK.'/'.$mala_slika;

                if (is_file($lok)) {
                    //$slikaKategBaner = $lokrel.'/'.$mala_slika;
                    $slikaKategBaner = KATSLIKELOK.'/'.$mala_slika;
                    //$slikaKategBaner = '/assets/images/banners/2.jpg';
                } else {
                    $slikaKategBaner = '/assets/images/banners/2.jpg';
                }


                $araBankat .= '<div class="col-md-4 col-sm-12 banner-3 odvojKategBaner"><div class="wrapper">';
                $araBankat .= '<h5 class=" boldirano category-title"><a class="font14 text-left bojatamnoplava" href="/'.$KatLinKatSideBar.'">'.$kaNazivNazKatSideBar.'</a></h5>';
                    $araBankat .= '<div class="banner-outer">';


                            $araBankat .= '<div class="textKateg col-xs-12">';
                                //$araBankat .= '<h4>'.$daLiImaPodKat.'</h4>';
                                //$araBankat .= '<h2>'.$kaNazivNazKatSideBar.'</h2>';

                            /*$upitKateg = "CALL listaKategorijaPoIdNew($KaNazKatId,1,$tipUsera,$jezikId,0,3);";
                            $kategLista = $db->rawQuery($upitKateg);

                            $rowCount = $db->count;

                            if ($kategLista) {
                                foreach($kategLista as $k => $v){

                                    $KaNazKatId = $v['KategorijaArtikalaId'];
                                    $kaNazivNazKatSideBarMali = $v['NazivKategorije'];
                                    $KatLinKatSideBarMali = $v['KategorijaArtikalaLink'];
                                    $daLiImaPodKat = ($v['daLiImaPodKat']) ? '+' : '';

                                    //$kv .= '<li><a class="active" href="/'.$KatLinKatSideBar.'">'.$kaNazivNazKatSideBar.' <span class="item-count">'.$daLiImaPodKat.'</span></a></li>';
                                    //$araBankat .= '<li><a href="/'.$KatLinKatSideBar.'">'.$kaNazivNazKatSideBar.' <span class="item-count">'.$daLiImaPodKat.'</span></a></li>';
                                     $araBankat .= '<div class="shop-now font12"><a class="bojatamnoplava" href="/'.$KatLinKatSideBarMali.'">'.$kaNazivNazKatSideBarMali.'</a></div>';
                                }

                                if($rowCount > 3 ){
                                    $araBankat .= '<div class="shop-now font12 more"><a class="bojacrvenasajt" href="/'.$KatLinKatSideBar.'">'.$jsonlang[425][$jezikId].'</a></div>';
                                }
                            }*/



                            $araBankat .= '</div>';

                           /* $araBankat .= '<div class="image no-padding col-xs-12">';
                                $araBankat .= '<a href="/'.$KatLinKatSideBar.'" >';
                                                $araBankat .= '<img src="'.$slikaKategBaner.'" alt="#" class="img-responsive">';
                                $araBankat .= '</a>';
                            $araBankat .= '</div>';*/


                    $araBankat .= '</div>';
                $araBankat .= '</div></div>';



                // if ($ik==2) {
                    // $ik=1;
                    // $araBankat .= '<div class="clearfix"></div>';
                // } else {
                    // $ik++;
                // }

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