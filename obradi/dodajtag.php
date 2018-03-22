<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 12. 08. 2015.
 * Time: 14:42
 */
$nazivtag = $common->clearvariable($_POST[nazivtag]);

if (isset($nazivtag)) {
    $data = Array(
        "TagoviIme" => "$nazivtag"
    );

    $db->startTransaction();
    $db->insert('tagovi', $data);
    $db->commit();
    $error_msg["ok"] = 'Dodat novi tag';
} else {
    $error_msg["error"] = 'Nema naziva';
}


echo $m = json_encode($error_msg);

header("Location:$url");
?>