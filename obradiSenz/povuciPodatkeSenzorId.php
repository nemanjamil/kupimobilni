<?php
//$postdata = file_get_contents("php://input");
// ostavio sam POST a skinuo GET
/*$postdata = $_GET;


if (!empty($postdata)) {
    $tp = $postdata;
} else {
    // ako nema upste podataka
    $o['tag'] = 'povuciPodatkeSenzor';
    $o['success'] = false;
    $o['error'] = 1;  // stavio sam svuda 1
    $o['error_msg'] = "No Data";

    echo json_encode($o, JSON_UNESCAPED_UNICODE);
    die;
}

$tp = json_encode($tp); // ovo nam nece trebati jer dobijamo JSON kada se salje POST
$someObject = json_decode($tp);

// hvatamo varijable
$komId = (int)trim($someObject->komId); // id K
$string = trim($someObject->string); // SIFRA SENZORA AABBCCXXYY
$br = trim($someObject->br); // SIFRA SENZORA AABBCCXXYY*/


if (isset($_POST['string'])) { $string = filter_var($_POST['string'], FILTER_SANITIZE_STRING); } else { $string = ''; }
if (isset($_POST['br'])) { $br = filter_var($_POST['br'], FILTER_SANITIZE_NUMBER_INT); } else { $br = ''; }
if (isset($_POST['komId'])) { $komId = filter_var($_POST['komId'], FILTER_SANITIZE_NUMBER_INT); } else { $komId = ''; }

require DCROOT."/obradi/snimiTxt.php";
$log->lfile(DCROOT.'/logovi/basta.txt');
$log->lwrite('Povlacenje podataka za senzor : string(sifra Senzora) : '.$string.'; br(kultura) : '.$br.' komId(KomitentId) : '.$komId);



if (!$string) {
    $o['tag'] = 'povuciPodatkeSenzor';
    $o['success'] = false;
    $o['error'] = 2;  // stavio sam svuda 1
    $o['error_msg'] = "Sensor CODE don't exist";
    $o['error_msg_interni'] = "Ne postoji kod senzor - varijabla je -> sting";
    echo json_encode($o, JSON_UNESCAPED_UNICODE);
    die;
}

if (!$komId) {
    $o['tag'] = 'povuciPodatkeSenzor';
    $o['success'] = false;
    $o['error'] = 3;  // stavio sam svuda 1
    $o['error_msg'] = "User ID don't exist";
    $o['error_msg_interni'] = "Ne postoji komitent ID - varijabla je -> komId";
    echo json_encode($o, JSON_UNESCAPED_UNICODE);
    die;
}

if (!$br) {
    $o['tag'] = 'povuciPodatkeSenzor';
    $o['success'] = false;
    $o['error'] = 4;  // stavio sam svuda 1
    $o['error_msg'] = "No Id from Culture";
    $o['error_msg_interni'] = "Nema kultura ID a varijabla je -> br";
    echo json_encode($o, JSON_UNESCAPED_UNICODE);
    die;
}


$cols = Array("LS.SenzorSifra", "LS.IdListaSenzora", "K.KomitentNaziv", "K.KomitentIme", "K.KomitentPrezime", "K.KomitentId");
$db->join("komitenti K", "K.KomitentId = LS.KomitentId");
$db->where("LS.SenzorSifra", $string);
$db->where("LS.KomitentId", $komId);
$users = $db->get("listasenzora LS", null, $cols);


if ($db->count > 0) {

    $o['tag'] = 'povuciPodatkeSenzor';
    $o['success'] = true;
    $o['error'] = 0;
    $o['error_msg'] = "Podaci u sistemu";

    $a = array();

    foreach ($users as $user) {

        $SenzorSifra = $user['SenzorSifra'];
        $IdListaSenzora = $user['IdListaSenzora'];
        $KomitentNaziv = $user['KomitentNaziv'];
        $KomitentIme = $user['KomitentIme'];
        $KomitentPrezime = $user['KomitentPrezime'];
        $KomitentId = $user['KomitentId'];
        /*$LokacijaIme = $user['LokacijaIme'];
        $LokacijaId = $user['LokacijaId'];*/

        $o['SenzorSifra'] = $SenzorSifra;
        $o['IdListaSenzora'] = $IdListaSenzora;
        $o['KomitentNaziv'] = $KomitentNaziv;
        $o['KomitentIme'] = $KomitentIme;
        $o['KomitentPrezime'] = $KomitentPrezime;
        $o['KomitentId'] = $KomitentId;
        /* $o['LokacijaIme'] = $LokacijaIme;
         $o['LokacijaId'] = $LokacijaId;*/
    }


    /*
    SELECT
    LS.IdListaSenzora, LS.KomitentId, LS.SenzorSifra,
    K.ImeKulture, K.IdKulture,
    ST.senzorTipIme,
    PKT.*
    FROM
    listasenzora LS
    JOIN kulturasenzor KS ON  KS.IdListaSenzora = LS.IdListaSenzora AND KS.IdKulture = 3
    JOIN kulture K ON K.IdKulture = KS.IdKulture
    JOIN senzorkullokpodaci SKL ON SKL.IdKulture = K.IdKulture
    JOIN senzortip ST ON ST.IdSenzorTip = SKL.IdSenzorTip
    JOIN podacikultiplok PKT ON PKT.IdKulLokPodaci = SKL.IdKulLokPodaci
    WHERE LS.SenzorSifra = '5ECF7F0752BA' AND LS.KomitentId = 81;
    */


    //$db->setTrace(true);
    $cols = Array("LS.IdListaSenzora, LS.KomitentId, LS.SenzorSifra", "K.ImeKulture, K.IdKulture", "ST.senzorTipIme,ST.IdSenzorTip,ST.senzorTipTabela",
        "PKT.OdPodaciIdeal", "PKT.DoPodaciIdeal", "PKT.OdZutoIdeal", "PKT.DoZutoIdeal");
    $db->join("kulturasenzor KS", "KS.IdListaSenzora = LS.IdListaSenzora AND KS.IdKulture = " . $br);
    $db->join("kulture K", "K.IdKulture = KS.IdKulture");
    $db->join("senzorkullokpodaci SKL", "SKL.IdKulture = K.IdKulture");
    $db->join("senzortip ST", "ST.IdSenzorTip = SKL.IdSenzorTip");
    $db->join("podacikultiplok PKT", "PKT.IdKulLokPodaci = SKL.IdKulLokPodaci");
    $db->where("LS.SenzorSifra", $string);
    $db->where("LS.KomitentId", $komId);
    $usersSenzor = $db->get("listasenzora LS", null, $cols);
    //print_r($db->trace);


    if ($db->count > 0) {

        foreach ($usersSenzor as $v) {

            $IdSenzorTip = (int)$v['IdSenzorTip'];
            $senzorTipTabela = $v['senzorTipTabela'];

            $u['IdListaSenzora'] = $v['IdListaSenzora'];
            $u['SenzorSifra'] = $v['SenzorSifra'];
            $u['ImeKulture'] = $v['ImeKulture'];
            $u['IdKulture'] = $v['IdKulture'];
            $u['OdPodaciIdeal'] = (float)$v['OdPodaciIdeal'];
            $u['DoPodaciIdeal'] = (float)$v['DoPodaciIdeal'];
            $u['OdZutoIdeal'] = (float)$v['OdZutoIdeal'];
            $u['DoZutoIdeal'] = (float)$v['DoZutoIdeal'];
            $u['IdSenzorTip'] = $IdSenzorTip;
            $u['senzorTipIme'] = $v['senzorTipIme'];
            //$u['ImeLokSamo'] = $v['ImeLokSamo'];
            //$u['IdLokSamo'] = $v['IdLokSamo'];
            $u['podacizaSenzor'] = [];
            $u['podacizaSenzorTime'] = [];

            $limitodUp = 0;
            $limitdoUp = 10;

            require('podacijson/podaciAllTabeleSenzorKultura.php');

            array_push($a, $u);       // ubacivenje u array


        }

        $o['podaciSenzor'] = $a;

    } else {
        $o['podacizaSenzor'] = [];
        $o['podacizaSenzorTime'] = [];
    }


} else {

    $o['tag'] = 'povuciPodatkeSenzor';
    $o['success'] = false;
    $o['error'] = 4;
    $o['error_msg'] = "Nema podataka za dati ID, nema senzora za datog komitenta";

}


echo json_encode($o, JSON_UNESCAPED_UNICODE);
die;


?>
