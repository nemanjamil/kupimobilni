<?php
/**
 * Created by PhpStorm.
 * User: Nikola Markovic
 * Date: 02.11.2017.
 * Time: 09:32
 * Expl: Servis za ubacivanje Tipova Dokumenata na sajt
 */

$calculus = new calculusServisi($db);

$urlServisa = URLCALCSERVICE . 'TipDokumenta';
$postParametri = [
    'sifra' => '',
    'naziv' => '',
    'sifapl' => ''

];

$curlInitStanje = $calculus->posaljiPodatkeCalc($urlServisa, $postParametri);


if ($curlInitStanje) {
    $dom = new DOMDocument();
    $dom->loadXML($curlInitStanje);
    //$dom->save(DCROOT.'/xml/TipoviDokumenata.xml');
    $tables = $dom->getElementsByTagName('Table');

    if (!empty($tables)) {

        $brojLenght = $tables->length;
        if ($brojLenght > 0) {

            foreach ($tables as $row) {

                $sifra = $row->getElementsByTagName("sifra");
                $sifra = $sifra->item(0)->nodeValue;

                $naziv = $row->getElementsByTagName("naziv");
                $naziv = $naziv->item(0)->nodeValue;

                $formatbroja = $row->getElementsByTagName("formatbroja");
                $formatbroja = $formatbroja->item(0)->nodeValue;


                $db->where('TipDokumenataSifra', $sifra);
                $upit = $db->getOne('tipovidokumenata', null, 'TipDokumenataId');
                $TipDokumenataId = $upit['TipDokumenataId'];

                if ($TipDokumenataId) {

                    $update_kateg = Array(
                        'TipDokumenataNaziv' => $naziv,
                        'TipDokumenataSifra' => $sifra
                    );
                    $db->where('TipDokumenataId', $TipDokumenataId);
                    if ($db->update('tipovidokumenata', $update_kateg)) {
                        echo '</br>';
                        echo '<b class="bojaplavasajt">Update Tipovi Dokumenata: TipDokumenataId: ' . $TipDokumenataId . ' TipDokumenataSifra: ' . $sifra . ' Naziv:' . $naziv . '</b>';
                        echo '</br>';
                    } else {
                        echo '</br>';
                        echo '<b class="bojaNaran"> Update Tipovi Dokumenata failed: ' . $db->getLastError() . '<b class="bojacrvena">' . $naziv . ' Sifra: '.$sifra.'</b>';
                        echo '</br>';
                    }
                } else {

                    $insert_query = Array(
                        'TipDokumenataNaziv' => $naziv,
                        'TipDokumenataSifra' => $sifra
                    );
                    $idUbacenogart = $db->insert('tipovidokumenata', $insert_query);

                    if ($idUbacenogart) {
                        echo '</br>';
                        echo '<b class="bojacrvena">Ubacen Tipovi Dokumenata:: ' . $idUbacenogart . '; Naziv:' . $naziv . ' TipDokumenataSifra: ' . $sifra . '</b>';
                        echo '</br>';
                    } else {
                        echo '</br>';
                        echo '<b class="bojaljub">Nije ubacen TIP DOKUMENTA! Neki fail! </b><b class="bojacrvena"> Naziv: ' . $naziv . ' Sifra: '.$sifra.'</b>';
                        echo '</br>';
                    }

                }


            }
            echo '</br>';
            echo '</br>';
            echo '<h3 class="bojazelenaener">Ubaceni Tipovi Dokumenata</h3>';
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
