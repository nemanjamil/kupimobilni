<?php


if (!$id) {
    $m['tag'] = 'informacije';
    $m['success'] = false;
    $m['error'] = 1;
    $m['error_msg'] = "Nema Id od Kategorije";
    echo $json =  json_encode($m, JSON_UNESCAPED_UNICODE);
}


$upirKh = "CALL listaKatHeadId($id,1,$jezikId,'','');";
$upitHead = $db->rawQuery($upirKh);
if ($upitHead) {

    $m['tag'] = 'informacije';
    $m['success'] = true;
    $m['error'] = 0;
    $m['error_msg'] = "Nema Errora";


    foreach ($upitHead AS $k => $v) {

        $IdKategHead = $v['IdKategHead'];
        $ParentKategHead = $v['ParentKategHead'];
        $LinkKategHead = $v['LinkKategHead'];
        $AktivanKategHead = $v['AktivanKategHead'];
        $MestoKategHead = $v['MestoKategHead'];
        $NaslovKategHead = mb_strtoupper($v['NaslovKategHead'], 'UTF-8');

        $upit = "daLiImaPodkaHead($IdKategHead,0,5)";
        $db->where($upit);
        if ($db->has('kateghead')) {
            $DaliImaPodKat = 1;
        } else {
            $DaliImaPodKat = 0;
        }


        $products['IdKategHead'] = $IdKategHead;
        $products['ParentKategHead'] = $ParentKategHead;
        $products['LinkKategHead'] = $LinkKategHead;
        $products['AktivanKategHead'] = $AktivanKategHead;
        $products['MestoKategHead'] = $MestoKategHead;
        $products['NaslovKategHead'] = $NaslovKategHead;
        $products['DaliImaPodKat'] = $DaliImaPodKat;

        $f[] = $products;

    }

    $m['lista'] = $f;


} else {
    $m['tag'] = 'informacije';
    $m['success'] = false;
    $m['error'] = 2;
    $m['error_msg'] = "Nema Liste";

}


echo $json = json_encode($m, JSON_UNESCAPED_UNICODE);


?>

