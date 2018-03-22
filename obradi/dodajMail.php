<?php
require 'proveriAjaxDeny.php';

if ($email) {

    try {
        //$db->setTrace (true);
        $db->startTransaction();



        $insert_query = Array('EmailAddressMail' => $email);
        $db->setQueryOption(Array('IGNORE'));
        $idTag = $db->insert('email', $insert_query);

        if($idTag){
        $error_msg["ok"] = 'OK thanks ';
        } else {
        $error_msg["ok"] = 'Have mail';
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
    $error_msg["error"] = 'No email';
}



echo $m = json_encode($error_msg);
?>

