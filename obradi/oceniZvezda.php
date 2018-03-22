<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 05. 08. 2015.
 * Time: 3:32 PM
 */

 require 'proveriAjaxDeny.php';


if ($id && $br) {
    try {
         //$db->setTrace (true);
            $db->startTransaction();




            /*$update_query = Array('ArtikalBrOcena' => $br,'ArtikalBrKlikova' => 'ArtikalBrKlikova + 1');
            $db->where('ArtikalId',$id);*/

            $asd = "UPDATE artikli SET ArtikalBrOcena = ArtikalBrOcena + $br, ArtikalBrKlikova = ArtikalBrKlikova + 1 WHERE  ArtikalId = $id";
            $resutls = $db->rawQuery($asd);

            $error_msg["ok"] = ':) '.$br;

          /*  if ($db->update('artikli', "ArtikalBrOcena = ArtikalBrOcena + $br, ArtikalBrKlikova = ArtikalBrKlikova + 1"))
                $error_msg["ok"] = 'ok';
            else
                $error_msg["error"] = 'nije uspelo dodavnanje';*/



        $db->commit();
        // var_dump($db->trace);


    } catch (Exception $e) {
        // An exception has been thrown
        // We must rollback the transaction
        $db->rollback();
        $error_msg["error"] = 'Uradje roll back';
    }
}
echo $m = json_encode($error_msg)
?>

