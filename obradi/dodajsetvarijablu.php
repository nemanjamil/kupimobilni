<?php
/**
 * Project: masinealati
 * Created by PhpStorm.
 * User: Nikola
 * Date: 21. 09. 2016.
 * Time: 20:11
 */

$vrednoststanja = $_POST['vrednoststanja'];
$imestanja = $_POST['imestanja'];


if (empty($_POST)) {
    echo 'Nisu pronadjeni POST parametri!';
    die;
}


if (isset($imestanja) && isset($vrednoststanja)) {
    $data = Array(
        'vrednoststanja' => $vrednoststanja,
        'imestanja' => $imestanja

    );

    $lastId = $db->insert('setovanjevarijabli', $data);
} else {
    $error_msg["error"] = 'Greska pri dodavanju magacina';
}


header("Location:" . URLVRATI . "");
