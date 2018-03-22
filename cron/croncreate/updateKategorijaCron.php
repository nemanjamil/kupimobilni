<?php

$i = 0;

if (1 == 1) {
    $dom = new DOMDocument();
    $dom->load(ROOTLOC . '/xml/GrupaArtUsl.xml');
    $tables = $dom->getElementsByTagName('Table');

    if (!empty($tables)) {

        $brojLenght = $tables->length;
        $log->lwrite('Koliko ima redova : ' . $brojLenght . ' Time : ' . $timeUbac . '');

        if ($brojLenght > 0) {

            foreach ($tables as $row) {

                $ID = $row->getElementsByTagName("ID");
                $ID = $ID->item(0)->nodeValue;

                $sifra = $row->getElementsByTagName("sifra");
                $sifra = $sifra->item(0)->nodeValue;

                $naziv = $row->getElementsByTagName("naziv");
                $naziv = $naziv->item(0)->nodeValue;

                $ceonaziv = $row->getElementsByTagName("ceonaziv");
                $ceonaziv = $ceonaziv->item(0)->nodeValue;

                $nadredjena = $row->getElementsByTagName("nadredjena");
                $nadredjena = $nadredjena->item(0)->nodeValue;

                $IDnadredjene = $row->getElementsByTagName("IDnadredjene");
                $IDnadredjene = $IDnadredjene->item(0)->nodeValue;

                $nivo = $row->getElementsByTagName("nivo");
                $nivo = (int)$nivo->item(0)->nodeValue;

                $KatLink = $common->friendly_convert($naziv);

                $db->startTransaction();

                $db->where('KategorijaArtiklaExtId', $ID);
                $upit = $db->getOne('kategorijeartikala', null, 'KategorijaArtiklaExtId');
                $KategorijaArtiklaExtIdUpit = $upit['KategorijaArtiklaExtId'];

                if ($KategorijaArtiklaExtIdUpit) {

                    $update_query = Array(
                        'KategorijaArtikalaTitle' => $naziv,
                        'ParentKategorijaArtiklaExtId' => $IDnadredjene
                        //'KategorijaArtikalaSifra' => $sifra,
                        //'KategorijaArtikalaLink' => $KatLink . '-' . rand(0, 100000)

                    );

                    $db->where('KategorijaArtiklaExtId', $ID);
                    $db->update('kategorijeartikala', $update_query);

                    $log->lwrite('UPDATE - Time : ' . $timeUbac . '');
                    $log->lwrite('Odradjen update- ubacen u KategorijaArtikalaSifra: ' . $sifra . ' Odradjen naziv : ' . $naziv . ' ID : ' . $ID . '');

                    require(ROOTLOC . '/stranice/servisi/naziviKategorija.php');

                } else {

                    $insert_query = Array(
                        'KategorijaArtiklaExtId' => $ID,
                        'KategorijaArtikalaTitle' => $naziv,
                        'KategorijaArtikalaLink' => $KatLink,
                        'KategorijaArtikalaSifra' => $sifra,
                        'ParentKategorijaArtiklaExtId' => $IDnadredjene
                    );
                    $idUbacenogart = $db->insert('kategorijeartikala', $insert_query);
                    $ID = $idUbacenogart;

                    $log->lwrite('INSERT - Time : ' . $timeUbac . '');

                    require(ROOTLOC . '/stranice/servisi/naziviKategorija.php');

                }

                $db->commit();

                $i++;

            }

        } else {
            $log->lwrite('brojLenght nije > 0 Time : ' . $timeUbac);
        }
    } else {
        $log->lwrite('empty(tables) Time : ' . $timeUbac);

    }
} else {
    $log->lwrite('nema curlinitstanje Time : ' . $timeUbac);
}
