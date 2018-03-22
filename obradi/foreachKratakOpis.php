<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 20. 05. 2016.
 * Time: 11:58
 */


foreach ($_POST['kratakopis'] as $valK => $kK) {
    $kratakOpis[$valK] = filter_var($kK, FILTER_SANITIZE_STRING);
}