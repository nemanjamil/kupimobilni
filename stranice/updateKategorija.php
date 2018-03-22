<?php

$i = 0;

if (1==1) {
    $dom = new DOMDocument();
    $dom->load(DCROOT.'/xml/GrupaArtUsl.xml');
    $tables = $dom->getElementsByTagName('Table');

    if (!empty($tables)) {

        $brojLenght = $tables->length;
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


                    echo '<div style="background-color: #f5e79e;padding: 10px;border: 1px solid;margin: 5px;">';
                    echo '<div>UPDATE</div>';
                    echo '<div class="bojacrvena">Odradjen update - ubacen u KategorijaArtikalaSifra: ' . $sifra . '</div>';
                    echo '<div class="bojacrvena">Odradjen naziv : ' . $naziv . '</div>';
                    echo '<div class="bojacrvena">ID : ' . $ID . '</div>';
                    echo '<div class="bojacrvena">IDnadredjene : ' . $IDnadredjene . '</div>';

                    require('servisi/naziviKategorija.php');

                    echo '</div>';





                } else {


                    // select * from where  KategorijaArtikalaLink= $KatLink ako ima onda
                    //  $KatLink = $KatLink.rand(1,10);

                    $insert_query = Array(
                        'KategorijaArtiklaExtId' => $ID,
                        'KategorijaArtikalaTitle' => $naziv,
                        'KategorijaArtikalaLink' => $KatLink,
                        'KategorijaArtikalaSifra' => $sifra,
                        'ParentKategorijaArtiklaExtId' => $IDnadredjene
                    );
                    $idUbacenogart = $db->insert('kategorijeartikala', $insert_query);
                    $ID = $idUbacenogart;

                    echo '<div style="background-color: #f5e79e;padding: 10px;border: 2px">';
                    echo '<div>INSERT</div>';

                    require('servisi/naziviKategorija.php');

                    echo '</div>';


                }


                $db->commit();

                /*if ($i==2) {
                    echo 'dossli samo do 2';
                    die;
                }*/
                $i++;

            }


        } else {
            echo '$brojLenght nije > 0';
            die;
        }
    } else {
        echo 'empty($tables)';
        die;
    }
} else {
    echo 'nema curlinitstanje';
    die;
}


