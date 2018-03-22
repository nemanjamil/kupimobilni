<?php

$linkSlikaDodatna = $slikaZaDownload;


$q = list($width, $height, $type, $attr) = getimagesize($linkSlikaDodatna);

$ms = '';
if (!$width || !$height) {
    $pokazi .= '<ul style="color: brown;background-color: #dedede;padding: 10px">';
    $pokazi .= '<li>Ne postoji $width ili $height u ubaciSlikeFile</li>';
    $pokazi .= '<li>Link do slike -> ' . $linkSlikaDodatna . '</li>';
    $pokazi .= '<li>Artikal 3g -> ' . $ID . '</li>';
    $pokazi .= '</ul>';

}

if ($width && $height) {

    $dimenzwh = ($width >= $height) ? $width : $height;

    $thumbmala = PhpThumbFactory::create($linkSlikaDodatna);
    $thumbmala->Resize(800, 800);
    $thumbmala->save($slikaUbacKodNasUFolder, EXTPRED);
    //$thumbmala->save($image_link);


    $imgmala = $lokslifol . "/" . $filename.'-'.  $ID .'_mala.' . EXTPRED;
    $kanvas = 110;
    $a = $common->snimiSlikuGD($slikaUbacKodNasUFolder, $imgmala, $kanvas);

    $imgsrednja = $lokslifol . "/" . $filename.'-'.  $ID .'_srednja.' . EXTPRED;
    $kanvas = 195;
    $common->snimiSlikuGD($slikaUbacKodNasUFolder, $imgsrednja, $kanvas);


    $imgsrednjaVeca = $lokslifol . "/" . $filename.'-'.  $ID .'_maloVeca.' . EXTPRED;
    $kanvas = 350;
    //$common->snimiSlikuGD($SlikaZaInsert, $imgsrednjaVeca, $kanvas);
    $common->snimiSlikuGD($slikaUbacKodNasUFolder, $imgsrednjaVeca, $kanvas);


    sleep(1);
}


?>




