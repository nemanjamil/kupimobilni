<?php
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_FLOAT);
$id = (int)$id;
if (!is_int($id)) {
    die;
}

$br = filter_input(INPUT_POST, 'br', FILTER_SANITIZE_NUMBER_FLOAT);
$br = (int)$br;
if (!is_int($br)) {

    die;
}

$_SESSION['elasticSes']['cena']['min'] = $id;
$_SESSION['elasticSes']['cena']['max'] = $br;

?>