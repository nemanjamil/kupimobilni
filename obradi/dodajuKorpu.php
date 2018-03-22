<?php
require 'proveriAjaxDeny.php';

if ($id && $br) {

    try {
        //$db->setTrace (true);
        $db->startTransaction();


        $db->where ("ArtikalId", $id);
        $user = $db->getOne ("artikli",  "MinimalnaKolArt");
        $minKol = $user['MinimalnaKolArt'];

        if ($minKol>=$br) {
            $br = $minKol;
        }

        $insert_query = Array('IdArtTempArt' => $id, 'KolTempArt' => $br, 'KomiTempArt' => $KomitentId);
        $db->setQueryOption(Array('IGNORE'));
        $idTag = $db->insert('tempart', $insert_query);

        $db->where ("ArtikalId", $id);
        $db->where ("IdLanguage", 5);
        $user = $db->getOne ("artikalnazivnew");
        $ArtikalNaziv = $user['OpisArtikla'];


        if($idTag){
            $error_msg["ok"] = 'Artikal '. $ArtikalNaziv .' je dodat u korpu.';
        } else {
            $error_msg["ok"] = 'Artikal '. $ArtikalNaziv .' se već nalazi u korpi.';
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
    $error_msg["error"] = 'No ID or Qty';
}



echo $m = json_encode($error_msg);
?>

