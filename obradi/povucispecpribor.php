<?php
set_time_limit(0);
$documentroot = DCROOT; // '/var/www/agro';
include(DCROOT.'/stranice/parse/simple_html_dom.php');

// Uvlacimo KLASE
$kategorijeDodatna = new kategorijeDodatna($db);
require_once(DCROOT.'/thumblib/ThumbLib.inc.php');

// TODO obratiti paznju da ID MODA da bude varijabla $idArt;
$idArt = $id;
$koji_link = $_POST['koji_link'];

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

/*
 * Uhvatimo celu Remote Stranu
 * odavde pocinje skripta include(DCROOT.'/stranice/parse/simple_html_dom.php'); sa linije 4
 */

$html = file_get_html($koji_link);


// http://www.bosch-pt.com/rs/sr/accocs/image/object/image/142490/142490.jpg/
// image/product/prodimgvp/14599/142490.jpg?maxwidth=74&maxheight=74
// http://www.bosch-pt.com/rs/sr/accocs/image/object/image/17025/17025.jpg/
// http://www.bosch-pt.com/rs/sr/accocs/image/product/prodimg/14599/170984.jpg/?maxwidth=240&maxheight=240


/*
 * hvatamo glavne slike
 */
foreach ($html->find('#smallChooser img') as $element) {
    $linkslike_bosch = 'http://www.bosch-pt.com/rs/sr/accocs/' . $element->src;

    if (!strpos($element->src, '360')){
        $slikep[] = strtok($linkslike_bosch, '?');
    }


}

/*
 * Hvatamo opis
 */
if ($html->find('div.techData', 0)->innertext) {

    // $miki_slike_opis = $html->find('div.techData', 0)->innertext;
    // $e->outertext = '';
    // $e->outertext = '';


    foreach ($html->find('#icons img') as $element) {
        $linkmaleSlike = 'http://www.bosch-pt.com/rs/sr/accocs/' . $element->src;
        $linkArrSlike[] = strtok($linkmaleSlike, '?');
        $slikeMale .= '<li>';
        $slikeMale .= '<img src="'.$linkmaleSlike.'">';
        $slikeMale .= '</li>';
    }


    // hvatamo #icons  hvatamo i taj div innertext outertext
    $html->find('#icons',0)->innertext = '<ul class="boschMaleIkone">'.$slikeMale.'</ul>';
    // skidamo iz diva
    $html->load($html->save());


    $miki_slike_opis = $html->find('div.techData', 0)->innertext;



    /*
     * UBACUJEMO SLIKE
     * KORAK 1
     */
    // prvo dobijamo lokaciju do slike u nasoj bazi
    $lok = $common->locationslika($idArt);
    $lokslifol = DCROOT . $lok;


    if(is_array($slikep)){

        // okrecemo array

        $prvaSlika=1; // TODO ovo moramo da da imamo zbog  ubaciSlikeLinkUbazu.php jer samo jedna slika je MainArtikliSlike a to je 1
        foreach($slikep as $linkSlikaDodatna) {  // TODO SLIKA mora da se zove $linkSlikaDodatna

            if ($kategorijeDodatna->checkRemoteFile($linkSlikaDodatna)) {



                $pokazi .= '<li style="color:red">Postoji na Bosch sajtu : ' . $slika . '</li>';

                if (true) { //!is_file($lokacijadoslikeBazaSlike)

                    $pokazi .= '<li>UKOLIKO NE POSTOJI FILE U NASOJ BAZI - ' . $linlslikazaupload . ' i ne postoji : ' . $linkslike . '</li>';


                    $ext = pathinfo($linkSlikaDodatna, PATHINFO_EXTENSION);  // uzimamo ektenziju od fajla .png ili .jpg ili bilo koju
                    $filename = pathinfo($linkSlikaDodatna, PATHINFO_FILENAME); // uzimamo naziv fajla
                    $linkslikeMojabaza = $filename . '-' . $idArt . '.'.EXTPRED;

                    $imeSlikeKodNas = $lokslifol . "/" . $linkslikeMojabaza;

                    $pokazi .= '<li>Link do slike kod nas u bazi  : ' . $imeSlikeKodNas . '</li>';

                    // ubacujemo u bazu podatke
                    require(DCROOT.'/admin/stranice/dodatna/ubaciSlikeLinkUbazu.php');

                    // ubacujemo slike u foldere
                    $imeSlikeKodNas = $lokslifol . "/" .$filename . '-' . $idArt . '_'.$idLinkSlike.'.'.EXTPRED;
                    require(DCROOT.'/admin/stranice/dodatna/ubaciSlikeFile.php');

                    // ubacujemo u bazu podatke
                    $linkslikeMojabaza = $filename . '-' . $idArt . '_'.$idLinkSlike.'.'.EXTPRED;
                    require(DCROOT.'/admin/stranice/dodatna/updateLinkSlike.php');


                }

            } else {

                $pokazi .= '<ul><li>Postoji na nasem sajtu slika</li></ul>';
            }
            $prvaSlika++;
        }
    } else {
        $pokazi .= '<li><strong style="color: red"> NE POSTOJE SLIKE NA SAJTU BOSCH </strong></li>';
    }


    if ($link_pdf_alat) {  $sve .= '<p><a href="'.$link_pdf_alat.'" style="color: red" target="_blank" >LINK KA PDF</a></p>'; }
    if ($miki_slike_opis) { $sve .= '<p>'.$miki_slike_opis.'</p>'; }

    //$sve = addslashes($sve);

    /*
     * UBACUJEMO OPIS
     */
    require(DCROOT.'/admin/stranice/dodatna/ubaciArtNazivArtOpisBosch.php');

    require(DCROOT.'/admin/stranice/dodatna/povuciSpec.php');




}

$pokazi .= '</ul>';
echo $pokazi;

$html->clear();
unset($html);

// header( "Location:$url" );
?>


