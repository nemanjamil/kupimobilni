<?php
/**
 * Project: masinealati
 * Created by PhpStorm.
 * User: Nikola
 * Date: 21. 09. 2016.
 * Time: 19:57
 */


if(isset($_POST['MagacinId'])) {  $MagacinId = filter_input(INPUT_POST, 'MagacinId', FILTER_SANITIZE_STRING); } else { $MagacinId = ''; }
if(isset($_POST['MagacinActive'])) {  $MagacinActive = filter_input(INPUT_POST, 'MagacinActive', FILTER_SANITIZE_STRING); } else { $MagacinActive = '0'; }
if(isset($_POST['MagacinNaziv'])) {  $MagacinNaziv = filter_input(INPUT_POST, 'MagacinNaziv', FILTER_SANITIZE_STRING); } else { $MagacinNaziv = ''; }
if(isset($_POST['MagacinSifra'])) {  $MagacinSifra = filter_input(INPUT_POST, 'MagacinSifra', FILTER_SANITIZE_STRING); } else { $MagacinSifra = ''; }


if (isset($MagacinId, $MagacinActive, $MagacinNaziv, $MagacinSifra)) {
    $update_query = Array(
        'MagacinActive' => $MagacinActive,
        'MagacinSifra' => $MagacinSifra,
        'MagacinNaziv' => $MagacinNaziv

    );
    $db->where('MagacinId', $MagacinId);
    $db->update('magacin', $update_query);

    header("Location: " . URLVRATI . "");
}
else { header("Location: /izvestaj?err=Niste uneli sve podatke."); }

