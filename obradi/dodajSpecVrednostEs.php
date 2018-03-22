<?php
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$id = (int)$id;
if (!is_int($id)) {
    die;
}

$br = filter_input(INPUT_POST, 'br', FILTER_SANITIZE_NUMBER_INT);
$br = (int)$br;
if (!is_int($br)) {
    die;
}

$upitSpecGrupe = "SELECT S.IdSpecVrednostiGrupe FROM specvrednosti S WHERE S.IdSpecVrednosti = $id";
$resultGrupe = $db->rawQueryOne($upitSpecGrupe);

$IdGrupeSpecKategorija = (int)$resultGrupe['IdSpecVrednostiGrupe'];


if (!$IdGrupeSpecKategorija) {
    echo 'Nema Grupe Spec';
    die;
}

if (!$br) {

    $kategProvera = array();
    foreach ($_SESSION['elasticSes']['specVrednosti'][$IdGrupeSpecKategorija] AS $k => $v) {
        if ($v != $id) {
            $kategProvera[] = $v;
        }
    }
    $_SESSION['elasticSes']['specVrednosti'][$IdGrupeSpecKategorija] = $kategProvera;

} else {


    if ($IdGrupeSpecKategorija) {


        if ($_SESSION['elasticSes']['specVrednosti']) {
            if (!in_array($id, $_SESSION['elasticSes']['specVrednosti'])) {
                $_SESSION['elasticSes']['specVrednosti'][$IdGrupeSpecKategorija][] = $id;
            }
        } else {
            $_SESSION['elasticSes']['specVrednosti'][$IdGrupeSpecKategorija][] = $id;
        }
    }
}

// Provera unique
$kategProvera = array();
foreach ($_SESSION['elasticSes']['specVrednosti'] AS $k => $v) {

    $_SESSION['elasticSes']['specVrednosti'][$k] = array();
    foreach ($v AS $kljuc => $vrednost) {
        if (!in_array($vrednost, $_SESSION['elasticSes']['specVrednosti'][$k])) {
            $_SESSION['elasticSes']['specVrednosti'][$k][] = $vrednost;
        }
    }
}


//$_SESSION['elasticSes']['specVrednosti'] = $kategProvera;


?>