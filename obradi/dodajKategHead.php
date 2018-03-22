<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 27. 08. 2015.
 * Time: 13:41
 */

//KategHead start

$ParentKategHead = $common->clearvariable($_POST['ParentKategHead']);
$LinkKategHead = $common->clearvariable($_POST['LinkKategHead']);
$AktivanKategHead = $common->clearvariable($_POST['AktivanKategHead']);
$MestoKategHead = $common->clearvariable($_POST['MestoKategHead']);
//KategHead End

$TekstHeadsrblat = $common->clearvariable($_POST['TekstHeadsrblat']);
$TekstHeadsrb = $common->clearvariable($_POST['TekstHeadsrb']);


//$insert_query od  KategHead
$insert_query = Array(
    'ParentKategHead' => $ParentKategHead,
    'LinkKategHead' => $LinkKategHead,
    'AktivanKategHead' => $AktivanKategHead,
    'MestoKategHead' => $MestoKategHead
);

//var_dump($insert_query);


if (isset($ParentKategHead)) {
    // $db->setTrace (true);
    $db->startTransaction();

    $idUbacenogart = $db->insert('kateghead', $insert_query);


    foreach ($_POST['NaslovKategHead'] as $valN => $kN) {
        $artiN[$valN] = filter_var($kN, FILTER_SANITIZE_STRING);
    }


    $db->where('IdKategHead', $idUbacenogart);
    if($db->delete('kategheadnaslov')) {
        $obr = true;
    } else {
        $obr = false;
    }

    if ($artiN) {
        foreach ($artiN as $key => $val) {
            $insert_query = Array('IdKategHead' => $idUbacenogart, 'IdLanguage' => $key, 'NaslovKategHead' => $val);
            $db->setQueryOption(Array('IGNORE'));
            $idArtNewInsert = $db->insert('kategheadnaslov', $insert_query);
        }
    }




    foreach ($_POST['OpisKategHeadTekst'] as $valNN => $kNN) {
        $artiNN[$valNN] = filter_var($kNN, FILTER_SANITIZE_STRING);
    }


    $db->where('IdKategHead', $idUbacenogart);
    if($db->delete('kategheadtekstnew')) {
        $obr = true;
    } else {
        $obr = false;
    }

    if ($artiNN) {
        foreach ($artiNN as $key => $vall) {
            $insert_query_tekst = Array('IdKategHead' => $idUbacenogart, 'IdLanguage' => $key, 'OpisKategHeadTekst' => $vall);
            $db->setQueryOption(Array('IGNORE'));
            $idArtNewTeksInsert = $db->insert('kategheadtekstnew', $insert_query_tekst);
        }
    }



    $db->commit();
    // var_dump($db->trace);


} else {
    $error_msg["error"] = 'Imate gresku u unosu kategorije';
}

echo $error_msg;

header("Location:/admin/kategorijeHeader");
