<?php
/**
 * Created by PhpStorm.
 * User: Nikola Markovic
 * Date: 02.11.2017.
 * Time: 09:32
 * Expl: Servis za ubacivanje komitenata na sajt
 */

require 'includeZaCalcServise.php';

$calculus = new calculusServisi($db);

$urlServisa = URLCALCSERVICE . 'PodaciKomitenta';
$postParametri = [
    'sifra' => '',
    'naziv' => '',
    'pib' => ''

];

$curlInitStanje = $calculus->posaljiPodatkeCalc($urlServisa, $postParametri);

if ($curlInitStanje) {
    $dom = new DOMDocument();
    $dom->loadXML($curlInitStanje);
    $dom->save(DCROOT . '/xml/Komitenti.xml');

    $tables = $dom->getElementsByTagName('Table');

    if (!empty($tables)) {

        $brojLenght = $tables->length;
        if ($brojLenght > 0) {

            foreach ($tables as $row) {

                $ID = $row->getElementsByTagName("ID");
                $ID = $ID->item(0)->nodeValue;

                $sifra = $row->getElementsByTagName("sifra");
                $sifra = $sifra->item(0)->nodeValue;

                $interninaziv = $row->getElementsByTagName("interninaziv");
                $interninaziv = $interninaziv->item(0)->nodeValue;

                $zvanicninaziv = $row->getElementsByTagName("zvanicninaziv");
                $zvanicninaziv = $zvanicninaziv->item(0)->nodeValue;

                $UserName = $common->friendly_convert($zvanicninaziv);

                $postanskibroj = $row->getElementsByTagName("postanskibroj");
                $postanskibroj = $postanskibroj->item(0)->nodeValue;

                $drzava = $row->getElementsByTagName("drzava");
                $drzava = $drzava->item(0)->nodeValue;

                $mesto = $row->getElementsByTagName("mesto");
                $mesto = $mesto->item(0)->nodeValue;

                $adresa = $row->getElementsByTagName("adresa");
                $adresa = $adresa->item(0)->nodeValue;

                $pfah = $row->getElementsByTagName("pfah");
                $pfah = $pfah->item(0)->nodeValue;

                $pak = $row->getElementsByTagName("pak");
                $pak = $pak->item(0)->nodeValue;

                $tel = $row->getElementsByTagName("tel");
                $tel = $tel->item(0)->nodeValue;

                $fax = $row->getElementsByTagName("fax");
                $fax = $fax->item(0)->nodeValue;

                $email = $row->getElementsByTagName("email");
                $email = $email->item(0)->nodeValue;

                $licezakontakt = $row->getElementsByTagName("licezakontakt");
                $licezakontakt = $licezakontakt->item(0)->nodeValue;
                $licezakontakt = ($licezakontakt) ? $licezakontakt : NULL;
                if ($licezakontakt) {
                    $ImePrezime = explode(' ', $licezakontakt);
                    $KomitentPrezime = $ImePrezime[0];
                    $KomitentIme = $ImePrezime[1];
                } else {
                    $KomitentPrezime = NULL;
                    $KomitentIme = NULL;
                }

                $pib = $row->getElementsByTagName("pib");
                $pib = $pib->item(0)->nodeValue;

                $matbroj = $row->getElementsByTagName("matbroj");
                $matbroj = $matbroj->item(0)->nodeValue;

                $tekuciracun = $row->getElementsByTagName("tekuciracun");
                $tekuciracun = $tekuciracun->item(0)->nodeValue;

                $pravnofizicko = $row->getElementsByTagName("pravnofizicko");
                $pravnofizicko = $pravnofizicko->item(0)->nodeValue;

                $rokplacanjakupcu = $row->getElementsByTagName("rokplacanjakupcu");
                $rokplacanjakupcu = $rokplacanjakupcu->item(0)->nodeValue;

                $rabatkupcu = $row->getElementsByTagName("rabatkupcu");
                $rabatkupcu = $rabatkupcu->item(0)->nodeValue;

                $rabatdobavljacu = $row->getElementsByTagName("rabatdobavljacu");
                $rabatdobavljacu = $rabatdobavljacu->item(0)->nodeValue;

                $tipcenovnika = $row->getElementsByTagName("tipcenovnika");
                $tipcenovnika = $tipcenovnika->item(0)->nodeValue;

                $napomena = $row->getElementsByTagName("napomena");
                $napomena = $napomena->item(0)->nodeValue;


                $komitentpassword = '1234';
                $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
                $komitentpassword77 = hash('sha512', $komitentpassword);
                $KomitentPassword = hash('sha512', $komitentpassword77 . $random_salt);


                require 'calculusDrzavaProvera.php';
                //Dobijamo $drzavaId


                $db->where('KomitentExtId', $ID);
                $upit = $db->getOne('komitenti', null, 'KomitentId');
                $KomitentId = $upit['KomitentId'];

                if ($KomitentId) {

                    $update_komitent = Array(
                        'KomitentExtId' => $ID,
                        'KomitentSifra' => $sifra,
                        'KomitentNaziv' => $zvanicninaziv,
                        'KomitentIme' => $KomitentIme,
                        'KomitentPrezime' => $KomitentPrezime,
                        'KomitentEmail' => $email,
                        'KomitentAdresa' => $adresa,
                        'KomitentPosBroj' => $postanskibroj,
                        'KomitentMesto' => $mesto,
                        'KomitentTelefon' => $fax,
                        'KomitentMobTel' => $tel,
                        'KomitentUserName' => $UserName,
                        'KomitentRabat' => $rabatkupcu,
                        'KomitentMatBr' => $matbroj,
                        'KomitentPib' => $pib,
                        'KomitentiZemlja' => $drzavaId,
                        'KomitentPravnoFizicko' => $pravnofizicko,
                        'KomitentRokPlacanjaKupcu' => $rokplacanjakupcu,
                        'KomitentTekuciRacun' => $tekuciracun
                    );

                    $db->where('KomitentId', $KomitentId);
                    if ($db->update('komitenti', $update_komitent)) {
                        echo '</br>';
                        echo '<b style="color: #45A6E6 !important;">Update komitenti : KomitentId: ' . $KomitentId . ' KomitentSifra: ' . $sifra . ' Naziv:' . $zvanicninaziv . '</b>';
                        echo '</br>';
                    } else {
                        echo '</br>';
                        echo '<b style="background-color: #EF7C07;"> Update Komitenta failed: ' . $db->getLastError() . '<b  style="color:#F00 !important;">' . $zvanicninaziv . ' Sifra: ' . $sifra . '</b>';
                        echo '</br>';
                    }
                } else {

                    $insert_query = Array(
                        'KomitentExtId' => $ID,
                        'KomitentSifra' => $sifra,
                        'KomitentNaziv' => $zvanicninaziv,
                        'KomitentIme' => $KomitentIme,
                        'KomitentPrezime' => $KomitentPrezime,
                        'KomitentEmail' => $email,
                        'KomitentAdresa' => $adresa,
                        'KomitentPosBroj' => $postanskibroj,
                        'KomitentMesto' => $mesto,
                        'KomitentTelefon' => $fax,
                        'KomitentMobTel' => $tel,
                        'KomitentUserName' => $UserName,
                        'KomitentRabat' => $rabatkupcu,
                        'KomitentMatBr' => $matbroj,
                        'KomitentPib' => $pib,
                        'KomitentiZemlja' => $drzavaId,
                        'KomitentPravnoFizicko' => $pravnofizicko,
                        'KomitentRokPlacanjaKupcu' => $rokplacanjakupcu,
                        'KomitentTekuciRacun' => $tekuciracun,
                        'KomitentSalt' => $random_salt,
                        'KomitentPassword' => $KomitentPassword

                    );

                    if ($idUbacenogKomitenta = $db->insert('komitenti', $insert_query)) {

                        echo '</br>';
                        echo '<b style="color:#F00 !important;">Ubacen komitent:: ' . $idUbacenogKomitenta . '; Naziv:' . $zvanicninaziv . ' Sifra komitenta: ' . $sifra . '</b>';
                        echo '</br>';
                    } else {
                        echo '</br>';
                        echo '<b style="color:#7b6173 !important;">Nije ubacen KOMITENT! Neki fail! failed: ' . $db->getLastError() . ' </b><b style="color:#F00 !important;"> Naziv: ' . $zvanicninaziv . ' Sifra: ' . $sifra . '</b>';
                        echo '</br>';
                    }

                }

            }
            echo '</br>';
            echo '</br>';
            echo '<h3 style="color:#44892c !important;">Ubaceni Komitenti</h3>';
            echo '</br>';
            echo '</br>';

        } else {
            echo 'brojLenght nije > 0';
            die;
        }

    } else {
        echo 'empty(tables)';
        die;
    }

} else {
    echo 'nema curlinitstanje';
    die;
}
