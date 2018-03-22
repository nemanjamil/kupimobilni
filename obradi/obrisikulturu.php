<?php
if ($id) {

    $db->where("IdKulture", $id);
    if($db->delete('kulture')) {
        // OBRISI SVE SLIKE IZ FOLDERA I IZ BAZE
        $lokacija = DCROOT.'/assets/images/kulture/'.$id;
        $stjobr = $common->obrisiFolderodIdRazno($lokacija);
        $error_msg["error"] = 'Obrisana kultura sa id: ' . $id;
    } else {
        $error_msg["error"] = 'Greska pri brisanju kulture';
    }






} else {
    $error_msg["error"] = 'Greska pri brisanju kulture';
}

header("Location: $url");

?>