<?php

$db->where('IdKategorije', $id);
if($db->delete('kategorijeartikalatekst')) {
    $obr = true;
} else {
    $obr = false;
}

if ($artiN) {
    foreach ($artiN as $key => $val) {
        $insert_query = Array('IdKategorije' => $id, 'IdLanguage' => $key, 'TekstKategorije' => $val);
        $db->setQueryOption(Array('IGNORE'));
        $idArtNewInsert = $db->insert('kategorijeartikalatekst', $insert_query);

        if(!$idArtNewInsert) {
            echo 'fail kod ubacivanje teksta u kategorijeartikalatekst id je '.$id;
            die;
        }

    }
}

?>