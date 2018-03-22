<?php
// 1. zakucavamo server execution time na 0 tj. da ne stane dok se sve ne izvrsi i da prikaze sve error - e.
echo ini_get('display_errors');
ini_set('max_execution_time', 0);

// 2. Pa prvo povlacimo file sa servera kod nas.

require('downloadFileCenaArtikala.php');

sleep(10);

// 3. Update-ujemo cene u bazi sa tim file koji smo skinuli

require('updateFileCenaArtikala.php');

sleep(10);

?>

<h1 class="centriraj">Zavrsen proces update cena artikala</h1>
