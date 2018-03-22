<?php

$calculus = new calculusServisi($db);

$urlServisa = URLCALCSERVICE . 'GrupaArtUsl';
$postParametri = [
    'artusl' => 'A',
    'klasifikacija' => '',
    'sifra' => '',
    'naziv' => '',
    'nivo' => ''

];

$curlInitStanje = $calculus->posaljiPodatkeCalc($urlServisa, $postParametri);

if ($curlInitStanje) {
    $dom = new DOMDocument();
    $dom->loadXML($curlInitStanje);
    $dom->save(ROOTLOC . '/xml/GrupaArtUsl.xml');
    $tables = $dom->getElementsByTagName('Table');

    if (!empty($tables)) {

        $brojLenght = $tables->length;
        $log->lwrite('Koliko ima redova : ' . $brojLenght . ' Time : ' . $timeUbac . '');

        if ($brojLenght > 0) {

            foreach ($tables as $row) {

                $ID = $row->getElementsByTagName("ID");
                $ID = (int)$ID->item(0)->nodeValue;

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


                if ($nivo == 0) {

                    $db->where('KategorijaArtiklaExtId', $ID);
                    $upit = $db->getOne('kategorijeartikala', null, 'KategorijaArtiklaExtId');
                    $KategorijaArtiklaExtIdUpit = $upit['KategorijaArtiklaExtId'];

                    if ($KategorijaArtiklaExtIdUpit) {

                        $update_kateg = Array(
                            'KategorijaArtikalaTitle' => $naziv,
                            'ParentKategorijaArtiklaExtId' => $IDnadredjene
                        );
                        $db->where('KategorijaArtiklaExtId', $ID);
                        $db->update('kategorijeartikala', $update_kateg);

                        $log->lwrite('Update Parent: IdGrupe: ' . $ID . ' IdNAD Grupe: ' . $IDnadredjene . ' Naziv:' . $naziv . ' Sifra: ' . $sifra . ' Time : ' . $timeUbac);

                    } else {

                        $insert_query = Array(
                            'KategorijaArtiklaExtId' => $ID,
                            'KategorijaArtikalaTitle' => $naziv,
                            'KategorijaArtikalaLink' => $KatLink,
                            'KategorijaArtikalaSifra' => $sifra,
                            'ParentKategorijaArtiklaExtId' => $IDnadredjene
                        );
                        $idUbacenogart = $db->insert('kategorijeartikala', $insert_query);

                        $log->lwrite('Ubacen Parent: IdGrupe: ' . $ID . ' IdNAD Grupe: ' . $IDnadredjene . ' Naziv:' . $naziv . ' Sifra: ' . $sifra . ' Time : ' . $timeUbac);

                    }


                } else {

                    $log->lwrite('Preskacem: IdGrupe: ' . $ID . ' Naziv: ' . $naziv . ' Time : ' . $timeUbac);
                }

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
