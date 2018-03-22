<?php

if (isset($id)) {

    $db->where("IdKulturaSenzor", $id);
    $db->delete('kulturasenzor');

    $error_msg["ok"] = 'Obrisan senzor sa id: ' . $id;
    header("Location:$url");

} else {
    $error_msg["error"] = 'Greska pri brisanju senzora';
}


?>