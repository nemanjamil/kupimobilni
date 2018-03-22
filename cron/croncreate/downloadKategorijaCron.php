<?php
// 1. zakucavamo server execution time na 0 tj. da ne stane dok se sve ne izvrsi i da prikaze sve error - e.
require 'includeZaCronCalcServise.php';

$varsleep = 10;

require ROOTLOC . '/obradi/snimiTxt.php';
$logLoc = ROOTLOC . '/logovi/logKategCron.txt';

$log->lfile($logLoc);
$log->lwrite('');
$log->lwrite('Masine ENV : ' . $serverVarijabla);
$log->lwrite('Calculus Kategorije Artikala Cron START : ' . $timeUbac );

// KALKULUS IDIJEVI
// 2. Pa prvo povlacimo PARENT kategorije sa servera.
// OVO JE SAMO NULTI NIVO
$log->lwrite('insert Parent Kategorija Cron START : ' . $timeUbac );
require 'insertParentKategorijaCron.php';
$log->lwrite('Ubacene parent kategorije Cron END : ' . $timeUbac );
sleep($varsleep);


// PONOVO DA POZOVEMO ISITI IZML
// 3. Zatim povlacimo sve ostale kategorije sa servera.
$log->lwrite('Update Kategorija Cron START : ' . $timeUbac );
require('updateKategorijaCron.php');
$log->lwrite('Ubacene kategorije Cron END : ' . $timeUbac );
sleep($varsleep);


// NASI IDIJEVI
// 4. Zatim update-ujemo parent kategorije.
$log->lwrite('Update Parent Kategorija Cron START : ' . $timeUbac );
require('updateKategorijaParentCron.php');
$log->lwrite('Update parent kategorije END : ' . $timeUbac );
sleep($varsleep);



$log->lwrite('Zavrsen proces download-a kategorija - grupa iz Calculus-a');
$log->lclose();