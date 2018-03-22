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
 *
 * Sifra magacina :
 * VP magacin = VP
 */


$SifraCenovnika = 3;
$SifraMagacina = 'VP';

$arraySifraGrupa = array(128);
$arrlength = count($arraySifraGrupa);


for ($x = 0; $x < $arrlength; $x++) {
    $SifraKategorijeGlavna = $arraySifraGrupa[$x];

    $log->lwrite('Sifra Kategorije iz koje vuce Artikle: '.$SifraKategorijeGlavna);

    $log->lwrite('Cenovnik u Calculusu iz koje vuce Cene: '.$SifraCenovnika);

    $log->lwrite('Magacin u Calculusu iz koje vuce Cene: '.$SifraMagacina);

    /*echo "<br>";
    echo "Sifra Kategorije iz koje vuce Artikle: ";
    echo $SifraKategorijeGlavna;
    echo "</br>";
    echo "Cenovnik u Calculusu iz koje vuce Cene: ";
    echo $SifraCenovnika;
    echo "</br>";
    echo "Magacin u Calculusu iz koje vuce Cene: ";
    echo $SifraMagacina;
    echo "</br>";*/


    $urlServisa = URLCALCSERVICE . 'StanjeArtikla';
    $postParametri = [
        'sifmag' => $SifraMagacina,
        'tipcen' => $SifraCenovnika,
        'valcen' => '',
        'ojcen' => '',
        'sifgrart' => $SifraKategorijeGlavna,
        'sifart' => '',
        'nazivart' => '',
        'zr' => '',
        'sort' => '',
        'uslov' => ''

    ];

    $calculus = new calculusServisi($db);
    $curlInitStanje = $calculus->posaljiPodatkeCalc($urlServisa, $postParametri);

    $aa = 0;
    if ($curlInitStanje) {
        $dom = new DOMDocument();
        $dom->loadXML($curlInitStanje);
        $lok = ROOTLOC . '/xml/ArtikliStanjeDownload.xml';
        $dom->save($lok);

        $log->lwrite('Skinut file cena i nalazi se na: '.$lok);

    } else {

        $log->lwrite('nema curlinitstanje ');

    }

}
