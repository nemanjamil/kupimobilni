<?php
/*error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 1);*/
require 'vezafull.php';
define('RB_ROOT', dirname(__FILE__));


if (getenv('KUPIMOBILNI')==1) {
    if ($_GET[miki]!=1) {
        die;
    }
}

// ovo koristimo za prikay proizvoda
require('./parts/product/product.php');

// Site key 6LeAXAwTAAAAAAVdcWKv9wjy58e-HIWgesCI-61w
// Secret key 6LeAXAwTAAAAAEaV4suQzhclY4he4mXojHoFMOm-
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<?php
require "stranice/head.php";
?>
<body>
<?php
include_once("stranice/analyticstracking.php");

// comment nemanja moze $layout da bude i boxed
$layout = '';
require RB_ROOT . '/layouts/fluid.php';

require "stranice/skripteBody.php";

?>
<!--<div class="config open">
    <?php /*include "stranice/popsaleve.php"; */ ?>
    <a class="show-theme-options" href="#"><i class="fa fa-wrench"></i></a>
</div>-->
<!-- This is left because we could need in the future : End -->

</body>
</html>