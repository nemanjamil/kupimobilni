<?php
// ova stranica se kaci na stranicu  /var/www/masine/obradi/editartikal.php
$db->where('IdArtiklaAkon', $idUbacenogart);
if($db->delete('artiklikratakopisnew')) {
    $obr = true;
} else {
    $obr = false;
}

if ($artiKrat) {
    foreach ($artiKrat as $key => $val) {
        $insert_query = Array('IdArtiklaAkon' => $idUbacenogart, 'IdLanguageAkon' => $key, 'OpisKratakOpis' => $val);
        $db->setQueryOption(Array('IGNORE'));
        $idArtNewInsert = $db->insert('artiklikratakopisnew', $insert_query);
    }
}

?>