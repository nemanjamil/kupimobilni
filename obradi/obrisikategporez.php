<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 24.11.15.
 * Time: 16.55
 */


$IdPdvKategZemlja = $common->clearvariable($_POST[IdKulLokPodaci]);

if (isset($IdPdvKategZemlja)) {

    $db->where("IdPdvKategZemlja", $id);
    $db->delete('pdvkategzemlja');

    $error_msg["ok"] = 'Obrisana kategorija sa id: ' . $id;
    header("Location:$url");
} else {
    $error_msg["error"] = 'Greska pri brisanju kategorije';
}
echo $m = json_encode($error_msg);
?>