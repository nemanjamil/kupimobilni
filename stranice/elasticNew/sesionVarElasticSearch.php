<?php

if (!$_SESSION['elasticSes']['brendovi']) {  $_SESSION['elasticSes']['brendovi'] = array(); }
if (!$_SESSION['elasticSes']['kategorije']) {  $_SESSION['elasticSes']['kategorije'] = array(); }
if (!$_SESSION['elasticSes']['specVrednosti']) {  $_SESSION['elasticSes']['specVrednosti'] = array(); }



if (!$_SESSION['elasticSes']['cena']['min']) {
    $_SESSION['elasticSes']['cena']['min'] = 0;
    $minCenaSesParam = 0;
} else {
    $minCenaSesParam = $_SESSION['elasticSes']['cena']['min'];
}
if (!$_SESSION['elasticSes']['cena']['max']) {
    $_SESSION['elasticSes']['cena']['max'] = 10000;
    $maxCenaSesParam = 10000;
} else {
    $maxCenaSesParam = $_SESSION['elasticSes']['cena']['max'];
}

if ($term) {
    if ($_SESSION['elasticSes']['rec'] == $term) {
        // nista ne diraj
    } else {
        // ako nema u sesion
        $_SESSION['elasticSes']['rec'] = $term;

        /*$_SESSION['elasticSes']['modeli'] = array();
        $_SESSION['elasticSes']['tagoviEs'] = array();*/
        $_SESSION['elasticSes']['brendovi'] = array();
        $_SESSION['elasticSes']['kategorije'] = array();
        $_SESSION['elasticSes']['specVrednosti'] = array();
        $_SESSION['elasticSes']['cena']['min'] = '';
        $_SESSION['elasticSes']['cena']['max'] = '';
    }
} else {
    $_SESSION['elasticSes']['rec'] = '';
}


?>