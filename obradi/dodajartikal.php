<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 05. 08. 2015.
 * Time: 3:32 PM
 */

// ovo sam dodao kod ArtNewNaziv
require_once('forEachArtNazivNew.php');

foreach ($jezLan as $k => $v):
    $ShortLanguage = $v['ShortLanguage'];
    $Are = 'ArtNaz' . $ShortLanguage;
    $Opi = 'OpisArtikliTekstovi' . $ShortLanguage;
    $Opia = 'ArtikalKratakOpis' . $ShortLanguage;

    $AreArr = 'ArtNaz' . $ShortLanguage;
    $OpisArr = 'OpisArtikliTekstovi' . $ShortLanguage;
    $OpisaArr = 'ArtikalKratakOpis' . $ShortLanguage;

    if (isset($_POST[$Are])) {
        $Are = filter_input(INPUT_POST, $Are, FILTER_SANITIZE_STRING);
    } else {
        $Are = '';
    }
    $Opi = $common->clearvariable($_POST[$Opi]);
    if (isset($_POST[$Opia])) {
        $Opia = filter_input(INPUT_POST, $Opia, FILTER_SANITIZE_STRING);
    } else {
        $Opia = '';
    }


    $an[$AreArr] = trim($Are);
    $op[$OpisArr] = trim($Opi);
    $opa[$OpisaArr] = trim($Opia);

endforeach;


if (isset($_POST['imeartikla'])) {
    $imeartikla = filter_input(INPUT_POST, 'imeartikla', FILTER_SANITIZE_STRING);
} else {
    $imeartikla = 'Artikal';
}

if (isset($_POST['idkategorijeDodajArtikal'])) {
    $idkategorijeDodajArtikal = filter_input(INPUT_POST, 'idkategorijeDodajArtikal', FILTER_SANITIZE_NUMBER_INT);

} elseif(isset($_POST['KategorijeArtikalaId'])){
    $idkategorijeDodajArtikal = filter_input(INPUT_POST, 'KategorijeArtikalaId', FILTER_SANITIZE_NUMBER_INT);
}
else {
    $idkategorijeDodajArtikal = '';
}

if (isset($_POST['ArtikalAktivan'])) {
    $ArtikalAktivan = filter_input(INPUT_POST, 'ArtikalAktivan', FILTER_SANITIZE_NUMBER_INT);
} else {
    $ArtikalAktivan = '1';
}

if (isset($_POST['ArtikalStanje'])) {
    $ArtikalStanje = filter_input(INPUT_POST, 'ArtikalStanje', FILTER_SANITIZE_NUMBER_INT);
} else {
    $ArtikalStanje = '0';
}

if (isset($_POST['brendartikla'])) {
    $brendartikla = filter_input(INPUT_POST, 'brendartikla', FILTER_SANITIZE_NUMBER_INT);
} else {
    $brendartikla = '';
}

//if (isset($_POST['cenavpartikla'])) { $cenavpartikla = filter_input(INPUT_POST, 'idkategorijeDodajArtikal', FILTER_SANITIZE_NUMBER_FLOAT);} else {$cenavpartikla = '';   }
//if (isset($_POST['cenavpartikla'])) { $cenavpartikla = filter_input(INPUT_POST, 'cenavpartikla', FILTER_SANITIZE_NUMBER_FLOAT);} else {$cenavpartikla = null;}
//if (isset($_POST['cenampartikla'])) { $cenampartikla = filter_input(INPUT_POST, 'cenampartikla', FILTER_SANITIZE_NUMBER_FLOAT);} else {$cenampartikla = null;}

if (isset($_POST['ArtikalDostupnoOd'])) {
    $ArtikalDostupnoOd = filter_input(INPUT_POST, 'ArtikalDostupnoOd', FILTER_SANITIZE_STRING);
} else {
    $ArtikalDostupnoOd = null;
}

if (isset($_POST['valutaartikla'])) {
    $valutaartikla = filter_input(INPUT_POST, 'valutaartikla', FILTER_SANITIZE_NUMBER_INT);
} else {
    $valutaartikla = '';
}

if (isset($_POST['barkodartikla'])) {
    $barkodartikla = filter_input(INPUT_POST, 'barkodartikla', FILTER_SANITIZE_NUMBER_INT);
} else {
    $barkodartikla = '';
}

if (isset($_POST['sifraartikla'])) {
    $sifraartikla = filter_input(INPUT_POST, 'sifraartikla', FILTER_SANITIZE_NUMBER_INT);
} else {
    $sifraartikla = '';
}

if (isset($_POST['KomitentId'])) {
    $KomitentId = filter_input(INPUT_POST, 'KomitentId', FILTER_SANITIZE_NUMBER_INT);
} else {
    $KomitentId = '';
}

$kod = explode("|", $_POST['KomitentId']);

if (isset($_POST['marzaartikla'])) {
    $marzaartikla = filter_input(INPUT_POST, 'marzaartikla', FILTER_SANITIZE_NUMBER_INT);
} else {
    $marzaartikla = '';
}

// hvatamo tagove
if (isset($_POST['tagime'])) {
    $tagime = filter_input(INPUT_POST, 'tagime', FILTER_SANITIZE_STRING);
} else {
    $tagime = '';
}

if (isset($_POST['MinimalnaKolArt'])) {
    $MinimalnaKolArt = filter_input(INPUT_POST, 'MinimalnaKolArt', FILTER_SANITIZE_NUMBER_INT);
} else {
    $MinimalnaKolArt = '';
}

if (isset($_POST['TipKatUnitArt'])) {
    $TipKatUnitArt = filter_input(INPUT_POST, 'TipKatUnitArt', FILTER_SANITIZE_NUMBER_INT);
} else {
    $TipKatUnitArt = '';
}

$imeartiklaurl = $common->clearvariable($_POST['ArtNazsrblat']);
$urlartikla = $common->friendly_convert($imeartiklaurl);
$ArtikalNaAkciji = $common->clearvariable($_POST['ArtikalNaAkciji']);
$cenavpartikla = $common->clearvariable($_POST['cenavpartikla']);
$cenampartikla = $common->clearvariable($_POST['cenampartikla']);

//$ArtikalKratakOpis = $common->clearvariable($_POST['ArtikalKratakOpis']);


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

        $insert_query = Array('TagoviIme' => $key);
        $db->setQueryOption(Array('IGNORE'));
        $idTag = $db->insert('tagovi', $insert_query);

        if ($idTag) {
            // ubacejemo Id-jeve u array
            $idTagArr[] = $idTag;
        }

    }
}

//$db->setTrace(true);
$insert_query = Array(
    //'ArtikalNaziv' => $imeartikla,
    'KategorijaArtikalId' => $idkategorijeDodajArtikal,
    'ArtikalBrendId' => $brendartikla,
    'ArtikalVPCena' => $cenavpartikla,
    'ArtikalMPCena' => $cenampartikla,
    'ArtikalBarKod' => $barkodartikla,
    // 'ArtikalSifra' => $sifraartikla,
    'ArtikalKomitent' => $kod[0],
    $kod[1] => $sifraartikla,
    'ArtikalNaAkciji' => $ArtikalNaAkciji,
    'ArtikalMarzaId' => $marzaartikla,
    'ArtikalLink' => $urlartikla,
    'ArtikalAktivan' => $ArtikalAktivan,
    'ArtikalStanje' => $ArtikalStanje,
    'TipKatUnitArt' => $TipKatUnitArt,
    'MinimalnaKolArt' => $MinimalnaKolArt,
    'ArtikalDostupnoOd' => $ArtikalDostupnoOd

);


try {
//     $db->setTrace (true);
    $db->startTransaction();

    $idUbacenogart = $db->insert('artikli', $insert_query);

    if (!$idUbacenogart) {
        echo $db->getLastError();
        die;
    }
    // $idTekst = $db->insert('ArtikalNaziv', $insert_queryOpisNaz);

    // sada ubacujemo tagove prema IDju koji su kreirani
    require_once('tagoviArtikalInsert.php');


    //ovde ubacujemo kratak opis za artikal
    /*$dataId['ArtikalIdKratakOpis'] = $idUbacenogart;
    $opa = array_merge($opa, $dataId);
    $IdArtikalKratakOpis = $db->insert('ArtikliKratakOpis', $opa);*/


    //ovde ubacujemo detaljan opis (veliki) za artikal
    /*$dataIdd['IdArtikliTekstovi'] = $idUbacenogart;
    $op = array_merge($op, $dataIdd);
    $IdArtikliTekstovi = $db->insert('ArtikliTekstovi', $op);*/


    /*$dataIddd['IdArtikalNaziv'] = $idUbacenogart;
    $an = array_merge($an, $dataIddd);
    $IdArtikalNaziv = $db->insert('ArtikalNaziv', $an);*/

    // V
    // sada ubacujemo specifikacije artikala
    require_once('specArtikalaEditNew.php');


    // VI
    // Ubacujemo NAZIVE U NOVU BAZU
    // prvo ih brisemo sve
    require_once('ubaciNaziveArtNewEditArt.php');



    require_once('forEachArtNazivNewVelOpis.php');
    require_once('ubaciVelikiNazivArtNewEditArt.php');



    $db->commit();
//    var_dump($db->trace);


} catch (Exception $e) {
    // An exception has been thrown
    // We must rollback the transaction
    $db->rollback();
    $error_msg .= 'rollback';
}

if ($idUbacenogart) {

    $error_msg .= 'ok - Ubaceno u bazu';

    $slika = $_FILES;
    $imeslike = $imeartikla;
    $idba = $idUbacenogart;
    $table = 'artiklislike';
    $kolona = 'ImeSlikeArtikliSlike';
    $location = 'p';
    $nazivInputPolja = 'slikeMultiple';
    $idkolone = 'IdArtikliSlike';
    $w = ''; // ako je prazno onda je default  800px
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