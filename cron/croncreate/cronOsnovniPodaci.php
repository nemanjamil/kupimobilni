<?php
/**
 * Created by PhpStorm.
 * User: NemanjaMilivojevic
 * Date: 30.7.15.
 * Time: 10.42
 */

$m = array();


//$cols = Array("TagoviId", "TagoviIme", "TagoviGrupa","TagoviIme,CONCAT('bazacron') AS bazacron");
//$db->where("tagovi.TagoviIme LIKE '%$string%'");
//$user = $db->get("osnpodaci",  Array (10, 10), $cols);

$cols = Array ("JZ.ShortLanguage", "OP.*");
$db->join("languagejezik JZ", "JZ.IdLanguage = OP.IdOsnPodaci");
$products = $db->get ("osnpodacimasine OP", null, $cols);


$os = 0;
foreach ($products as $k=>$v){

    $ShortLanguageAaaa = $v['ShortLanguage'];
    $ShortLanguageArr = $v['IdOsnPodaci'];

    $arr[$ShortLanguageArr] = array();


    $cols = Array ("JZ.ShortLanguage", "OP.*");
    $db->join("languagejezik JZ", "JZ.IdLanguage = OP.IdOsnPodaci");
    $db->where("ShortLanguage",$ShortLanguageAaaa);
    $arrayShort = $db->get ("osnpodacimasine OP", null, $cols);

    //$na = array();
    foreach ($arrayShort as $k=>$user) {


        $arr[$ShortLanguageArr]['IdOsnPodaci'] .= $user['IdOsnPodaci'];
        $arr[$ShortLanguageArr]['ImeSajtaOsnPodaci'] .= $user['ImeSajtaOsnPodaci'];
        $arr[$ShortLanguageArr]['ImeFirmeOsnPodaci'] .= $user['ImeFirmeOsnPodaci'];


        $arr[$ShortLanguageArr]['UlicaiBrOsnPodaci'] .= $user['UlicaiBrOsnPodaci'];
        $arr[$ShortLanguageArr]['GradOsnPodaci'] .= $user['GradOsnPodaci'];
        $arr[$ShortLanguageArr]['PosBrOsnPodaci'] .= $user['ImeFirPosBrOsnPodacimeOsnPodaci'];
        $arr[$ShortLanguageArr]['TelefonOsnPodaci'] .= $user['TelefonOsnPodaci'];
        $arr[$ShortLanguageArr]['MobTelOsnPodaci'] .= $user['MobTelOsnPodaci'];
        $arr[$ShortLanguageArr]['EmailOsnPodaci'] .= $user['EmailOsnPodaci'];
        $arr[$ShortLanguageArr]['RadnoVremeOsnPodaci'] .= $user['RadnoVremeOsnPodaci'];
        $arr[$ShortLanguageArr]['TitleOsnPodaci'] .= $user['TitleOsnPodaci'];
        $arr[$ShortLanguageArr]['OpisOsnPodaci'] .= $user['OpisOsnPodaci'];
        $arr[$ShortLanguageArr]['KeywordsOsnPodaci'] .= $user['KeywordsOsnPodaci'];
        $arr[$ShortLanguageArr]['SeoTekstOsnPodaci'] .= $user['SeoTekstOsnPodaci'];


        $arr[$ShortLanguageArr]['PodaciZaKorisnikaOsnPodaci'] .= $user['PodaciZaKorisnikaOsnPodaci'];
        $arr[$ShortLanguageArr]['PibOsnPodaci'] .= $user['PibOsnPodaci'];
        $arr[$ShortLanguageArr]['MatBrOsnPodaci'] .= $user['MatBrOsnPodaci'];
        $arr[$ShortLanguageArr]['ZiroRacunOsnPodaci'] .= $user['ZiroRacunOsnPodaci'];
        $arr[$ShortLanguageArr]['BankaOsnPodaci'] .= $user['BankaOsnPodaci'];
        $arr[$ShortLanguageArr]['ZiroRacun1Osnpodaci'] .= $user['ZiroRacun1Osnpodaci'];
        $arr[$ShortLanguageArr]['Banka1OsnPodaci'] .= $user['Banka1OsnPodaci'];
        $arr[$ShortLanguageArr]['NacinKupovineOsnPodaci'] .= $user['NacinKupovineOsnPodaci'];

        $arr[$ShortLanguageArr]['NacinPlacanjaOsnPodaci'] .= $user['NacinPlacanjaOsnPodaci'];
        $arr[$ShortLanguageArr]['NacinDostaveOsnPodaci'] .= $user['NacinDostaveOsnPodaci'];
        $arr[$ShortLanguageArr]['FbOsnPodaci'] .= $user['FbOsnPodaci'];
        $arr[$ShortLanguageArr]['GoogleOsnPodaci'] .= $user['GoogleOsnPodaci'];


        $arr[$ShortLanguageArr]['TwitterOsnPodaci'] .= $user['TwitterOsnPodaci'];
        $arr[$ShortLanguageArr]['YoutubeOsnPodaci'] .= $user['YoutubeOsnPodaci'];
        $arr[$ShortLanguageArr]['OstaliPodaciOsnPodaci'] .= $user['OstaliPodaciOsnPodaci'];

        $arr[$ShortLanguageArr]['welcomeOpis'] .= $user['welcomeOpis'];
        $arr[$ShortLanguageArr]['welcomeNas'] .= $user['welcomeNas'];


        //Text box pocetna sa ikonicom
        $arr[$ShortLanguageArr]['welcomeTbNas1'] .= $user['welcomeTbNas1'];
        $arr[$ShortLanguageArr]['welcomeTbOpis1'] .= $user['welcomeTbOpis1'];
        $arr[$ShortLanguageArr]['welcomeTbNas2'] .= $user['welcomeTbNas2'];
        $arr[$ShortLanguageArr]['welcomeTbOpis2'] .= $user['welcomeTbOpis2'];
        $arr[$ShortLanguageArr]['welcomeTbNas3'] .= $user['welcomeTbNas3'];
        $arr[$ShortLanguageArr]['welcomeTbOpis3'] .= $user['welcomeTbOpis3'];

        //Zdravlje stranica
        $arr[$ShortLanguageArr]['zdravljeNaslov'] .= $user['zdravljeNaslov'];
        $arr[$ShortLanguageArr]['zdravljeOpis'] .= $user['zdravljeOpis'];

        $arr[$ShortLanguageArr]['zdravljeTbNaslov1'] .= $user['zdravljeTbNaslov1'];
        $arr[$ShortLanguageArr]['zdravljeTbOpis1'] .= $user['zdravljeTbOpis1'];
        $arr[$ShortLanguageArr]['zdravljeTbNaslov2'] .= $user['zdravljeTbNaslov2'];
        $arr[$ShortLanguageArr]['zdravljeTbOpis2'] .= $user['zdravljeTbOpis2'];


        $arr[$ShortLanguageArr]['PravilaRecenzije'] .= $user['PravilaRecenzije'];

    }

}



$cities = json_encode($arr, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES |JSON_HEX_APOS |JSON_HEX_QUOT);


/*JSON_UNESCAPED_UNICODE da bi dobili utf-8
http://se2.php.net/manual/en/json.constants.php*/
//$post_data = json_encode($e, JSON_UNESCAPED_UNICODE);


$fp = fopen(DCROOT.'/cron/crongotovo/osnovnipodaci.json', 'w+');
fwrite($fp, $cities);
fclose($fp);

