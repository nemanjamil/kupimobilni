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

// hvatamo glavnu sliku
foreach ($html->find('#smLeft img') as $element) {
    $linkslike_bosch = $element->src;
    //  $slikep[] = strtok($linkslike_bosch, '?');
}


//https://www.functions-online.com/parse_url.html
/*$link =  $html->find('#fEndNav .print a',0)->href;
$mile = explode('=',$link);
$idbrojSlike = $mile[1];
$ldoslika = "http://www.skileurope.com/rs/sr/diyocs/usageimage/938.jpg"; //.$idbrojSlike;*/

$link =  $html->find('li.abZoom a',0)->href;
$mile = explode('/',$link);
$idbrojSlike = $mile[1];
$ldoslika = "http://www.skileurope.com/rs/sr/diyocs/usageimage/$idbrojSlike.jpg"; //.$idbrojSlike;


$hvataj2 = mie($ldoslika);
$htmlSlike = str_get_html($hvataj2);

foreach ($htmlSlike->find('div.galContainer div.galImg img') as $element) {  //  galContainer
    $linkslike_bosch_opis = $element->src;
    $slikep[] = $linkslike_bosch_opis;
    /*if (!strpos($linkslike_bosch_opis,'usageimgprev')){
        if ($db->remoteFileExists($linkslike_bosch_opis)) {
            $slikep[] = $linkslike_bosch_opis;
            usleep(500000);
        }
    }*/

}
//$slikep[] = $linkslike_bosch;




if ($html->find('div#ct_1 .ctLeft', 0)->innertext) {



$miki_slike_opis = $html->find('div#ct_1 .ctLeft', 0)->innertext;
$miki_slike_opis .= $html->find('div#ct_2', 0)->innertext;
$miki_slike_opis .= '<div class="obimisporukeBosch">Isporuka</div>';
$miki_slike_opis .= $html->find('div#ct_3', 0)->innertext;


    if(is_array($slikep)){




        $prvaSlika=2; // stavili smo ovde 2 da ne bi bila nijedna mail Slika
        foreach($slikep as $linkSlikaDodatna) {


            $ext = pathinfo($linkSlikaDodatna, PATHINFO_EXTENSION);  // uzimamo ektenziju od fajla .png ili .jpg ili bilo koju
            $filename = pathinfo($linkSlikaDodatna, PATHINFO_FILENAME); // uzimamo naziv fajla
            $linkslikeMojabaza = $filename . '-' . $idArt . '.'.EXTPRED;

            $imeSlikeKodNas = $lokslifol . "/" . $linkslikeMojabaza; // $likacijadoslikedir

            $pokazi .= '<li>Link do slike kod nas u bazi  : ' . $imeSlikeKodNas . '</li>';


            // ubacujemo u bazu podatke
            require(DCROOT.'/admin/stranice/dodatna/ubaciSlikeLinkUbazu.php');

            // ubacujemo slike u foldere
            require(DCROOT.'/admin/stranice/dodatna/ubaciSlikeFile.php');

            sleep(2);

            $prvaSlika++;

        }
    }


    // ovde treba dodati da se samo glavna slika ubaci

    // ubacujemo u bazu podatke
    $prvaSlika = 1;
    $filename = $filename.'-main';
    $linkslikeMojabaza = $filename. '-' . $idArt . '.png';
    require(DCROOT.'/admin/stranice/dodatna/ubaciSlikeLinkUbazu.php');


    // ubacujemo slike u foldere
    $linkSlikaDodatna = $linkslike_bosch;
    $imeSlikeKodNas = $lokslifol . "/" . $linkslikeMojabaza; // $likacijadoslikedir
    require(DCROOT.'/admin/stranice/dodatna/ubaciSlikeFile.php');





}






    /*
     * UBACUJEMO OPIS
     */
   $sve = '<div class="skillspecopis">'.$miki_slike_opis.'</div>';
   require(DCROOT.'/admin/stranice/dodatna/ubaciArtNazivArtOpisBosch.php');



   $pokazi .= '</ul>';



echo $pokazi;

$html->clear();
unset($html);

// header( "Location:$url" );
?>


