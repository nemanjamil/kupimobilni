<?php

$cols = Array("linkslike");
$db->where("V.id", $idArtDodatna);
$db->join("slikeproiz SP", "SP.idslike = V.id", "LEFT");
$slike = $db->get("vebsop V", NULL, $cols);
$prvaSlika = 1;
if ($db->count > 0) {

    /*
       * !!!! AGRO NASA BAZA !!!!
       */
    // lokacija foldera kod nas u bazi
    $lok = $common->locationslika($idArt);
    $lokslifol = DCROOT . $lok;
    // dali postoji folder ko nas u bazi
    $nekifoldir = substr($idArt, 0, 2);
    /*if (!$nekifoldir) {
        echo 'nema neki folder ' . $nekifoldir;
        echo '<br/>';
        echo $pokazi;
        die;
    }*/

    // OBRISI SVE SLIKE IZ FOLDERA I IZ BAZE
    require('obrisiSveiZFolderaIBaze.php');


    $pokazi .= '<ul>';
    foreach ($slike as $k => $v):


        $linkslike = $v['linkslike'];
        $ext = pathinfo($linkslike, PATHINFO_EXTENSION);
        $filename = pathinfo($linkslike, PATHINFO_FILENAME);

        $linkslikeMojabaza = $filename . '-' . $idArt . '.' . EXTPRED;// stavili smo drugaciji link slike


        $folderslikaVelika = DCROOT . '/p/' . $nekifoldir;


        if (!is_dir($folderslikaVelika)) {
            mkdir($folderslikaVelika, 0775, true);
        }
        if (!is_dir($lokslifol)) {
            mkdir($lokslifol, 0775, true);
        }

        if (!is_dir($lokslifol)) {
            echo 'Nije kreiran folder -> ' . $lokslifol;
            die;
        }


        // ime slike koja se kod nas ubacuje
        // $imeSlikeKodNas = $lokslifol.'/'.$linkslike;
        $imeSlikeKodNas = $lokslifol . "/" . $linkslikeMojabaza;
        $pokazi .= '<li>$imeSlikeKodNas : ' . $imeSlikeKodNas . '</li>';


        /*
         * !!!! BAZA DODATNA !!!!!
         * http://dodatnaoprema.com/p/10/104446/burgija-za-drvo-standard_3.jpg
         * lokacije do slike na dodatnoj
         */
        $folderslikaD = substr($idArtDodatna, 0, 2);
        $linkSlikaDodatna = $linkDodatnaSajt . '/p/' . $folderslikaD . '/' . $idArtDodatna . '/' . $linkslike;
        $pokazi .= '<li>$linkSlikaDodatna : ' . $linkSlikaDodatna . '</li>';


        /*
         * Kada smo definisali gde nam se nalazi slika na sajtu dodatna oprema i
         * kada smo definisam gde CE NAM SE NALAZITI slika na bazi AGRO
         * ONDA
         * UBACIVANJE SLIKE kod nas u bazu
         */
        $daliImasSlikaDodatna = $kategorijeDodatna->checkRemoteFile($linkSlikaDodatna); // provera da li postoji remote slika
        sleep(2);

        if ($daliImasSlikaDodatna) {

            // proveramo da li postoji slika na dodatnoj preko hedera
            if ($kategorijeDodatna->get_http_response_code($linkSlikaDodatna) != "200") {

                $pokazi .= '<li>Nema Slike na get_http_response_code : ' . $linkSlikaDodatna . '</li>';

            } else {
                $pokazi .= '<li> IMA SLIKE </li>';




                // OVO SAM KORISTIO ZA AGRO



                // prvo se ubacuje u Bazu
                $pokazi .= $common->microtime_floatProlaz($start, 'ubaciSlikeLinkUbazu');
                // sada ubacujemo LINKOVE slika kod nas u bazu artiklislike
                require('ubaciSlikeLinkUbazu.php');

                $linkslikeMojabaza = $filename . '-' . $idArt . '_'.$idLinkSlike.'.'.EXTPRED;
                $imeSlikeKodNas = $lokslifol . "/" . $linkslikeMojabaza;
                $pokazi .= '<li>Link do slike kod nas u bazi  : ' . $imeSlikeKodNas . '</li>';


                $pokazi .= $common->microtime_floatProlaz($start, 'ubaciSlikeLinkUbazuSTART');
                require(DCROOT.'/admin/stranice/dodatna/ubaciSlikeFile.php');
                $pokazi .= $common->microtime_floatProlaz($start, 'ubaciSlikeLinkUbazuKRAJ');

                // sada reimenujemo link do slike
                $pokazi .= '<li>$linkslikeMojabaza : ' . $linkslikeMojabaza . '</li>';
                require(DCROOT.'/admin/stranice/dodatna/updateLinkSlike.php');


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


        $pokazi .= '<li>$linkslike : ' . $linkslike . '</li>';
        $pokazi .= '<br/>';


        $prvaSlika++;
    endforeach;

    $pokazi .= '</ul>';
} else {
    $pokazi .= '<li>Nema slika na dodatnoj opremi</li>';
    var_dump($slike);

}


?>