<?php
/*
 * 1. prvo uzimamo trenutno vreme
 *
*/
$mailBody = '';
$linkdoSlike = DPROOT.'/obradi/cssMailAndroid/images';

/*$user = $db->ObjectBuilder()->rawQueryOne ('SELECT NOW() AS trenVreme');
echo $trenVreme = $user->trenVreme;
echo '<br/>';
echo date("jS F, Y", strtotime($trenVreme));
echo '<br/>';
echo $dan = date("d", strtotime($trenVreme));  // j  je dan bez nule
echo '<br/>';
echo $mesec = date("m", strtotime($trenVreme));  // n  je mesec bez nule
echo '<br/>';
echo $godina = date("Y", strtotime($trenVreme));
echo '<br/>';
echo $sat = date("G", strtotime($trenVreme)); // sat
echo '<br/>';
echo $minut = date("i", strtotime($trenVreme)); // minut
echo '<br/>';
echo $sekunda = date("s", strtotime($trenVreme)); // minut

echo '<br/><br/>';
echo 'Stavljamo testno vreme';
echo '<br/>';*/

$dan = 07;
$mesec = 12;
$godina = 2015;
$sat = 14;
$minut = 34;
$sekunda = 15;
$dateStr = $godina.'-'.$dan.'-'.$mesec.' '.$sat.':'.$minut.':'.$sekunda;
$date = DateTime::createFromFormat('Y-d-m G:i:s', $dateStr);
$vremeTest = $date->format('Y-m-d G:i:s');

// prvo uradimo kojim komitentima saljemo

$cols = Array("K.KomitentId","K.KomitentEmail","K.KomitentIme","K.KomitentPrezime");
$db->join("listasenzora LS", "LS.SenzorSifra = PN.notSifraSenzora");
$db->join("komitenti K", "K.KomitentId = LS.PripadaKomitentu");
$db->where ("PN.vremeNotifikacije ", $vremeTest, '>=');
$db->where("PN.poslatMail", 0);
$db->groupBy('K.KomitentId');
$link = $db->get("podacinotifikacija PN", null, $cols);

if (!$link) die;

foreach ($link AS $key => $value):

    $Kid = $value['KomitentId'];
    $KomitentEmail = $value['KomitentEmail'];
    $KomitentIme = $value['KomitentIme'];
    $KomitentPrezime = $value['KomitentPrezime'];


    require('cssMailAndroid/mailBody.php');

    // Sada listamo sve kulture koje pripadaju komitentu a KOJIMA PRIPADA JEDAN ILI VISE SENZORA

    $cols = Array("KL.IdKulturaLokacija","KL.NazivKulturaLokacija","KUL.ImeKulture", "LOK.ImeLokSamo");
    $db->join("listasenzora LS", "LS.SenzorSifra = PN.notSifraSenzora");
    $db->join("komitenti K", "K.KomitentId = LS.PripadaKomitentu");
    $db->join("kulturalokacija KL", "KL.IdKulturaLokacija = LS.PripadaKulLok");
    $db->join("kulture KUL", "KUL.IdKulture = KL.PovKulture");
    $db->join("lokalnasu LOK", "LOK.IdLokSamo = KL.PovLokSamouprava");

    $db->where ("PN.vremeNotifikacije ", $vremeTest, '>=');
    $db->where("PN.poslatMail", 0);
    $db->where("K.KomitentId", $Kid);
    $db->groupBy('KL.IdKulturaLokacija');
    $linkKultura = $db->get("podacinotifikacija PN", null, $cols);



    if ($linkKultura) {

        // Sada listamo sve senzore koje pripadaju datoj kulturi i tom komitentu

        foreach ($linkKultura AS $key => $value):

            $IdKulturaLokacija = $value['IdKulturaLokacija'];
            $NazivKulturaLokacija = $value['NazivKulturaLokacija'];
            $ImeKulture = $value['ImeKulture'];
            $ImeLokSamo = $value['ImeLokSamo'];

            require('cssMailAndroid/listaKultura.php');

            $cols = Array("PN.notSifraSenzora");
            $db->join("listasenzora LS", "LS.SenzorSifra = PN.notSifraSenzora");
            $db->join("komitenti K", "K.KomitentId = LS.PripadaKomitentu");
            $db->join("kulturalokacija KL", "KL.IdKulturaLokacija = LS.PripadaKulLok");
            $db->where ("PN.vremeNotifikacije ", $vremeTest, '>=');
            $db->where("PN.poslatMail", 0);
            $db->where("K.KomitentId", $Kid);
            $db->where("KL.IdKulturaLokacija", $IdKulturaLokacija);
            $db->groupBy("PN.notSifraSenzora");
            $linkSifraSenzora = $db->get("podacinotifikacija PN", null, $cols);


            // i na kraju vucemo podatke o senzoru
            require('podaciSenzor.php');



        endforeach;

    }




    require('cssMailAndroid/mailBodyfut.php');

echo $mailBody;


endforeach;

?>

