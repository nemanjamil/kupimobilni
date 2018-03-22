<?php
/*
 * '' - kategorija parent // moze da stavi i (NULL)
 * 1 active
 * 1 vidljiv za MP - 1 ako je vidljiv --- 0 ako nije vidljiv
 * 0 limit pocetak
 * 4 limit kraj,4
 */

// INICIJELNO SETOVANJE
$tipUsera = 10;  // VP da se vide sve kategorije
$jezik = '5';


$kaL = '';
$upitKateg = "CALL listaKategorijaPoListiIdNew('" . KATEGORIJESAJT . "',$jezik,$tipUsera,0,25)";
$katspGlavne = $db->rawQuery($upitKateg);

if ($katspGlavne) {
    foreach ($katspGlavne AS $kay => $val) {
        $KategorijaArtikalaIdMM = $val['KategorijaArtikalaId'];
        $KategorijaArtikalaNazivMM = $val['NazivKategorije'];
        $KategorijaArtikalaLinkMM = $val['KategorijaArtikalaLink'];

        $daliimapodkatupArray = "SELECT daLiImaPodkat($KategorijaArtikalaIdMM,1,$tipUsera) AS kolikoImaPodkat";
        $kolikoImaPodkatRes = $db->rawQueryOne($daliimapodkatupArray);

        $imaPodkat = $kolikoImaPodkatRes['kolikoImaPodkat'];

        $nomenu = ($imaPodkat) ? '' : 'no-menu';

        $brojDeli = 4;

        $kaL .= '<li class="dropdown menu-item ' . $nomenu . '">';

        $broj = $imaPodkat / $brojDeli;
        $kolikoRed = ceil($broj);

        $kaL .= '<a data-toggle="dropdown" class="dropdown-toggle visina40XXX" href="/' . $KategorijaArtikalaLinkMM . '">' . $KategorijaArtikalaNazivMM . '</a>';


        $kaL .= '<ul class="dropdown-menu mega-menu normal">';
        $kaL .= '<li>';
        $kaL .= '<div class="yamm-content">';


        $limP = 0;
        $limK = $brojDeli;

        for ($i = 0; $i < $kolikoRed; $i++) {

            // $upitKateg = "CALL listaKategorijaPoParent($KategorijaArtikalaIdMM,$jezik,$tipUsera,$limP,$limK)";
            $upitKateg = "CALL listaKategorijaPoParent($KategorijaArtikalaIdMM,$var_user,$jez_trenutni,$limP,$limK)";

            $katspGlavne = $db->rawQuery($upitKateg);
            $kaL .= '<div class="row">';

            if ($katspGlavne) {

                foreach ($katspGlavne AS $kay => $val) {


                    $KategorijaArtikalaIdMM2 = $val['KategorijaArtikalaId'];
                    $KategorijaArtikalaNazivMM2 = $val['NazivKategorije'];
                    $KategorijaArtikalaLinkMM2 = $val['KategorijaArtikalaLink'];

                    $KategorijaArtikalaSlika = $val['KategorijaArtikalaSlika'];

                    $daliimapodkatupArray = "SELECT daLiImaPodkat($KategorijaArtikalaIdMM2,1,$tipUsera) AS kolikoImaPodkat";
                    $kolikoImaPodkatRes = $db->rawQueryOne($daliimapodkatupArray);
                    $imaPodkat = $kolikoImaPodkatRes['kolikoImaPodkat'];


                    $lokrel = $common->locationslikaOstalo(KATSLIKELOK, $KategorijaArtikalaIdMM2);

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


                    $kaL .= '<div class="peraDiv col-sm-3 col-md-3 col-xs-6">';

                    $kaL .= '<div class="col-sm-6 col-md-6 col-xs-6">';
                    $kaL .= '<a href="/' . $KategorijaArtikalaLinkMM2 . '">';
                    $kaL .= '<img src="' . $slikaKategBaner . '" class="img-responsive"  alt="' . $KategorijaArtikalaNazivMM2 . '">';
                    $kaL .= '</a>';
                    $kaL .= '</div>';

                    $kaL .= '<div class="col-sm-6 col-md-6 col-xs-6">';
                    $kaL .= '<div class="title fontPadajuciMeniNaslov"><a href="/' . $KategorijaArtikalaLinkMM2 . '">' . $KategorijaArtikalaNazivMM2 . '</a></div>';
                    $kaL .= '</div>';


                    //$kaL .= '<ul class="links list-unstyled">';

                    // III
                    /* $upitKateg = "CALL listaKategorijaPoParent($KategorijaArtikalaIdMM2,$tipUsera,0,5)";
                     //$katspGlavne = $db->rawQuery($upitKateg);
                     if ($katspGlavneXXX) {
                         foreach ($katspGlavne AS $kay => $val) {
                             $KategorijaArtikalaIdMM3 = $val['KategorijaArtikalaId'];
                             $KategorijaArtikalaNazivMM3 = $val['Kat' . $jezik];
                             $KategorijaArtikalaLinkMM3 = $val['KategorijaArtikalaLink'];
                             $kaL .= '<li><a href="/'.$KategorijaArtikalaLinkMM3.'">'.$KategorijaArtikalaNazivMM3.'</a></li>';
                         }

                     }*/
                    // KRAJ III


                    //$kaL .= '</ul>';
                    $kaL .= '</div>';


                }

            }

            $kaL .= '</div>';

            $limP = $limP + $brojDeli;
            //$limK = $limK + 2;


        }


        $kaL .= '</div>';
        $kaL .= '</li>';
        $kaL .= '</ul>';

        $kaL .= '</li>';

    }
}


$fp = fopen(DCROOT . '/cron/crongotovo/kategorijecron-create.php', 'w+');
fwrite($fp, $kaL);
fclose($fp);

?>

