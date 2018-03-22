<?php
// bg.company3g.com/xml/3gmobilniCentar.zip.
set_time_limit(300); // setovano da ne prekida skriptu

function kojijehost($tipHosta){

    if ($tipHosta) {
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
$log->lwrite('OK 3g XML -> tip HOST '.$documentroot.'; ROOTLOC : '.ROOTLOC);



$kojijevendor = 6;  // id u tabeli cronzaxml
$vendor = 90;  // u tabeli komitenti
$codetip = 'code3g'; // koji je red za sifru u tabel artikli
$brend_code = 50; // tabela brendovi 3g Brend je 50
$nedefinisanoRazno = 164; // ako zelimo da promenimo folder u koji cemo da ubacujemo inicijelno artikle
$TipKatUnitArt = 8; // tabela UNIT 8 je kom
$MinimalnaKolArt = 1; // minmalna kolicina koja moze da se naruci
$folder = '3gsimus';

$doc = new DOMDocument();
$doc->load($documentrootAdmin . '/xml/'.$folder.'/xmlovi/3gMobilniCentar.xml');
$dataset = $doc->getElementsByTagName("artikal"); // uhvati sve Product

$kolikoimachild = $doc->getElementsByTagName('artikal')->length;
$pokazi = '<br/>Ukupno CHILD : ' . $kolikoimachild . '<br/>'; // 6


$cols = Array("BrojDokle");
$db->where("IdCronXml", $kojijevendor);
$users = $db->getOne("cronzaxml", null, $cols);

$BrojDokle = (int) $users['BrojDokle'];

$k=0;
$i = 0;
$BrojDokle = ($BrojDokle) ? $BrojDokle : 0;
$pokazi .= 'Dokle smo dosli - BrojDokle : ';
$pokazi .= $BrojDokle;
$pokazi .= '<br/>';

if ($kolikoimachild > $BrojDokle) {
    foreach ($dataset as $row) {

        $pokazi .= '<br/>Redni broj : ' . $i . ' - Broj dokle : ' . $BrojDokle . '<br/>';
        $pokazi .= '<br/>'.$common->microtime_floatProlaz($start, 'ubaciSlikeFile').'<br/>';

            if ($i >= $BrojDokle) {

                $pokazi .= '<div style="background-color: lightcyan;padding: 20px;border: 1px solid black">';

                $pokazi .= '<div style="background-color: peru;padding: 20px;border: 1px solid black">';
                    $pokazi .= $common->microtime_floatProlaz($start, 'ubaciSlikeFile');
                $pokazi .= '</div>';

                include('folder/podaci.php');
                //$pokazi .= '<br />ID : ' . $ID . '<br /><br /><br />';
                $MenjanArtikal .= $ArtikalId . ' /('.$sifra.')  extId :  [ '.$extId.' ] ; ';

                $end = microtime_float();
                $pokazi .= '<hr/><br/>Script Execution Time: ' . round($end - $start, 3) . ' seconds<br/>';

                $pokazi .= '</div>';

            }

        $i++;

        //echo '<br/><br/>';
        if ($i == ($BrojDokle +20)) break;
        //echo '<hr/>';
        //usleep(100000); // milion je 1 sec

    }
} else {
    $log->lwrite('DOSAO DO 0 3G XML');
    echo 'Nema vise';
    die;
}


echo '<hr/><hr/>';
echo '<br/>Poslednji : ' . $i;
echo '<br/>';

require($documentrootAdmin.'/xml/centralniXml/azurirajCronZaXML.php');


echo $pokazi;

$end = microtime_float();
echo '<br/>';
echo 'Script Execution Time: ' . round($end - $start, 3) . ' seconds<br />';
echo '<br/>';
echo "Gotov update 3g Company <br/>\n";

$log->lwrite('KRAJ 3G XML '.$MenjanArtikal);
?>









