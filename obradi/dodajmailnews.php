<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 28. 08. 2015.
 * Time: 15:13
 */
var_dump($_POST);


$insertmail = Array(
    'FirstNameMail' => $naziv,
    'LastNameMail' => $string,
    'EmailAddressMail' => $email

);

$db->insert('email', $insertmail);

echo $error_msg;

header("Location:$url");

?>