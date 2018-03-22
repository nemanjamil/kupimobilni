<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 20. 08. 2015.
 * Time: 15:14
 */
require 'proveriAjaxDeny.php';

$cekiran = $_POST['cekiran'];

if ($id && $br) {

    if ($cekiran=='true') {

        $insertData = Array(
            'IdZdravljeArtikli' => $id,
            'IdOdKategZdravlje' => $br
        );

        try {
            $db->startTransaction();
            $idub = $db->insert('povezkatzdravlje', $insertData);
            if ($idub) {
                $db->commit();
                $error_msg["ok"] = 'OK';
            } else {
                $error_msg["error"] = 'No Id';
                $db->rollback();
            }
        } catch (Exception $e) {
            $db->rollback();
        }

    } else {

        $db->where('IdZdravljeArtikli', $id);
        $db->where('IdOdKategZdravlje', $br);
        if($db->delete('povezkatzdravlje')) {
            $error_msg["ok"] = 'OK, obrisano';
        } else {
            $error_msg["error"] = 'Nije obrisano - verovatno je povezano sa nekim artiklom';
        }

    }



} else {
    $error_msg["error"] = 'No id or Br';
}


echo $m = json_encode($error_msg);


?>