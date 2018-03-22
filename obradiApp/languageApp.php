<?php

$m['tag'] = 'languageApp';
$m['success'] = true;
$m['error'] = 0;
$m['error_msg'] = "Nema Errora";


$specPoKategArr = array();


$spacgrupeKat = $db->get("languagejezik", null, $cols);

if ($db->count > 0) {


    foreach ($spacgrupeKat as $k => $v) {

        $IdLanguage = $v['IdLanguage'];
        $NameLanguage = $v['NameLanguage'];
        $ShortLanguage = $v['ShortLanguage'];
        $ActiveLanguage = $v['ActiveLanguage'];

        $spcK['IdLanguage'] = $IdLanguage;
        $spcK['NameLanguage'] = $NameLanguage;
        $spcK['ShortLanguage'] = $ShortLanguage;
        $spcK['ActiveLanguage'] = $ActiveLanguage;


        $f[] = $spcK;
    }

    $m['listaJezik'] = $f;
}

echo json_encode($m, JSON_UNESCAPED_UNICODE);

?>

