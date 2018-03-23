<?php
/*
* !!!! AGRO NASA BAZA !!!!
*/
// lokacija foldera kod nas u bazi
$lok = $common->locationslika($idUbacenogart);
$lokslifol = $documentroot . $lok;
// dali postoji folder ko nas u bazi
$nekifoldir = substr($idUbacenogart, 0, 2);

if (!$nekifoldir) {
    echo 'nema neki folder ' . $nekifoldir;
    echo '<br/>';
    echo $pokazi;
    die;
}

// OBRISI SVE SLIKE IZ FOLDERA I IZ BAZE
$idArt = $idUbacenogart;
require($documentroot.'/admin/stranice/dodatna/obrisiSveiZFolderaIBazeFullLink.php');


$folderslikaVelika = $documentroot . '/p/' . $nekifoldir;

if (!is_dir($folderslikaVelika)) {  mkdir($folderslikaVelika, 0775, true); }
if (!is_dir($lokslifol)) {  mkdir($lokslifol, 0775, true); }
if (!is_dir($lokslifol)) {  echo 'Nije kreiran folder -> ' . $lokslifol;   die; }


$pokazi .= '<div style="border: 1px dashed #000000; padding: 10px;margin: 10px 0; background-color: deepskyblue">';

$sliId = 0;

$pokazi .= '<div><strong>Id ubacenog artikla : </strong> ' . $idUbacenogart . '</div>';
$pokazi .= '<div><strong>Folder ID ubacenog artikla : </strong> ' . $nekifoldir . '</div>';

$prvaSlika = 1;


if (is_array($miki)) {


    $pokazi .= '<ul>';
    foreach ($miki as $key => $value) {

        $linkSlikaDodatna = $value;

        $ext = pathinfo($linkSlikaDodatna, PATHINFO_EXTENSION);  // uzimamo ektenziju od fajla .png ili .jpg ili bilo koju
        $filename = pathinfo($linkSlikaDodatna, PATHINFO_FILENAME); // uzimamo naziv fajla

        $daliImasSlikaDodatna = $kategorijeDodatna->checkRemoteFile($linkSlikaDodatna); // provera da li postoji remote slika
        sleep(1);

        if ($daliImasSlikaDodatna) {

            if ($kategorijeDodatna->get_http_response_code($linkSlikaDodatna) != "200") {

                $pokazi .= '<li>Nema Slike na get_http_response_code : ' . $linkSlikaDodatna . '</li>';

            } else {

                $pokazi .= '<li> IMA SLIKE </li>';
                $pokazi .= $common->microtime_floatProlaz($start, 'ubaciSlikeFile');

                // ubacujemo u bazu podatke
                $idArt = $idUbacenogart;


                $filename = $url_artikla; // reimenujemo naziv slike
                // !!!! ovo posle cemo reimenovati na liniji 69 jer dodajemo $idUbacenogart !!!!
                $linkslikeMojabaza = $filename . '-' . $idLinkSlike . '.' . EXTPRED;

                require($documentroot . '/admin/stranice/dodatna/ubaciSlikeLinkUbazu.php');

                /*
                 * OVO SAM KORISITIO ZA 3G SIMUS
                 * */
                $linkslikeMojabaza = $filename . '-' . $idUbacenogart . '_' . $idLinkSlike . '.' . EXTPRED;
                $imeSlikeKodNas = $lokslifol . "/" . $linkslikeMojabaza;
                $pokazi .= '<li>Link do slike kod nas u bazi  : ' . $imeSlikeKodNas . '</li>';


                // ubacujemo slike u foldere
                $pokazi .= $common->microtime_floatProlaz($start, 'ubaciSlikeLinkUbazuSTART');
                require($documentroot . '/admin/stranice/dodatna/ubaciSlikeFile.php');
                $pokazi .= $common->microtime_floatProlaz($start, 'ubaciSlikeLinkUbazuKRAJ');

                // sada reimenujemo link do slike
                $pokazi .= '<li>$linkslikeMojabaza : ' . $linkslikeMojabaza . '</li>';
                require($documentroot . '/admin/stranice/dodatna/updateLinkSlike.php');


                // sada proveravamo da li je ubacio sliku
                if (is_file($imeSlikeKodNas)) {
                    $pokazi .= '<li>Ima slike posle provere : ' . $imeSlikeKodNas . '</li>';
                } else {
                    $pokazi .= '<li><strong style="color: red">Nema slike posle provere : </strong>' . $imeSlikeKodNas . '</li>';
                }

            }


        } else {
            $pokazi .= '<li><strong style="color: red">Nema slike checkRemoteFile </strong> : ' . $linkSlikaDodatna . '</li>';
        }


    }

    $pokazi .= '</ul>';

    $sliId++;

    //sleep(1); // zadrzavamo ovde jer smo uplodovali sliku
} else {
    $pokazi .= '<div><strong>NEMA SLIKE </strong></div>';
}


$pokazi .= '</div>';
?>