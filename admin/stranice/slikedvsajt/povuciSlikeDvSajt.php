<?php
echo ini_get('display_errors');
ini_set('max_execution_time', 0);

define('DPROOT', 'http://' . $_SERVER['HTTP_HOST']); //http://dodatnaoprema.com
define('DCROOT', $_SERVER['DOCUMENT_ROOT']); ///var/www/html/dodatnaoprema.com

$limit_slika = 10000;
$prvaSlika = 1;

require DCROOT . '/vezafull.php';
require(DCROOT . '/thumblib/ThumbLib.inc.php');

$kategorijeDodatna = new kategorijeDodatna($db);

$xmlLokacija = DCROOT . '/xml/3gStorePictureTransfer.xml';
$dom = new DOMDocument();
$dom->load($xmlLokacija);

$tables = $dom->getElementsByTagName('artikal');

if (!empty($tables)) {

    $brojLenght = $tables->length;

    if ($brojLenght > 0) {

        $pokazi .= '<ul>';

        foreach ($tables as $row) {

            $ID = $row->getElementsByTagName("id");
            $ID = (int)$ID->item(0)->nodeValue;

            $sifra = $row->getElementsByTagName("ProductSifra");
            $sifra = $sifra->item(0)->nodeValue;

            $link = $row->getElementsByTagName("ProductURL");
            $link = $link->item(0)->nodeValue;

            $image_link = $row->getElementsByTagName("Image");
            $image_link = $image_link->item(0)->nodeValue;

            $slikaZaDownload = $image_link;

            $db->where('ArtikalSifra', $sifra);
            $upit = $db->getOne('artikli');

            $ArtikalIdUpit = $upit['ArtikalId'];
            $ArtikalLink = $upit['ArtikalLink'];

            if ($ArtikalIdUpit) {

                //G:/projects/devshone/p/108/108200

                $lok = $common->locationslika($ArtikalIdUpit);
                $lokslifol = DCROOT . $lok;

                $ext = pathinfo($image_link, PATHINFO_EXTENSION);
                $filename = pathinfo($image_link, PATHINFO_FILENAME);

                $SlikaZaInsert = $filename . '-' . $ID;

                $linkslikeMojabaza = $filename . '-' . $ID . '.' . EXTPRED;

                $slikaUbacKodNasUFolder = $lokslifol . '/' . $linkslikeMojabaza;

                if (!is_dir($lokslifol)) {
                    mkdir($lokslifol, 0775, true);
                }

                if (!is_dir($lokslifol)) {
                    echo 'Nije kreiran folder -> ' . $lokslifol;
                    die;
                }

                $daliImasSlikaDodatna = $kategorijeDodatna->checkRemoteFile($image_link);
                sleep(2);

                if ($daliImasSlikaDodatna) {

                    if ($kategorijeDodatna->get_http_response_code($image_link) != "200") {

                        $pokazi .= '<li>Nema Slike na get_http_response_code : ' . $image_link . '</li>';

                    } else {

                        $pokazi .= '<li> IMA SLIKE </li>';

                        $pokazi .= $common->microtime_floatProlaz($start, 'ubaciSlikeLinkUbazu');

                        require('ubaciSlikeLinkUbazu.php');


                        $imeSlikeKod = $lokslifol . "/" . $linkslikeMojabaza;

                        $pokazi .= '<li>Link do slike kod nas u bazi  : ' . $imeSlikeKod . '</li>';
                        $pokazi .= $common->microtime_floatProlaz($start, 'ubaciSlikeLinkUbazuSTART');

                        require(DCROOT . '/admin/stranice/dodatna/ubaciSlikeFile3g.php');

                        $pokazi .= $common->microtime_floatProlaz($start, 'ubaciSlikeLinkUbazuKRAJ');

                        if (is_file($imeSlikeKod)) {
                            $pokazi .= '<li>Ima slike posle provere : ' . $imeSlikeKod . '</li>';
                        } else {
                            $pokazi .= '<li><strong style="color: red">Nema slike posle provere : </strong>' . $imeSlikeKod . '</li>';
                        }
                    }

                } else {
                    $pokazi .= '<li><strong style="color: red">Nema slike checkRemoteFile </strong> : ' . $image_link . '</li>';
                }

            } else {
                $pokazi .= '<li><strong style="color: red">Nema artikal u bazi sa ovom sifrom :</strong> : ' . $sifra . '<strong>Id </strong> : ' . $ID . '</li>';

            }


            if ($prvaSlika == $limit_slika) {
                echo 'PrvaSlika : ' . $prvaSlika;
                echo '</br>';
                echo 'Samo  : ' . $limit_slika . ' Necemo vise';
                die;
            }
            $prvaSlika++;

            echo '</br>';
            echo 'Rbr slike: '. $prvaSlika .'IdArtikla: '.$ArtikalIdUpit;
            echo '</br>';
        }

        $pokazi .= '</ul>';

    } else {
        echo 'brojLenght nije > 0';
        die;
    }

} else {
    echo 'empty(tables)';
    die;
}

echo $pokazi;
?>