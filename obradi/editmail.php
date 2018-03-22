<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 29. 08. 2015.
 * Time: 20:21
 */
//var_dump($_POST);
//die;

$idImail = $common->clearvariable($_POST[id]);

if (isset($idImail)) {
    $updatemail = Array(
        'FirstNameMail' => $naziv,
        'LastNameMail' => $string,
        'EmailAddressMail' => $email

    );

    $db->where("idImail", $id);
    $db->update('email', $updatemail);

    header("Location:admin/newsletter");

} else {
    $error_msg["error"] = 'Greska pri izmeni taga';
}
echo $m = json_encode($error_msg);
?>