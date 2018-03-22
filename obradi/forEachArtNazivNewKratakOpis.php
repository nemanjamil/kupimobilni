<?php

foreach ($_POST['artNazivKratak'] as $valN => $kN) {
    $artiKrat[$valN] = filter_var($kN, FILTER_SANITIZE_STRING);
}