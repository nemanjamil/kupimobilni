<?php
/**
 * Created by PhpStorm.
 * User: NemanjaMilivojevic
 * Date: 29.7.15.
 * Time: 17.55
 */

    $cookie_name = 'language';
    setcookie($cookie_name, $string, time() + (86400 * 30 * 12), "/"); // setovano da se izbrise cookie za 360 dana
    $_SESSION['language'] = $string;

    $cookie_name = 'languageId';
    setcookie($cookie_name, $id, time() + (86400 * 30 * 12), "/"); // setovano da se izbrise cookie za 360 dana
    $_SESSION['languageId'] = (int) $id;


    header("Location:" . URLVRATI . "");

