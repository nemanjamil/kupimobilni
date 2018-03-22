<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 13. 01. 2016.
 * Time: 10:12 AM
 */

if (isset($_POST['title'])) { $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING); } else {    $title = ''; }
if (isset($_POST['model'])) { $model = filter_input(INPUT_POST, 'model', FILTER_SANITIZE_STRING); } else {    $model = ''; }
if (isset($_POST['codebosch'])) { $codebosch = filter_input(INPUT_POST, 'codebosch', FILTER_SANITIZE_STRING); } else {    $codebosch = ''; }
if (isset($_POST['codeboschlink'])) { $codeboschlink = filter_input(INPUT_POST, 'codeboschlink', FILTER_SANITIZE_STRING); } else {    $codeboschlink = ''; }

if (!$codebosch) {
    echo 'Nema $codebosch';
    die;
}
/*
 * FAZA I
 * Kako smo promenuli url na Agro basta tako menjamo i na dodatnoj
 */


    // http://www.sitepoint.com/using-curl-for-remote-requests/
    $url = 'http://dodatnaoprema.com/koment.php?akcija=ubacilinkbosch';
    $fields = array(
        'id' => $id,
        'codeboschlink' => $codeboschlink
    );

    //open connection
    $ch = curl_init();

    curl_setopt($ch,CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_POST, true);
    curl_setopt($ch,CURLOPT_POSTFIELDS, json_encode($fields));
    //curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // da vraca string, tako mozemo da kupimo JSON

    $pnp_result_page = curl_exec($ch);
    if (!$pnp_result_page) {
            $error = false;
            //echo '<br>An error has occurred: ' . curl_error($ch);
        }
        else {
            $error = true;
            //echo '<br>Nas podatak : everything was successful';
        }

    //close connection
    curl_close($ch);


/*
 * FAZA II
 * MENJAMO U DODATNA OPREMA VEBSOP Linku u Lokalu
 */
    // kupimo podatke od responce
    $jsd = json_decode($pnp_result_page);
    $staje = $jsd->sucess;


    if (!$error || !$staje) {
        echo 'Nesto nije dobro';
        die;
    }


    $update_query = Array(

        'codebosch' => $codebosch,
        'codeboschlink' => $codeboschlink

    );
    $db->where('id', $id);

    //$db->setTrace (true);
    $db->startTransaction();

    if (!$db->update('vebsop', $update_query)) {
        $db->rollback();
        echo 'Nesto nije dobro ROLLBACK baza vebsop';
        die;
    } else {
        $db->commit();
        echo 'Sve je ok';
    }
    //var_dump($db->trace);



/*
 * FAZA II
 * Menjamo u artikli Bazi
 */

    if ($br) {
        $update_query = Array(
            'CodeBoschLink' => $codeboschlink
        );
        $db->where('ArtikalId', $br);

        //$db->setTrace (true);
        $db->startTransaction();

        if (!$db->update('artikli', $update_query)) {
            $db->rollback();
            echo 'Nesto nije dobro ROLLBACK baza artikli';
            die;
        } else {
            $db->commit();
            echo 'Sve je ok baza artikli';
        }
    }

//echo $error_msg;

header("Location: " . URLVRATI);
?>