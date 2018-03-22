<?php
/**
 * Created by PhpStorm.
 * User: Nikola Markovic
 * Date: 5.1.2018.
 * Time: 15:59
 */
// 1. zakucavamo server execution time na 0 tj. da ne stane dok se sve ne izvrsi i da prikaze sve error - e.
require 'includeZaCronCalcServise.php';

$varsleep = 10;

require ROOTLOC . '/obradi/snimiTxt.php';
$logLoc = ROOTLOC . '/logovi/logArtCron.txt';

$log->lfile($logLoc);
$log->lwrite('');
$log->lwrite('Masine ENV : ' . $serverVarijabla);
$log->lwrite('Calculus Artikli Cron START : ' . $timeUbac );


$arraySifraGrupa = array(55, 321123321,102, 128);
$arrlength = count($arraySifraGrupa);


for ($x = 0; $x < $arrlength; $x++) {
    $idKategorijeGlavna = $arraySifraGrupa[$x];

    $log->lwrite('IdGlavne Kategorije iz koje vuce Artikle: '.$idKategorijeGlavna);

    require('jedanDownloadArtikalaCron.php');

    if ($x == 0) {

        $log->lwrite('Prosao PRVI');
        sleep(10);
    } else if ($x == 1) {

        $log->lwrite('Prosao DRUGI');
        sleep(10);

    } else if ($x == 2) {
        $log->lwrite('Prosao TRECI');
        sleep(10);

    } else if ($x == 3) {
        $log->lwrite('Prosao CETVRTI');

        sleep(10);

    } else if ($x == 4) {
        $log->lwrite('Prosao PETI');
        sleep(10);

    } else {
        $log->lwrite('NESTO NIJE U REDU');

    }

    sleep(10);
}



$log->lwrite('Zavrsen proces update artikala iz Calculus-a');
$log->lclose();


