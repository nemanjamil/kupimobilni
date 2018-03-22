<?php
/**
 * Project: masinealati
 * Created by PhpStorm.
 * User: Nikola
 * Date: 21. 09. 2016.
 * Time: 19:57
 */


if(isset($_POST['IdLanguage'])) {  $IdLanguage = filter_input(INPUT_POST, 'IdLanguage', FILTER_SANITIZE_STRING); } else { $IdLanguage = ''; }
if(isset($_POST['ActiveLanguage'])) {  $ActiveLanguage = filter_input(INPUT_POST, 'ActiveLanguage', FILTER_SANITIZE_STRING); } else { $ActiveLanguage = '0'; }
if(isset($_POST['NameLanguage'])) {  $NameLanguage = filter_input(INPUT_POST, 'NameLanguage', FILTER_SANITIZE_STRING); } else { $NameLanguage = ''; }
if(isset($_POST['ShortLanguage'])) {  $ShortLanguage = filter_input(INPUT_POST, 'ShortLanguage', FILTER_SANITIZE_STRING); } else { $ShortLanguage = ''; }


if (isset($IdLanguage, $ActiveLanguage, $NameLanguage, $ShortLanguage)) {
    $update_query = Array(
        'ActiveLanguage' => $ActiveLanguage,
        'ShortLanguage' => $ShortLanguage,
        'NameLanguage' => $NameLanguage

    );
    $db->where('IdLanguage', $IdLanguage);
    $db->update('languagejezik', $update_query);

    header("Location: " . URLVRATI . "");
}
else { header("Location: /izvestaj?err=Niste uneli sve podatke."); }

