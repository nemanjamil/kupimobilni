<?php
/**
 * Created by PhpStorm.
 * User: Nikola Markovic
 * Date: 8.1.2018.
 * Time: 14:38
 */
require 'includeZaCronCalcServise.php';

$varsleep = 10;

require ROOTLOC . '/obradi/snimiTxt.php';
$logLoc = ROOTLOC . '/logovi/logKomitentiCron.txt';

$log->lfile($logLoc);
$log->lwrite('');
$log->lwrite('Masine ENV : ' . $serverVarijabla);
$log->lwrite('Calculus Komitenti Cron START : ' . $timeUbac );


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
    $dom->save(ROOTLOC . '/xml/Komitenti.xml');

    $tables = $dom->getElementsByTagName('Table');

    if (!empty($tables)) {

        $brojLenght = $tables->length;
        $log->lwrite('Koliko ima komitenata : ' . $brojLenght );

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


                require 'calculusDrzavaProveraCron.php';
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
                        $log->lwrite('Update komitenti : KomitentId: ' . $KomitentId . ' KomitentSifra: ' . $sifra . ' Naziv:' . $zvanicninaziv);
                    } else {
                        $log->lwrite('Update Komitenta failed: ' . $db->getLastError() .' Naziv: '  . $zvanicninaziv . ' Sifra: ' . $sifra);
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
                        $log->lwrite('Ubacen komitent:: ' . $idUbacenogKomitenta . '; Naziv:' . $zvanicninaziv . ' Sifra komitenta: ' . $sifra);
                    } else {
                        $log->lwrite('Nije ubacen KOMITENT! Neki fail: ' . $db->getLastError() . ' Naziv: ' . $zvanicninaziv . ' Sifra: ' . $sifra );
                    }

                }

            }

            $log->lwrite('Ubaceni Komitenti');

        } else {
            $log->lwrite('brojLenght nije > 0 ' );

        }

    } else {
        $log->lwrite('empty(tables)');

    }

} else {
    $log->lwrite('nema curlinitstanje');

}

$log->lwrite('Zavrsen proces update komitenata iz Calculus-a');
$log->lclose();



