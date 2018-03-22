<div class="body-content">
    <div class="container">
        <div class="row outer-top-sm outer-top-md outer-top-bd  outer-top-xs-nema">

            <div class="col-md-3 sidebar clearfix">
                <?php require RB_ROOT . '/parts/navigation/sidebar/menu-vertical.php'; ?>
                <?php require RB_ROOT . '/parts/widgets/sidebar/digital-by-category.php' ?>
            </div>
            <!-- /.col -->

            <div class="col-md-9">


                <?php


                $db->where("B.BrendLink", $string);
                $users = $db->get("brendovi B", null, "B.BrendId");
                if ($db->count > 0) {
                    $bidListaId = (int)$users[0]['BrendId'];
                }

                $osd = '';
                if ($bidListaId) {

                    $cols = Array("DISTINCT A.KategorijaArtikalId, KA.KategorijaArtikalaLink, KA.KategorijaArtikalaSlika ,KN.NazivKategorije ");
                    $db->join("kategorijeartikala KA", "KA.KategorijaArtikalaId = A.KategorijaArtikalId");
                    $db->join("kategorijeartikalanaslov KN","KN.IdKategorije = KA.KategorijaArtikalaId AND KN.IdLanguage = $jezikId","LEFT");
                    $db->where("ArtikalBrendId", $bidListaId);
                    $db->orderBy("KategorijaArtikalaLink", "ASC");
                    $users = $db->get("artikli A", null, $cols);

                    if ($db->count > 0) {
                        //$osd .= '<ul class="list-inline">';
                        foreach ($users as $user) {

                            $KategorijaArtikalId = $user['KategorijaArtikalId'];
                            $KategorijaArtikalaLink = $user['KategorijaArtikalaLink'];
                            $KategorijaArtikalaSlika = $user['KategorijaArtikalaSlika'];
                            $katJezik = $user['NazivKategorije'];




                            $lokrel = $common->locationslikaOstalo(KATSLIKELOK,$KategorijaArtikalId);

                            $ext = pathinfo($KategorijaArtikalaSlika, PATHINFO_EXTENSION);
                            $fileName = pathinfo($KategorijaArtikalaSlika, PATHINFO_FILENAME);

                            //$mala_slika = $fileName . '_172.' . $ext;
                            $mala_slika = $fileName . '.' . $ext;


                            //$lok = $lok = DCROOT . $lokrel . '/' . $mala_slika;
                            $lok =   $lok = DCROOT.'/'.KATSLIKELOK.'/'.$mala_slika;

                            if (is_file($lok)) {
                                //$slikaKategBaner = $lokrel.'/'.$mala_slika;
                                $slikaKategBaner = KATSLIKELOK.'/'.$mala_slika;
                                //$slikaKategBaner = '/assets/images/banners/2.jpg';
                            } else {
                                $slikaKategBaner = '/assets/images/banners/2.jpg';
                            }


                            $osd .= '<div class="col-md-4 col-xs-6 no-padding margin-top-0px margin-bottom5 visinaBoksa">';
                                $osd .= '<div class="col-md-4 col-xs-4 no-padding"><a href="/'.$KategorijaArtikalaLink.'">
                                <img src="/'.$slikaKategBaner   .'" class="img-responsive"  alt="'.$katJezik.'">
                                </a></div>';
                                $osd .= '<div class="col-md-8 col-xs-8 "><a href="/'.$KategorijaArtikalaLink.'">'.$katJezik.'</a></div>';
                            $osd .= '</div>';

                           /* $osd .= '<li class="col-md-3 col-xs-4 okvirBrend borderMoj2">';
                                $osd .= '<a href="">'.$katJezik.'</a>';
                            $osd .= '</li>';*/



                        }
                        //$osd .= '</ul>';
                    }

                    echo $osd;
                }

                ?>


            </div>
            <!-- /.col -->

        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</div><!-- /.body-content -->
<!-- ========================================= CONTENT : END========================================= -->