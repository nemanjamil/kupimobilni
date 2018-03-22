<?php
require 'proveriAjaxDeny.php';


if ($id) {


         $db->where('IdSpecVrednosti', $id);
         if($db->delete('specvrednosti')) {
             $error_msg["ok"] = 'OK, obrisano';
         } else {
             $error_msg["error"] = 'Nije obrisano - verovatno je povezano sa nekim artiklom';
         }




} else {
    $error_msg["error"] = 'Nema Id';
}


echo $m = json_encode($error_msg);


?>