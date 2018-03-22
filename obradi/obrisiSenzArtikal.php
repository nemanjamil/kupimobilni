<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 04. 08. 2015.
 * Time: 12:48
 */

if (isset($id)) {

    $err = $db->where("SenzorZaArtikal", $id);
    $err = $db->delete('senzorizaartikal');
//var_dump($db);
//die;


    if ($err) {
        header("Location:$url");
        $error_msg["id"] = $err;
    } else {
        $error_msg["Greska"] = 'Greska pri brisanju; Senzor Za Artikal id: ' . $id . ', je povezan sa nekim senzorom... obrisati prvo sve senzore za artikal, pa onda sam artikal.';
    }


}

echo $m = json_encode($error_msg);


?>

