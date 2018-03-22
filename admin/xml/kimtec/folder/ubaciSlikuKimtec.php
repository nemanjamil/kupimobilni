<?php
if ($ProductImageUrl && $idUbacenogart) {

    $pokazi .= '<li>IMA SLIKE '.$ProductImageUrl.'</li>';

    $folderslika = substr($idUbacenogart, 0, 2);
    $lok = $common->locationslika($idUbacenogart);
    $pokazi .= '<li>likacijadoslikedir : ' . $likacijadoslikedir . '</li>';
    if (!is_dir($documentroot . "/p/$folderslika")) {
        mkdir($documentroot . "/p/$folderslika", 0775, true);
    }
    if (!is_dir($documentroot . "/p/$folderslika/$idUbacenogart")) {
        mkdir($documentroot . "/p/$folderslika/$idUbacenogart", 0775, true);
    }

    // OBRISI SVE SLIKE IZ FOLDERA I IZ BAZE
    $idArt = $idUbacenogart;
    $lokslifol = $documentroot."/p/".$folderslika."/".$idUbacenogart;
    require($documentroot.'/admin/stranice/dodatna/obrisiSveiZFolderaIBazeFullLink.php');


    $dir = $documentroot."/p/$folderslika/$idUbacenogart/";
    $pokazi .= '<li>Gde se ubacuje  '.$dir.'</li>';

    $lfile = fopen($dir . basename($ProductImageUrl), "w");

    $lokdosert = $documentrootAdmin.'/xml/kimtec/';
    if(file_exists($lokdosert."certs/ca.pem") && file_exists($lokdosert."certs/client.pem") && file_exists($lokdosert."certs/key.pem"))
    {

        $ch =curl_init();
        curl_setopt($ch, CURLOPT_URL,$ProductImageUrl);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_SSLVERSION, 3);
        curl_setopt($ch, CURLOPT_CAINFO, $lokdosert."certs/ca.pem");
        curl_setopt($ch, CURLOPT_SSLCERT, $lokdosert."certs/client.pem");
        curl_setopt($ch, CURLOPT_SSLKEY, $lokdosert."certs/key.pem");
        curl_setopt($ch, CURLOPT_SSLKEYPASSWD, "miki"); // pin vezan za B2B certifikat
        curl_setopt($ch, CURLOPT_FILE, $lfile);
        $return = curl_exec($ch);
        //echo $return;
        echo curl_error($ch);
        curl_close ($ch);

    }
    else
    {
        if(!file_exists($documentroot."/admin/xml/kimtec/certs/ca.pem")) { echo ("Datoteka certs/ca.pem ne postoji<br>"); }
        if(!file_exists($documentroot."/admin/xml/kimtec/certs/client.pem")) { echo ("Datoteka certs/client.pem ne postoji<br>"); }
        if(!file_exists($documentroot."/admin/xml/kimtec/certs/key.pem")) {echo ("Datoteka certs/key.pem ne postoji<br>"); }
    }


    $pokazi .= '<li> IMA SLIKE </li>';
    $pokazi .= $common->microtime_floatProlaz($start, 'ubaciSlikeFile');

    // ubacujemo u bazu podatke
    $idArt = $idUbacenogart;


    $ext = pathinfo($ProductImageUrl, PATHINFO_EXTENSION);  // uzimamo ektenziju od fajla .png ili .jpg ili bilo koju
    $filename = pathinfo($ProductImageUrl, PATHINFO_FILENAME); // uzimamo naziv fajla

    // !!!! ovo posle cemo reimenovati na liniji 69 jer dodajemo $idUbacenogart !!!!
    $linkslikeMojabaza = $filename . '-' . $idLinkSlike . '.' . EXTPRED;
    $prvaSlika = 1;
    require($documentroot . '/admin/stranice/dodatna/ubaciSlikeLinkUbazu.php');

    /*
     * OVO SAM KORISITIO ZA 3G SIMUS
     * */
    $linkslikeMojabaza = $filename . '-' . $idUbacenogart . '_' . $idLinkSlike . '.' . EXTPRED;
    $imeSlikeKodNas = $lokslifol . "/" . $linkslikeMojabaza;
    $pokazi .= '<li>Link do slike kod nas u bazi  : ' . $imeSlikeKodNas . '</li>';

    $linkSlikaDodatna =  $documentroot."/p/$folderslika/$idUbacenogart/".basename($ProductImageUrl);
    $pokazi .= '<li>$linkSlikaDodatna  : ' . $linkSlikaDodatna . '</li>';
    // ubacujemo slike u foldere
    $pokazi .= $common->microtime_floatProlaz($start, 'ubaciSlikeLinkUbazuSTART');
    require($documentroot . '/admin/stranice/dodatna/ubaciSlikeFile.php');
    $pokazi .= $common->microtime_floatProlaz($start, 'ubaciSlikeLinkUbazuKRAJ');

    // sada reimenujemo link do slike
    $pokazi .= '<li>$linkslikeMojabaza : ' . $linkslikeMojabaza . '</li>';
    require($documentroot . '/admin/stranice/dodatna/updateLinkSlike.php');


    unlink($linkSlikaDodatna);

    // sada proveravamo da li je ubacio sliku
    if (is_file($imeSlikeKodNas)) {
        $pokazi .= '<li>Ima slike posle provere : ' . $imeSlikeKodNas . '</li>';
    } else {
        $pokazi .= '<li><strong style="color: red">Nema slike posle provere : </strong>' . $imeSlikeKodNas . '</li>';
    }



} else {

    $pokazi .= '<li>Ne postoji Link do slike ili ID ubacenog artikla '.$ProductImageUrl.'</li>';
}


