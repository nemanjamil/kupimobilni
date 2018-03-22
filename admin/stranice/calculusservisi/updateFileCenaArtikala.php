<?php

$lok = DCROOT . '/xml/ArtikliCeneDownload.xml';

$dom = new DOMDocument();
$dom->load($lok);

$tables = $dom->getElementsByTagName('Table');

if (!empty($tables)) {

    $brojLenght = $tables->length;
    if ($brojLenght > 0) {

        foreach ($tables as $row) {

            $Sifra = $row->getElementsByTagName("Sifra");
            $Sifra = (int)$Sifra->item(0)->nodeValue;

            $naziv = $row->getElementsByTagName("naziv");
            $naziv = $naziv->item(0)->nodeValue;

            $Grupa = $row->getElementsByTagName("Grupa");
            $Grupa = $Grupa->item(0)->nodeValue;

            $DatumCenovnika = $row->getElementsByTagName("DatumCenovnika");
            $DatumCenovnika = $DatumCenovnika->item(0)->nodeValue;

            $Cena = $row->getElementsByTagName("Cena");
            $Cena = $Cena->item(0)->nodeValue;

            $Rabat = $row->getElementsByTagName("Rabat");
            $Rabat = $Rabat->item(0)->nodeValue;


            $colls = array('ArtikalLink', 'ArtikalId');
            $db->where('ArtikalSifra', $Sifra);
            $art = $db->getOne('artikli', $colls);

            $ArtikalLinkUpit = $art['ArtikalLink'];
            $ArtikalIdUpit = $art['ArtikalId'];
            $linkIzUpita = '/' . $ArtikalLinkUpit . '/' . $ArtikalIdUpit;

            if ($ArtikalIdUpit) {

                echo '</br>';
                echo '<b class="bojaljubsvetank" >Selektovan Artikli - ArtikalLink: <a href="' . $linkIzUpita . '" target="_blank">' . $linkIzUpita . '</a>  -Ide update u bazu</b>';
                echo '</br>';
                echo '<b class="bojaljubsvetank">Kategorija: ' . $Grupa . '</b>';
                echo '</br>';


                $update_queryArtikal = Array(
                    'ArtikalVPCena' => $Cena,
                    'ArtikalMPCena' => $Cena,
                    'ArtikalRabat' => $Rabat

                );

                $db->where('ArtikalId', $ArtikalIdUpit);
                $db->update('artikli', $update_queryArtikal);


            } else {

                echo '</br>';
                echo "<h4 class='bojacrvenaosn'>Nema artikla u bazi: $naziv </h4>";
                echo '</br>';
                echo "<h4 class='bojacrvenaosn'>Sifra artikla u Calculusu: $Sifra </h4>";
                echo "</br>";

            }

            $aa++;

            echo '</br>';
            echo $aa;
            echo '</br>';


            usleep(10000);
        }


    } else {
        echo '$brojLenght nije > 0';
        die;
    }

} else {
    echo 'empty($tables)';
    die;
}


