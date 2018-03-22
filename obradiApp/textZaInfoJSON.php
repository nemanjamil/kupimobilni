<?php


if (!$id) {

    $m['tag'] = 'textZaInfoJSON';
    $m['success'] = false;
    $m['error'] = 1;
    $m['error_msg'] = "Nema Id od Kategorije";
    echo json_encode($m, JSON_UNESCAPED_UNICODE);
    die;
}

$keyArt = $db->rawQueryOne("CALL opisTekstHead($id,$jezikId)");


if (!$keyArt) {

    $m['tag'] = 'textZaInfoJSON';
    $m['success'] = false;
    $m['error'] = 2;
    $m['error_msg'] = "Nema Podataka";
    echo json_encode($m, JSON_UNESCAPED_UNICODE);
    die;

}


$m['tag'] = 'textZaInfoJSON';
$m['success'] = true;
$m['error'] = 1;
$m['error_msg'] = "Sve ok";


$ParentKategHead = $keyArt['ParentKategHead'];
$LinkKategHead = $keyArt['LinkKategHead'];
$AktivanKategHead = $keyArt['AktivanKategHead'];
$MestoKategHead = $keyArt['MestoKategHead'];
$NaslovKategHead = $keyArt['NaslovKategHead'];
$DaliImaPodKat = $keyArt['DaliImaPodKat'];
$OpisKategHeadTekst = $keyArt['OpisKategHeadTekst'];

$products['IdKategHead'] = $IdKategHead;
$products['ParentKategHead'] = $ParentKategHead;
$products['LinkKategHead'] = $LinkKategHead;
$products['AktivanKategHead'] = $AktivanKategHead;
$products['MestoKategHead'] = $MestoKategHead;
$products['NaslovKategHead'] = $NaslovKategHead;
$products['DaliImaPodKat'] = $DaliImaPodKat;
$products['OpisKategHeadTekst'] = base64_encode($OpisKategHeadTekst);

$m['podaci'] = $products;

echo json_encode($m, JSON_UNESCAPED_UNICODE);
die;


?>