<?php
/**
 * Project: masine
 * Created by PhpStorm.
 * User: Nikola
 * Date: 05. 02. 2016.
 * Time: 14:31
 */


//var_dump($_POST);
//var_dump($ipAdresa);

$PosaoIme = $common->clearvariable($_POST['ime']);
$PosaoEmail = $common->clearvariable($_POST['email']);
$PosaoTelefon = $common->clearvariable($_POST['telefon']);
$PosaoAdresa = $common->clearvariable($_POST['adresa']);
$PosaoIskustvo = $common->clearvariable($_POST['iskustvo']);
$PosaoPoruka = $common->clearvariable($_POST['poruka']);
$recaptcha = $common->clearvariable($_POST['g-recaptcha-response']);


if ($PosaoIme && $PosaoEmail && $ipAdresa) {

    try {
        //$db->setTrace (true);
        $db->startTransaction();

        $insert_query = Array(
            'PosaoIme' => $PosaoIme,
            'PosaoEmail' => $PosaoEmail,
            'PosaoTelefon' => $PosaoTelefon,
            'PosaoAdresa' => $PosaoAdresa,
            'PosaoIskustvo' => $PosaoIskustvo,
            'PosaoPoruka' => $PosaoPoruka,
            'PosaoIp' => $ipAdresa);

        $idTag = $db->insert('posao', $insert_query);

        if ($idTag) {
            $error_msg = 'OK ';
        } else {
            $error_msg = 'No insert';
        }

        if ($idTag) {
            $db->commit();
        }
        //var_dump($db->trace);

    } catch (Exception $e) {
        // An exception has been thrown
        // We must rollback the transaction
        $db->rollback();
        $error_msg = 'Roll back';
    }

} else {
    $error_msg = 'Nema emaila ili Imena';
}

if (!empty($recaptcha)) {

    include("getCurlData.php");
    $google_url = "https://www.google.com/recaptcha/api/siteverify";
    $secret = '6LcU3k4UAAAAAL1FpMzCS4z-VVK2-QUXVnML9xNg';
    //$secret = '6LeTYBcTAAAAAJ1NwgkORz3wp0eBYwV39qb8gGrk';
    $ip = $_SERVER['REMOTE_ADDR'];
    $url = $google_url . "?secret=" . $secret . "&response=" . $recaptcha . "&remoteip=" . $ip;
    $res = getCurlData($url);
    $res = json_decode($res, true);
//reCaptcha success check
    if ($res['success']) {


        if ($PosaoIme && $PosaoEmail && $ipAdresa) {

            try {
                $db->setTrace (true);
                $db->startTransaction();

                $insert_query = Array(
                    'PosaoIme' => $PosaoIme,
                    'PosaoEmail' => $PosaoEmail,
                    'PosaoTelefon' => $PosaoTelefon,
                    'PosaoAdresa' => $PosaoAdresa,
                    'PosaoIskustvo' => $PosaoIskustvo,
                    'PosaoPoruka' => $PosaoPoruka,
                    'PosaoIp' => $ipAdresa);

                $idTag = $db->insert('posao', $insert_query);

                if ($idTag) {
                    $error_msg = 'OK ';
                } else {
                    $error_msg = 'No insert';
                }

                if ($idTag) {
                    $db->commit();
                }
                var_dump($db->trace);
                die;
            } catch (Exception $e) {
                // An exception has been thrown
                // We must rollback the transaction
                $db->rollback();
                $error_msg = 'Roll back';
            }

        } else {
            $error_msg = 'No email or IdArticle';
        }


    }


    else {
        $error_msg = "Please re-enter your reCAPTCHA.";
    }

} else {
    $error_msg = "Please re-enter your reCAPTCHA.";
}


header("Location: ".DPROOT."/?e=$error_msg");


