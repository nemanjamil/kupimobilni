<?php
/**
 * Created by PhpStorm.
 * User: Nikola Markovic
 * Date: 26.10.2017.
 * Time: 14:33
 */

if($idubacenog){ $idubacenog = $idubacenog; }else{ $idubacenog = $BrendIdUpit; }

$insert_opis = Array(
    'BrendId' => $idubacenog,
    'IdLanguage' => 5,
    'BrendOpis' => $BrendOpis

);
$idubacenogOpisa = $db->insert('brendoviopis', $insert_opis);

if ($idubacenogOpisa) {

    echo '<b style="color: lightgreen;">' . $idubacenogOpisa . '</b> Id Ubacenog kod nas: <b style="color: blue;">' . $BrendIme . '</b>';
    echo '</br>';
} else {
    echo '<b style="color: black;"> Insert failed: ' . $db->getLastError() . '<b style="color: red;">' . $BrendIme . '</b>';
    echo '</br>';
}
