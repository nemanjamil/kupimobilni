<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 27. 08. 2015.
 * Time: 15:32
 *
 */



$IdKategHead = $common->clearvariable($_POST['id']);


$update_query = Array(
    'ParentKategHead' => $_POST['ParentKategHead'],
    'LinkKategHead' => $_POST['LinkKategHead'],
    'AktivanKategHead' => $_POST['AktivanKategHead'],
    'MestoKategHead' => $_POST['MestoKategHead']

);


if (isset($id)) {
    $db->setTrace(true);
    $db->startTransaction();

    $db->where('IdKategHead', $id);
    $idUbacenogart = $db->update('kateghead', $update_query);


    // I
    // Ubacujemo NAZIVE U NOVU BAZU
    // prvo ih brisemo sve
    require_once('ubaciNaziveKategHead.php');


    // I
    // Ubacujemo NAZIVE U NOVU BAZU
    // prvo ih brisemo sve
    require_once('ubaciOpiseKategHead.php');


    $db->commit();
    /*var_dump($db->trace);
    die;*/


} else {
    $error_msg .= 'Nema $idTekst : ' . $IdKategHead . ' $idUbacenogart : ' . $idUbacenogart;
    die;
}

//echo $error_msg;

header("Location: " . URLVRATI ."");
?>

