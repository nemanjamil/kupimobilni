<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 05. 08. 2015.
 * Time: 3:32 PM
 */

 require 'proveriAjaxDeny.php';

    if (isset($_POST['idart'])) {  $idart = filter_input(INPUT_POST, 'idart', FILTER_SANITIZE_NUMBER_INT);  } else {  $idart = '';   }

if ($id && $br) {
    try {
          // $db->setTrace (true);
            $db->startTransaction();

            $db->where ("ArtikalId", $idart);
            $user = $db->getOne ("artikli",  "MinimalnaKolArt");
            $minKol = $user['MinimalnaKolArt'];



            if ($minKol>=$br) {
                $br = $minKol;
            }

            $update_query = Array('KolTempArt' => $br);
            $db->where('IdTempArtAuto',$id);

            if ($db->update('tempart', $update_query))
                $error_msg["ok"] = 'Promenjena količina. '. $br. ' kom u korpi.';
            else
                $error_msg["error"] = 'Nije uspela promena količine';



        $db->commit();
        //var_dump($db->trace);


    } catch (Exception $e) {
        // An exception has been thrown
        // We must rollback the transaction
        $db->rollback();
        $error_msg["error"] = 'Uradje roll back';
    }
}
echo $m = json_encode($error_msg)
?>

