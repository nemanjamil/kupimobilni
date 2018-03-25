<?php
/**
 * Created by PhpStorm.
 * User: Nikola Markovic
 * Date: 26.10.2017.
 * Time: 14:33
 */

if($idubacenog){ $idubacenog = $idubacenog; }else{ $idubacenog = $BrendId; }

$insert_opis = Array(
    'BrendId' => $idubacenog,
    'IdLanguage' => 5,
    'BrendOpis' => $BrendOpis

);
$idubacenogOpisa = $db->insert('brendoviopis', $insert_opis);

if ($idubacenogOpisa) {

    $echoodstampaj .= '<b class="bojaZelenaEnerStr">' . $idubacenogOpisa . '</b> Id Ubacenog kod nas: <b class="bojaplavasajt">' . $BrendIme . '</b>';
    $echoodstampaj .= '</br>';
} else {
    $echoodstampaj .= '<b class="bojaZutaEner"> Insert failed: ' . $db->getLastError() . '<b class="bojacrvena">' . $BrendIme . '</b>';
    $echoodstampaj .= '</br>';
}
