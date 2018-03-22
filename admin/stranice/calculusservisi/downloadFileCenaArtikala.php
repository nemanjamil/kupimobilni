<?php

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
 * Uvlacimo: Mobilni
 *
 * ----
 *
 * Sifra cenovnika:
 * 3gShop Web Cenovnik = 3
 */


$SifraCenovnika = 3;

$arraySifraGrupa = array(128);
$arrlength = count($arraySifraGrupa);

for ($x = 0; $x < $arrlength; $x++) {
    $SifraKategorijeGlavna = $arraySifraGrupa[$x];

    echo "<br>";
    echo "Sifra Kategorije iz koje vuce Artikle: ";
    echo $SifraKategorijeGlavna;
    echo "</br>";
    echo "Cenovnika u Calculusu iz koje vuce Cene: ";
    echo $SifraCenovnika;
    echo "</br>";


    $urlServisa = URLCALCSERVICE . 'CenovnikArtUsl';
    $postParametri = [
        'tipcen' => $SifraCenovnika,
        'valcen' => '',
        'ojcen' => '',
        'sifgrart' => $SifraKategorijeGlavna,
        'sifart' => '',
        'nazivart' => ''
    ];

    $calculus = new calculusServisi($db);
    $curlInitStanje = $calculus->posaljiPodatkeCalc($urlServisa, $postParametri);

    if ($curlInitStanje) {
        $dom = new DOMDocument();
        $dom->loadXML($curlInitStanje);
        $lok = DCROOT . '/xml/ArtikliCeneDownload.xml';
        $dom->save($lok);

        echo '<b class="bojasiva333"> Skinut file cena i nalazi se na: '.$lok.' </b>';
        echo '</br>';
        echo '</br>';
    } else {
        echo 'nema curlinitstanje';
        die;
    }

}
