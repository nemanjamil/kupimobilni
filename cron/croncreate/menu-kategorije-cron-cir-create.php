<?php
/**
 * Project: masinealati
 * Created by PhpStorm.
 * User: Nikola
 * Date: 25. 04. 2016.
 * Time: 16:58
 */
$jez_trenutni = '1';
$ostalo =  'Остале категорије';

$kaL = '';

$upitKateg = "CALL listaKategorijaPoListiIdNew('".KATEGORIJESAJTCRON."',$jez_trenutni,$var_user,0,25)";
$katspGlavne = $db->rawQuery($upitKateg);


if ($katspGlavne){
    foreach ($katspGlavne AS $kay => $val) {
        $KategorijaArtikalaIdMM = $val['KategorijaArtikalaId'];
        $KategorijaArtikalaNazivMM = $val['NazivKategorije'];
        $KategorijaArtikalaLinkMMGlv = $val['KategorijaArtikalaLink'];

        $kaL .= '<div style="width: 20% !important;" class="col-xs-12 col-sm-6 col-md-3">';
        $kaL .= '<h2 class="title font12XXX"><a class="bojacrnadefXXX" href="/'.$KategorijaArtikalaLinkMMGlv.'">'.$KategorijaArtikalaNazivMM.'</a></h2>';

        $upitKateg = "CALL listaKategorijaPoParent($KategorijaArtikalaIdMM,$var_user,$jez_trenutni,0,5)";
        $katspGlavne = $db->rawQuery($upitKateg);
        if ($katspGlavne){
            $kaL .= '<ul class="links">';
            foreach ($katspGlavne AS $kay => $val) {
                $KategorijaArtikalaNazivMM = $val['NazivKategorije'];
                $KategorijaArtikalaLinkMM = $val['KategorijaArtikalaLink'];
                $KategorijaArtikalaIdMM = $val['KategorijaArtikalaId'];
                $KategorijaArtikalaSlika = $val['KategorijaArtikalaSlika'];


                /*$lokrel = $common->locationslikaOstalo(KATSLIKELOK,$KategorijaArtikalaIdMM);
                $ext = pathinfo($KategorijaArtikalaSlika, PATHINFO_EXTENSION);
                $fileName = pathinfo($KategorijaArtikalaSlika, PATHINFO_FILENAME);
                $mala_slika = $fileName . '_172.' . $ext;

                $lok =   $lok = DCROOT.$lokrel.'/'.$mala_slika;
                if (is_file($lok)) {
                    $slikaKategBaner = $lokrel.'/'.$mala_slika;
                    //$slikaKategBaner = '/assets/images/banners/2.jpg';
                } else {
                    $slikaKategBaner = '/assets/images/banners/2.jpg';
                }*/


                $kaL .= '<li>';
                $kaL .= '<a href="/'.$KategorijaArtikalaLinkMM.'">'.$KategorijaArtikalaNazivMM.'</a>';
                //$kaL .= '<img src="'.$slikaKategBaner.'" height="70px" alt="">';
                $kaL .= '</li>';
            }
            $kaL .= '<li>';
            $kaL .= '<a class="bojacrvena" href="/'.$KategorijaArtikalaLinkMMGlv.'">'. $ostalo .'...</a>';
            $kaL .= '</li>';
            $kaL .= '</ul>';
        }
        $kaL .= '</div>';

    }
}



$kateg = fopen(DCROOT . '/cron/crongotovo/kategorije-megamenu-cir-cron.php', 'w+');
fwrite($kateg, $kaL);
fclose($kateg);



