<?php
/**
 * Created by PhpStorm.
 * User: Nikola Markovic
 * Date: 5.1.2018.
 * Time: 12:07
 */
// 1. zakucavamo server execution time na 0 tj. da ne stane dok se sve ne izvrsi i da prikaze sve error - e.
require 'includeZaCronCalcServise.php';

$varsleep = 10;

require ROOTLOC . '/obradi/snimiTxt.php';
$logLoc = ROOTLOC . '/logovi/logStanjeArtCron.txt';

$log->lfile($logLoc);
$log->lwrite('');
$log->lwrite('Masine ENV : ' . $serverVarijabla);
$log->lwrite('Calculus Stanje Artikala Cron START : ' . $timeUbac );

require('downloadFileStanjeArtikalaCron.php');
sleep($varsleep);

require('updateFileStanjeArtikalaCron.php');
sleep($varsleep);

$log->lwrite('Zavrsen proces update stanja i cena artikala iz Calculus-a');
$log->lclose();

