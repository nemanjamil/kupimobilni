<?php
function kojijehost($tipHosta){

    if ($tipHosta == 1) {
        $hostTip = '/data/kupimobilni'; // server Linux
    } elseif ($tipHosta == 3) {
        $hostTip = 'C:/wamp64/www/kupimobilni'; // Nemanja Windows
    } elseif ($tipHosta == 4) {
        $hostTip = 'G:/projects/XXXXXX'; // Nikola
    } else {
        $hostTip = '/var/www/kupimobilni'; // Nemanja Linux
    }
    return $hostTip;
}
$mcProd = getenv('KUPIMOBILNI');

$documentroot = kojijehost($mcProd);

// 1. zakucavamo server execution time na 0 tj. da ne stane dok se sve ne izvrsi i da prikaze sve error - e.
echo ini_get('display_errors');
ini_set('max_execution_time', 0);

include ($documentroot."/vezafull.php");
require_once ($documentroot.'/thumblib/ThumbLib.inc.php');
include($documentroot.'/stranice/parse/simple_html_dom.php');
$kategorijeDodatna = new kategorijeDodatna($db);
$jezLan = $db->get('languagejezik', null, "IdLanguage,ShortLanguage");

$varsleep = 10;

echo ini_get('display_errors');
ini_set('max_execution_time', 0);

$prvaSlika = 1;

$xmlLokacija = $documentroot . '/xml/3gStoreBrendovi.xml';
$dom = new DOMDocument();
$dom->load($xmlLokacija);
$tables = $dom->getElementsByTagName('brend');
$brojLenght = $tables->length;

if (!empty($tables)) {

    $brojLenght = $tables->length;


    if ($brojLenght > 0) {

        foreach ($tables as $row) {

            $ID = $row->getElementsByTagName("id");
            $ID = (int)$ID->item(0)->nodeValue;

            $BrendIme = $row->getElementsByTagName("BrendIme");
            $BrendIme = $BrendIme->item(0)->nodeValue;
            $BrendIme = filter_var($BrendIme, FILTER_SANITIZE_URL);

            $BrendLink = $row->getElementsByTagName("BrendLink");
            $BrendLink = $BrendLink->item(0)->nodeValue;
            $BrendLink = filter_var($BrendLink, FILTER_SANITIZE_URL);

            $image_link = $row->getElementsByTagName("pictureUrl");
            $image_link = $image_link->item(0)->nodeValue;

            $BrendActive = $row->getElementsByTagName("BrendActive");
            $BrendActive = $BrendActive->item(0)->nodeValue;

            $BrendNaslovna = $row->getElementsByTagName("BrendNaslovna");
            $BrendNaslovna = $BrendNaslovna->item(0)->nodeValue;

            $BrendOpis = $row->getElementsByTagName("BrendOpis");
            $BrendOpis = $BrendOpis->item(0)->nodeValue;


            $db->startTransaction();

            //Prvo provaravamo da li imamo isti kod nas u bazi

            $db->where('BrendLink', $BrendLink);
            $upit1 = $db->getOne('brendovi');
            $BrendIdUpit = $upit1['BrendId'];

            //Ako imamo kod nas u bazi
            if ($upit1) {

                $update_input = Array(
                    'BrendSlika' => $image_link,
                    'BrendNaslovna' => $BrendNaslovna,
                    'BrendActive' => $BrendActive
                );

                $db->where('BrendId', $BrendIdUpit);
                //prvo  updatujemo isti kod nas

                if ($db->update('brendovi', $update_input)) {

                    echo '<b class="bojaplavasajt">' . $db->count . '</b> records were updated: <b class="bojaplavasajt">' . $BrendIme . '</b>';
                    echo '</br>';

                    //onda proveravamo da li imamo Ime kod nas u bazi
                    $db->where('BrendId', $BrendIdUpit);
                    $db->where('IdLanguage', 5);
                    $upit2 = $db->getOne('brendoviime');
                    $BrendImeUpit2 = $upit2['BrendIme'];

                    //ako imamo ide update
                    if ($upit2) {

                        $update_name = Array(
                            'BrendIme' => $BrendIme

                        );

                        $db->where('BrendId', $BrendIdUpit);
                        $db->where('IdLanguage', 5);
                        if ($db->update('brendoviime', $update_name)) {
                            echo '</br>';
                            echo '<b class="bojaplavadrz">' . $BrendIme . '</b> updated: <b class="bojaplavasajt">' . $BrendIme . '</b>';
                            echo '</br>';

                        } else {

                            echo '</br>';
                            echo '<b class="bojaNaran"> IME update failed: ' . $db->getLastError() . '<b class="bojacrvena">' . $BrendIme . '</b>';
                            echo '</br>';
                        }

                    }
                    //Ako nemamo insert imena
                    else{

                        require 'ubaciNaziveBrend.php';

                    }

                    //Onda proveravamo da li ima opisa
                    $db->where('BrendId', $BrendIdUpit);
                    $db->where('IdLanguage', 5);
                    $upit3 = $db->getOne('brendoviopis');
                    $BrendOpisUpit3 = $upit3['BrendOpis'];

                    //Ako imamo Onda update opisa
                    if($BrendOpisUpit3){

                        $update_Opis = Array(
                            'BrendOpis' => $BrendOpis

                        );

                        $db->where('BrendId', $BrendIdUpit);
                        $db->where('IdLanguage', 5);
                        if ($db->update('brendoviopis', $update_Opis)) {
                            echo '</br>';
                            echo '<b class="bojaplavadrz">' . $BrendOpis . '</b> updated: <b class="bojaplavasajt">' . $BrendIme . '</b>';
                            echo '</br>';

                        } else {

                            echo '</br>';
                            echo '<b class="bojaNaran"> OPIS update failed: ' . $db->getLastError() . '<b class="bojacrvena">' . $BrendIme . '</b>';
                            echo '</br>';
                        }


                    }
                    //Ako nemamo onda ubac opisa
                    else{
                        require 'ubaciOpiseBrend.php';

                    }


                } else {
                    echo '<b class="bojacrvena"> update failed: ' . $db->getLastError() . '<b class="bojacrvena">' . $BrendIme . '</b>';
                    echo '</br>';
                }

            }

            //ako nemamo kod nas u bazi...
            else
            {

                $insert_input = Array(
                    'BrendLink' => $BrendLink,
                    'BrendSlika' => $image_link,
                    'BrendNaslovna' => $BrendNaslovna,
                    'BrendActive' => $BrendActive
                );

                $idubacenog = $db->insert('brendovi', $insert_input);

                if ($idubacenog) {

                    echo '<b class="bojaplavasajt">' . $idubacenog . '</b> Id Ubacenog kod nas: <b class="bojaplavasajt">' . $BrendIme . '</b>';
                    echo '</br>';


                    require 'ubaciNaziveBrend.php';

                    require 'ubaciOpiseBrend.php';



                } else {


                    echo '<b class="bojacrvena"> Insert failed: ' . $db->getLastError() . '<b class="bojacrvena">' . $BrendIme . '</b>';
                    echo '</br>';


                }


            }

            $db->commit();

        }

        echo 'Gotov foreach ubac';
        die;

    } else {
        echo 'brojLenght nije > 0';
        die;
    }

} else {
    echo 'empty(tables)';
    die;
}


?>