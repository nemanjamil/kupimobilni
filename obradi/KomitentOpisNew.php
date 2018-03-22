<?php
foreach ($_POST['TekstHead'] as $valN => $kN) {
    $artiN[$valN] = $common->clearvariableTekst($kN);
}

// obrisemo sve postojece tekstove
$db->where('KomitentId', $id);
if($db->delete('komitentiopisnew')) {
    $obr = true;
} else {
    $obr = false;
}

if ($artiN) {
    foreach ($artiN as $key => $val) {
        $insert_query = Array('KomitentId' => $id, 'IdLanguage' => $key, 'OpisKomitent' => $val);
        $db->setQueryOption(Array('IGNORE'));
        $idArtNewInsert = $db->insert('komitentiopisnew', $insert_query);
    }
}

?>