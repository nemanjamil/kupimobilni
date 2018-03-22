<?php
/**
 * Project: masinealati
 * Created by PhpStorm.
 * User: Nikola
 * Date: 21. 09. 2016.
 * Time: 20:11
 */


if (empty($_POST)) {
    echo 'Nisu pronadjeni POST parametri!';
    die;
}


if ($naziv) {
    $data = Array(
        'NameLanguage' => $naziv,
        'ShortLanguage' => $string,
        'ActiveLanguage' => $br

    );

    $lastId = $db->insert('languagejezik', $data);

} else {
    $error_msg["error"] = 'Greska pri dodavanju jezika';
}


header("Location:" . URLVRATI . "");
