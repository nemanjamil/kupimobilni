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
 *
 */
//require('dodatnaObradi/odabirArtiklaDodatna.php');




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




foreach ($html->find('a[data-gall="media-gallery"]') as $element) {

   $linkslike_boschArrayLink = $element->href;
    $parse = parse_url($linkslike_boschArrayLink);
    if ($parse['host']) {
        $slikep[] = $linkslike_boschArrayLink;
    }
}




$pokazi .= '<li>$linkslike_bosch : ' . $slikep[0] . '</li>';

$miki_tool = $html->find('section#be-detail-tool-features', 0)->innertext;

$miki_detail = $html->find('section#be-detail-scope',0)->innertext;

// ovde hvatamo sve slike od IKONA
foreach ($html->find('.be-detail-tech-data-right img') as $element) {
    $slikeMale .= '<li>';
    $slikeMale .= '<img src="'.$element->src.'">';
    $slikeMale .= '</li>';
}

// sada menjamo postojeci html i umesto dela gde su tabele stavljamo li elemente
$miki_desc_techMalo = $html->find('.be-detail-tech-data-right',0)->innertext = '<ul class="boschMaleIkone">'.$slikeMale.'</ul>';

// snimamo modifikovanu stranu
$html->load($html->save());

// ponovo pozivamo datu sekciju
$miki_technical = $html->find('section#be-detail-technical-data',0)->innertext;



//$link_pdf_alat = 'http://www.bosch-professional.com/gb/en/'.$html->find('a.ctmLink', 0)->href;


/*
 * Hvatamo opis
 */


    // prvo dobijamo lokaciju do slike u nasoj bazi
    $lok = $common->locationslika($idArt);
    $lokslifol = DCROOT . $lok;


if(is_array($slikep)){

    // okrecemo array
    $slikep = array_reverse($slikep); // TODO obrati paznju da tek kada imamo array onda da rotiramo

    $prvaSlika=1; // TODO ovo moramo da da imamo zbog  ubaciSlikeLinkUbazu.php jer samo jedna slika je MainArtikliSlike a to je 1
    foreach($slikep as $linkSlikaDodatna) {  // TODO SLIKA mora da se zove $linkSlikaDodatna

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

                // ubacujemo u bazu podatke
                require(DCROOT.'/admin/stranice/dodatna/ubaciSlikeLinkUbazu.php');

                // ubacujemo slike u foldere
                require(DCROOT.'/admin/stranice/dodatna/ubaciSlikeFile.php');

                //sleep(1);



            }

        } else {

            $pokazi .= '<ul><li>Postoji na nasem sajtu slika</li></ul>';
        }
        $prvaSlika++;
    }
} else {
    $pokazi .= '<li><strong style="color: red"> NE POSTOJE SLIKE NA SAJTU BOSCH </strong></li>';
}


$sve = $miki_tool;
$sve .= $miki_detail;
$sve .= $miki_technical;




    /*
     * UBACUJEMO OPIS
     */
    $sve = '<div class="boschProfesionalOpis">'.$sve.'</div>';
    require(DCROOT.'/admin/stranice/dodatna/ubaciArtNazivArtOpisBosch.php');


    require(DCROOT.'/admin/stranice/dodatna/povuciSpec.php');



    $pokazi .= '</ul>';



echo $pokazi;

$html->clear();
unset($html);

header( "Location:$url" );
?>


