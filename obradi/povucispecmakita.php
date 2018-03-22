<?php
set_time_limit(0);
$documentroot = DCROOT; // '/var/www/agro';
include(DCROOT . '/stranice/parse/simple_html_dom.php');

// Uvlacimo KLASE
$kategorijeDodatna = new kategorijeDodatna($db);
require_once(DCROOT . '/thumblib/ThumbLib.inc.php');

// TODO obratiti paznju da ID MODA da bude varijabla $idArt;
$idArt = $id;
$koji_link = $_POST['koji_link'];

$sajt_url = 'http://www.wolfcraft.com';

if (!$idArt) {
    echo 'Nema ID artikla';
    die;
}

/*
 * ODABIR DATAOG ARTIKLA iz baze AGRO
 */
require('dodatnaObradi/odabirArtiklaDodatna.php');


/*
 * Definisi Folder u koji se ubacuju slike
 */
require('dodatnaObradi/definisiFolder.php');

/*
 * Obrisi slike iz Foldera i iz Baze podataka
 */
require('dodatnaObradi/obrisiSlikeBazaDodatna.php');


$pokazi .= '<ul style="border: 1px solid green">';


$html = file_get_html($koji_link);



if ($html->find('div.product_item_info_image',0)->innertext) {

    $miki = $html->find('div.product_item_info_image', 0)->innertext;
    $htmlss = str_get_html($miki);
    $likslika_sa_makita_sajta = $htmlss->find('a', 0)->href;
    $likslika_sa_makita_sajta = trim($likslika_sa_makita_sajta);

    if ($kategorijeDodatna->checkRemoteFile($likslika_sa_makita_sajta)) {

        /*
         * Prebacili smo da bude isto kao na drugim skriptama */
        $linkSlikaDodatna = $likslika_sa_makita_sajta;

        $pokazi .= '<li><br><br></li>';

        $pokazi .= '<li style="color:red">Postoji na Makita sajtu : ' . $linkSlikaDodatna . '</li>';


        if (true) { //!is_file($lokacijadoslikeBazaSlike)

            $pokazi .= '<li>UKOLIKO NE POSTOJI FILE U NASOJ BAZI - ' . $linkSlikaDodatna . ' i ne postoji : ' . $linkslike . '</li>';


            $ext = pathinfo($linkSlikaDodatna, PATHINFO_EXTENSION);  // uzimamo ektenziju od fajla .png ili .jpg ili bilo koju
            $filename = pathinfo($linkSlikaDodatna, PATHINFO_FILENAME); // uzimamo naziv fajla
            $linkslikeMojabaza = $filename . '-' . $idArt . '.'.EXTPRED;

            $imeSlikeKodNas = $lokslifol . "/" . $linkslikeMojabaza;

            $pokazi .= '<li>Link do slike kod nas u bazi  : ' . $imeSlikeKodNas . '</li>';

            // ubacujemo u bazu podatke
            require(DCROOT . '/admin/stranice/dodatna/ubaciSlikeLinkUbazu.php');

            // ubacujemo slike u foldere
            require(DCROOT . '/admin/stranice/dodatna/ubaciSlikeFile.php');


            //Get the file OVO NE KORISTIMO
            /*$content = file_get_contents($linkSlikaDodatna);
            //Store in the filesystem.
            $fp = fopen($likacijadoslikedir . '/' .$url_artikla_slika, "w");
            fwrite($fp, $content);
            fclose($fp);*/


        }

    } else {

        $pokazi .= '<ul><li style="color: red">Ne postoji na nasem sajtu slika</li></ul>';
    }

    /*
     * Ubacujemo Opis Artikla */

    $miki = $html->find('div.product_item_info_tab_content div#tab_content_general div',0)->innertext;

    $miki .= $html->find('div.product_item_info_tab_content div#tab_content_userbenefits ul',0)->outertext;

    $miki .= $html->find('div.product_item_info_tab_content div#tab_content_techspecs div.techspec',0)->innertext;

//echo $miki = $html->find('div.product_item_info_tab_content div#tab_content_standard_equipment div.standard_equipment',0)->outertext;

    $sve = $common->clearvariableTekst($miki);

    require(DCROOT . '/admin/stranice/dodatna/ubaciArtNazivArtOpisBosch.php');

    require(DCROOT.'/admin/stranice/dodatna/povuciSpec.php');



} else {
    echo 'Nema Podataka';
    die;
}

// echo $pokazi;

$html->clear();
unset($html);

header( "Location:$url" );
?>


