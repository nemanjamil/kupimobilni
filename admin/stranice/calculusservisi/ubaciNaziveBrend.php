<?php
/**
 * Created by PhpStorm.
 * User: Nikola Markovic
 * Date: 26.10.2017.
 * Time: 14:33
 */

if($idubacenog){ $idubacenog = $idubacenog; }else{ $idubacenog = $BrendIdUpit; }

$insert_naziv = Array(
    'BrendId' => $idubacenog,
    'IdLanguage' => 5,
    'BrendIme' => $BrendIme

);
$idubacenogNaziva = $db->insert('brendoviime', $insert_naziv);

if ($idubacenogNaziva) {

    echo '<b style="color: forestgreen;;">' . $idubacenogNaziva . '</b> Id Ubacenog kod nas: <b class="bojaplavasajt">' . $BrendIme . '</b>';
    echo '</br>';
} else {
    echo '<b style="color: red;"> Insert failed: ' . $db->getLastError() . '<b class="bojacrvena">' . $BrendIme . '</b>';
    echo '</br>';
}

