<?php
define('RB_ROOT', dirname(__FILE__));
require '../vezafull.php';

$sesKor = new functions($db); // za registraciju
$sesKor->sec_session_start();
$common = new common($db);
$adminfunkc = new adminfunkc($db);
$senzori = new senzori($db);

require DCROOT."/include/lang.php";
$db->where("ActiveLanguage",1);
$jezLan = $db->get ('languagejezik', null, "IdLanguage,ShortLanguage");

require DCROOT."/stranice/cookSajtCheck.php";
// ---------------------------------------------------------------- LOGOVANJE
require DCROOT."/stranice/loginIndex.php";
// -------------------------------------------------------------- LOGOVANJE KRAJ

if ($tipUsera<=10 || !$logged) {
    echo 'Nemate admin ovlascenja';
    die;
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
   <?php
   require ('stranice/head.php');
   ?>
</head>

<body>

<?php
require ('stranice/header.php');
include_once('../tini.php');
?>

<div id="container">
    <?php
    require ('stranice/sidebar.php');
    ?>
    <div id="content">
        <div class="container">
            <!-- Breadcrumbs line -->
            <?php
           require ('stranice/crumbs.php');
            ?>

            <!-- /Breadcrumbs line -->

            <!--=== Page Header ===-->
            <?php
            require ('stranice/page-header.php');
            ?>
            <!-- /Page Header -->
<div class="row">
            <!--=== Page Content ===-->
            <?php

            if ($stranica) {
                if (file_exists('stranice/' . $stranica . '.php')) {
                    //require RB_ROOT . '/stranice/crumbs.php';
                    require 'stranice/' . $stranica . '.php';
                } else {

                    require 'stranice/error.php';
                }
            } else {
                // ako ne postoji stranica onda ide pocetna
                require ('stranice/pocetna.php');
            }


            ?>
</div>
            <!-- /Page Content -->
        </div>
        <!-- /.container -->

    </div>
</div>

</body>
</html>