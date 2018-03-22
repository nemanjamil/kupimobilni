<?php

$lok = DCROOT . '/xml/ArtikliStanjeDownload.xml';

$dom = new DOMDocument();
$dom->load($lok);

$tables = $dom->getElementsByTagName('Table');

if (!empty($tables)) {

    $brojLenght = $tables->length;
    if ($brojLenght > 0) {

        foreach ($tables as $row) {

            $sifra = $row->getElementsByTagName("sifra");
            $sifra = $sifra->item(0)->nodeValue;

            $naziv = $row->getElementsByTagName("naziv");
            $naziv = $naziv->item(0)->nodeValue;

            $jdm = $row->getElementsByTagName("jdm");
            $jdm = $jdm->item(0)->nodeValue;

            $stanje = $row->getElementsByTagName("stanje");
            $stanje = (int)$stanje->item(0)->nodeValue;

            $rezervisano = $row->getElementsByTagName("rezervisano");
            $rezervisano = (int)$rezervisano->item(0)->nodeValue;

            $pozajmice = $row->getElementsByTagName("pozajmice");
            $pozajmice = (int)$pozajmice->item(0)->nodeValue;

            $grupa = $row->getElementsByTagName("grupa");
            $grupa = $grupa->item(0)->nodeValue;

            $cena = $row->getElementsByTagName("cena");
            $cena = (float)$cena->item(0)->nodeValue;

            $rabat = $row->getElementsByTagName("rabat");
            $rabat = (float)$rabat->item(0)->nodeValue;

            $opis = $row->getElementsByTagName("opis");
            $opis = $opis->item(0)->nodeValue;


            $ArtikalStanje = $stanje - $pozajmice - $rezervisano;

            $colls = array('ArtikalLink', 'ArtikalId');
            $db->where('ArtikalSifra', $sifra);
            $art = $db->getOne('artikli', $colls);

            $ArtikalLinkUpit = $art['ArtikalLink'];
            $ArtikalIdUpit = $art['ArtikalId'];
            $linkIzUpita = '/' . $ArtikalLinkUpit . '/' . $ArtikalIdUpit;

            if ($ArtikalIdUpit) {

                echo '</br>';
                echo '<b class="bojaljubsvetank" >Selektovan Artikli - ArtikalLink: <a href="' . $linkIzUpita . '" target="_blank">' . $linkIzUpita . '</a>  -Ide update u bazu</b>';
                echo '</br>';
                echo '<b class="bojaljubsvetank">Kategorija: ' . $grupa . '</b>';
                echo '</br>';

                /*Zapocinjemo transakciju -> */
                $db->startTransaction();


                /*Ubacujemo cene i stanje u bazu, tabela: artikli*/
                $update_queryArtikal = Array(
                    'ArtikalVPCena' => $cena,
                    'ArtikalMPCena' => $cena,
                    'ArtikalRabat' => $rabat,
                    'ArtikalStanje' => $ArtikalStanje

                );

                $db->where('ArtikalId', $ArtikalIdUpit);
                $db->update('artikli', $update_queryArtikal);
                //Gotov ubac u artikli


                /*Ubacujemo opis u bazu, tabela: artiklitekstovinew*/
                $insert_queryOpis = Array(
                    'ArtikalId' => $ArtikalIdUpit,
                    'LanguageId' => 5,
                    'OpisArtTekst' => $opis

                );

                $db->insert('artiklitekstovinew', $insert_queryOpis);
                //Gotov ubac u artiklitekstovinew


                /*Ubacujemo kratak opis u bazu, tabela: artiklitekstovinew*/
                $insert_queryKratakOpis = Array(
                    'IdArtiklaAkon' => $ArtikalIdUpit,
                    'IdLanguageAkon' => 5,
                    'OpisKratakOpis' => $opis

                );

                $db->insert('artiklikratakopisnew', $insert_queryKratakOpis);
                //Gotov ubac u artiklikratakopisnew


                /*-> Zavrsavamo transakciju! */
                $db->commit();


            } else {

                echo '</br>';
                echo '<h4 class="bojacrvenaosn">Nema artikla u bazi: '.$naziv.' </h4>';
                echo '</br>';
                echo '<h4 class="bojacrvenaosn">Sifra artikla u Calculusu: '.$sifra.' </h4>';
                echo '</br>';
                echo '<h4 class="bojacrvenaosn"">Kategorija artikla u Calculusu: '.$grupa.' </h4>';
                echo '</br>';

            }

            $aa++;

            echo '</br>';
            echo 'R.br.: ' . $aa;
            echo '</br>';

            usleep(10000);

        }


    } else {
        echo 'brojLenght nije > 0';
        die;
    }

} else {
    echo 'empty(tables)';
    die;
}