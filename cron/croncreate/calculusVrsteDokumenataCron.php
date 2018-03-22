<?php

require 'includeZaCronCalcServise.php';


require ROOTLOC . '/obradi/snimiTxt.php';
$logLoc = ROOTLOC . '/logovi/logVrDok.txt';

$log->lfile($logLoc);
$log->lwrite('');
$log->lwrite('Masine ENV : ' . $serverVarijabla);
$log->lwrite('Calculus Vrste dokumenata Cron : ' . $timeUbac );


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

        $log->lwrite('Koliko ima redova : ' . $brojLenght .' Time : ' . $timeUbac . '');


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
                        $log->lwrite('Update Vrste Dokumenata: VrsteDokumenataId: ' . $VrsteDokumenataId . ' TipDokumenataSifra: ' . $sifra . ' Naziv:' . $naziv);
                    } else {
                        $log->lwrite('Update Vrste Dokumenata failed: ' . $db->getLastError() . ' Naziv: ' . $naziv);
                    }
                } else {

                    $insert_query = Array(
                        'VrsteDokumenataNaziv' => $naziv,
                        'VrsteDokumenataPrefiks' => $brojbpref,
                        'TipDokumenataSifra' => $sifra
                    );
                    $idUbacenogart = $db->insert('vrstedokumenata', $insert_query);

                    if ($idUbacenogart) {
                        $log->lwrite('Ubacen Vrste Dokumenata:: ' . $idUbacenogart . '; Naziv:' . $naziv . ' TipDokumenataSifra: ' . $sifra .' Time : ' . $timeUbac . '');
                    } else {
                        $log->lwrite('Nije ubacen Vrste DOKUMENTA! Neki fail! Time : ' . $timeUbac . '');
                    }

                }

            }
            $log->lwrite('Ubacene Vrste Dokumenata Time : ' . $timeUbac . '');
            $log->lclose();
        } else {
            $log->lwrite('brojLenght nije > 0 Time : ' . $timeUbac . '');
            $log->lclose();
        }

    } else {
        $log->lwrite('empty(tables) Time : ' . $timeUbac . '');
        $log->lclose();
    }

} else {
    $log->lwrite('Nema curlinitstanje Time : ' . $timeUbac . '');
    $log->lclose();
}
