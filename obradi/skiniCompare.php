<?php
require 'proveriAjaxDeny.php';

if ($id && $br) {

    try {
        //$db->setTrace (true);
        $db->startTransaction();


        $db->where('ArtCompareId', $id);
        $db->where('KomitentCompareId', $br);
        if($db->delete('compare')) {
            $error_msg["ok"] = 'OK';
        } else {
            $error_msg["ok"] = 'No';
        }

        $db->commit();
        //var_dump($db->trace);

    } catch (Exception $e) {
        // An exception has been thrown
        // We must rollback the transaction
        $db->rollback();
        $error_msg["error"] = 'Roll back';
    }

} else {
    $error_msg["error"] = 'No ID';
}



echo $m = json_encode($error_msg);
?>

