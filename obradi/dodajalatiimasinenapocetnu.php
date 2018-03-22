<?php
/**
 * Project: masine
 * Created by PhpStorm.
 * User: Nikola
 * Date: 08. 03. 2016.
 * Time: 11:59
 */


$updatever = Array( "ArtikalNaAkciji" => "10" );
$db->where("ArtikalId", $id);

if ($db->update('artikli', $updatever)) {
    //echo $db->count . ' records were updated';
    header("Location:$url");
} else {
    echo 'update failed: ' . $db->getLastError();
    die;
}