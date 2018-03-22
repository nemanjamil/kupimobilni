<?php

foreach ($_POST['artNazivNew'] as $valN => $kN) {
    $artiN[$valN] = filter_var($kN, FILTER_SANITIZE_STRING);
}
?>