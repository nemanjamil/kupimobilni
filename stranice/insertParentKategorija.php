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
    $dom->save($documentroot.'/xml/GrupaArtUsl.xml');
    $tables = $dom->getElementsByTagName('Table');

    if (!empty($tables)) {

        $brojLenght = $tables->length;
        if ($brojLenght > 0) {

            foreach ($tables as $row) {

                $ID = $row->getElementsByTagName("ID");
                $ID = (int)$ID->item(0)->nodeValue;

                $sifra = $row->getElementsByTagName("sifra");
                $sifra = $sifra->item(0)->nodeValue;

                $naziv = $row->getElementsByTagName("naziv");
                $naziv = mb_strimwidth($naziv->item(0)->nodeValue,0,73);
                //$naziv = $naziv->item(0)->nodeValue;

                $ceonaziv = $row->getElementsByTagName("ceonaziv");
                $ceonaziv = $ceonaziv->item(0)->nodeValue;

                /*$nadredjena = $row->getElementsByTagName("nadredjena");
                $nadredjena = $nadredjena->item(0)->nodeValue;*/

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

                        if ($inicijelno_punjenje==1) {
                            $update_kateg = Array(
                                'KategorijaArtikalaTitle' => $naziv,
                                'ParentKategorijaArtiklaExtId' => $IDnadredjene
                            );
                            $db->where('KategorijaArtiklaExtId', $ID);
                            $db->update('kategorijeartikala', $update_kateg);

                            $prikaz .= '</br>';
                            $prikaz .= '<b class="bojaplavasajt">Update Parent: IdGrupe: ' . $ID . ' IdNAD Grupe: ' . $IDnadredjene . ' Naziv:' . $naziv . ' Sifra: ' . $sifra . '</b>';
                            $prikaz .= '</br>';
                        }

                    } else {

                        $insert_query = Array(
                            'KategorijaArtiklaExtId' => $ID,
                            'KategorijaArtikalaTitle' => $naziv,
                            'KategorijaArtikalaLink' => $KatLink,
                            'KategorijaArtikalaSifra' => $sifra,
                            'ParentKategorijaArtikalaId' => 6,
                            'ParentKategorijaArtiklaExtId' => $IDnadredjene
                        );
                        $idUbacenogart = $db->insert('kategorijeartikala', $insert_query);

                        $prikaz .= '</br>';
                        $prikaz .= '<b class="bojacrvena">Ubacen Parent: IdGrupe: ' . $ID . '; IdNAD Grupe: ' . $IDnadredjene.'; Naziv:' . $naziv . ' Sifra: ' . $sifra.'</b>';
                        $prikaz .= '</br>';

                    }


                } else {

                    $prikaz .= '</br>';
                    $prikaz .= 'Preskacem: IdGrupe: ' . $ID . ' Naziv: ' . $naziv;
                    $prikaz .= '</br>';
                }

            }

        } else {
            $prikaz .= 'brojLenght nije > 0';
            die;
        }

    } else {
        $prikaz .= 'empty(tables)';
        die;
    }

} else {
    $prikaz .= 'nema curlinitstanje';
    die;
}
