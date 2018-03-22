<?php

require 'includeZaCronCalcServise.php';


require ROOTLOC . '/obradi/snimiTxt.php';
$logLoc = ROOTLOC . '/logovi/logVrDok.txt';

$log->lfile($logLoc);
$log->lwrite('');
$log->lwrite('Masine ENV : ' . $serverVarijabla);
$log->lwrite('Calculus Tipovi dokumenata Cron : ' . $timeUbac );


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

                        $log->lwrite('Update Tipovi Dokumenata: TipDokumenataId: ' . $TipDokumenataId . ' TipDokumenataSifra: ' . $sifra . ' Naziv:' . $naziv . '');
                    } else {
                        $log->lwrite('Update Tipovi Dokumenata failed: ' . $db->getLastError() . '  ' . $naziv . ' Sifra: ' . $sifra . ' ');
                    }
                } else {

                    $insert_query = Array(
                        'TipDokumenataNaziv' => $naziv,
                        'TipDokumenataSifra' => $sifra
                    );
                    $idUbacenogart = $db->insert('tipovidokumenata', $insert_query);

                    if ($idUbacenogart) {
                        $log->lwrite('Ubacen Tip Dokumenta: ' . $idUbacenogart . '; Naziv:' . $naziv . ' TipDokumenataSifra: ' . $sifra . ' Time : ' . $timeUbac . '');
                    } else {
                        $log->lwrite('Nije ubacen TIP DOKUMENTA! Neki fail! Naziv: ' . $naziv . ' Sifra: '.$sifra.' Time : ' . $timeUbac . '');
                    }

                }


            }
            $log->lwrite('Ubaceni Tipovi Dokumenata Time : ' . $timeUbac . '');
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
