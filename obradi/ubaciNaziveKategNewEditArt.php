<?php

$db->where('IdKategorije', $id);
if($db->delete('kategorijeartikalanaslov')) {
    $obr = true;
} else {
    $obr = false;
}

if ($artiN) {
    foreach ($artiN as $key => $val) {
        $insert_query = Array('IdKategorije' => $id, 'IdLanguage' => $key, 'NazivKategorije' => $val);
        $db->setQueryOption(Array('IGNORE'));
        $idArtNewInsert = $db->insert('kategorijeartikalanaslov', $insert_query);
    }
}

?>