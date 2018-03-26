<?php
/*$image = file_get_contents($linkSlikaDodatna);
file_put_contents($imeSlikeKodNas, $image);*/

list($width, $height, $type, $attr) = getimagesize($linkSlikaDodatna);
$ms = '';
if (!$width || !$height) {
    $pokazi .= '<ul style="color: brown;background-color: #dedede;padding: 10px">';
    $pokazi .= '<li>Ne postoji $width ili $height u ubaciSlikeFile</li>';
    $pokazi .= '<li>Link do slike -> ' . $linkSlikaDodatna . '</li>';
    $pokazi .= '<li>Artikal dodatna -> ' . $idArtDodatna . '</li>';
    $pokazi .= '</ul>';

}

if ($width && $height) {

    $dimenzwh = ($width >= $height) ? $width : $height;

    $thumbmala = PhpThumbFactory::create($linkSlikaDodatna);
    $thumbmala->Resize(800, 800);
    $thumbmala->save($imeSlikeKodNas, EXTPRED);

    $imgmala = $lokslifol . "/" . $filename . '-' . $idArt . '_'.$idLinkSlike.'_mala.' . EXTPRED;
    $kanvas = 110;
    $common->snimiSlikuGD($imeSlikeKodNas, $imgmala, $kanvas);
    /*$thumbmala = PhpThumbFactory::create($linkSlikaDodatna);
    $thumbmala->crop(0, 0, $dimenzwh, $dimenzwh);
    $thumbmala->Resize(110,110);
    $thumbmala->save($imgmala, EXTPRED);*/

    $imgsrednja = $lokslifol . "/" . $filename . '-' . $idArt . '_'.$idLinkSlike.'_srednja.' . EXTPRED;
    $kanvas = 195;
    $common->snimiSlikuGD($imeSlikeKodNas, $imgsrednja, $kanvas);


    $imgsrednjaVeca = $lokslifol . "/" . $filename . '-' . $idArt . '_'.$idLinkSlike.'_maloVeca.' . EXTPRED;
    $kanvas = 350;
    $common->snimiSlikuGD($imeSlikeKodNas, $imgsrednjaVeca, $kanvas);


    /*
    $thumbsrednja = PhpThumbFactory::create($linkSlikaDodatna);
    //$thumbsrednja->crop(0, 0, $dimenzwh, $dimenzwh);
    $thumbsrednja->Resize(195, 195);
    $thumbsrednja->save($imgsrednja, EXTPRED);*/


    sleep(1);
    // zasto smo stavili 5 sec pojma nemam
}


?>




