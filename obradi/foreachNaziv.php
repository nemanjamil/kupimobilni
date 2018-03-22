<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 20. 05. 2016.
 * Time: 11:58
 */


foreach ($_POST['naziv'] as $val => $k) {
    $naziv[$val] = filter_var($k, FILTER_SANITIZE_STRING);
}
?>