<?php
define('RB_ROOT', dirname(__FILE__));
require 'vezafull.php';

$ipAdresa = getenv('REMOTE_ADDR'); // GET IP Address

$sesKor = new functions($db);
$ubacisliku = new ubacisliku($db);
$sesKor->sec_session_start();

$klasaApp = new klasaApp($db);


if (isset($_GET['action'])) {  $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING); }
elseif (isset($_POST['action'])) { $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING); } else {
        $action = '';
}

if (!$action) {
    echo 'Nema Akcije';
    die;
}

require "include/lang.php";
// tu smo dobili  $jezik = $_SESSION['language']; $valutasession = $_SESSION['valuta'];

$db->where("ActiveLanguage",1);
$jezLan = $db->get('languagejezik', null, "IdLanguage,ShortLanguage");


/*
 * Ovde uvlacimo Verzije LANG Stara verzija
 */
//$langjsonfile = file_get_contents(DCROOT.'/cron/crongotovo/lang.json');
//$jsonlang = json_decode($langjsonfile,true); // ako je ,true onda je array

$langjsonfile = file_get_contents(DCROOT.'/cron/crongotovo/langNew.json');
$jsonlang = json_decode($langjsonfile,true); // ako je ,true onda je array

/*
 * VARIJABLE
*/
if(isset($_GET['od'])) {  $od = filter_var($_GET['od'], FILTER_SANITIZE_NUMBER_INT); } else { $od = 0; }
if(isset($_GET['do'])) {  $do = filter_var($_GET['do'], FILTER_SANITIZE_NUMBER_INT); } else { $do = 10; }

if (isset($_GET['valutasession'])) {  $valutasession = filter_var($_GET['valutasession'], FILTER_SANITIZE_STRING); } else { $valutasession = VALUTA;  }
if (isset($_GET['valutaId'])) {  $valutaId = filter_var($_GET['valutaId'], FILTER_SANITIZE_NUMBER_INT); } else { $valutaId = VALUTAKOMITENT;  }

if (isset($_GET['jezik'])) {  $jezik = filter_var($_GET['jezik'], FILTER_SANITIZE_STRING); } else { $jezik = JEZIK;  }
if (isset($_GET['jezikId'])) {  $jezikId = filter_var($_GET['jezikId'], FILTER_SANITIZE_NUMBER_INT); } else { $jezikId = JEZIKID;  }
if (isset($_GET['brend'])) {  $brendArtUpit = filter_var($_GET['brend'], FILTER_SANITIZE_NUMBER_INT); } else { $brendArtUpit = '';  }
if (isset($_GET['sortKontrole'])) {  $sortKontrole = filter_var($_GET['sortKontrole'], FILTER_SANITIZE_NUMBER_INT); } else { $sortKontrole = '';  }
// if (isset($_GET['userTip'])) {  $userTip = $common->isEmpty($_GET['userTip'],FILTER_SANITIZE_NUMBER_INT);  } else { $userTip = 1;  }
if (isset($_GET['limit'])) {  $limit = $common->isEmpty($_GET['limit'],FILTER_SANITIZE_NUMBER_INT);  } else { $limit = 5;  }
if (isset($_GET['userId'])) {

        $userId = $common->isEmpty($_GET['userId'],FILTER_SANITIZE_NUMBER_INT);

        if ($userId) {

            $cols = Array ("KomitentId","KomitentTipUsera", "KomiRabatKupi");
            $db->where("KomitentId",$userId);
            $komitent = $db->get ("komitenti", null, $cols);
            if ($db->count > 0) {
                foreach ($komitent as $v => $k) {
                    $userId = $k['KomitentId'];
                    $userTip = $k['KomitentTipUsera'];
                    $KomiRabatKupi = $k['KomiRabatKupi'];

                }
            } else {

                /*
                 * Ipak vracamo na staro
                 * ne mozemo ovo zbog korpe kada milance trazi za korisnika po nekom
                 * njegovom ID podatke sta je on stavio u kopru kod nas u bazu
                 * */


                $m['tag'] = 'KomitentTipUsera';
                $m['success'] = false;
                $m['error'] = 1;
                $m['error_msg'] = "Ne postoji Komitent user za userID : ".$userId;
                echo json_encode($m, JSON_UNESCAPED_UNICODE);
                die;
            }


       } else {
            $userId = USERIDOBICAN;
            $userTip = 0;
            $KomiRabatKupi = 0;
        }
    } else {

    $userId = USERIDOBICAN;
    $userTip = 0;
    $KomiRabatKupi = 0;
}

/*
 * Kada budemo setovali POST
 * if(isset($_POST['od'])) {  $od = filter_var($_POST['od'], FILTER_SANITIZE_NUMBER_INT); } else { $od = 0; }
 * if(isset($_POST['do'])) {  $do = filter_var($_POST['do'], FILTER_SANITIZE_NUMBER_INT); } else { $do = 5; }
 * if (isset($_POST['valutasession'])) {  $valutasession = filter_var($_POST['valutasession'], FILTER_SANITIZE_STRING); } else { $valutasession = '';  }
 * if (isset($_POST['jezik'])) {  $jezik = filter_var($_POST['jezik'], FILTER_SANITIZE_STRING); } else { $jezik = JEZIK;  }
 * if (isset($_POST['jezik'])) {  $jezik = filter_var($_GET['jezik'], FILTER_SANITIZE_STRING); } else { $jezik = JEZIK;  }
*/


switch ($action) {

    /*
     * SIFRE I REGISTRACIJA */

    case "registrujAndroid":
        require('obradiApp/registrujAndroid.php');
        break;
    // IZGUBI SIFRU !!!
    case "izgubiSifruAndroid":
        require('obradiApp/izgubiSifruAndroid.php');
        break;
    case "izmeniPodatkeKomitent":
        require('obradiApp/izmeniPodatkeKomitent.php');
        break;
    // IZMENI SIFRU !!!
    /*case "izmeniSifruAndroid":
        require('obradiApp/izmeniSifruAndroid.php');
        break;*/
    case "povuciPodatkeAndroidKorisnik":
        require('obradiApp/povuciPodatkeAndroidKorisnik.php');
        break;

    /*
     * PODACI*/

    case "sveKategorije":
        require('obradiApp/sveKategorije.php');
        break;
    case "artNaAkciji":
        require('obradiApp/artNaAkciji.php');
        break;
    case "artikliPoKateg":
        require('obradiApp/artikliPoKateg.php');
        break;

    /*
        BRENDOVI
    */
    case "brendoviPoKateg":
        require('obradiApp/brendoviPoKateg.php');
        break;
    case "sviBrendoviNaslovna":
        require('obradiApp/sviBrendoviNaslovna.php');
        break;
    case "listaBrendova":
        require('obradiApp/listaBrendova.php');
        break;
    case "listaKategorijaPoBrendu":
        require('obradiApp/listaKategorijaPoBrendu.php');
        break;




    case "kategorijePoId":
        require('obradiApp/kategorijePoId.php');
        break;
    case "breadCrumpodIdKategFull":
        require('obradiApp/breadCrumpodIdKategFull.php');
        break;

    case "artikal":
        require('obradiApp/artikal.php');
        break;

    case "artikalTekstXml":
        require('obradiApp/artikalTekstXml.php');
        break;

    case "specPoKategorijiSamo":
        require('obradiApp/specPoKategorijiSamo.php');
        break;

    case "horizMeni":
        require('obradiApp/horizMeni.php');
        break;

    case "horizMenipoId":
        require('obradiApp/horizMenipoId.php');
        break;

    case "languageApp":
        require('obradiApp/languageApp.php');
        break;

    case "troskoviPrevoza":
        require('obradiApp/troskoviPrevoza.php');
        break;


    case "povezaniArtikliNaslovna":
        require('obradiApp/povezaniArtikliNaslovna.php');
        break;

    case "povezaniArtikliNaArtiklu":
        require('obradiApp/povezaniArtikliNaArtiklu.php');
        break;

    case "informacije":
        require('obradiApp/informacije.php');
        break;

    case "textZaInfoXML":
        require('obradiApp/textZaInfoXML.php');
        break;

    case "textZaInfoJSON":
        require('obradiApp/textZaInfoJSON.php');
        break;

    case "searchMob":
        require('obradiApp/searchMob.php');
        break;

    case "kategYouMayAlso":
        require('obradiApp/kategYouMayAlso.php');
        break;

    /* KORPA */
    case "korpaLista":
        require('obradiApp/korpaLista.php');
        break;
    case "dodajArtikalKorpa":
        require('obradiApp/dodajArtikalKorpa.php');
        break;
    case "obrisiArtikalKorpa":
        require('obradiApp/obrisiArtikalKorpa.php');
        break;
    case "obrisiSveKorpa":
        require('obradiApp/obrisiSveKorpa.php');
        break;
    case "kupovinaKorpa":
        require('obradiApp/kupovinaKorpa.php');
        break;
    case "kupovinaKorpaUnregistered":
        require('obradiApp/kupovinaKorpaUnregistered.php');
        break;



    /*
     * POSALJI MAIL*/
    case "posaljiMailAndr":
        require('obradiApp/posaljiMailAndr.php');
        break;

    /*
     * SEARCH REST API*/
    case "searchAndr":
        require('obradiApp/searchAndr.php');
        break;


    // RAZNE STRANICE
    case "nacinKupovine": // Nije Napravljeno
        require('obradiApp/nacinKupovine.php');
        break;
    case "oNama": // Nije Napravljeno
        require('obradiApp/oNama.php');
        break;
    case "kontakt": // Nije Napravljeno
        require('obradiApp/kontakt.php');
        break;
    case "komentariPoArtiklu": // Nije Napravljeno
        require('obradiApp/komentariPoArtiklu.php');
        break;
    case "recenzijePoArtiklu": // Nije Napravljeno
        require('obradiApp/recenzijePoArtiklu.php');
        break;


    /*
     *
     * API !!!!
     * POCETAK SENZORI API za APLIKACIJU
     *
     **/

    // SENZORI PO KOMITENTU
    case "dodajSenzorId":
        require('obradiSenz/dodajSenzorId.php');
        break;
    case "obrisiSenzorId":
        require('obradiSenz/obrisiSenzorId.php');
        break;
    case "listaSenzoraPoKomitentu":
        require('obradiSenz/listaSenzoraPoKomitentu.php');
        break;


    // KOMITENT
    case "povuciUidOdEmail":
        require('obradiApp/povuciUidOdEmail.php');
        break;
    // registracija FB
    case "registrujFBusera":
        require('obradiApp/registrujFBusera.php');
        break;
    // REGISTRACIJA G TOKEN
    case "registrujGToken":
        require('obradiApp/registrujGToken.php');
        break;

    case "logujGToken":
        require('obradiApp/logujGToken.php');
        break;

    // KULTURA SENZOR
    case "podaciKulture":
        require('obradiSenz/podaciKulture.php');
        break;
    case "podaciPoJednojKulturi":
        require('obradiSenz/podaciPoJednojKulturi.php');
        break;
    case "listaKulturaPoSenzoru":
        require('obradiSenz/listaKulturaPoSenzoru.php');
        break;
    case "dodajKulturuNaSenzor":
        require('obradiSenz/dodajKulturuNaSenzor.php');
        break;
    case "obrisiKulturuNaSenzoru":
        require('obradiSenz/obrisiKulturuNaSenzoru.php');
        break;

    // UBACIVANJE PODATAKA SA SENZORA U BAZU
    case "osnovniparametri":
        require('obradiSenz/osnovniparametri.php');
        break;

    // POVLACENJE PODATAKA OD SENZORA
    case "povuciPodatkeSenzorId":
        require('obradiSenz/povuciPodatkeSenzorId.php');
        break;



    // STARO
    case "povuciSenzorUid":
        require('obradiSenz/povuciSenzorUid.php');
        break;
    case "cronPoslatiMail":
        require('obradiSenz/cronPoslatiMail.php');
        break;
    case "izmeniPodatkeSenzorId":
        require('obradiSenz/izmeniPodatkeSenzorId.php');
        break;

    /*case "dodajSenzorArt":
        require('obradi/dodajSenzorArt.php');
        break;
    case "editsenzid":
        require('obradi/editsenzid.php');
        break;
    case "dodajSenzorSenz":
        require('obradi/dodajSenzorSenz.php');
        break;
    case "obrisisenzor":
        require('obradi/obrisisenzor.php');
        break;
    case "obrisiSenzArtikal":
        require('obradi/obrisiSenzArtikal.php');
        break;
    case "jsonpodaciSenzor":
        require('obradi/jsonpodaciSenzor.php');
        break;
    case "dodajpodkulturi":
        require('obradi/dodajpodkulturi.php');
        break;
    case "editpodkulture":
        require('obradi/editpodkulture.php');
        break;
    case "obrisipodkulture":
        require('obradi/obrisipodkulture.php');
        break;
    case "dodajpodkulturisve":
        require('obradi/dodajpodkulturisve.php');
        break;
    case "obrisipodkulturesve":
        require('obradi/obrisipodkulturesve.php');
        break;
    case "dodajlokkulturi":
        require('obradi/dodajlokkulturi.php');
        break;
    case "editlokkulture":
        require('obradi/editlokkulture.php');
        break;
    case "obrisilokkulture":
        require('obradi/editlokkulture.php');
        break;*/


    /*
     * KRAJ SENZORI */


    default:

    }

    //header("Location:" . URLVRATI . "?err=3vece");




?>

