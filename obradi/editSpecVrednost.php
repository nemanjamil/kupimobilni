<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 13. 08. 2015.
 * Time: 17:18
 */

foreach ($_POST['grupe'] as $valN => $kN) {
    $artiN[$valN] = filter_var($kN, FILTER_SANITIZE_STRING);
}


if (isset($id)) {


    foreach ($artiN as $key => $val) {

        $update_query = Array('SpecVredNaziv' => $val);
        $db->where('IdSpecVrednosti', $id);
        $db->where('IdLanguage', $key);
        if ($db->update('specvrednaziv', $update_query))
            $error_msg = true;
        else
            $error_msg = false;
    }


} else {
    echo 'Nema Id';
    die;
}

header("Location: " . URLVRATI . "/?e=$error_msg");

?>




