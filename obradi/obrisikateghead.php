<?php
require 'proveriAjaxDeny.php';


if (isset($id)) {



    $s = "SELECT IdKategHead FROM kateghead WHERE ParentKategHead = $id";
    $kipodKat = $db->rawQuery($s);
    $kolikoredova = $kipodKat[0]['IdKategHead'];

    // ako ima vise od 0 onda ne moze da se obrise
    if ($kolikoredova == 0) {

     try {

            $db->startTransaction();

            $db->where ('IdKategHead', $id);
            $db->where ('ParentKategHead', $br);

            if($db->delete('kateghead')) {
                $error_msg["ok"] = 'Uspesno obrisano';
            } else {
                $error_msg["error"] = 'Nesto ne valja : '.$db->getLastError();
            }

            $db->commit();

        } catch (Exception $e) {

            $db->rollback();
            $error_msg["error"] = 'Uradjen roolBack : '.$db-> $e->getMessage();

        }
    }
    else {
        $error_msg["error"] = 'Ne moze da se obrise. Ima podkagetegorije. Prvo njih obrisi';
    }

} else {
    $error_msg["error"] = 'Nema Id';
}


echo $m = json_encode($error_msg);


?>