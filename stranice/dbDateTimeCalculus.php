<?php
echo $urlServisa = 'http://10.8.0.10/CalculusWebService/CalculusWebService.asmx/DatumVremeDBServera';
echo '</br>';
$postParametri = [];

$calculus = new calculusServisi($db);
$curlInitStanje = $calculus->posaljiPodatkeCalc($urlServisa, $postParametri);

if ($curlInitStanje) {
    $dom = new DOMDocument();
    $dom->loadXML($curlInitStanje);
    $tables = $dom->getElementsByTagName('string');

    if (!empty($tables)) {
        $VremeDatum = $tables->item(0)->nodeValue;

        echo '</br>';
        echo '<i class="bojaljubsajta">Vreme i datum Calculus servera: ' . $VremeDatum .'</i>';
        echo '</br>';
        echo '</br>';


    } else {
        echo 'empty(tables)';
        die;
    }

} else {
    echo 'nema curlinitstanje';
    die;
}