<?php
set_time_limit(0); // setovano da ne prekida skriptu

function kojijehost($tipHosta){

    if ($tipHosta==1) {
        $hostTip = '/data/kupimobilni';
    } else {
        $hostTip = '/var/www/masine';
    }
    return $hostTip;
}
$mcProd = getenv('MASINEENV');
$documentroot = kojijehost($mcProd);
$documentrootAdmin = $documentroot.'/admin';
define('ROOTLOC', $documentroot);

require($documentrootAdmin.'/xml/centralniXml/setovanjeXml.php');

require $documentroot."/stranice/elasticTest/logTxtElastic.php";
$log->lwrite('OK VERMAX MAKITA OSTALI -> tip HOST '.$documentroot.'; ROOTLOC : '.ROOTLOC);

$kojijevendor = 20;  // id u tabeli cronzaxml @vermax ostalo@
$vendor = 54;  // u tabeli komitenti
$codetip = 'codevermax'; // koji je red za sifru u tabel artikli
$codetipLink = 'codevermaxlink'; // art za ubaciti link na AGRO
$codetipLinkDodatna = 'codevermaxlink'; // kolona na Dodatnoj opremi

$brend_code = 35; // tabela brendovi
$nedefinisanoRazno = 164; // ako zelimo da promenimo folder u koji cemo da ubacujemo inicijelno artikle
$TipKatUnitArt = 8; // tabela UNIT 8 je kom
$MinimalnaKolArt = 1; // minmalna kolicina koja moze da se naruci
$folder = 'vermax';

$doc = new DOMDocument();
$doc->load($documentrootAdmin . '/xml/'.$folder.'/xmlovi/vermax_mak_delovi.xml');
$dataset = $doc->getElementsByTagName("artikal"); // uhvati sve Product

$kolikoimachild = $doc->getElementsByTagName('artikal')->length;
$pokazi = '<br/>Ukupno CHILD : ' . $kolikoimachild . '<br/>'; // 6


$cols = Array("BrojDokle");
$db->where("IdCronXml", $kojijevendor);
$users = $db->getOne("cronzaxml", null, $cols);

$BrojDokle = $users['BrojDokle'];


$i = 0;
$BrojDokle = ($BrojDokle) ? $BrojDokle : '0';
$pokazi .= 'Dokle smo dosli - BrojDokle : ';
$pokazi .= $BrojDokle;
$pokazi .= '<br/>';

if ($kolikoimachild > $BrojDokle) {
    foreach ($dataset as $row) {

        $pokazi .= '<br/>Redni broj : ' . $i . ' - Broj dokle : ' . $BrojDokle . '<br/>';

            if ($i >= $BrojDokle) {

                $pokazi .= '<div style="background-color: lightcyan;padding: 20px;border: 1px solid black">';

                include($documentrootAdmin.'/xml/vermax/folder/podaci.php');
                //$pokazi .= '<br />ID : ' . $ID . '<br /><br /><br />';
                $MenjanArtikal .= $ArtikalId . ' /('.$sifra.') [ '.$ArtikalIdDodatna.' ] ; ';

                $end = microtime_float();
                $pokazi .= '<hr/><br/>Script Execution Time: ' . round($end - $start, 3) . ' seconds<br/>';

                $pokazi .= '</div>';

            }

        $i++;

        //echo '<br/><br/>';
        if ($i == ($BrojDokle + KOLIKOXML)) break;
        //echo '<hr/>';
        //usleep(100000); // milion je 1 sec

    }
} else {
    $log->lwrite('DOSAO DO 0 VERMAX OSTALO MAK XML');
    echo 'Nema vise';
    die;
}


$pokazi .=  '<br/>Poslednji : ' . $i;
$pokazi .=  '<br/>';


require($documentrootAdmin.'/xml/centralniXml/azurirajCronZaXML.php');


echo $pokazi;

$end = microtime_float();
echo '<br/>';
echo 'Script Execution Time: ' . round($end - $start, 3) . ' seconds<br />';
echo '<br/>';
echo "Gotov update VERMAX <br/>\n";

$log->lwrite('KRAJ VERMAX MAKITA OSTALI XML '.$MenjanArtikal);


?>









