<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 05. 08. 2015.
 * Time: 3:32 PM
 */

/*
var_dump($_POST);
var_dump($_FILES);
die;
*/

// da li ima kategoriju u editu
if (isset($_POST['idkategorijeDodajArtikal'])) {  $idkategorijeDodajArtikal = filter_input(INPUT_POST, 'idkategorijeDodajArtikal', FILTER_SANITIZE_NUMBER_INT); } else {   $idkategorijeDodajArtikal = ''; }
if (isset($_POST['KategorijeArtikalaId'])) {  $KategorijeArtikalaId = filter_input(INPUT_POST, 'KategorijeArtikalaId', FILTER_SANITIZE_NUMBER_INT); } else {   $KategorijeArtikalaId = ''; }

if (isset($_POST['imeartikla'])) {  $imeartikla = filter_input(INPUT_POST, 'imeartikla', FILTER_SANITIZE_STRING); } else {   $imeartikla = 'Artikal'; }

if (isset($_POST['brendartikla'])) {  $brendartikla = filter_input(INPUT_POST, 'brendartikla', FILTER_SANITIZE_NUMBER_INT); } else {   $brendartikla = ''; }

if (isset($_POST['KomitentId'])) {  $KomitentId = filter_input(INPUT_POST, 'KomitentId', FILTER_SANITIZE_NUMBER_INT); } else {   $KomitentId = ''; }

$kod = explode("|",$_POST['KomitentId']);

if (isset($_POST['MinimalnaKolArt'])) {  $MinimalnaKolArt = filter_input(INPUT_POST, 'MinimalnaKolArt', FILTER_SANITIZE_NUMBER_INT); } else {   $MinimalnaKolArt = ''; }

if (isset($_POST['TipKatUnitArt'])) {  $TipKatUnitArt = filter_input(INPUT_POST, 'TipKatUnitArt', FILTER_SANITIZE_NUMBER_INT); } else {   $TipKatUnitArt = ''; }

if (isset($_POST['ArtikalDostupnoOd'])) {  $ArtikalDostupnoOd = filter_input(INPUT_POST, 'ArtikalDostupnoOd', FILTER_SANITIZE_STRING); } else {   $ArtikalDostupnoOd = null; }
if (isset($_POST['ArtikalReklamaTekst'])) {  $ArtikalReklamaTekst = filter_input(INPUT_POST, 'ArtikalReklamaTekst', FILTER_SANITIZE_STRING); } else {   $ArtikalReklamaTekst = null; }

if (isset($_POST['barkodartikla'])) { $barkodartikla = filter_input(INPUT_POST, 'barkodartikla', FILTER_SANITIZE_NUMBER_INT); } else {   $barkodartikla = ''; }

if (isset($_POST['sifraartikla'])) { $sifraartikla = filter_input(INPUT_POST, 'sifraartikla', FILTER_SANITIZE_NUMBER_INT); } else {   $sifraartikla = ''; }

if (isset($_POST['marzaartikla'])) {  $marzaartikla = filter_input(INPUT_POST, 'marzaartikla', FILTER_SANITIZE_NUMBER_INT);} else {    $marzaartikla = '';}

if (isset($_POST['urlartikla'])) {  $urlartikla = filter_input(INPUT_POST, 'urlartikla', FILTER_SANITIZE_STRING);}  else {    $urlartikla = 'artikal'; }

if (isset($_POST['ArtikalStanje'])) {  $ArtikalStanje = filter_input(INPUT_POST, 'ArtikalStanje', FILTER_SANITIZE_NUMBER_INT);} else {    $ArtikalStanje = '';}

if (isset($_POST['ArtikalAktivan'])) {  $ArtikalAktivan = filter_input(INPUT_POST, 'ArtikalAktivan', FILTER_SANITIZE_STRING);}  else {    $ArtikalAktivan = ''; }

if (isset($_POST['ArtikalKratakOpis'])) { $ArtikalKratakOpis = filter_input(INPUT_POST, 'ArtikalKratakOpis', FILTER_SANITIZE_STRING); } else {    $ArtikalKratakOpis = ''; }
/*
if (!empty($_POST['codeboschlink'])) { $codeboschlink = filter_input(INPUT_POST, 'codeboschlink', FILTER_SANITIZE_STRING); } else {    $codeboschlink = NULL; }
if (!empty($_POST['codebosch'])) { $codebosch = $common->isEmpty($_POST['codebosch'],FILTER_SANITIZE_STRING);  } else {    $codebosch = NULL; }

if (!empty($_POST['codeagro'])) { $codeagro = $common->isEmpty($_POST['codeagro'],FILTER_SANITIZE_STRING);  } else {    $codeagro = NULL; }

if (!empty($_POST['codelumen'])) { $codelumen = $common->isEmpty($_POST['codelumen'],FILTER_SANITIZE_STRING); } else {    $codelumen = NULL; }
if (!empty($_POST['codelumenlink'])) { $codelumenlink = filter_input(INPUT_POST, 'codelumenlink', FILTER_SANITIZE_URL); } else {    $codelumenlink = NULL; }

if (!empty($_POST['codevermax'])) {  $codevermax = $common->isEmpty($_POST['codevermax'],FILTER_SANITIZE_STRING); } else {    $codevermax = NULL; }
if (!empty($_POST['codevermaxlink'])) { $codevermaxlink = filter_input(INPUT_POST, 'codevermaxlink', FILTER_SANITIZE_URL); } else {    $codevermaxlink = NULL; }

if (!empty($_POST['CodeNutricija'])) { $CodeNutricija = $common->isEmpty($_POST['CodeNutricija'],FILTER_SANITIZE_STRING); } else {    $CodeNutricija = NULL; }
*/


// hvatamo tagove
if (isset($_POST['tagime'])) { $tagime = filter_input(INPUT_POST, 'tagime', FILTER_SANITIZE_STRING); } else {    $tagime = ''; }

if (isset($_POST['poklonArikliIdjevi'])) {
    $poklonArikliIdjevi = filter_input(INPUT_POST, 'poklonArikliIdjevi', FILTER_SANITIZE_STRING);
    $piecesPoklon = explode(",", $poklonArikliIdjevi);
} else {    $poklonArikliIdjevi = ''; }

//if (isset($_POST['cenavpartikla'])) {  $cenavpartikla = filter_input(INPUT_POST, 'cenavpartikla', FILTER_SANITIZE_NUMBER_FLOAT); } else {   $cenavpartikla = null; }
//if (isset($_POST['cenampartikla'])) {  $cenampartikla = filter_input(INPUT_POST, 'cenampartikla', FILTER_SANITIZE_NUMBER_FLOAT); } else {   $cenampartikla = null; }

$cenavpartikla = $_POST['cenavpartikla'];
$cenampartikla = $_POST['cenampartikla'];

$ArtikalNaAkciji = $common->clearvariable($_POST['ArtikalNaAkciji']);



// prvo ubacujemo tagove u bazu
if ($tagime) {
    $valueTagovi = explode(',', $tagime);
    foreach ($valueTagovi as $key) {

        // vidi da li vec postoji ID taga u bazi; Ako ima uzmi ID
        $db->where("TagoviIme", $key);
        $user = $db->getOne("tagovi");

        if ($user) {
            $idTagArr[] = $user['TagoviId'];
        }

        // ubacujemo takove koje nemamo u bazi
        $insert_query = Array('TagoviIme' => $key);
        $db->setQueryOption(Array('IGNORE'));
        $idTag = $db->insert('tagovi', $insert_query);

        if ($idTag) {
            // ubacejemo Id-jeve u array
            $idTagArr[] = $idTag;
        }

    }
}




$update_query = Array(
    //'ArtikalKratakOpis' => $ArtikalKratakOpis,
    'ArtikalBrendId' => $brendartikla,
    'ArtikalVPCena' => $cenavpartikla,
    'ArtikalMPCena' => $cenampartikla,
    'ArtikalBarKod' => $barkodartikla,
    'ArtikalNaAkciji' => $ArtikalNaAkciji,
    'ArtikalMarzaId' => $marzaartikla,
    'ArtikalAktivan' => $ArtikalAktivan,
    'ArtikalLink' => $urlartikla,
    'ArtikalDostupnoOd' => $ArtikalDostupnoOd,
    //'ArtikalKomitent' => $KomitentId,
    'ArtikalKomitent' => $kod[0],
     $kod[1] => $sifraartikla,
    //'ArtikalSifra' => $sifraartikla,
    'TipKatUnitArt' => $TipKatUnitArt,
    'MinimalnaKolArt' => $MinimalnaKolArt,
    'ArtikalStanje' => $ArtikalStanje,
    'ArtikalReklamaTekst' => $ArtikalReklamaTekst
);

// ako postoji da smo promenulu kategoriju
if ($idkategorijeDodajArtikal) {
    $in=array('KategorijaArtikalId'=>$idkategorijeDodajArtikal);
    // onda dodajemo ovo u array
    $update_query = array_merge($update_query, $in);
}else{
    $in=array('KategorijaArtikalId'=>$KategorijeArtikalaId);
    // onda dodajemo ovo u array
    $update_query = array_merge($update_query, $in);
}


try {
    $db->setTrace (true);
    $db->startTransaction();

    $db->where('ArtikalId', $id);

    if ($db->update('artikli', $update_query)) {
        //echo $db->count . ' records were updated';
    } else {
        echo 'update failed: ' . $db->getLastError();
        die;
    }

    // 0
    // ovo smo dodali zvog varijabli zajednickih
    $idUbacenogart = $id;




    // IV
    // sada ubacujemo tagove prema IDju koji su kreirani
    require_once('tagoviArtikalInsert.php');


    // V
    // sada ubacujemo specifikacije artikala
    require_once('specArtikalaEditNew.php');


    /*
     * OVDE POCINJE NOVI UBAC U TABELE
     * NAZIV, KRATAK OPIS, VELIKI OPIS
     * */

    // VI
    // Ubacujemo NAZIVE U NOVU BAZU
    // prvo ih brisemo sve
    require_once('forEachArtNazivNew.php');
    require_once('ubaciNaziveArtNewEditArt.php');

    // VII
    // Ubacujemo KRATAK NAZIV U NOVU BAZU
    // prvo ih brisemo sve
    require_once('forEachArtNazivNewKratakOpis.php');
    require_once('ubaciKratakNazivArtNewEditArt.php');



    // VII
    // Ubacujemo VELIKI NAZIV U NOVU BAZU
    // prvo ih brisemo sve
    require_once('forEachArtNazivNewVelOpis.php');
    require_once('ubaciVelikiNazivArtNewEditArt.php');


    // ubacujemo poklon Artikle
    if ($piecesPoklon) {
        foreach ($piecesPoklon as $pkk => $pav) {
        $insert_queryPoklon = Array('ArtikalIdGlavni' => $idUbacenogart, 'ArtikalIdPoklon' => $pav);
        $db->setQueryOption(Array('IGNORE'));
        $db->insert('poklonartikli', $insert_queryPoklon);
        }


    }

    $db->commit();

    //print_r($db->trace);
    // die;
    //var_dump($db);


} catch (Exception $e) {
    // An exception has been thrown
    // We must rollback the transaction
    $db->rollback();
    $error_msg .= 'rollback';
}

if ($id) {

    $error_msg .= 'ok - Ubaceno u bazu';

    $slika = $_FILES;
    $imeslike = $urlartikla;
    $idba = $id;
    $table = 'artiklislike';
    $kolona = 'ImeSlikeArtikliSlike';
    $location = 'p';
    $nazivInputPolja = 'slikeMultiple';
    $idkolone = 'IdArtikliSlike';
    $w = '';  // ako je prazno onda je default  800px
    $h = ''; // ako je prazno onda je default  800px
    $preview = '1'; //ako pravimo thumb sliku _mala (80, 110) i _srednja  250, 340
    $orgSlika = ''; // da li zelimo da snimimo i originalnu sliku


    $ubacisliku->ubacislikuSve($slika, $imeslike, $idba, $table, $kolona, $location, $nazivInputPolja, $idkolone, $w, $h, $preview, $orgSlika);


} else {
    $error_msg .= 'Nema $idTekst : ' . $idTekst . ' $idUbacenogart : ' . $idUbacenogart;
    die;
}

//echo $error_msg;

header("Location: " . URLVRATI . "/?e=$error_msg");
?>

