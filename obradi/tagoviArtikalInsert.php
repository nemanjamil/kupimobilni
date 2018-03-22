<?php
if ($idTagArr) {
    foreach ($idTagArr as $key) {
        $insert_query = Array('IdTagoviArtikli' => $idUbacenogart, 'IdOdTagovaArt' => $key);
        $db->setQueryOption(Array('IGNORE'));
        $idTag = $db->insert('tagoviartikli', $insert_query);
    }
}