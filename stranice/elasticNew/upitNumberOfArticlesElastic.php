<?php

$gled = (int) $_SESSION['kontrole']['sortKontrole'];

if (isset($_GET['stranaEs'])) {
    $currentpage = $_GET['stranaEs'];
} else {
    $currentpage = 1;
}


if ($currentpage > 1) {
    $od = (($currentpage - 1) * $limitpostrani) + 1;
    $do = ($currentpage * $limitpostrani);
} else {
    $od = 0;
    $do = $limitpostrani;
}
$od = (int) $od;
$do = (int) $do;


?>