<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 18. 08. 2015.
 * Time: 00:55
 */

$komitentime = $common->clearvariable($_POST[komitentime]);
$komitentid = $common->clearvariable($_POST[komitentid]);


if (isset($komitentime)) {

    $err = $db->where("KomitentId", $id);
    $err = $db->delete('komitenti');
//var_dump($db);
//die;


    if ($err) {
        header("Location:$url");
        $error_msg["id"] = $err;
    } else {
        $error_msg["Greska"] = 'Greska pri brisanju; Komitent id: ' . $id . ', ima proizvode koji su povezani sa njim.';
    }


}

echo $m = json_encode($error_msg);


?>

