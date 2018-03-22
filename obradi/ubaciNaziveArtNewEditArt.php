<?php
// ova stranica se kaci na stranicu  /var/www/masine/obradi/editartikal.php
$db->where('ArtikalId', $idUbacenogart);
if($db->delete('artikalnazivnew')) {
    $obr = true;
} else {
    $obr = false;
}

if ($artiN) {
    foreach ($artiN as $key => $val) {
        $insert_query = Array('ArtikalId' => $idUbacenogart, 'IdLanguage' => $key, 'OpisArtikla' => $val);
        $db->setQueryOption(Array('IGNORE'));
        $idArtNewInsert = $db->insert('artikalnazivnew', $insert_query);
    }
}

?>