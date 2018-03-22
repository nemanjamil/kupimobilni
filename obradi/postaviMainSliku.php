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
    $cekiran = 0;
}

if ($id) {
    try {
        // $db->setTrace (true);
        $db->startTransaction();




            $update_query = Array('MainArtikliSlike' => $cekiran);
            $db->where('IdArtikliSlike',$id);

            if ($db->update('artiklislike', $update_query))
                $error_msg["ok"] = 'ok - '.$db->count;
            else
                $error_msg["error"] = 'nije uspelo dodavnanje';



        $db->commit();
        //var_dump($db->trace);


    } catch (Exception $e) {
        // An exception has been thrown
        // We must rollback the transaction
        $db->rollback();
        $error_msg["error"] = 'Uradje roll back';
    }
}

echo $m = json_encode($error_msg);
?>

