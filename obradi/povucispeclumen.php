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

// hvatamo glavnu sliku
foreach ($html->find('.mainPic a img') as $element)
    $linkslike_wolf = $sajt_url . $element->src;
$pokazi .= '<li>$linkslike_wolf : ' . $linkslike_wolf . '</li>';


foreach ($html->find('#productImages ul a img') as $element) {
    $linkslike_bosch_opis = $sajt_url.$element->src;
    if ($kategorijeDodatna->checkRemoteFile($linkslike_bosch_opis)) {
        $slikep[] = $sajt_url . $element->src;
        usleep(500000);
    }
}

$slikep = array_reverse($slikep);

if ($html->find('.mainInfo ul', 0)->outertext) { // negde nema id=ct_2

$h2 = $html->find('.mainInfo h2', 0)->innertext;
$opis_ul = $html->find('.mainInfo ul', 0)->outertext;
$spec_wolf = $html->find('.content .contenttable', 0)->outertext;


$miki_slike_opis = '<h2>' . $h2 . '</h2>';
$miki_slike_opis .= '<div class="opiswolf">' . $opis_ul . '</div>';
$miki_slike_opis .= '<div class="opiswolfspec">' . $spec_wolf . '</div>';


if (is_array($slikep)) {

    // okrecemo array

    $prvaSlika = 1; // TODO ovo moramo da da imamo zbog  ubaciSlikeLinkUbazu.php jer samo jedna slika je MainArtikliSlike a to je 1
    foreach ($slikep as $linkSlikaDodatna) {  // TODO SLIKA mora da se zove $linkSlikaDodatna


        if ($kategorijeDodatna->checkRemoteFile($linkSlikaDodatna)) {


            $pokazi .= '<li><br><br></li>';

            $pokazi .= '<li style="color:red">Postoji na Bosch sajtu : ' . $slika . '</li>';


            if (true) { //!is_file($lokacijadoslikeBazaSlike)

                $pokazi .= '<li>UKOLIKO NE POSTOJI FILE U NASOJ BAZI - ' . $linlslikazaupload . ' i ne postoji : ' . $linkslike . '</li>';


                $ext = pathinfo($linkSlikaDodatna, PATHINFO_EXTENSION);  // uzimamo ektenziju od fajla .png ili .jpg ili bilo koju
                $filename = pathinfo($linkSlikaDodatna, PATHINFO_FILENAME); // uzimamo naziv fajla
                $linkslikeMojabaza = $filename . '-' . $idArt . '.'.EXTPRED;

                $imeSlikeKodNas = $lokslifol . "/" . $linkslikeMojabaza;

                $pokazi .= '<li>Link do slike kod nas u bazi  : ' . $imeSlikeKodNas . '</li>';
/*
                // ubacujemo u bazu podatke
                require(DCROOT . '/admin/stranice/dodatna/ubaciSlikeLinkUbazu.php');

                // ubacujemo slike u foldere
                require(DCROOT . '/admin/stranice/dodatna/ubaciSlikeFile.php');
*/


                // prvo se ubacuje u Bazu
                $pokazi .= $common->microtime_floatProlaz($start, 'ubaciSlikeLinkUbazu');
                // sada ubacujemo LINKOVE slika kod nas u bazu artiklislike
                require(DCROOT . '/admin/stranice/dodatna/ubaciSlikeLinkUbazu.php');

                $linkslikeMojabaza = $filename . '-' . $idArt . '_'.$idLinkSlike.'.'.EXTPRED;
                $imeSlikeKodNas = $lokslifol . "/" . $linkslikeMojabaza;
                $pokazi .= '<li>Link do slike kod nas u bazi  : ' . $imeSlikeKodNas . '</li>';


                $pokazi .= $common->microtime_floatProlaz($start, 'ubaciSlikeLinkUbazuSTART');
                require(DCROOT.'/admin/stranice/dodatna/ubaciSlikeFile.php');
                $pokazi .= $common->microtime_floatProlaz($start, 'ubaciSlikeLinkUbazuKRAJ');

                // sada reimenujemo link do slike
                $pokazi .= '<li>$linkslikeMojabaza : ' . $linkslikeMojabaza . '</li>';
                require(DCROOT.'/admin/stranice/dodatna/updateLinkSlike.php');


                // sada proveravamo da li je ubacio sliku
                if (is_file($imeSlikeKodNas)) {
                    $pokazi .= '<li>Ima slike posle provere : ' . $imeSlikeKodNas . '</li>';
                } else {
                    $pokazi .= '<li><strong style="color: red">Nema slike posle provere : </strong>' . $imeSlikeKodNas . '</li>';
                }

            }

        } else {

            $pokazi .= '<ul><li>Postoji na nasem sajtu slika</li></ul>';
        }
        $prvaSlika++;
    }
} else {
    $pokazi .= '<li><strong style="color: red"> NE POSTOJE SLIKE NA SAJTU BOSCH </strong></li>';
}

    /*
     * UBACUJEMO OPIS
     */
    if ($miki_slike_opis) {
        $sve .= '<div>' . $miki_slike_opis . '</div>';
    }
    require(DCROOT . '/admin/stranice/dodatna/ubaciArtNazivArtOpisBosch.php');

    require(DCROOT.'/admin/stranice/dodatna/povuciSpec.php');

    $pokazi .= '</ul>';

}

echo $pokazi;

$html->clear();
unset($html);

header( "Location:$url" );
?>


