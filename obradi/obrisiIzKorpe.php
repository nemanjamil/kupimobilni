<?php
require 'proveriAjaxDeny.php';


if ($id && $br) {


    $db->where ("ArtikalId", $id);
    $db->where ("IdLanguage", 5);
    $user = $db->getOne ("artikalnazivnew");
    $ArtikalNaziv = $user['OpisArtikla'];

    $db->where('IdArtTempArt', $id);
    $db->where('KomiTempArt', $br);

    if($db->delete('tempart')) {
             $error_msg["ok"] = 'Artikal: ' .$ArtikalNaziv . ' je izbačen iz korpe';
         } else {
             $error_msg["error"] = 'Desila se greška. Nije moguće izbaciti artikal iz korpe. Obratite se administratoru sajta.';
         }




} else {
    $error_msg["error"] = 'Nema Id';
}


echo $m = json_encode($error_msg);


?>