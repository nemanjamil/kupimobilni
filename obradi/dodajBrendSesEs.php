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


if (!$br) {
    // obrisi brend
    $kategProvera = array();
    foreach ($_SESSION['elasticSes']['brendovi'] AS $k => $v) {
        if ($v != $id) {
            $kategProvera[] = $v;
        }
    }

} else {
    // DODAJ BREND
    if ($_SESSION['elasticSes']['brendovi']) {
        if (!in_array($id, $_SESSION['elasticSes']['brendovi'])) {
            array_push($_SESSION['elasticSes']['brendovi'], $id);
        }
    } else {
        $kateg[] = $id;
        $_SESSION['elasticSes']['brendovi'] = $kateg;
    }

    $kategProvera = array();
    foreach ($_SESSION['elasticSes']['brendovi'] AS $k => $v) {
        if (!in_array($v, $kategProvera)) {
            $kategProvera[] = $v;
        }
    }
}

$_SESSION['elasticSes']['brendovi'] = $kategProvera;

?>