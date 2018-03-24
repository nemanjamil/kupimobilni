<?php
define('RB_ROOT', dirname(__FILE__));
require 'vezafull.php';

$ipAdresa = getenv('REMOTE_ADDR'); // GET IP Address

$url = $_SERVER["HTTP_REFERER"];
$sesKor = new functions($db);
$senzori = new senzori($db);
$ubacisliku = new ubacisliku($db);
$sesKor->sec_session_start();

$ipAdress = getenv('REMOTE_ADDR'); // GET IP Address

if (isset($_GET['action'])) {
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
} else {
    $action = '';
}

require "include/lang.php";
// tu smo dobili  $jezik = $_SESSION['language']; $valutasession = $_SESSION['valuta'];

$db->where("ActiveLanguage",1);
$jezLan = $db->get('languagejezik', null, "IdLanguage,ShortLanguage");


if (!$action) {
    echo 'Nema Akcije';
    die;
}
require "stranice/cookSajtCheck.php";


// ---------------------------------------------------------------- LOGOVANJE
require "stranice/loginIndex.php";
//-------------------------------------------------------------- LOGOVANJE KRAJ

// da svi mogu da koriste




switch ($action) {

    case "registruj":
        require('obradi/registruj.php');
        break;
    case "logujse":
        require('obradi/logujse.php');
        break;
    case "logujFbUbazi":
        require('obradi/logujFbUbazi.php');
        break;
    case "izlogujse":
        require('obradi/izlogujse.php');
        break;
    case "izmenasifre":
        require('obradi/izmenasifre.php');
        break;
    case "promenajezika":
        require('obradi/promenajezika.php');
        break;
    case "promenavalute":
        require('obradi/promenavalute.php');
        break;
    case "dodajuKorpu":
        require('obradi/dodajuKorpu.php');
        break;
    case "obrisiIzKorpe":
        require('obradi/obrisiIzKorpe.php');
        break;
    case "postaviMainSliku":
        require('obradi/postaviMainSliku.php');
        break;
    case "postaviMainSlikuKateg":
        require('obradi/postaviMainSlikuKateg.php');
        break;
    case "promeniKolCart":
        require('obradi/promeniKolCart.php');
        break;
    case "kupiArtikal":
        require('obradi/kupiArtikal.php');
        break;
    case "oceniZvezda":
        require('obradi/oceniZvezda.php');
        break;
    case "dodajMail":
        require('obradi/dodajMail.php');
        break;
    case "dodajKometar":
        require('obradi/dodajKometar.php');
        break;
    case "dodajCompare":
        require('obradi/dodajCompare.php');
        break;
    case "skiniCompare":
        require('obradi/skiniCompare.php');
        break;
    case "izmenimojepodatke":
        require('obradi/izmenimojepodatke.php');
        break;
    case "posaljiPitanjeKomentar":
        require('obradi/posaljiPitanjeKomentar.php');
        break;
    case "dodajocenu":
        require('obradi/dodajocenu.php');
        break;
    case "dodajzaposao":
        require('obradi/dodajzaposao.php');
        break;
    case "traziArtKateg":
        require('obradi/traziArtKateg.php');
        break;
    case "traziArtikle":
        require('obradi/traziArtikle.php');
        break;
    case "obrisiSpecEs":
        require('obradi/obrisiSpecEs.php');
        break;
    case "dodajKategSesEs":
        require('obradi/dodajKategSesEs.php');
        break;
    case "dodajBrendSesEs":
        require('obradi/dodajBrendSesEs.php');
        break;
    case "dodajSpecCenaES":
        require('obradi/dodajSpecCenaES.php');
        break;
    case "dodajSpecVrednostEs":
        require('obradi/dodajSpecVrednostEs.php');
        break;
    case "izmenilozinkukorisnika":
        require('obradi/izmenilozinkukorisnika.php');
        break;
    case "prosp":
        require('obradi/prosp.php');
        break;

    /*
     * DODATNA OPREMA DEO ide kod Logovanog dela*/

    case "promeniArtKateg":
        require('obradi/promeniArtKateg.php');
        break;


   /* default:
        echo 'Nije dobar upit na Akcija -> $action : '.$action;
        die;*/

}


// samo registrovani
require('akcijaSamoReg.php');




?>

