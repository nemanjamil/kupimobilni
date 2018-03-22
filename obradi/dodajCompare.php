<?php
require 'proveriAjaxDeny.php';

if ($id && $br) {

    try {
        //$db->setTrace (true);
        $db->startTransaction();


        $insert_query = Array(
            'ArtCompareId' => $id,
            'KomitentCompareId' => $br
            );
       // $db->setQueryOption(Array('IGNORE'));
        $idTag = $db->insert('compare', $insert_query);

        if($idTag){
        $error_msg["ok"] = 'OK thanks ';
        } else {
        $error_msg["ok"] = 'In compare';
        }

        if ($idTag){
        $db->commit();
        }
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

