<?php
// ova stranica se kaci na stranicu  /var/www/masine/obradi/editartikal.php
$db->where('ArtikalId', $idUbacenogart);
if($db->delete('artiklitekstovinew')) {
    $obr = true;
} else {
    $obr = false;
}

if ($artiVel) {
    foreach ($artiVel as $key => $val) {
        $insert_query = Array('ArtikalId' => $idUbacenogart, 'LanguageId' => $key, 'OpisArtTekst' => $val);
        $db->setQueryOption(Array('IGNORE'));
        $idArtNewInsert = $db->insert('artiklitekstovinew', $insert_query);
    }
}

?>