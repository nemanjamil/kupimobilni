<?php
/**
 * Created by PhpStorm.
 * User: NemanjaMilivojevic
 * Date: 30.7.15.
 * Time: 16.05
 */

$cookie_name = 'valuta';
setcookie($cookie_name, $string, time() + (86400 * 30 * 12), "/"); // setovano da se izbrise cookie za 360 dana
$_SESSION['valuta'] = $string;


header("Location:" . URLVRATI . "");