<?php


$updatever = Array( "ArtikalNaAkciji" => $br );
$db->where("ArtikalId", $id);

if ($db->update('artikli', $updatever)) {
    //echo $db->count . ' records were updated';
    header("Location:$url");
} else {
    echo 'update failed: ' . $db->getLastError();
    die;
}

?>
