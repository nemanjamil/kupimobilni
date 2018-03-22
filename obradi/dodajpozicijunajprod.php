<?php
/**
 * Project: masine
 * Created by PhpStorm.
 * User: Nikola
 * Date: 28. 01. 2016.
 * Time: 14:59
 */

$top3 = $common->clearvariable($_POST[top3]);

$updatever = Array("top3" => "$top3");
$db->where("ArtikalId", $id);

if ($db->update('artikli', $updatever)) {
    //echo $db->count . ' records were updated';
    header("Location:$url");
} else {
    echo 'update failed: ' . $db->getLastError();
    die;
}

?>