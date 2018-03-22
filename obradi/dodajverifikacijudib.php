<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 26. 08. 2015.
 * Time: 23:03
 */


$OcenaVeriKomi = $common->clearvariable($_POST[string]);
$OpisVerKomit = $common->clearvariable($_POST[naziv]);

if (isset($OcenaVeriKomi)) {
    $insertData = Array(
        'OcenaVeriKomi' => $OcenaVeriKomi,
        'OpisVerKomit' => $OpisVerKomit,

    );


    $id = $db->insert('verikomitent', $insertData);


} else {
    $error_msg["error"] = 'Nema naziva';
}

echo $error_msg;

header("Location:$url");

?>