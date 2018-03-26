<?php
//require 'proveriAjaxDeny.php';
// http://www.9lessons.info/2014/12/google-new-recaptcha-using-php-are-you.html
$KomentarKomentari = $common->clearvariable($_POST['komentar']);

$recaptcha = $_POST['g-recaptcha-response'];
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


        if ($email && $br && $id) {

            try {
                //$db->setTrace (true);
                $db->startTransaction();

                $insert_query = Array('KomentarKomentari' => $KomentarKomentari, 'ArtikalKomentar' => $id, 'UserKomentari' => $br,
                    'EmailKomentar' => $email, 'IpKomentar' => $ipAdress, 'ImeKomentar' => $string);
                $idTag = $db->insert('komentari', $insert_query);

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
            $error_msg = 'No email or IdArticle';
        }


    } else {
        $error_msg = "Please re-enter your reCAPTCHA.";
    }

} else {
    $error_msg = "Please re-enter your reCAPTCHA.";
}




header("Location: ".URLVRATI."/?e=$error_msg");
?>

