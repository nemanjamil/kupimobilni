<?php
require 'proveriAjaxDeny.php';


if (isset($id) && isset($string)) {


    $data = Array (
        'KategorijaArtikalaNaziv' => $string,
        'KategorijaArtikalaLink' => $common->friendly_convert($string)
    );

    $db->where ('KategorijaArtikalaId', $id);


        try {

            $db->startTransaction();

            if ($db->update ('kategorijeartikala', $data)) {
                $error_msg["ok"] = 'Update : '.$db->count.' red';
            } else {
                $error_msg["error"] = 'Nesto ne valja : '.$db->getLastError();
            }
            $db->commit();

        } catch (Exception $e) {
            $db->rollback();
            $error_msg["error"] = 'Uradjen roolBack : '.$db-> $e->getMessage();
        }


} else {
    $error_msg["error"] = 'Nema Id';
}


echo $m = json_encode($error_msg);


?>