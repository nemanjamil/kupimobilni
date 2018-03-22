<!-- ============================================== FASHION-V3 BANNER ============================================== -->
<div class="banner-link"><!--wow fadeInUp-->
    <div class="row">

        <?php

        $upitKateg = "CALL listaKategZdravljeParent($katZdravljeID,0,50)";
        $kategLista = $db->rawQuery($upitKateg);



        $araBankat .= '';
        if ($kategLista) {
            $ik = 1;
            foreach ($kategLista as $k => $v) {

                // 172 x 170
                $KaNazKatId = $v['KategorijaArtikalaIdZdravlje'];
                $kaNazivNazKatSideBar = $v['TekstZdravlje' . $jezik];
                $KatLinKatSideBar = $v['KategorijaArtikalaLinkZdravlje'];
                $KategorijaArtikalaSlika = $v['KategorijaArtikalaSlikaZdravlje'];
                $KategorijaArtikalaKratak = $v['KategorijaArtikalaKratakZdravlje'];
                $daLiImaPodKat = ($v['daLiImaPodKat']) ? '+' : '';

                 $lokrel = $common->locationslikaOstalo(KATSLIKELZDRAVLJE,$KaNazKatId);

                $ext = pathinfo($KategorijaArtikalaSlika, PATHINFO_EXTENSION);
                $fileName = pathinfo($KategorijaArtikalaSlika, PATHINFO_FILENAME);

                $mala_slika = $fileName . '.' . $ext; // _172


                $lok =   $lok = DCROOT.$lokrel.'/'.$mala_slika;
                if (file_exists($lok)) {
                    $slikaKategBaner = $lokrel.'/'.$mala_slika;
                    //$slikaKategBaner = '/assets/images/banners/2.jpg';
                } else {
                    $slikaKategBaner = '/assets/images/banners/2.jpg';
                }


                $araBankat .= '<div class="col-md-6 col-sm-12  banner-3 odvojKategBaner">';
               // $araBankat .= '<h2 class="font21 boldirano"><a class="bojatamnoplava" href="/z/'.$KatLinKatSideBar.'">'.$kaNazivNazKatSideBar.'</a></h2>';
                    $araBankat .= '<div class="banner-outer borderMoj">';


                            $araBankat .= '<div class="text col-md-6 col-xs-12">';
                                //$araBankat .= '<h4>'.$daLiImaPodKat.'</h4>';
                                //$araBankat .= '<h2>'.$kaNazivNazKatSideBar.'</h2>';

                $araBankat .= '<div class="shop-now"><a class="bojatamnoplava" href="/z/'.$KatLinKatSideBar.'">'.$kaNazivNazKatSideBar.'</a></div>';

                //$upitKateg = "CALL listaKategorijaPoIdNew($KategorijaArtikalaIdOS,1,$tipUsera,$jezikId,'','');";
                //$kategLista = $db->rawQuery($upitKateg);

                if ($kategLista) {
                    foreach($kategLista as $k => $v){

                        $KaNazKatId = $v['KategorijaArtikalaId'];
                        $kaNazivNazKatSideBarMali = $v['Kat'.$jezik];
                        $KatLinKatSideBarMali = $v['KategorijaArtikalaLink'];
                        $daLiImaPodKat = ($v['daLiImaPodKat']) ? '+' : '';

                        //$kv .= '<li><a class="active" href="/'.$KatLinKatSideBar.'">'.$kaNazivNazKatSideBar.' <span class="item-count">'.$daLiImaPodKat.'</span></a></li>';
                        //$araBankat .= '<li><a href="/'.$KatLinKatSideBar.'">'.$kaNazivNazKatSideBar.' <span class="item-count">'.$daLiImaPodKat.'</span></a></li>';
                        $araBankat .= '<div class="shop-now"><a class="bojatamnoplava" href="/'.$KatLinKatSideBarMali.'">'.$kaNazivNazKatSideBarMali.'</a></div>';
                    }

                }


                            $araBankat .= '</div>';

                            $araBankat .= '<div class="image col-md-6 col-xs-12">';
                                $araBankat .= '<a href="/z/'.$KatLinKatSideBar.'" >';
                                                $araBankat .= '<img src="'.$slikaKategBaner.'" alt="#" class="img-responsive">';
                                $araBankat .= '</a>';
                            $araBankat .= '</div>';


                    $araBankat .= '</div>';
                $araBankat .= '</div>';



                if ($ik==2) {
                    $ik=1;
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