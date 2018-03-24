<?php
// osnovni podaci treba da idu u cron da se pravi JSON
$osnPodFile = file_get_contents(DCROOT.'/cron/crongotovo/osnovnipodaci.json');
$jsonOsn = json_decode($osnPodFile,true); // ako je ,true onda je array

$osnpodaciImesajta = $jsonOsn->imeSajta;
$osnpodaciUlicaibr = $jsonOsn->ulicaibr;
$osnpodaciTitle = $jsonOsn->title;
$osnpodaciDescription = $jsonOsn->description;
$osnpodaciGrad = $jsonOsn->grad;
$osnpodaciBrtel = $jsonOsn->brtelfirma;
$osnpodaciMoblinifirma = $jsonOsn->moblinifirma;
$osnpodaciFaxfirma = $jsonOsn->faxfirma;
$osnpodaciRadnovreme = $jsonOsn->radnovreme;
$osnpodaciSeotekst = $jsonOsn->seotekst;
$osnpodaciPodzakorisnika = $jsonOsn->podzakorisnika;
$osnpodaciPib = $jsonOsn->pib;
$osnpodaciOsnPodGlavniMail = $jsonOsn->OsnPodGlavniMail;
$OsnPodFB = $jsonOsn->OsnPodFB;
$OsnPodGoogle = $jsonOsn->OsnPodGoogle;
$OsnPodTw = $jsonOsn->OsnPodTw;
$OsnPodYou = $jsonOsn->OsnPodYou;
$OsnPodInstagram = $jsonOsn->OsnPodInstagram;
$OsnPodValuta = $jsonOsn->KomitentiValuta;

?>