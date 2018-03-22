<?php

set_time_limit(0); // setovano da ne prekida skriptu

function kojijehost($tipHosta){

    if ($tipHosta==1) {
        $hostTip = '/data/masinealati';
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
$log->lwrite('OK VERMAX FINAL -> tip HOST '.$documentroot.'; ROOTLOC : '.ROOTLOC);

$file1 = $documentrootAdmin . '/xml/vermax/xmlovi/vermax_mak.xml';
$file2 = $documentrootAdmin . '/xml/vermax/xmlovi/vermax_ostali.xml';
$fileout = $documentrootAdmin . '/xml/vermax/xmlovi/finalVermax.xml';




/*$doc1 = new DOMDocument();
$doc1->load($file1);

$doc2 = new DOMDocument();
$doc2->load($file2);

// get 'res' element of document 1
$res1 = $doc1->getElementsByTagName('response')->item(0);

// iterate over 'item' elements of document 2
$items2 = $doc2->getElementsByTagName('artikal');
for ($i = 0; $i < $items2->length; $i ++) {
    $item2 = $items2->item($i);

    // import/copy item from document 2 to document 1
    $item1 = $doc1->importNode($item2, true);

    // append imported item to document 1 'res' element
    $res1->appendChild($item1);

}*/




/*function simplexml_merge (SimpleXMLElement &$xml1, SimpleXMLElement $xml2) {
    // convert SimpleXML objects into DOM ones
    $dom1 = new DomDocument();
    $dom2 = new DomDocument();
    $dom1->loadXML($xml1->asXML());
    $dom2->loadXML($xml2->asXML());

    // pull all child elements of second XML
    $xpath = new domXPath($dom2);
    $xpathQuery = $xpath->query('/response/command/artikal');
    for($i = 0; $i < $xpathQuery->length; $i++) {
        // and pump them into first one
        $dom1->documentElement->appendChild($dom1->importNode($xpathQuery->item($i), true));
    } // for($i = 0; $i < $xpathQuery->length; $i++)
    $xml1 = simplexml_import_dom($dom1);
} // function simplexml_merge (SimpleXMLElement &$xml1, SimpleXMLElement $xml2)


$xmlstr = file_get_contents($file1);
$stock_xml = new SimpleXMLElement($xmlstr);

$xmlstr = file_get_contents($file2);
$xml_app = new SimpleXMLElement($xmlstr);

simplexml_merge($stock_xml, $xml_app);

file_put_contents($fileout, $stock_xml->asXML());*/





/*$xml1 = simplexml_load_file($file1);
$xml2 = simplexml_load_file($file2);    // loop through the FOO and add them and their attributes to xml1

foreach ($xml2->command->artikal as $foo) {
    $new = $xml1->addChild('artikal', $foo);
    foreach ($foo->attributes() as $key => $value) {
        $new->addAttribute($key, $value);
    }
}
$fh = fopen($fileout, 'w') or die ("can't open file $fileout");
fwrite($fh, $xml1->asXML());
fclose($fh);*/


$log->lwrite('KRAJ VERMAX FINAL -> tip HOST '.$documentroot.'; ROOTLOC : '.ROOTLOC);
?>