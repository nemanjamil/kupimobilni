`<?php
require 'proveriAjaxDeny.php';




if (!$id) {
    $error_msg["error"] = 'No ID';
    echo $m = json_encode($error_msg);
    die;
}


try {
    // $db->setTrace (true);
    $db->startTransaction();

    if ($string=='true') {

        $update_query = Array(ACTIVEKATEG => 1);
        $db->where('KategorijaArtikalaId',$id);

        if ($db->update('kategorijeartikala', $update_query))
            $error_msg["ok"] = 'ok - 1 '.$db->count;
        else
            $error_msg["error"] = 'nije uspelo dodavnanje';


    } else {

        $update_query = Array(ACTIVEKATEG => 0);
        $db->where('KategorijaArtikalaId',$id);

        if ($db->update('kategorijeartikala', $update_query))
            $error_msg["ok"] = 'ok - 0 '.$db->count;
        else
            $error_msg["error"] = 'nije uspelo dodavnanje';

    }

    $db->commit();
    //var_dump($db->trace);



} catch (Exception $e) {
    // An exception has been thrown
    // We must rollback the transaction
    $db->rollback();
    $error_msg["error"] = 'Uradje roll back';
}


echo $m = json_encode($error_msg);


?>