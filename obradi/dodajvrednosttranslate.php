<?php
/**
 * Project: masinealati
 * Created by PhpStorm.
 * User: Nikola
 * Date: 21. 09. 2016.
 * Time: 14:49
 */

$IdTranslate = $common->clearvariable($_POST[IdTranslate]);


/*$db->where('IdTranslate', $idUbacenogart);
if($db->delete('translatenaziv')) {
    $obr = true;
} else {
    $obr = false;
}*/

$artiN = '';
foreach ($_POST['OpisTranslateVrd'] as $valN => $kN) {
    $artiN[$valN] = $common->clearvariable($kN);
}

if ($artiN) {


    foreach ($artiN as $key => $val) {

    $insert_query = Array('IdTranslate' => $IdTranslate, 'IdLanguage' => $key, 'NazivTranslate' => $val);
        $db->setQueryOption(Array('IGNORE'));
        $idArtNewInsert = $db->insert('translatenaziv', $insert_query);
    }
}
//header("Location:" . DPROOT . '/admin/translate');
//header ( "Location:".'admin/translate/'. $lastId ."");
$urltrenutni = 'admin/translate/';

header("Location: " . $urltrenutni . "");
?>