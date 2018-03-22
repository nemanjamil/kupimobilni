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
    $kategProvera = array();
    foreach ($_SESSION['elasticSes']['kategorije'] AS $k => $v) {
        if ($v != $id) {
            $kategProvera[] = $v;
        }
    }

} else {
    if ($_SESSION['elasticSes']['kategorije']) {
        if (!in_array($id, $_SESSION['elasticSes']['kategorije'])) {
            array_push($_SESSION['elasticSes']['kategorije'], $id);
        }
    } else {
        $kateg[] = $id;
        $_SESSION['elasticSes']['kategorije'] = $kateg;
    }

    $kategProvera = array();
    foreach ($_SESSION['elasticSes']['kategorije'] AS $k => $v) {
        if (!in_array($v, $kategProvera)) {
            $kategProvera[] = $v;
        }
    }
}
$_SESSION['elasticSes']['kategorije'] = $kategProvera;


?>