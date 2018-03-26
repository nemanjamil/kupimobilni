<!--<head>
    <meta http-equiv="refresh" content="303">
</head>-->
<?php
// bg.company3g.com/xml/3gmobilniCentar.zip.
set_time_limit(300); // setovano da ne prekida skriptu

/*
 *
 * kopirati tabele sa dodatneSajt na dodatnuLocal
 * brand, kategorije, slike_proiz, vendor, vebsop
 * onda skinuti forein key sa vebsop
 * kopirati na agro_Local
 * Testirato za bagove
 * Kopirati na AWS AGRO
 * */

set_time_limit(0);
function kojijehost($tipHosta){

    if ($tipHosta == 1) {
        $hostTip = '/data/kupimobilni'; // server Linux
    } elseif ($tipHosta == 3) {
        $hostTip = 'C:/wamp64/www/kupimobilni'; // Nemanja Windows
    } elseif ($tipHosta == 4) {
        $hostTip = 'G:/projects/kupimobilni'; // Nikola
    } else {
        $hostTip = '/var/www/kupimobilni'; // Nemanja Linux
    }
    return $hostTip;
}
$mcProd = getenv('KUPIMOBILNI');
$documentroot = kojijehost($mcProd);
$documentrootAdmin = $documentroot.'/admin';
define('ROOTLOC', $documentroot);

require($documentrootAdmin.'/xml/centralniXml/setovanjeXml.php');

require $documentroot."/obradi/snimiTxt.php";
$log->lfile(ROOTLOC.'/logovi/3g_cron_xml.txt');
$log->lwrite('OK 3g XML -> tip HOST '.$documentroot.'; ROOTLOC : '.ROOTLOC);
/**
 * Ovo koristimo da vidimo da li ponovo azuriramo slike na update
 * ako je 0 ne diraj nista
 * ako je 1 onda ponovo na update povuci slike sa servera
 */
$cols = Array("vrednoststanja");
$db->where("imestanja", "povuci_slike_na_update");
$povuci_slike_na_update = $db->getOne("setovanjevarijabli", null, $cols);
$vred_povuci_slike_na_update = $povuci_slike_na_update['vrednoststanja'];



$kojijevendor = 6;  // id u tabeli cronzaxml
$vendor = 1;  // u tabeli Komitenti
$codetip = 'code3g'; // koji je red za sifru u tabel Artikli
$brend_code = 1; // tabela Brendovi 3g Brend je 1
$nedefinisanoRazno = 6715; // ako zelimo da promenimo folder u koji cemo da ubacujemo inicijelno artikle
$TipKatUnitArt = 8; // tabela UNIT 8 je kom
$MinimalnaKolArt = 1; // minmalna kolicina koja moze da se naruci
$folder = '3g';

$doc = new DOMDocument();
$doc->load($documentroot . '/xml/'.$folder.'/3gMobilSistemSajt.xml');
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
        if ($i == ($BrojDokle +1)) break;
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









