<?php
require 'proveriAjaxDeny.php';


if (isset($id)) {


/*    $s = "SELECT daLiImaPodkat($id) AS kolikoImaPodkat";
    $kipodKat = $db->rawQuery($s);
    $kolikoredova = $kipodKat[0]['kolikoImaPodkat'];
    // ako ima vise od 0 onda moze da se doda nova kategorija
    if ($kolikoredova == 0) {
    } else {
        $error_msg["error"] = 'Ne moze da se obrise. Ima podkagetegorije. Prvo njih obrisi';
    }
  */

     try {

            $db->startTransaction();

            $db->where ('KategorijaArtikalaIdZdravlje', $id);

            if($db->delete('kategorijezdravlje')) {
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
    $error_msg["error"] = 'Nema Id';
}


echo $m = json_encode($error_msg);


?>