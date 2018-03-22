<?php
/**
 * Created by PhpStorm.
 * User: nemanja
 * Date: 27.7.15.
 * Time: 22.41
 */

/*if (empty($_POST)) {
    echo 'Nisu pronadjeni POST parametri!';
    die;
}*/

// prevent direct access
$isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND
strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
if(!$isAjax) {
    $user_error = 'Access denied - not an AJAX request...';
    trigger_error($user_error, E_USER_ERROR);
}
