<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 05. 08. 2015.
 * Time: 3:32 PM
 */

require 'proveriAjaxDeny.php';


if (isset($_POST['cekiran'])) {
    $cekiran = filter_input(INPUT_POST, 'cekiran', FILTER_SANITIZE_NUMBER_INT);
} else {
    $cekiran = '';
}


try {
   // $db->setTrace (true);
    $db->startTransaction();

    if ($cekiran) {
        $insert_query = Array('IdSpecKategorija' => $id, 'IdGrupeSpecKategorija' => $br);
        $db->setQueryOption(Array('IGNORE'));
        $idTag = $db->insert('speckategorija', $insert_query);

        if($idTag){
            $error_msg["ok"] = 'successfully dodato';
        } else {
            $error_msg["error"] = 'nije uspelo dodavnanje';
        }
    } else {

        $db->where('IdSpecKategorija', $id);
        $db->where ("IdGrupeSpecKategorija", $br);
        if($db->delete('speckategorija')) {
            $error_msg["ok"] = 'successfully deleted';
        } else {
            $error_msg["error"] = 'nije uspelo brisanje';
        }
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

