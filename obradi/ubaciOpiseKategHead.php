<?php

foreach ($_POST['TekstHead'] as $valN => $kN) {
    $artiN[$valN] = $common->clearvariableTekst($kN);
}

$db->where('IdKategHead', $IdKategHead);
if($db->delete('kategheadtekstnew')) {
    $obr = true;
} else {
    $obr = false;
}

if ($artiN) {
    foreach ($artiN as $key => $val) {
        $insert_query = Array('IdKategHead' => $IdKategHead, 'IdLanguage' => $key, 'OpisKategHeadTekst' => $val);
        $db->setQueryOption(Array('IGNORE'));
        $idArtNewInsert = $db->insert('kategheadtekstnew', $insert_query);
    }
}

?>