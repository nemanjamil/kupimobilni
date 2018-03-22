<?php
/**
 * Project: masine
 * Created by PhpStorm.
 * User: Nikola
 * Date: 28. 01. 2016.
 * Time: 14:15
 */


$updatever = Array("ArtikalNaAkciji" => 9);
$db->where("ArtikalId", $id);

if ($db->update('artikli', $updatever)) {
    //echo $db->count . ' records were updated';
    header("Location:$url");
} else {
    echo 'update failed: ' . $db->getLastError();
    die;
}


?>
