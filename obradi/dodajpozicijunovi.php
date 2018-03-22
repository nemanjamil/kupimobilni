<?php
/**
 * Project: masine
 * Created by PhpStorm.
 * User: Nikola
 * Date: 28. 01. 2016.
 * Time: 14:59
 */


//var_dump($_POST);
//var_dump($id);

$top2 = $common->clearvariable($_POST[top2]);

$updatever = Array(  "top2" => "$top2" );
$db->where("ArtikalId", $id);

if ($db->update('artikli', $updatever)) {
    //echo $db->count . ' records were updated';
    header("Location:$url");
} else {
    echo 'update failed: ' . $db->getLastError();
    die;
}
