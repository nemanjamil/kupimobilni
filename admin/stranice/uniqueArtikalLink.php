<?php

$cols = Array ("ArtikalId");
$db->where ("ArtikalLink", $url_artikla);
if($db->has("artikli", NULL, $cols)) {
    /*echo $error = 'Ima duplikat ArtikalLink na ID od vebsop -> '.$idArtDodatna;
    echo '<br/>';
    error_log($error,0);*/
    continue;
}



?>