<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 31. 08. 2015.
 * Time: 16:52
 */

$insertcom = Array(
    'OpisRekOnama' => $string,
    'SajtOnama' => '1',
    'KomitRekONama' => $id
);
$db->insert('rekonama', $insertcom);

echo $error_msg;

header("Location:$url");

?>