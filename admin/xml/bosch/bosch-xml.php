<?php
set_time_limit(0); // setovano da ne prekida skriptu
$documentroot = '/data/masinealati'; // ovo koristimo kada je cron
define('DCROOTXML', $_SERVER['DOCUMENT_ROOT']);
define('DCROOTADMINXML', DCROOTXML.'/admin');
$documentroot = DCROOTXML;
require(DCROOTADMINXML . '/xml/centralniXml/setovanjeXml.php');


$kojijevendor = 13;  // id u tabeli cronzaxml
$vendor = 29;  // u tabeli komitenti
$codetip = 'CodeBosch'; // koji je red za sifru u tabel artikli
$brend_code = 31; // tabela brendovi
$nedefinisanoRazno = 164; // ako zelimo da promenimo folder u koji cemo da ubacujemo inicijelno artikle
$TipKatUnitArt = 8; // tabela UNIT 8 je kom
$MinimalnaKolArt = 1; // minmalna kolicina koja moze da se naruci
$folder = 'bosch';

$doc = new DOMDocument();
$doc->load(DCROOTADMINXML . '/xml/'.$folder.'/xmlovi/bosch.xml');
$dataset = $doc->getElementsByTagName("Product"); // uhvati sve Product

$kolikoimachild = $doc->getElementsByTagName('Product')->length;
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

                include('folder/podaci.php');
                //$pokazi .= '<br />ID : ' . $ID . '<br /><br /><br />';
                $MenjanArtikal .= $ArtikalId . ' / ';

                $end = microtime_float();
                $pokazi .= '<hr/><br/>Script Execution Time: ' . round($end - $start, 3) . ' seconds<br/>';

                $pokazi .= '</div>';

            }

        $i++;

        //echo '<br/><br/>';
        if ($i == ($BrojDokle + 10)) break;
        //echo '<hr/>';
        //usleep(100000); // milion je 1 sec

    }
}


echo '<hr/><hr/>';
echo '<br/>Poslednji : ' . $i;
echo '<br/>';

$data = Array (
    'MenjanArtikal' => $MenjanArtikal,
    'BrojDokle' => $i
);
$db->where ('IdCronXml', $kojijevendor);
if ($db->update ('cronzaxml', $data)) {
    $pokazi .= $db->count . ' records were updated';
} else {
    $pokazi .= 'update failed: ' . $db->getLastError();
}

echo $pokazi;

$end = microtime_float();
echo '<br/>';
echo 'Script Execution Time: ' . round($end - $start, 3) . ' seconds<br />';
echo '<br/>';
echo "Gotov update BOSCH <br/>\n";

?>









