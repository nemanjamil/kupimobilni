<?php
require 'proveriAjaxDeny.php';


if (isset($string) && $id && $br) {

    $part = explode('.',$string);
    $lokFolder = $common->locationslikaOstaloGalKomitent(KOMSLIKE,$id);
    $likDoslike = $lokFolder . '/' . $string;
    $apLdSl = DCROOT . '/' . $likDoslike;


    $ext = pathinfo($string, PATHINFO_EXTENSION);
    $fileName = pathinfo($string, PATHINFO_FILENAME);

    $mala_slika = DCROOT.$lokFolder.'/'.$fileName . '_mala.' . $ext;
    $srednja_slika = DCROOT.$lokFolder.'/'.$fileName . '_srednja.' . $ext;



     if (file_exists($apLdSl)) {

         try {

             $db->startTransaction();

             $db->where ('IdKomitentiSlike', $br);
             if($db->delete('komitentislike')) {

                 // brisemo sliku
                 unlink($apLdSl);

                 if (file_exists($mala_slika)) {  unlink($mala_slika); }
                 if (file_exists($srednja_slika)) {  unlink($srednja_slika); }
                 $error_msg["ok"] = 'Uspesno obrisano';


             } else {
                 $error_msg["error"] = 'Nesto ne valja : '.$db->getLastError();
             }

             $db->commit();

         } catch (Exception $e) {

             $db->rollback();
             $error_msg["error"] = 'Uradjen roolBack : '.$db-> $e->getMessage();

         }


     } else {
         $db->where('IdKomitentiSlike', $br);
         $db->delete('komitentislike');
         $error_msg["error"] = 'Nema Slike ali smo obrisali iz baze';
     }


} else {
    $error_msg["error"] = 'Nema Id';
}


echo $m = json_encode($error_msg);


?>