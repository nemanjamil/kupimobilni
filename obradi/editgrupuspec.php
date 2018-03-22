<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 20. 08. 2015.
 * Time: 15:14
 */


foreach ($_POST['grupe'] as $valN => $kN) {
    $artiN[$valN] = filter_var($kN, FILTER_SANITIZE_STRING);
}

if (isset($id)) {


    $updategrupu = Array(
        'OtvZarvSpecGrupe' => $brSpec,
        'MestoSpecGrupe' => $br,
        'OpisSpecGrupe' => $string,
    );

    $db->where("IdSpecGrupe", $id);
    $db->update('specifikacijagrupe', $updategrupu);



    foreach ($artiN as $key => $val) {

        $update_query = Array('NazivSpecGrupe' => $val);
        $db->where('IdSpecGrupe', $id);
        $db->where('IdLanguage', $key);
        if ($db->update('specgrupenaz', $update_query))
            $error_msg = true;
        else
            $error_msg = false;
    }




} else {
    echo 'Greska pri izmeni specifikacije';
    die;
}


header("Location: " . URLVRATI);
?>
