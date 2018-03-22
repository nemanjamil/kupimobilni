<?php
/**
 * Project: masinealati
 * Created by PhpStorm.
 * User: Nikola
 * Date: 10. 05. 2016.
 * Time: 10:41
 */


foreach ($_POST['BrendIme'] as $valN => $kN) {
    $artiN[$valN] = filter_var($kN, FILTER_SANITIZE_STRING);
}

$db->where('BrendId', $BrendId);
if($db->delete('brendoviime')) {
    $obr = true;
} else {
    $obr = false;
}

if ($artiN) {
    foreach ($artiN as $key => $val) {
        $insert_query = Array('BrendId' => $BrendId, 'IdLanguage' => $key, 'BrendIme' => $val);
        $db->setQueryOption(Array('IGNORE'));
        $idImeNewInsert = $db->insert('brendoviime', $insert_query);
    }
}

