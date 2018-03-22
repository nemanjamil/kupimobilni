<?php
error_reporting( E_ALL & ~E_NOTICE );
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

require_once($documentroot . '/thumblib/ThumbLib.inc.php'); // include class

require($documentrootAdmin.'/xml/centralniXml/setovanjeXml.php');

require $documentroot."/stranice/elasticTest/logTxtElastic.php";
$log->lwrite('OK TSMOD XML -> tip HOST '.$documentroot.'; ROOTLOC : '.ROOTLOC);


/*echo $lokdosert = $documentrootAdmin.'/xml/kimtec/';
echo '<br/>';
echo '<br/>';


$linkdoxml = 'https://b2b.kimtec.rs/slike/01001071_big.jpg';
$lfile = $lokdosert.'/p/test.jpg';
$fp = fopen($lfile, "w");

if(file_exists($lokdosert."certs/ca.pem") && file_exists($lokdosert."certs/client.pem") && file_exists($lokdosert."certs/key.pem"))
{


    $ch =curl_init();
    curl_setopt($ch, CURLOPT_URL,$linkdoxml);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
    curl_setopt($ch, CURLOPT_SSLVERSION, 3);
    curl_setopt($ch, CURLOPT_CAINFO, $lokdosert."certs/ca.pem");
    curl_setopt($ch, CURLOPT_SSLCERT, $lokdosert."certs/client.pem");
    curl_setopt($ch, CURLOPT_SSLKEY, $lokdosert."certs/key.pem");
    curl_setopt($ch, CURLOPT_SSLKEYPASSWD, "miki"); // pin vezan za B2B certifikat
    curl_setopt($ch, CURLOPT_FILE, $fp);
    $return = curl_exec ($ch);
    //echo $return;
    echo curl_error($ch);
    curl_close ($ch);

}*/


$kojijevendor = 1;  // id u tabeli cronzaxml
$vendor = 120;  // u tabeli komitenti
$codetip = 'codekimtec'; // koji je red za sifru u tabel artikli
$codetipLink = ''; // art za ubaciti link na AGRO
$codetipLinkDodatna = ''; // kolona na Dodatnoj opremi
$brend_code = 49; // tabela brendovi
$nedefinisanoRazno = 164; // ako zelimo da promenimo folder u koji cemo da ubacujemo inicijelno artikle
$TipKatUnitArt = 8; // tabela UNIT 8 je kom
$MinimalnaKolArt = 1; // minmalna kolicina koja moze da se naruci
$folder = 'kimtec';

$doc = new DOMDocument();
$doc->validateOnParse = true;
$doc->load($documentrootAdmin . '/xml/'.$folder.'/xmlovi/GetProductsPriceList.xml');
$dataset = $doc->getElementsByTagName("Table"); // uhvati sve Product

$dockatalog = new DOMDocument();
$dockatalog->validateOnParse = true;
$dockatalog->load($documentrootAdmin . '/xml/'.$folder.'/xmlovi/GetProductsList.xml');
$dockatalogxpath = new DOMXPath($dockatalog);

$docspec = new DOMDocument();
$docspec->validateOnParse = true;
$docspec->load($documentrootAdmin . '/xml/'.$folder.'/xmlovi/GetProductsSpecification.xml');
$docspecxpath = new DOMXPath($docspec);


$kolikoimachild = $doc->getElementsByTagName('Table')->length;
$pokazi = '<br/>Ukupno CHILD : ' . $kolikoimachild . '<br/>'; // 6


$cols = Array("BrojDokle");
$db->where("IdCronXml", $kojijevendor);
$users = $db->getOne("cronzaxml", null, $cols);

$BrojDokle = $users['BrojDokle'];


$i = 0;
$BrojDokle = ($BrojDokle) ? $BrojDokle : '0';
$pokazi .= 'Dokle smo dosli - BrojDokle : <br/>';
$pokazi .= '$kolikoimachild : '.$kolikoimachild.'<br/>';
$pokazi .= '$BrojDokle : '.$BrojDokle.'<br/>';

if ($kolikoimachild > $BrojDokle) {
    foreach ($dataset as $row) {



        $pokazi .= '<br/>Redni broj : ' . $i . ' - Broj dokle : ' . $BrojDokle . '<br/>';

        if ($i >= $BrojDokle) {

            $pokazi .= '<div style="background-color: lightcyan;padding: 20px;border: 1px solid black">';

            include('folder/podaci.php');
            //$pokazi .= '<br />ID : ' . $ID . '<br /><br /><br />';
            $MenjanArtikal .= $ArtikalId . ' /('.$sifra.') [ '.$ArtikalIdDodatna.' ] ; ';

            $end = microtime_float();
            $pokazi .= '<hr/><br/>Script Execution Time: ' . round($end - $start, 3) . ' seconds<br/>';

            $pokazi .= '</div>';

        }



        //echo '<br/><br/>';
        if ($i == ($BrojDokle + 2)) break;
        $i++;
        //echo '<hr/>';
        //usleep(100000); // milion je 1 sec

    }
} else {
    $log->lwrite('DOSAO DO 0 KIMTEC XML');
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
echo "Gotov update TSMOD <br/>\n";

$log->lwrite('KRAJ KIMTEC XML '.$MenjanArtikal);


?>









