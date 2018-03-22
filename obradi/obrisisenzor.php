<?php
//require 'proveriAjaxDeny.php';


$SenzorSifraSenzora = $common->clearvariable($_GET[id]);


if ($SenzorSifraSenzora) {


         $db->where('SenzorSifraSenzora', $SenzorSifraSenzora);
         if($db->delete('senzorizaartikal')) {
             header("Location: " . URLVRATI . "/?e=$error_msg");
            // $error_msg["ok"] = 'OK, obrisano';
         } else {
             $error_msg["error"] = 'Nije obrisano ';
         }

} else {
    $error_msg["error"] = 'Ne hvata Id';
}


echo $m = json_encode($error_msg);


?>