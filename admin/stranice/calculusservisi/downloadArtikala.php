<?php
echo ini_get('display_errors');
ini_set('max_execution_time', 0);

/**
 * Auto = 55
 * Led = 74
 * Racunar = 102
 * Mobilni = 128
 * Security = 510
 * ZZ - staro = '' //nema
 * Ambalaza = 46121
 * MP = '' //nema
 * Stara roba = '' //nema
 * ROBA KOJA NIJE ZA PRODAJU = 9955115
 * Tablet = 321123321
 *
 * Uvlacimo: Auto, Tablet, Racunar, Mobilni
 */

$arraySifraGrupa = array(55, 321123321,102, 128);
$arrlength = count($arraySifraGrupa);

for ($x = 0; $x < $arrlength; $x++) {
    $idKategorijeGlavna = $arraySifraGrupa[$x];

    echo "<br>";
    echo "IdGlavne Kategorije iz koje vuce Artikle: ";
    echo $idKategorijeGlavna;
    echo "</br>";

    require('jedanDownloadArtikala.php');

    if ($x == 0) {

        echo '<h2 class="bojaNaran">Prosao PRVI</h2>';
        echo '</br>';
        sleep(10);
    } else if ($x == 1) {

        echo '<h2 class="bojaZelenaEner">Prosao DRUGI</h2>';
        echo '</br>';
        sleep(10);

    } else if ($x == 2) {
        echo '<h2 class="bojaTamnoZuta">Prosao TRECI</h2>';
        echo '</br>';
        sleep(10);

    } else if ($x == 3) {
        echo '<h2 class="bojaZelenaSveEner">Prosao CETVRTI</h2>';
        echo '</br>';
        sleep(10);

    } else if ($x == 4) {
        echo '<h2 class="bojaZutaEner">Prosao PETI</h2>';
        echo '</br>';
        sleep(10);

    } else {
        echo '</br>';
        echo '<h2 class="BOJACRVENA">NESTO NIJE U REDU</h2>';
        echo '</br>';
        die;


    }

    sleep(10);
}
