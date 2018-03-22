<?php


if (!$id) {

    $m['tag'] = 'horizMeniPoId';
    $m['success'] = false;
    $m['error'] = 1;
    $m['error_msg'] = "Nema Id Artikla";
    echo json_encode($m, JSON_UNESCAPED_UNICODE);
    die;
}


if (!$br) {

    $m['tag'] = 'horizMeniPoId';
    $m['success'] = false;
    $m['error'] = 2;
    $m['error_msg'] = "Nema Id Jezika";
    echo json_encode($m, JSON_UNESCAPED_UNICODE);
    die;
}


$keyArt = $db->rawQueryOne("CALL opisKategHead($id,$br)");

if (!$keyArt) {

    $m['tag'] = 'horizMeniPoId';
    $m['success'] = false;
    $m['error'] = 3;
    $m['error_msg'] = "Nema Podataka";
    echo json_encode($m, JSON_UNESCAPED_UNICODE);
    die;

}




$IdKategHead = $keyArt['IdKategHead'];
$NaslovKategHead = $keyArt['NaslovKategHead'];
$OpisKategHeadTekst = $keyArt['OpisKategHeadTekst'];


$dom = new DOMDocument('1.0', 'utf-8');
$dom->formatOutput = true;
$dom->preserveWhiteSpace = false;


$bookElem = $dom->createElement('product');
$dom->appendChild($bookElem);

$modelopis = $dom->createElement('IdKategHead',$IdKategHead);
//$modelopis->appendChild( $dom->createAttribute($IdKategHead) );
$bookElem->appendChild( $modelopis );


$modelopis = $dom->createElement('NaslovKategHead');
$modelopis->appendChild( $dom->createCDATASection($NaslovKategHead) );
$bookElem->appendChild( $modelopis );


$infoElem = $dom->createElement('opis');
$infoElem->appendChild( $dom->createCDATASection($OpisKategHeadTekst) );
$bookElem->appendChild( $infoElem );

header("Content-Type: text/plain");
$pera = $dom->saveXml();
echo $pera;

$filename = DCROOT."/obradiApp/testOpisKateg.xml";
$file = fopen($filename,"w+");
fwrite($file, $pera);
fclose($file);




?>