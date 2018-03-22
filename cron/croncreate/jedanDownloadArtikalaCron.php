<?php
/**
 * Created by PhpStorm.
 * User: Nikola Markovic
 * Date: 8.1.2018.
 * Time: 13:05
 */

$urlServisa = URLCALCSERVICE . 'PodaciArtikla';
$postParametri = [
    'grupa' => $idKategorijeGlavna,
    'sifra' => '',
    'naziv' => '',
    'barkod' => '',
    'serbr' => '',
    'nazivsvojstva' => '',
    'vredsvoj' => '',
    'sort' => '',
    'uslov' => ''

];

$calculus = new calculusServisi($db);
$curlInitStanje = $calculus->posaljiPodatkeCalc($urlServisa, $postParametri);


$aa = 0;
if ($curlInitStanje) {
    $dom = new DOMDocument();
    $dom->loadXML($curlInitStanje);
    $lok = ROOTLOC . '/xml/ArtikliDownload.xml';
    $dom->save($lok);

    $tables = $dom->getElementsByTagName('Table');

    if (!empty($tables)) {

        $brojLenght = $tables->length;


        $log->lwrite('Koliko ima artikala: '.$brojLenght);

        if ($brojLenght > 0) {

            foreach ($tables as $row) {

                $artikalID = $row->getElementsByTagName("artikalID");
                $artikalID = (int)$artikalID->item(0)->nodeValue;

                $sifra = $row->getElementsByTagName("sifra");
                $sifra = $sifra->item(0)->nodeValue;

                $naziv = $row->getElementsByTagName("naziv");
                $naziv = $naziv->item(0)->nodeValue;

                $nazivukasi = $row->getElementsByTagName("nazivukasi");
                $nazivukasi = $nazivukasi->item(0)->nodeValue;

                $barkod = $row->getElementsByTagName("barkod");
                $barkod = $barkod->item(0)->nodeValue;

                $jdm = $row->getElementsByTagName("jdm");
                $jdm = $jdm->item(0)->nodeValue;

                $pakovanje = $row->getElementsByTagName("pakovanje");
                $pakovanje = $pakovanje->item(0)->nodeValue;

                $jdmpakovanja = $row->getElementsByTagName("jdmpakovanja");
                $jdmpakovanja = $jdmpakovanja->item(0)->nodeValue;

                $pdvstopa = $row->getElementsByTagName("pdvstopa");
                $pdvstopa = $pdvstopa->item(0)->nodeValue;

                $proizvodjac = $row->getElementsByTagName("proizvodjac");
                $proizvodjac = $proizvodjac->item(0)->nodeValue;

                $netomasa = $row->getElementsByTagName("netomasa");
                $netomasa = $netomasa->item(0)->nodeValue;

                $brutomasa = $row->getElementsByTagName("brutomasa");
                $brutomasa = $brutomasa->item(0)->nodeValue;

                $transportnamasa = $row->getElementsByTagName("transportnamasa");
                $transportnamasa = $transportnamasa->item(0)->nodeValue;

                $jdmmase = $row->getElementsByTagName("jdmmase");
                $jdmmase = $jdmmase->item(0)->nodeValue;

                $uvoznik = $row->getElementsByTagName("uvoznik");
                $uvoznik = $uvoznik->item(0)->nodeValue;

                $zemljaporekla = $row->getElementsByTagName("zemljaporekla");
                $zemljaporekla = $zemljaporekla->item(0)->nodeValue;

                $zemljauvoza = $row->getElementsByTagName("zemljauvoza");
                $zemljauvoza = $zemljauvoza->item(0)->nodeValue;

                $komisionar = $row->getElementsByTagName("komisionar");
                $komisionar = $komisionar->item(0)->nodeValue;

                $kataloskibroj = $row->getElementsByTagName("kataloskibroj");
                $kataloskibroj = $kataloskibroj->item(0)->nodeValue;

                $lokacija = $row->getElementsByTagName("lokacija");
                $lokacija = $lokacija->item(0)->nodeValue;

                $garantnirok = $row->getElementsByTagName("garantnirok");
                $garantnirok = $garantnirok->item(0)->nodeValue;

                $sifragrupe = $row->getElementsByTagName("sifragrupe");
                $sifragrupe = $sifragrupe->item(0)->nodeValue;

                $nazivgrupe = $row->getElementsByTagName("nazivgrupe");
                $nazivgrupe = $nazivgrupe->item(0)->nodeValue;

                $klasifikacija = $row->getElementsByTagName("klasifikacija");
                $klasifikacija = $klasifikacija->item(0)->nodeValue;

                $standard = $row->getElementsByTagName("standard");
                $standard = $standard->item(0)->nodeValue;

                $roktrajanja = $row->getElementsByTagName("roktrajanja");
                $roktrajanja = $roktrajanja->item(0)->nodeValue;

                $naakciji = $row->getElementsByTagName("naakciji");
                $naakciji = $naakciji->item(0)->nodeValue;

                if ($naakciji == "D") {
                    $naakciji = 1;
                } else {
                    $naakciji = 0;
                }

                $sifraakcijskogcenovnika = $row->getElementsByTagName("sifraakcijskogcenovnika");
                $sifraakcijskogcenovnika = $sifraakcijskogcenovnika->item(0)->nodeValue;

                $opis = $row->getElementsByTagName("opis");
                $opis = $opis->item(0)->nodeValue;

                $ArtLink = $common->friendly_convert($naziv);


                $db->where('KategorijaArtikalaSifra', $sifragrupe);
                $kateg = $db->getOne('kategorijeartikala', 'KategorijaArtikalaId');
                $KategorijaArtikalaIdUpit = $kateg['KategorijaArtikalaId'];

                $colls = array('ArtikalLink', 'ArtikalId');
                $db->where('ArtikalExtId', $artikalID);
                $art = $db->getOne('artikli', $colls);

                $ArtikalLinkUpit = $art['ArtikalLink'];
                $ArtikalIdUpit = $art['ArtikalId'];
                $linkIzUpita = '/' . $ArtikalLinkUpit . '/' . $ArtikalIdUpit;

                if ($ArtikalIdUpit) {

                    require "jedanDownloadArtikalaUpdateCron.php";

                } else {

                    require "jedanDownloadArtikalaInsertCron.php";

                }

                $a++;

                $log->lwrite('R BR : '.$a.'');

                usleep(10000);
            }


        } else {

            $log->lwrite('$brojLenght nije > 0');

        }

    } else {
        $log->lwrite('empty($tables)');
    }

} else {
    $log->lwrite('nema curlinitstanje');

}