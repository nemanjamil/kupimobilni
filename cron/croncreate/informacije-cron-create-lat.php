<?php
/**
 * Project: masine
 * Created by PhpStorm.
 * User: Nikola
 * Date: 14. 04. 2016.
 * Time: 12:48
 */
$jezikId = '5';
$upirKh = "CALL listaKatHeadId(2,1,$jezikId,NULL,NULL);";
$upitHead = $db->rawQuery($upirKh);
if ($upitHead) {

    $khul = '<ul>';
    foreach ($upitHead AS $k => $v) {

        $IdKategHead = $v['IdKategHead'];
        $ParentKategHead = $v['ParentKategHead'];
        $LinkKategHead = $v['LinkKategHead'];
        $AktivanKategHead = $v['AktivanKategHead'];
        $MestoKategHead = $v['MestoKategHead'];
        $NaslovKategHead = mb_strtoupper($v['NaslovKategHead'], 'UTF-8');
        $khul .= '<li>';
        $khul .= '<a href="/' . $LinkKategHead . '">' . $NaslovKategHead . '</a>';
        $khul .= '</li>';

    }
    $khul .= '</ul>';


}


$fpp = fopen(DCROOT . '/cron/crongotovo/informacije-lat-cron.php', 'w+');
fwrite($fpp, $khul);
fclose($fpp);


