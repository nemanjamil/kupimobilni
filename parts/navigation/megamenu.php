<!-- ============================================== MEGAMENU ============================================== -->
<div class="yamm-content">
    <div class="row">
        <div class="col-md-8 col-sm-8">
            <div class="row">
                <?php
                /*
                 * '' - kategorija parent // moze da stavi i (NULL)
                 * 1 akcitve
                 * 1 vidljiv za MP - 1 ako je vidljiv --- 0 ako nije vidljiv
                 * 0 limit pocetak
                 * 4 limit kraj,4
                 */
                $kaL = '';
                $upitKateg = "CALL listaKategorijaPoParent('',$tipUsera,0,2)";
                $katspGlavne = $db->rawQuery($upitKateg);

                if ($katspGlavne){
                foreach ($katspGlavne AS $kay => $val) {
                    $KategorijaArtikalaIdMM = $val['KategorijaArtikalaId'];
                    $KategorijaArtikalaNazivMM = $val['Kat'.$jezik];
                    $KategorijaArtikalaLinkMM = $val['KategorijaArtikalaLink'];

                    $kaL .= '<div class="col-xs-12 col-sm-6 col-md-3">';
                    $kaL .= '<h2 class="title"><a class="bojacrnadef" href="/'.$KategorijaArtikalaLinkMM.'">'.$KategorijaArtikalaNazivMM.'</a></h2>';

                    $upitKateg = "CALL listaKategorijaPoParent($KategorijaArtikalaIdMM,$tipUsera,0,100)";
                    $katspGlavne = $db->rawQuery($upitKateg);
                    if ($katspGlavne){
                        $kaL .= '<ul class="links">';
                        foreach ($katspGlavne AS $kay => $val) {
                            $KategorijaArtikalaNazivMM = $val['Kat'.$jezik];
                            $KategorijaArtikalaLinkMM = $val['KategorijaArtikalaLink'];
                            $kaL .= '<li><a href="/'.$KategorijaArtikalaLinkMM.'">'.$KategorijaArtikalaNazivMM.'</a></li>';
                        }
                        $kaL .= '</ul>';
                    }
                    $kaL .= '</div>';

                }
                }
                echo $kaL;
                ?>



            </div><!-- /.row -->
            <?php
            /*
             * '' - kategorija parent // moze da stavi i (NULL)
             * 1 akcitve
             * 1 vidljiv za MP - 1 ako je vidljiv --- 0 ako nije vidljiv
             * 0 limit pocetak
             * 4 limit kraj,4
             */
            $kaL = '';
            $upitKateg = "CALL listaKategorijaPoParent('',$tipUsera,2,4)";
            $katspGlavne = $db->rawQuery($upitKateg);

            if ($katspGlavne){
                foreach ($katspGlavne AS $kay => $val) {
                    $KategorijaArtikalaIdMM = $val['KategorijaArtikalaId'];
                    $KategorijaArtikalaNazivMM = $val['Kat'.$jezik];
                    $KategorijaArtikalaLinkMM = $val['KategorijaArtikalaLink'];

                    $kaL .= '<div class="col-xs-12 col-sm-6 col-md-3">';
                    $kaL .= '<h2 class="title"><a class="bojacrnadef" href="/'.$KategorijaArtikalaLinkMM.'">'.$KategorijaArtikalaNazivMM.'</a></h2>';

                    $upitKateg = "CALL listaKategorijaPoParent($KategorijaArtikalaIdMM,$tipUsera,0,100)";
                    $katspGlavne = $db->rawQuery($upitKateg);
                    if ($katspGlavne){
                        $kaL .= '<ul class="links">';
                        foreach ($katspGlavne AS $kay => $val) {
                            $KategorijaArtikalaNazivMM = $val['Kat'.$jezik];
                            $KategorijaArtikalaLinkMM = $val['KategorijaArtikalaLink'];
                            $kaL .= '<li><a href="/'.$KategorijaArtikalaLinkMM.'">'.$KategorijaArtikalaNazivMM.'</a></li>';
                        }
                        $kaL .= '</ul>';
                    }
                    $kaL .= '</div>';

                }
            }
            echo $kaL;
            ?>

            <div class="row">



            </div><!-- /.col -->
        </div><!-- /.col -->

        <div class="col-sm-4 col-md-4">
            <div class="menu-banner">
                <img class="img-responsive" src="/assets/images/banners/9.jpg" alt="R">
                <span class="line"></span>
                <div class="content">
                    <span class="text text-1">collection</span>
                    <span class="text text-2">women's</span>
                    <span class="text text-3">save up to 25% off</span>
                </div><!-- /.content -->
            </div><!-- /.menu-banner -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.yamm-content -->
<!-- ============================================== MEGAMENU : END ============================================== -->
