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

function mie($koji_link) {
    $curl_handle=curl_init();
    curl_setopt($curl_handle, CURLOPT_URL,$koji_link);
    curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl_handle, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1");
    $query = curl_exec($curl_handle);
    curl_close($curl_handle);
    return $query;
}



$hvataj = mie($koji_link);
$html = str_get_html($hvataj);


$naslov = $html->find('h1.stgHdline',0)->innertext;
$kratak_opis = $html->find('#descriptionDiv p.fltL',0)->innertext;
$glavna_slika = $html->find('#descriptionDiv img',0)->src;
$tehnickaspec = $html->find('#packagingDiv .mrgb20',0)->outertext;

if (!$naslov) {
    echo 'Nema naslov Dremel';
    die;
}

// promeni naslov
require(DCROOT.'/admin/stranice/dodatna/promeniNaslovDremel.php');

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





// male slike
foreach ($html->find('#accIcons img') as $element) {
    $linkslike_boschArrayLink = $element->src;
    if ($kategorijeDodatna->checkRemoteFile($linkslike_boschArrayLink)) {
        $slike_male[] = $linkslike_boschArrayLink;
        usleep(500000);
        $slikeMale .= '<li>';
        $slikeMale .= '<img src="'.$linkslike_boschArrayLink.'">';
        $slikeMale .= '</li>';
    }
}
$slokM = '<ul class="DremelMaleIkone">'.$slikeMale.'</ul>';

$linkslike_boschArrayLink = '';
foreach ($html->find('#imageGalleryDiv .stageCntntImg .imgGlly img') as $element) {
    $linkslike_boschArrayLink = $element->src;
    if ($kategorijeDodatna->checkRemoteFile($linkslike_boschArrayLink)) {
        $slikep[] = $linkslike_boschArrayLink;
        usleep(500000);
    }
}

$slikep[] = $glavna_slika;



$pokazi .= '<ul style="border: 1px solid green">';


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

                sleep(2);



            }

        } else {

            $pokazi .= '<ul><li>Postoji na nasem sajtu slika</li></ul>';
        }
        $prvaSlika++;
    }
} else {
    $pokazi .= '<li><strong style="color: red"> NE POSTOJE SLIKE NA SAJTU BOSCH </strong></li>';
}


$sve = $tehnickaspec;
$sve .= $slokM;


    /*
     * UBACUJEMO OPIS
     */
   require(DCROOT.'/admin/stranice/dodatna/ubaciArtNazivArtOpisBosch.php');


   // povecaj za 1
   require(DCROOT.'/admin/stranice/dodatna/povuciSpec.php');



    $pokazi .= '</ul>';



echo $pokazi;

$html->clear();
unset($html);

// header( "Location:$url" );
?>


