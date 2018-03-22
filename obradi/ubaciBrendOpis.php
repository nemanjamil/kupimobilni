<?php
/**
 * Project: masinealati
 * Created by PhpStorm.
 * User: Nikola
 * Date: 10. 05. 2016.
 * Time: 10:42
 */


foreach ($_POST['BrendOpis'] as $val => $k) {
    $brendO[$val] = filter_var($k, FILTER_SANITIZE_STRING);
}

$db->where('BrendID', $BrendId);
if($db->delete('brendoviopis')) {
    $obr = true;
} else {
    $obr = false;
}

if ($brendO) {
    foreach ($brendO as $key => $val) {
        $insert_query = Array('BrendId' => $BrendId, 'IdLanguage' => $key, 'BrendOpis' => $val);
        $db->setQueryOption(Array('IGNORE'));
        $idOpisNewInsert = $db->insert('brendoviopis', $insert_query);
    }
}

