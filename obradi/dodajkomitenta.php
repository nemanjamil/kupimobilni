<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 17. 08. 2015.
 * Time: 4  :32 PM
 */


//$KategorijaArtikalaNaziv = $common->clearvariable($_POST[KategorijaArtikalaNaziv]);

$komitenttipusera = $common->clearvariable($_POST[komitenttipusera]);

//----VP-----
$komitentfirma = $common->clearvariable($_POST[komitentfirma]);
$komitentpib = $common->clearvariable($_POST[komitentpib]);
$komitentmatbr = $common->clearvariable($_POST[komitentmatbr]);
$komitentfirmaadresa = $common->clearvariable($_POST[komitentfirmaadresa]);


//----/VP-----
$komitentime = $common->clearvariable($_POST[komitentime]);
$komitentprezime = $common->clearvariable($_POST[komitentprezime]);
$komitentnaziv = $common->friendly_convert($komitentime);
$komitentmesto = $common->clearvariable($_POST[komitentmesto]);
$komitentadresa = $common->clearvariable($_POST[komitentadresa]);
$komitentposbroj = $common->clearvariable($_POST[komitentposbroj]);
$komitenttelefon = $common->clearvariable($_POST[komitenttelefon]);
$komitentmobtel = $common->clearvariable($_POST[komitentmobtel]);
$komitentusername = $common->clearvariable($_POST[komitentusername]);
$komitentpassword = '1234';
$komitentivaluta = $common->clearvariable($_POST[komitentivaluta]);

$VerifikovanDib = $common->clearvariable($_POST[VerifikovanDib]);
$VerifikovanDib = ($VerifikovanDib) ?  $VerifikovanDib : NULL;

$VerifikovanLS = $common->clearvariable($_POST[VerifikovanLS]);
$VerifikovanLS = ($VerifikovanLS) ?  $VerifikovanLS : NULL;


$KomitentiZemlja = $common->clearvariable($_POST[KomitentiZemlja]);

$komitentemail = filter_input(INPUT_POST, 'komitentemail', FILTER_SANITIZE_EMAIL);
$komitentemail = filter_var($komitentemail, FILTER_VALIDATE_EMAIL);
if (!filter_var($komitentemail, FILTER_VALIDATE_EMAIL)) {
    $error_msg .= 'The email address you entered is not valid';

}
$komitentpassword = filter_input(INPUT_POST, 'komitentpassword', FILTER_SANITIZE_STRING);

$db->where('KomitentEmail', $komitentemail);
$upitmail = $db->has("komitenti");

if ($upitmail) {
    // A user with this email address already exists
    $error_msg .= 'Postoji korisnik sa tom mail adresom';
}

// Create a random salt
$random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
// Create salted password
$komitentpassword77 = hash('sha512', $komitentpassword);

$komitentpassword = hash('sha512', $komitentpassword77 . $random_salt);


if (isset($komitentime)) {
    $insertData = Array(
        'KomitentTipUsera' => $komitenttipusera,
        'KomitentEmail' => $komitentemail,
        'KomitentPassword' => $komitentpassword,
        'KomitentSalt' => $random_salt,

        'KomitentFirma' => $komitentfirma,
        'KomitentPib' => $komitentpib,
        'KomitentMatBr' => $komitentmatbr,
        'KomitentNaziv' => $komitentnaziv,
        'KomitentFirmaAdresa' => $komitentfirmaadresa,

        'KomitentIme' => $komitentime,
        'KomitentPrezime' => $komitentprezime,
        'KomitentMesto' => $komitentmesto,
        'KomitentAdresa' => $komitentadresa,
        'KomitentPosBroj' => $komitentposbroj,
        'KomitentTelefon' => $komitenttelefon,
        'KomitentMobTel' => $komitentmobtel,
        'KomitentUserName' => $komitentusername,
        'KomitentiValuta' => $komitentivaluta,
        'VerifikovanDib' => $VerifikovanDib,
        'VerifikovanLS' => $VerifikovanLS,
        'KomitentiZemlja' => $KomitentiZemlja,

    );


    $id = $db->insert('komitenti', $insertData);

    if (!$id) {
        echo 'Nije dodat komitent';
        echo $db->getLastError();
        die;
    }

   /* foreach ($jezLan as $k => $v):
        $ShortLanguage = $v['ShortLanguage'];
        $IdLanguage = $v['IdLanguage'];

        $insertOpis = Array(
            'KomitentId' => $id,
            'IdLanguage' => $IdLanguage
        );

        $idOpis = $db->insert('komitentiopisnew', $insertOpis);

        if (!$idOpis) {

            echo 'insert failed - Nije ubacen komitent opis : ' . $db->getLastError();
            die;
        }

    endforeach;*/



} else {
    $error_msg["error"] = 'Nema naziva';
}

echo $error_msg;

header("Location:/admin/listaartikala");
//header("Location:$url");

?>