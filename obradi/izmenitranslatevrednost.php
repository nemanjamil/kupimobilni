<?php
/**
 * Created by PhpStorm.
 * User: ITCluster Serbia
 * Date: 27.4.2016.
 * Time: 15:13
 */

$IdTranslate = $common->clearvariable($_POST[IdTranslateVrd]);


$artiN = '';
foreach ($_POST['OpisTranslateVrd'] as $valN => $kN) {
    $artiN[$valN] = $common->clearvariable($kN);
}


if ($artiN) {


    foreach ($artiN as $key => $val) {


        $updatetranslate = Array(
            "NazivTranslate" => "$val"
        );


        $db->where("IdTranslate", $IdTranslate);
        $db->where("IdLanguage", $key);
        $idubacenog = $db->update('translatenaziv', $updatetranslate);

/*        $insert_query = Array('IdTranslate' => $IdTranslate, 'IdLanguage' => $key, 'NazivTranslate' => $val);
        $db->setQueryOption(Array('IGNORE'));
        $idArtNewInsert = $db->update('translatenaziv', $updatetranslate);*/
    }
}
//header("Location:" . DPROOT . '/admin/translate');
//header ( "Location:".'admin/translate/'. $lastId ."");
$urltrenutni = 'admin/translate/';

header("Location: " . $urltrenutni . "");
















if(isset($_POST['IdJezik'])) {  $IdJezik = filter_input(INPUT_POST, 'IdJezik', FILTER_SANITIZE_STRING); } else { $IdJezik = ''; }
if(isset($_POST['IdTranslateVrd'])) {  $IdTranslateVrd = filter_input(INPUT_POST, 'IdTranslateVrd', FILTER_SANITIZE_STRING); } else { $IdTranslateVrd = ''; }
if(isset($_POST['OpisTranslateVrd'])) {  $OpisTranslateVrd = filter_input(INPUT_POST, 'OpisTranslateVrd', FILTER_SANITIZE_STRING); } else { $OpisTranslateVrd = ''; }


if (empty($_POST)) {
    echo 'Nisu pronadjeni POST parametri!';
    die;
}
if (!$IdJezik) {
    echo 'Nema ID jezika';
    die;
}
$query = "UPDATE TranslateVrd SET
      OpisTranslateVrd = '$OpisTranslateVrd'
      WHERE IdJezik = $IdJezik
      AND IdTranslateVrd = $IdTranslateVrd";

$result = $db->executeCommand($query);
header ( "Location:".URLVRATI."");
// automatski automski se poziva __destruct
?>