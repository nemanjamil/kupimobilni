<?php
require 'includeZaCalcServise.php';

echo ini_get('display_errors');
ini_set('max_execution_time', 0);

$prvaSlika = 1;

$kategorijeDodatna = new kategorijeDodatna($db);

$xmlLokacija = DCROOT . '/xml/3gStoreBrendoviPovez.xml';
$dom = new DOMDocument();
$dom->load($xmlLokacija);
$tables = $dom->getElementsByTagName('brendpovez');
$brojLenght = $tables->length;

if (!empty($tables)) {

    $brojLenght = $tables->length;


    if ($brojLenght > 0) {

        foreach ($tables as $row) {

            $ArtikalExtId = $row->getElementsByTagName("ArtikalExtId");
            $ArtikalExtId = (int)$ArtikalExtId->item(0)->nodeValue;

            $ArtikalSifra = $row->getElementsByTagName("ArtikalSifra");
            $ArtikalSifra = $ArtikalSifra->item(0)->nodeValue;

            $BrendLink = $row->getElementsByTagName("BrendLink");
            $BrendLink = $BrendLink->item(0)->nodeValue;
            $BrendLink = filter_var($BrendLink, FILTER_SANITIZE_URL);


            $db->startTransaction();

            //Prvo provaravamo da li imamo isti kod nas u bazi


            $db->where('BrendLink', $BrendLink);
            $upit1 = $db->getOne('brendovi');
            $BrendIdUpit = $upit1['BrendId'];

            //Ako imamo kod nas u bazi
            if ($upit1) {
                $db->where('ArtikalSifra', $ArtikalSifra);
                $upit2 = $db->getOne('artikli');
                $ArtikalId = $upit2['ArtikalId'];


                if ($ArtikalId) {

                    $udate_artikal = Array(
                        'ArtikalBrendId' => $BrendIdUpit

                    );

                    $db->where('ArtikalId', $ArtikalId);
                    if ($db->update('artikli', $udate_artikal)) {
                        echo '</br>';
                        echo '<b class="bojaplavadrz">' . $ArtikalId . '</b> ArtikalId updated: <b class="bojaplavasajt">' . $BrendLink . '</b>';
                        echo '</br>';

                    } else {

                        echo '</br>';
                        echo '<b class="bojaNaran"> ARTIKAL update failed: ' . $db->getLastError() . '<b class="bojacrvena">' . $BrendLink . '</b>';
                        echo '</br>';
                    }


                } else {
                    echo '</br>';
                    echo '<b class="bojacrvena">Nemamo ARTIKAL u bazi, nije moguc update! <i class="bojaljubsajta">ArtikalSifra: '.$ArtikalSifra.'</i></b>';
                    echo '</br>';

                }


            } //ako nemamo kod nas u bazi...
            else {
                echo '</br>';
                echo '<b class="bojacrvenasajt">Nemamo BREND u bazi, nije moguc update! <i class="bojaljubsajta"> Brend Link: '.$BrendLink.'</i></b>';
                echo '</br>';

            }

            $db->commit();

        }

        echo 'Gotov foreach ubac';
        die;

    } else {
        echo 'brojLenght nije > 0';
        die;
    }

} else {
    echo 'empty(tables)';
    die;
}


?>