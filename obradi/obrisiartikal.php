<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 12. 08. 2015.
 * Time: 20:13
 */


if (isset($_POST['imeartikla'])) {
    $imeartikla = filter_input(INPUT_POST, 'imeartikla', FILTER_SANITIZE_NUMBER_INT);
} else {
    $imeartikla = '';
}

$imeartikla = $common->clearvariable($_POST[imeartikla]);


if (isset($imeartikla)) {
    $obrisiartikal = Array(
        "ArtikalNaziv" => "$imeartikla"
    );


    $err = $db->where("ArtikalId", $id);
    $err = $db->delete('artikli');


    /*
     * Brisemo sa vebsop baze
     */
    $db->where ("ArtikalIdDodatna", $id);
    $user = $db->getOne ("artikli");
    $ArtikalIdDodatna = $user['ArtikalIdDodatna'];
    if ($ArtikalIdDodatna) {
        $db->where('id', $ArtikalIdDodatna);
        if($db->delete('vebsop')) echo 'successfully deleted';
    }

    /*
     * Sada treba da brisemo slike iz tog foldera gde je dati artikal
    */
    $lok = $common->locationslika($location, $id);
    $lokslifol = DCROOT . $lok;
    // brisemo sve slike iz foldera // RIZICNA FUNKCIJA DA NE OBRISMO ROOT FOLDER
    /*if ($idba) {
        $common->rrmdir($lokslifol);
    }*/

    $files = glob($lokslifol."/*");
    foreach ($files as $file) {
        if (is_file($file)) {
            unlink($file);
        }
    }


    if ($err) {
        header("Location:admin/listaartikalauser");
        $error_msg["id"] = $err;
    } else {
        $error_msg["Greska"] = 'Greska pri brisanju; Artikal id: ' . $id . ', ima podatke koji su povezani sa drugim tabelama. Obratite se administratoru sajta.';
    }


    // todo da se brise i iz vebsop baze
    // todo da se brise i iza dodatna oprema baze
}

//echo $m = json_encode($error_msg);


?>