<?php


if (!$id) {

    $m['tag'] = 'artikalTekst';
    $m['success'] = false;
    $m['error'] = 1;
    $m['error_msg'] = "Nema Id Artikla";
    echo json_encode($m, JSON_UNESCAPED_UNICODE);
    die;
}



$keyArt = $db->rawQueryOne("CALL opisArtikla($id,$jezikId)");

if (!$keyArt) {

    $m['tag'] = 'artikalTekst';
    $m['success'] = false;
    $m['error'] = 2;
    $m['error_msg'] = "Nema Podataka";
    echo json_encode($m, JSON_UNESCAPED_UNICODE);
    die;

}


$OpisArtikla = $keyArt['OpisArtikla'];
$OpisKratakOpis = $keyArt['OpisKratakOpis'];
$OpisArtTekst = $keyArt['OpisArtTekst'];




$dom = new DOMDocument('1.0', 'utf-8');
$dom->formatOutput = true;
$dom->preserveWhiteSpace = false;


$bookElem = $dom->createElement('product');
$dom->appendChild($bookElem);


$modelopis = $dom->createElement('OpisArtikla',$OpisArtikla);
$bookElem->appendChild( $modelopis );


$infoElem = $dom->createElement('OpisKratakOpis');
$infoElem->appendChild( $dom->createCDATASection($OpisKratakOpis) );
$bookElem->appendChild( $infoElem );

$infoElem = $dom->createElement('OpisArtTekst');
$infoElem->appendChild( $dom->createCDATASection($OpisArtTekst) );
$bookElem->appendChild( $infoElem );


header("Content-Type: text/plain"); // da browser prikaze kako plain tekst
echo $pera = $dom->saveXml();


$filename = DCROOT."/obradiApp/testOpisArt.xml";
$file = fopen($filename,"w+");
fwrite($file, $pera);
fclose($file);

die;



?>