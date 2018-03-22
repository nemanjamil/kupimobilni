<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 12. 08. 2015.
 * Time: 15:22
 */

$IdOSnPodaci = $common->clearvariable($_POST['IdOSnPodaci']);
if (isset($IdOSnPodaci)) {
    $updatepodatke = Array(
        'ImeSajtaOsnPodaci' => $_POST['naziv'],
        'ImeFirmeOsnPodaci' => $_POST['ImeFirmeOsnPodaci'],
        'PibOsnPodaci' => $_POST['PibOsnPodaci'],
        'MatBrOsnPodaci' => $_POST['MatBrOsnPodaci'],
        'ZiroRacunOsnPodaci' => $_POST['ZiroRacunOsnPodaci'],
        'BankaOsnPodaci' => $_POST['BankaOsnPodaci'],
        'ZiroRacun1OsnPodaci' => $_POST['ZiroRacun1OsnPodaci'],
        'Banka1OsnPodaci' => $_POST['Banka1OsnPodaci'],
        'UlicaiBrOsnPodaci' => $_POST['UlicaiBrOsnPodaci'],
        'PosBrOsnPodaci' => $_POST['PosBrOsnPodaci'],
        'GradOsnPodaci' => $_POST['GradOsnPodaci'],
        'TelefonOsnPodaci' => $_POST['TelefonOsnPodaci'],
        'MobTelOsnPodaci' => $_POST['MobTelOsnPodaci'],
        'EmailOsnPodaci' => $_POST['EmailOsnPodaci'],
        'RadnoVremeOsnPodaci' => $_POST['RadnoVremeOsnPodaci'],
        'TitleOsnPodaci' => $_POST['string'],
        'OpisOsnPodaci' => $_POST['OpisOsnPodaci'],
        'KeywordsOsnPodaci' => $_POST['KeywordsOsnPodaci'],
        'SeoTekstOsnPodaci' => $_POST['SeoTekstOsnPodaci'],
        'PodaciZaKorisnikaOsnPodaci' => $_POST['PodaciZaKorisnikaOsnPodaci'],
        'NacinKupovineOsnPodaci' => $_POST['NacinKupovineOsnPodaci'],
        'NacinPlacanjaOsnPodaci' => $_POST['NacinPlacanjaOsnPodaci'],
        'NacinDostaveOsnPodaci' => $_POST['NacinDostaveOsnPodaci'],
        'FbOsnPodaci' => $_POST['FbOsnPodaci'],
        'GoogleOsnPodaci' => $_POST['GoogleOsnPodaci'],
        'TwitterOsnPodaci' => $_POST['TwitterOsnPodaci'],
        'YouTubeOsnPodaci' => $_POST['YouTubeOsnPodaci'],
        'OstaliPodaciOsnPodaci' => $_POST['OstaliPodaciOsnPodaci'],
        'PravilaRecenzije' => $_POST['PravilaRecenzije']
        /*,
        'welcomeNas' => $_POST['welcomeNas'],
        'welcomeOpis' => $_POST['welcomeOpis'],
        'welcomeTbNas1' => $_POST['welcomeTbNas1'],
        'welcomeTbOpis1' => $_POST['welcomeTbOpis1'],
        'welcomeTbNas2' => $_POST['welcomeTbNas2'],
        'welcomeTbOpis2' => $_POST['welcomeTbOpis2'],
        'welcomeTbNas3' => $_POST['welcomeTbNas3'],
        'welcomeTbOpis3' => $_POST['welcomeTbOpis3']
        */

    );

    $db->where("IdOsnPodaci", $id);
    $db->update('osnpodaci', $updatepodatke);
//var_dump($db);

//die;

    //$error_msg["ok"] = 'Izmenjen tag novo ime';
    header("Location:admin/osnovnipodaci");

} else {
    $error_msg["error"] = 'Greska pri izmeni podataka';
}


echo $m = json_encode($error_msg);


?>