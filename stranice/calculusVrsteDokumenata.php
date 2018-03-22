<?php
/**
 * Created by PhpStorm.
 * User: Nikola Markovic
 * Date: 02.11.2017.
 * Time: 09:32
 * Expl: Servis za ubacivanje Tipova Dokumenata na sajt
 */

$calculus = new calculusServisi($db);

$urlServisa = URLCALCSERVICE . 'VrstaDokumenta';
$postParametri = [
    'tipdok' => '',
    'naziv' => '',
    'prefix' => '',
    'sufix' => ''

];

$curlInitStanje = $calculus->posaljiPodatkeCalc($urlServisa, $postParametri);

if ($curlInitStanje) {
    $dom = new DOMDocument();
    $dom->loadXML($curlInitStanje);
    //$dom->save(DCROOT.'/xml/VrsteDokumenata.xml');
    $tables = $dom->getElementsByTagName('Table');

    if (!empty($tables)) {

        $brojLenght = $tables->length;
        if ($brojLenght > 0) {

            foreach ($tables as $row) {

                $sifra = $row->getElementsByTagName("sifra");
                $sifra = $sifra->item(0)->nodeValue;

                $naziv = $row->getElementsByTagName("naziv");
                $naziv = $naziv->item(0)->nodeValue;

                $brojbpref = $row->getElementsByTagName("brojbpref");
                $brojbpref = $brojbpref->item(0)->nodeValue;

                $brojbsuf = $row->getElementsByTagName("brojbsuf");
                $brojbsuf = $brojbsuf->item(0)->nodeValue;


                $db->where('VrsteDokumenataPrefiks', $brojbpref);
                $upit = $db->getOne('vrstedokumenata', null, 'VrsteDokumenataId');
                $VrsteDokumenataId = $upit['VrsteDokumenataId'];

                if ($VrsteDokumenataId) {

                    $update_kateg = Array(
                        'VrsteDokumenataNaziv' => $naziv,
                        'VrsteDokumenataPrefiks' => $brojbpref,
                        'TipDokumenataSifra' => $sifra
                    );
                    $db->where('VrsteDokumenataId', $VrsteDokumenataId);
                    if ($db->update('vrstedokumenata', $update_kateg)) {
                        echo '</br>';
                        echo '<b class="bojaplavasajt">Update Vrste Dokumenata: VrsteDokumenataId: ' . $VrsteDokumenataId . ' TipDokumenataSifra: ' . $sifra . ' Naziv:' . $naziv . '</b>';
                        echo '</br>';
                    } else {
                        echo '</br>';
                        echo '<b class="bojaNaran"> Update Vrste Dokumenata failed: ' . $db->getLastError() . '<b class="bojacrvena">' . $naziv . '</b>';
                        echo '</br>';
                    }
                } else {

                    $insert_query = Array(
                        'VrsteDokumenataNaziv' => $naziv,
                        'VrsteDokumenataPrefiks' => $brojbpref,
                        'TipDokumenataSifra' => $sifra
                    );
                    $idUbacenogart = $db->insert('vrstedokumenata', $insert_query);

                    if ($idUbacenogart) {
                        echo '</br>';
                        echo '<b class="bojacrvena">Ubacen Vrste Dokumenata:: ' . $idUbacenogart . '; Naziv:' . $naziv . ' TipDokumenataSifra: ' . $sifra . '</b>';
                        echo '</br>';
                    } else {
                        echo '</br>';
                        echo '<b class="bojaljub">Nije ubacen Vrste DOKUMENTA! Neki fail!</b>';
                        echo '</br>';
                    }

                }


            }
            echo '</br>';
            echo '</br>';
            echo '<h3 class="bojazelenaener">Ubacene Vrste Dokumenata</h3>';
            echo '</br>';
            echo '</br>';

        } else {
            echo 'brojLenght nije > 0';
            die;
        }

    } else {
        echo 'empty(tables)';
        die;
    }

} else {
    echo 'nema curlinitstanje';
    die;
}
