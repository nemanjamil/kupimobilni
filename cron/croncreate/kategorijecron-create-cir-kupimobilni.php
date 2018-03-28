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
$jezikTrenutni = '1';


$kaL = '';

//$upitKateg = "CALL listaKategorijaPoListiIdNew('".KATEGORIJESAJTCRON."',$jezikTrenutni,$tipUsera,0,25)";
$upitKateg = "CALL listaKategorijaPoListiIdNew('1,6',$jez_trenutni,$var_user,0,25)";
$katspGlavne = $db->rawQuery($upitKateg);

if ($katspGlavne){
    foreach ($katspGlavne AS $kay => $val) {
        $KategorijaArtikalaIdMM = $val['KategorijaArtikalaId'];
        $KategorijaArtikalaNazivMM = $val['NazivKategorije'];
        $KategorijaArtikalaLinkMM = $val['KategorijaArtikalaLink'];



        $kaL .= '<li><a href="/'.$KategorijaArtikalaLinkMM.'">'.$KategorijaArtikalaNazivMM.'<span class="item-count"><i class="fa fa-angle-double-right">

</i> </span> </a></li>';



    }
}

$fp = fopen(DCROOT.'/cron/crongotovo/kategorijecron-create-cir-kupimobilni.php', 'w+');
fwrite($fp, $kaL);
fclose($fp);

    ?>

