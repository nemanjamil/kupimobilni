<?php
/**
 * Project: masinealati
 * Created by PhpStorm.
 * User: Nikola
 * Date: 21. 09. 2016.
 * Time: 19:57
 */


if(isset($_POST['imestanja'])) {  $imestanja = filter_input(INPUT_POST, 'imestanja', FILTER_SANITIZE_STRING); } else { $imestanja = ''; }
if(isset($_POST['vrednoststanja'])) {  $vrednoststanja = filter_input(INPUT_POST, 'vrednoststanja', FILTER_SANITIZE_STRING); } else { $vrednoststanja = '0'; }


if (isset($imestanja, $vrednoststanja)) {
    $update_query = Array(
        'vrednoststanja' => $vrednoststanja

    );
    $db->where('imestanja', $imestanja);
    $db->update('setovanjevarijabli', $update_query);

    header("Location: " . URLVRATI . "");
}
else { header("Location: /izvestaj?err=Niste uneli sve podatke."); }

