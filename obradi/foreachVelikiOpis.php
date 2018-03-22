<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 20. 05. 2016.
 * Time: 11:58
 */


foreach ($_POST['velikiopis'] as $valV => $kV) {
    $velikiOpis[$valV] = filter_var($kV, FILTER_SANITIZE_STRING);
}
?>