<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 04. 08. 2015.
 * Time: 12:48
 */


if (isset($id)) {

    $db->setTrace(true);
    $db->where("IdSpecGrupe", $id);
     if($db->delete('specifikacijagrupe')) {
        echo $e = '?successfully deleted';
    } else {
        echo $e = '?Nesto nije dobro';

    }


    header("Location:$url.$e");
}


?>

