<?php

$lok = ROOTLOC . '/xml/ArtikliStanjeDownload.xml';

$dom = new DOMDocument();
$dom->load($lok);

$tables = $dom->getElementsByTagName('Table');

if (!empty($tables)) {

    $brojLenght = $tables->length;
    $log->lwrite('$brojLenght: '.$brojLenght);

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

                $log->lwrite('Selektovan Artikli - ArtikalLink: : '.$linkIzUpita.'   -Ide update u bazu');
                $log->lwrite('Kategorija: ' . $grupa );

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

                $log->lwrite('Nema artikla u bazi: '.$naziv . ' Sifra artikla u Calculusu: '.$sifra . ' Kategorija artikla u Calculusu: '.$grupa);


            }

            $aa++;


            $log->lwrite('R.br.: ' . $aa);

            usleep(10000);

        }


    } else {
        $log->lwrite('brojLenght nije > 0');
    }

} else {
    $log->lwrite('empty(tables)');

}