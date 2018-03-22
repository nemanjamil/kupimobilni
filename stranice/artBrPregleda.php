<?php
if (!$id) {
    echo 'Nema ID od Artikla';
    echo '<br/>';
    echo 'stranice/artBrPregleda.php';
    die;
}

$dataBrPregleda = Array ('ArtikalBrPregleda' => $ArtikalBrPregleda+1);
$db->where ('ArtikalId', $id);
$db->update ('artikli', $dataBrPregleda);

?>