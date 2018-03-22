<?php
$postdata = file_get_contents("php://input");

$mailClass = new mailClass($db);

if (!empty($postdata)) {
    $tp = $postdata;
} else {
    $tp = 'prazno';

    /* $o['tag'] = 'upucavenjaSenzora';
     $o['success'] = false;
     $o['error'] = 7;
     $o['error_msg'] =  "prazno";*/
}
/*echo 'string : ';
echo $tp = 'humidity=35;temperature=33;luminosity=300;moisture=231;ID=5ECF7F0752BA';
echo '<br/>';*/

$woot = explode(';', $tp);
$i = 0;
foreach ($woot as $key => $value) {
    $s = explode('=', $value);
    //$pod[] = array($s[0]=>$s[1]);
    $pod[$s[0]] = $s[1];
    $i++;
}

// dobijamo podatke sto kupimo od senzora
$w = json_encode($pod);
$someObject = json_decode($w);
$idSifra = $someObject->ID;
$temperature = (float) $someObject->temperature;
$humidity = (float) $someObject->humidity;
$luminosity = (float) $someObject->luminosity;
$moisture = (float) $someObject->moisture;


require DCROOT."/obradi/snimiTxt.php";
$log->lfile(DCROOT.'/logovi/basta.txt');
$log->lwrite('Dodaj Upucaj Podatke se Senzora : $temperature : '.$temperature.'; $humidity : '.$humidity.'; $luminosity : '.$luminosity.'; $moisture : '.$moisture.' $idSifra : '.$idSifra);

require "proveraDaLiImaSvihPodataka.php";

/*
 * tipNotifikacije
 * 0 - Zeleno
 * 1 - Zuto
 * 2 - Crveno
 * */
$zelenazona = 1;
$zutazona = 2;
$crvenazona = 3;

// ovde mozemo da kreiramo JSON sa svim idealnim podacima pa onda me moramo da pravimo 4 upita neko pozovemo JSON
// require_once('podaciZaSenzor.php');

// UBACUJEMO VLAZNOST VAZDUHA
$vrednostPodatak = $humidity;
$opisSenzora = 'Vlaznost Vazduha';
$log->lwrite($opisSenzora.' 0 : Postoji  idSenzorSifra : '.$idSifra.' ; vredSenzor: '.$vrednostPodatak);
require_once('obradiVlaznostVazduha.php');

// UBACUJEMO TEMEPRATURU
$vrednostPodatak = $temperature;
$opisSenzora = 'Temperatura';
$log->lwrite($opisSenzora.' 0 : Postoji  idSenzorSifra : '.$idSifra.' ; vredSenzor: '.$vrednostPodatak);
require_once('obraditemp.php');

// UBACUJEMO SVETLOST
$vrednostPodatak = $luminosity;
$opisSenzora = 'Svetlost';
$log->lwrite($opisSenzora.' 0 : Postoji  idSenzorSifra : '.$idSifra.' ; vredSenzor: '.$vrednostPodatak);
require_once('obradisvetlost.php');

// UBACUJEMO MOISTURE
$vrednostPodatak = $moisture;
$opisSenzora = 'Vlaznost Zemljista';
$log->lwrite($opisSenzora.' 0 : Postoji  idSenzorSifra : '.$idSifra.' ; vredSenzor: '.$vrednostPodatak);
require_once('obradimoisture.php');



$o['tag'] = 'upucavenjaSenzora';
$o['success'] = true;
$o['error'] = 0;
$o['error_msg'] =  "Sve je upucano kako treba";
echo json_encode($o,JSON_UNESCAPED_UNICODE);

$log->lwrite('Sve je ok UPUCANO');
$log->lwrite('');
$log->lwrite('');
/*$db->startTransaction();
if (!$db->insert ('myTable', $insertData)) {
    $db->rollback();
} else {
    $db->commit();
}*/

?>
	