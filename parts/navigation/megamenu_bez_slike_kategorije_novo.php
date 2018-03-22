<?php

$var_user = '2';
define('KATEGORIJESAJT', '11185, 11192, 11184, 11182');
$jez_trenutni = '5';
$ostalo =  'Ostale kategorije';

$kaL = '';

$upitKateg = "CALL listaKategorijaPoListiIdNew('".KATEGORIJESAJT."',$jez_trenutni,$var_user,0,25)";


$katspGlavne = $db->rawQuery($upitKateg);

if ($katspGlavne){
    foreach ($katspGlavne AS $kay => $val) {
        $KategorijaArtikalaIdMM = $val['KategorijaArtikalaId'];
        $KategorijaArtikalaNazivMM = $val['NazivKategorije'];
        $KategorijaArtikalaLinkMMGlv = $val['KategorijaArtikalaLink'];

        $kaL .= '<div style="width: 20% !important;" class="col-xs-12 col-sm-6 col-md-3 visinaKategMeni">';

        $upitKateg2 = "CALL listaKategorijaPoParent($KategorijaArtikalaIdMM,$var_user,$jez_trenutni,0,5)";
        $katspGlavne = $db->rawQuery($upitKateg2);
        if ($katspGlavne){
            $kaL .= '<ul class="links">';
            foreach ($katspGlavne AS $kay => $val) {
                $KategorijaArtikalaNazivMM = $val['NazivKategorije'];
                $KategorijaArtikalaLinkMM = $val['KategorijaArtikalaLink'];
                $KategorijaArtikalaIdMM = $val['KategorijaArtikalaId'];
                $KategorijaArtikalaSlika = $val['KategorijaArtikalaSlika'];


                $KategorijaArtikalaNazivMM = $common->limit_text_obican_mb($KategorijaArtikalaNazivMM, 30);

                $kaL .= '<li>';
                $kaL .= '<a href="/'.$KategorijaArtikalaLinkMM.'">'.$KategorijaArtikalaNazivMM.'</a>';
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

echo $kaL;