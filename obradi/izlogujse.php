<?php
/**
 * Created by PhpStorm.
 * User: nemanja
 * Date: 29.7.15.
 * Time: 10.19
 */

require 'proveriAjaxDeny.php';

setcookie("credentials", "", time()-3600);
setcookie("language", "", time()-3600);
setcookie("languageId", "", time()-3600);
setcookie("valuta", "", time()-3600);
setcookie("logovankako", "", time()-3600);

unset($_SESSION['user']);
unset($_SESSION['language']);
unset($_SESSION['languageId']);
unset($_SESSION['valuta']);
unset($_SESSION['logovankako']);


echo 'Izlogovali ste se!';