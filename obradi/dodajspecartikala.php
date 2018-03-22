<?php
/**
 * Created by PhpStorm.
 * User: NemanjaMilivojevic
 * Date: 8.8.15.
 * Time: 08.24
 */
require 'proveriAjaxDeny.php';


if (isset($id)) {


    $cols = Array ("IdSpecGrupe", "ImeSpecGrupe");
    $db->join("specifikacijagrupe sg", "sg.IdSpecGrupe=s.IdGrupeSpecKategorija");
    $db->where ('s.IdSpecKategorija', $id);
    $upit = $db->get ("speckategorija s", null, $cols);


    if ($upit){

        foreach ($upit as $key => $val){
            $IdSpecGrupe = $val['IdSpecGrupe'];
            $ImeSpecGrupe = $val['ImeSpecGrupe'];


            $cols = Array ("IdSpecVrednosti", "IdSpecVrednostiGrupe", "IdSpecVrednostiIme");
            $db->where ('IdSpecVrednostiGrupe', $IdSpecGrupe);
            $users = $db->get ("specvrednosti", null, $cols);


            if ($db->count > 0)
                foreach ($users as $user) {
                    $IdSpecVrednosti = $user['IdSpecVrednosti'];
                    $error_msg['ok'][$ImeSpecGrupe][$IdSpecVrednosti] = $user;
                }



        }

    } else {
        $error_msg['error'] = 'nema nista u spec';
    }

} else {
    $error_msg["error"] = 'Nema Id';
}


echo $m = json_encode($error_msg);


?>