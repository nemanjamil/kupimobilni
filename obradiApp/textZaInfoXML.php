<?php


if (!$id) {

    $m['tag'] = 'textZaInfoXML';
    $m['success'] = false;
    $m['error'] = 1;
    $m['error_msg'] = "Nema Id od Kategorije";
    echo json_encode($m, JSON_UNESCAPED_UNICODE);
    die;
}

$keyArt = $db->rawQueryOne("CALL opisTekstHead($id,$jezikId)");

if (!$keyArt) {

    $m['tag'] = 'textZaInfoXML';
    $m['success'] = false;
    $m['error'] = 2;
    $m['error_msg'] = "Nema Podataka";
    echo json_encode($m, JSON_UNESCAPED_UNICODE);
    die;

}


$ParentKategHead = $keyArt['ParentKategHead'];
$LinkKategHead = $keyArt['LinkKategHead'];
$AktivanKategHead = $keyArt['AktivanKategHead'];
$MestoKategHead = $keyArt['MestoKategHead'];
$NaslovKategHead = $keyArt['NaslovKategHead'];
$OpisKategHeadTekst = $keyArt['OpisKategHeadTekst'];


$dom = new DOMDocument('1.0', 'utf-8');
$dom->formatOutput = true;
$dom->preserveWhiteSpace = false;


$bookElem = $dom->createElement('product');
$dom->appendChild($bookElem);


$modelopis = $dom->createElement('ParentKategHead',$ParentKategHead);
$bookElem->appendChild( $modelopis );

$modelopis = $dom->createElement('LinkKategHead',$LinkKategHead);
$bookElem->appendChild( $modelopis );

$modelopis = $dom->createElement('AktivanKategHead',$AktivanKategHead);
$bookElem->appendChild( $modelopis );

$modelopis = $dom->createElement('MestoKategHead',$MestoKategHead);
$bookElem->appendChild( $modelopis );

$infoElem = $dom->createElement('NaslovKategHead');
$infoElem->appendChild( $dom->createCDATASection($NaslovKategHead) );
$bookElem->appendChild( $infoElem );

$infoElem = $dom->createElement('OpisKategHeadTekst');
$infoElem->appendChild( $dom->createCDATASection($OpisKategHeadTekst) );
$bookElem->appendChild( $infoElem );


header("Content-Type: text/plain"); // da browser prikaze kako plain tekst
echo $pera = $dom->saveXml();


/*$filename = DCROOT."/obradiApp/textZaInfoXML.xml";
$file = fopen($filename,"w+");
fwrite($file, $pera);
fclose($file);

die;*/


?>