<?php


$pokazi .= '<ul style="background-color: #dedede">';

$id = $row->getElementsByTagName("id");
$id = $id->item(0)->nodeValue;
$id = (int) $id;
$pokazi .= '<li>$id : ' . $id . '</li>';

/*$extId = $row->getElementsByTagName("extId");
$extId = $extId->item(0)->nodeValue;
$extId = (int) $extId;
$pokazi .= '<li>$extId : ' . $extId . '</li>';*/

$kategorijaId = $row->getElementsByTagName("kategorijaId");
$kategorijaId = $kategorijaId->item(0)->nodeValue;
$kategorijaId = (int) $kategorijaId;
$pokazi .= '<li>$kategorijaId : ' . $kategorijaId . '</li>';

$brendId = $row->getElementsByTagName("brendId");
$brendId = $brendId->item(0)->nodeValue;
$brendId = (int) $brendId;
$pokazi .= '<li>$brendId : ' . $brendId . '</li>';

$proizvodjacId = $row->getElementsByTagName("proizvodjacId");
$proizvodjacId = $proizvodjacId->item(0)->nodeValue;
$proizvodjacId = (int) $proizvodjacId;
$pokazi .= '<li>$proizvodjacId : ' . $proizvodjacId . '</li>';

$sifra = $row->getElementsByTagName("sifra");
$sifra = $sifra->item(0)->nodeValue;
$pokazi .= '<li>$sifra - ova treba : ' . $sifra . '</li>';

$naziv = $row->getElementsByTagName("naziv");
$naziv = $naziv->item(0)->nodeValue;
$naziv = trim($naziv);
$pokazi .= '<li>Naziv : ' . $naziv . '</li>';

$url_artikla = $common->friendly_convert($naziv);
$pokazi .= '<li>Url Artikla : ' . $url_artikla . '</li>';

$stanje = $row->getElementsByTagName("stanje");
$stanje = $stanje->item(0)->nodeValue;
if ($stanje > 0) { $stanje = 1;} else {$stanje = '0';}
$pokazi .= '<li>$stanje : ' . $stanje . '</li>';

$naAkciji = $row->getElementsByTagName("naAkciji");
$naAkciji = $naAkciji->item(0)->nodeValue;
$naAkciji = (int) $naAkciji;
$pokazi .= '<li>$naAkciji : ' . $naAkciji . '</li>';

$opis = $row->getElementsByTagName("opis");
$opis = $opis->item(0)->nodeValue;
$pokazi .= '<li>Opis : ' . $opis . '</li>';

$barKod = $row->getElementsByTagName("barKod");
$barKod = $barKod->item(0)->nodeValue;
$barKod = trim($barKod);
$pokazi .= '<li>$barKod : ' . $barKod . '</li>';

$cenan = $row->getElementsByTagName("vpCena");
$cenan = $cenan->item(0)->nodeValue;
$cenan = (float) $cenan;
$pokazi .= '<li>Cena XML : ' . $cenan . '</li>';

$mpCena = $row->getElementsByTagName("mpCena");
$mpCena = $mpCena->item(0)->nodeValue;
$mpCena = (float) $mpCena;
$pokazi .= '<li>$mpCena : ' . $mpCena . '</li>';


$marzaid = $common->cenamarzadinObori($cenan);
$pokazi .= '<li> Marza id : ' . $marzaid . '</li>';


$pokazi .= '<br> Slike : ';
$miki[] = '';
unset($miki);

$pokazi .= '<div style="border: 1px solid #000000; padding: 10px;background-color: lightslategray">';
//$params2 = $dataset->item($kl)->getElementsByTagName('slike');
$params2 = $row->getElementsByTagName( "slike" );

$kl = 0; // values is used to iterate categories
foreach ($params2 as $p) {
    //$params3 = $params2->item($kl)->getElementsByTagName('slika'); //dig Arti into Categories
    $params3 = $p->getElementsByTagName('slika'); //dig Arti into Categories

    $mm = 0;
    foreach ($params3 as $p2) {
        //$sl = $params3->item($mm)->nodeValue;
        $sl = $p2->nodeValue;

        $miki[] = $sl;
        $pokazi .= '<p>'.$sl.'</p>';
        $mm++;
    }
    $kl++;
}
$pokazi .= '</div>';


/*    $arti = $row->getElementsByTagName( "slike" );// uhvati sve elemente
    $j=0;
    $pokazi .= '<br> Slike : ';
    $miki[] = '';
    unset($miki);
    $pokazi .= '<div style="border: 1px solid #000000; padding: 10px;background-color: lightslategray">';
    foreach( $arti as $rows ) {

        //$pokazi .= $arti->item($j)->getElementsByTagName('slika');//  uhvati za svaki element NAME
        $artim = $rows->getElementsByTagName("slika");
        $sl = $arti->item($j)->nodeValue;
        //$pokazi .= $sl;
        $miki[] = $sl;
        $j++;
    }
    $pokazi .= '</div>';*/


//var_dump($miki);



$pokazi .= '</ul>';





?>
