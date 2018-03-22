<?php
/**
 * Project: masinealati
 * Created by PhpStorm.
 * User: Nikola
 * Date: 21. 09. 2016.
 * Time: 20:11
 */

$MagacinNaziv = $_POST['MagacinNaziv'];
$MagacinSifra = $_POST['MagacinSifra'];
$MagacinActive = $_POST['MagacinActive'];

if (empty($_POST)) {
    echo 'Nisu pronadjeni POST parametri!';
    die;
}


if (isset($MagacinNaziv) && isset($MagacinSifra)) {
    $data = Array(
        'MagacinNaziv' => $MagacinNaziv,
        'MagacinSifra' => $MagacinSifra,
        'MagacinActive' => $MagacinActive

    );

    $lastId = $db->insert('magacin', $data);
} else {
    $error_msg["error"] = 'Greska pri dodavanju magacina';
}


header("Location:" . URLVRATI . "");
