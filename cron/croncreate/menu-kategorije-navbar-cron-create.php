<?php
/**
 * Project: masinealati
 * Created by PhpStorm.
 * User: Nikola
 * Date: 25. 04. 2016.
 * Time: 17:33
 */

$jez_trenutni = '5';
$ostalo = 'Ostale kategorije';

$kaL = '';

$upitKateg = "CALL listaKategorijaPoListiIdNew('" . KATEGORIJESAJTCRON . "',$jez_trenutni,$var_user,0,50)";
$katspGlavne = $db->rawQuery($upitKateg);
$prikaz = '';

if ($katspGlavne) {
    foreach ($katspGlavne AS $kay => $value) {
        $KategorijaArtikalaIdMM = $value['KategorijaArtikalaId'];
        $KategorijaArtikalaNazivMM = $value['NazivKategorije'];
        $KategorijaArtikalaLinkMMGlv = $value['KategorijaArtikalaLink'];

        $prikaz .= '<li class="dropdown yamm">'; //yamm-fw

        $prikaz .= '<a href="'.$KategorijaArtikalaLinkMMGlv.'" class="dropdown-toggle" data-hover="dropdown"
                        data-toggle="dropdown">'.$KategorijaArtikalaNazivMM.'</a>'; //data-hover="dropdown"

        $prikaz .= '<ul class="dropdown-menu pages fadeInUp animated animatedfadeInUp">'; //animatedfadeInUp

        $prikaz .= '<li>';

        $prikaz .= '<div class="yamm-content">';
        $prikaz .= '<div class="row">';
        $prikaz .= '<div class="col-xs-12 col-md-7 col-sm-7">';

     echo    $upitKateg2 = "CALL listaKategorijaPoParent($KategorijaArtikalaIdMM,$var_user,$jez_trenutni,0,50)";
        $katspGlavne2 = $db->rawQuery($upitKateg2);
        $count = $db->count;

        if ($katspGlavne2) {

            $prikaz .= '<ul class="links">';

            foreach ($katspGlavne2 AS $key => $val) {
                $KategorijaArtikalaNazivMMala = $val['NazivKategorije'];
                $KategorijaArtikalaLinkMMala = $val['KategorijaArtikalaLink'];
                $KategorijaArtikalaIdMMala = $val['KategorijaArtikalaId'];
                $KategorijaArtikalaSlikaMala = $val['KategorijaArtikalaSlika'];

                $KategorijaArtikalaNazivMMala = $common->limit_text_obican_mb($KategorijaArtikalaNazivMMala, 30);

                $prikaz .= '<li>';
                $prikaz .= '<a href="/' . $KategorijaArtikalaLinkMMala . '">' . $KategorijaArtikalaNazivMMala . '</a>';
                $prikaz .= '</li>';
            }

            /*if($count >= 9){
                $prikaz .= '<li>';
                $prikaz .= '<a class="bojacrvena" href="/' . $KategorijaArtikalaLinkMMGlv . '">' . $ostalo . '...</a>';
                $prikaz .= '</li>';
            }*/
            $prikaz .= '</ul>';


        }
        $prikaz .= '</div>';


        $podaIn = $db->rawQueryOne("SELECT svePodkat($KategorijaArtikalaIdMM) as svePodk");

        $podIn = rtrim($podaIn['svePodk'], ",");

        $podInUpitu = ($podIn) ? 'A.KategorijaArtikalId IN ('.$podIn.') AND ' : '';



        $upitPodKateg = "SELECT A.*, ANN.OpisArtikla, SL.ImeSlikeArtikliSlike FROM artikli A
                         JOIN artiklislike SL ON SL.IdArtikliSlikePov = A.ArtikalId AND SL.MainArtikliSlike = 1
                         JOIN artikalnazivnew ANN ON ANN.ArtikalId = A.ArtikalId AND ANN.IdLanguage = $jez_trenutni
                         WHERE $podInUpitu
                         A.ArtikalMPCena > 0
                         AND A.ArtikalVPCena > 0
                         ORDER BY RAND()
                         LIMIT 1";

        $podaci = $db->rawQueryOne($upitPodKateg);

        $ArtikalIdPod = $podaci['ArtikalId'];
        $ArtikalLinkPod = $common->linkoDoArt($ArtikalIdPod);

        $ArtikalNazivPod = $podaci['OpisArtikla'];
        $ImeSlikeArtikliSlikePod = $podaci['ImeSlikeArtikliSlike'];


        $lokFolder = $common->locationslika($ArtikalIdPod);


        $ext = pathinfo($ImeSlikeArtikliSlikePod, PATHINFO_EXTENSION);
        $fileName = pathinfo($ImeSlikeArtikliSlikePod, PATHINFO_FILENAME);

        $mala_slikaPod = $lokFolder . '/' . $fileName . '_mala.' . $ext;
        $srednja_slikaPod = $lokFolder . '/' . $fileName . '_srednja.' . $ext;
        $maloVeca_slikaPod = $lokFolder . '/' . $fileName . '_maloVeca.' . $ext;
        $velika_slikaPod = $lokFolder . '/' . $ImeSlikeArtikliSlikePod;

        $maloVeca_slikaPod = $common->nemaSlike($maloVeca_slikaPod);



        if($podaci){

            $prikaz .=' <div class="col-sm-5 col-md-5">';
            $prikaz .='<a href="'.$ArtikalLinkPod.'">';
            $prikaz .='<div class="menu-banner">';
            $prikaz .='<img class="img-responsive" src="'.$maloVeca_slikaPod.'" alt="R">';
            $prikaz .='<span class="line"></span>';
            $prikaz .='<div class="content">';
            $prikaz .='<span class="text text-2">'.$ArtikalNazivPod.'</span>';
            $prikaz .='<span class="text text-1">Promo</span>';
            //$prikaz .='<span class="text text-3">save up to 25% off</span>';
            $prikaz .='</div>';
            $prikaz .='</div>';
            $prikaz .='</a>';
            $prikaz .='</div>';

        }

        $prikaz .= '</div>';
        $prikaz .= '</div>';


        $prikaz .= '</li>';
        $prikaz .= '</ul>';
        $prikaz .= '</li>';



    }

}
$kategNew = fopen(DCROOT . '/cron/crongotovo/menu-kategorije-navbar-cron.php', 'w+');
fwrite($kategNew, $prikaz);
fclose($kategNew);



