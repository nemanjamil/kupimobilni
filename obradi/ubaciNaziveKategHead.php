<?php

foreach ($_POST['NazivKategHead'] as $valN => $kN) {
    $artiN[$valN] = filter_var($kN, FILTER_SANITIZE_STRING);
}

$db->where('IdKategHead', $IdKategHead);
if($db->delete('kategheadnaslov')) {
    $obr = true;
} else {
    $obr = false;
}

if ($artiN) {
    foreach ($artiN as $key => $val) {
        $insert_query = Array('IdKategHead' => $IdKategHead, 'IdLanguage' => $key, 'NaslovKategHead' => $val);
        $db->setQueryOption(Array('IGNORE'));
        $idArtNewInsert = $db->insert('kategheadnaslov', $insert_query);
    }
}

?>