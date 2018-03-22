<?php
/**
 * Created by PhpStorm.
 * User: nemanja
 * Date: 29.7.15.
 * Time: 10.55
 */

require 'proveriAjaxDeny.php';

$db->where('KomitentId', $id);
$resultrows = $db->getOne("komitenti");



if ($resultrows) {

    //$passwordorg = hash('sha512', $passwordorg1);
    $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
    $password = hash('sha512', $string . $random_salt);

    $data = Array(
        'KomitentPassword' => $password,
        'KomitentSalt' => $random_salt
    );
    $db->where('KomitentId', $KomitentId);
    if ($db->update('komitenti', $data)) {
        $error_msg["ok"] = 'OK - Reload';

        unset($_SESSION['user']);
        setcookie("credentials", "", time() - 3600);

    } else {
        $error_msg["error"] = 'Bag';
    }


} else {
    $error_msg["error"] = 'No user in DataBase';
}


echo $m = json_encode($error_msg);
?>