<?php
/**
 * Created by PhpStorm.
 * User: NemanjaMilivojevic
 * Date: 12.8.15.
 * Time: 23.11
 */

$sta = array("SELECT", "IFNULL", "CONCAT", "password", "UNION", "BINARY", "limit", "FROM");
$scim = array("", "", "", "", "", "", "", "");
$stranica = str_ireplace($sta, $scim, $stranica);
$stranica = $common->clearvariable($stranica);

//$kategorijaMP = $db->mpkategorija($KomitentExtId);

// ako postoji kategorija

if ($stranica) {
$dataKateg = array("K.KategorijaArtikalaId",  "K.ParentKategorijaArtikalaId",  "K.KategorijeBrojPregleda", "K.KategorijaArtikalaLink",
    "K.KategorijaArtikalaKratak", "KN.NazivKategorije");
$db->join("kategorijeartikalanaslov KN","KN.IdKategorije = K.KategorijaArtikalaId AND KN.IdLanguage = $jezikId","LEFT");
$db->join("kategorijeartikalatekst KAT","KAT.IdKategorije = K.KategorijaArtikalaId AND KAT.IdLanguage = $jezikId","LEFT");
$db->where("K.KategorijaArtikalaLink", $stranica);
$katLinkUpit = $db->get("kategorijeartikala K", null, $dataKateg);
}
//var_dump($katLinkUpit);

$KategorijaArtikalaIdOS = $katLinkUpit[0]['KategorijaArtikalaId'];
$ParentKategorijaArtikalaId = $katLinkUpit[0]['ParentKategorijaArtikalaId'];

if ($KategorijaArtikalaIdOS) {
    /*
     * katod artikala
     * 1 aktivna kategorija
     * Tip Korisnika
     */
    $daliimapodkatupArray = "SELECT daLiImaPodkat($KategorijaArtikalaIdOS,1,$tipUsera) AS kolikoImaPodkat";
    $kolikoImaPodkatRes = $db->rawQueryOne($daliimapodkatupArray);
    $imaPodkat = $kolikoImaPodkatRes['kolikoImaPodkat'];
}

/*
 * IF IS CATEGORY
 */
/* ovde dobijamo podatke koja je strana
Da li je
1. /kategorija
2. /login strana
3. /obicna strana iz admina sto editujemo - da mogu oni sami da edituju
*/


if ($stranica) {

    if ($KategorijaArtikalaIdOS) {


        // upitzaOpisKategorije
        $dataKategOpis = array("KAT.TekstKategorije");
        $db->join("kategorijeartikalatekst KAT","KAT.IdKategorije = K.KategorijaArtikalaId AND KAT.IdLanguage = $jezikId","LEFT");
        $db->where("K.KategorijaArtikalaId", $KategorijaArtikalaIdOS);
        $katLinkUpitOpis = $db->getOne("kategorijeartikala K", null, $dataKategOpis);


        $KategorijaArtikalaNaziv = $title = $katLinkUpit[0]['NazivKategorije'];
        $KategorijaArtikalaLink = $katLinkUpit[0]['KategorijaArtikalaLink'];
        $ParentKategorijaArtikalaId = $katLinkUpit[0]['ParentKategorijaArtikalaId'];
        $KategorijaArtikalaKratak = $description = $katLinkUpit[0]['KategorijaArtikalaKratak'];

        $KategorijaOpis = $katLinkUpit[0]['NazivKategorije'];
        $OpisKatTekst = $katLinkUpitOpis['TekstKategorije'];
        $KategorijeBrojPregleda = $katLinkUpit[0]['KategorijeBrojPregleda'];






        $stranica = 'kategorija';

        if ($_SESSION['specPodaci']) {
            if ($kategStranica != $stranica) {
                unset($_SESSION['specPodaci']);
                $_SESSION['kategstranica'] = $stranica;
            }
        }

        if (!$_SESSION['kategstranica']) {
            $kategStranica = $_SESSION['kategstranica'] = $stranica;
        } else {
            $kategStranica = $_SESSION['kategstranica'];
        }

        $specPodaciPost = $_POST['specPodaci'];
        if ($specPodaciPost) {
            $specPodaci = $_SESSION['specPodaci'] = $specPodaciPost;
        } else {
            $specPodaci = $_SESSION['specPodaci'];
        }


        if ($KategorijaArtikalaLink == $_SESSION['kategstranica']) {
            $brendArtUpit = $kontrole['brend'];
        } else {
            $brendArtUpit = '';
            $kontrole['brend'] = '';
            $_SESSION['kontrole']['brend'] = '';
            $_SESSION['kategstranica'] = $KategorijaArtikalaLink;
        }



    } elseif (file_exists('stranice/' . $stranica . '.php')) {

        switch ($stranica) {

            case "proiz":
                include_once('infoproiz.php');
                break;

            case "vestipokateg":

                $cols = Array("V.*","VN.VestiNaslov".$jezik,"VO.VestiOpis".$jezik,"K.KomitentIme, K.KomitentPrezime, K.KomitentiSlika","KN.NazivKategorije");
                $db->join("vestinaslov VN", "VN.IdVestiNaslov = V.IdVesti");
                $db->join("vestiopis VO", "VO.IdVestiOpis = V.IdVesti");
                $db->join("komitenti K", "K.KomitentId = V.IdKomitentVesti");
                $db->join("kategorijeartikala KAT", "KAT.KategorijaArtikalaId = V.IdKategVesti");
                $db->join("kategorijeartikalanaslov KN","KN.IdKategorije = KAT.KategorijaArtikalaId AND KN.IdLanguage = $jezikId","LEFT");
                $db->where("KAT.KategorijaArtikalaLink", $string);
                $dataVesti = $db->get("vesti V", null, $cols);

                $title =  $jsonlang[191][$jezikId] . ':' . $dataVesti[0]['NazivKategorije'];
                break;

            case "zdravlje":
                $title =  $jsonlang[265][$jezikId] . ':' . $dataVesti[0]['NazivKategorije'];
                break;

            case "thank-you":
                $title =  'Thank you :)';
                break;

            case "zdravljekateg":

                // ovde smo definisali string jer kada se promeni broj artikala na pregledu onda imamo post a ne ulazi u get
                if(isset($_GET['string'])) {  $string = filter_input(INPUT_GET, 'string', FILTER_SANITIZE_STRING); } else { $string = ''; }


                $cols = Array("K.KategorijaArtikalaIdZdravlje","K.KategorijaArtikalaLinkZdravlje");
                $db->join("kategorijezdrnaslov KZN", "KZN.IdKategZdravlje = K.KategorijaArtikalaIdZdravlje AND KZN.IdLanguage = $jezikId");
                $db->join("kategorijezdravljetekst KZT", "KZT.IdKategZdravlje = K.KategorijaArtikalaIdZdravlje AND KZT.IdLanguage = $jezikId");
                $db->where("K.KategorijaArtikalaLinkZdravlje", $string);
                $dataZdravlje = $db->getOne("kategorijezdravlje K", null, $cols);

                $title = $KategorijaArtikalaNaziv =  $dataZdravlje['NazivKategZdravlje'];
                $KategZdravlje = $KategZdravljeOpis =  $dataZdravlje['TekstKategZdr']; // ovde smo stavili dve varijable
                $katZdravljeID = $dataZdravlje['KategorijaArtikalaIdZdravlje'];
                $KategorijaArtikalaLinkZdravlje = $dataZdravlje['KategorijaArtikalaLinkZdravlje'];

                // ovde smo dodali ako nema $katZdravljeID onda idi na zdravlje
                if (!$katZdravljeID) {
                    $stranica = 'zdravlje';
                } else {

                    $upitKateg = "CALL listaKategZdravljeParent($katZdravljeID,0,50)";
                    $kategListaZdravljeDaliIma = $db->rawQuery($upitKateg);
                    if ($kategListaZdravljeDaliIma) {
                        $stranica = 'zdravljekateg';

                    } else {
                        $stranica = 'listaArtZdravlje';
                    }
                }

                break;



            case "vestijedna":
                /* $kojavest = $common->clearvariable($id);
                 $kat_upit = "SELECT vesti.* FROM ".BAZA.".[vesti] WHERE VestiLink = '$kojavest'";
                 $daljestr = $db->fetchassoc($kat_upit);
                 $VestiNaslov = $daljestr[VestiNaslov];
                 $VestiLink = $daljestr[VestiLink];
                 $VestiKratakOpis = $daljestr[VestiKratakOpis];
                 $VestiOpis = $daljestr[VestiOpis];
                 $VestiSlika = $daljestr[VestiSlika];
                 $lokacijaslika = $db->locationSlikaBilosta('vestislika');
                 $slika = $lokacijaslika.'/'.$VestiSlika;
                 $dalipostoji = $db->daLiPostojiSlika($slika);
                 $lVesti = '/klase/timthumb.php?src='.$dalipostoji.'&w=260';*/

                $title = $VestiNaslov;
                $description = $VestiNaslov . ". " . $VestiKratakOpis;

                break;
            case "tag":

                $cols = Array ("TAG.TagoviIme");
                $db->where ("TAG.TagoviId", $id);
                $usersTags = $db->getOne("tagovi TAG", null, $cols);

                $title = 'Tag : ' . $usersTags['TagoviIme'];
                $description = 'Tagovi za dati proizvod : ' . $_GET['tag'];
                break;

            case "vestisingle":


                $cols = Array("V.*","VN.VestiNaslov".$jezik,"VO.VestiOpis".$jezik,"K.KomitentIme, K.KomitentPrezime, K.KomitentiSlika");
                $db->join("vestinaslov VN", "VN.IdVestiNaslov = V.IdVesti");
                $db->join("vestiopis VO", "VO.IdVestiOpis = V.IdVesti");
                $db->join("komitenti K", "K.KomitentId = V.IdKomitentVesti");
                $db->where("V.UrlVesti", $string);
                $dataVesti = $db->get("vesti V", null, $cols);


                foreach ($dataVesti as $sds => $link) {
                    $IdVesti = $link['IdVesti'];
                    $NaslovVesti = $link['VestiNaslov' . $jezik];
                    $VestiOpisVest = $link['VestiOpis' . $jezik];

                    $DatumVesti = $link['DatumVesti'];
                    $SlikaVesti = $link['SlikaVesti'];
                    $MestoVesti = $link['MestoVesti'];

                    $VestKomitentIme = $link['KomitentIme'];
                    $VestKomitentPrezime = $link['KomitentPrezime'];
                    $VestKomitentiSlika = $link['KomitentiSlika'];

                    $imaPrevest = $VestKomitentIme.' '.$VestKomitentPrezime;

                    // slika vest
                    $slika = $common->locationslikaOstalo(VESTISLIKELOK, $IdVesti);
                    $ext = pathinfo($SlikaVesti, PATHINFO_EXTENSION);
                    $fileName = pathinfo($SlikaVesti, PATHINFO_FILENAME);
                    $velika_slikaVest = $slika.'/'.$fileName . '.' . $ext;
                   /* $lok = DCROOT . $slika . '/' . $mala_slika;
                    if (file_exists($lok)) {
                        $slikaV = '<img src="' . $slika . '/' . $mala_slika . '" alt="">';
                    }*/


                }

                $title = $NaslovVesti;

                break;

            case "cart":
                $title = $jsonlang[22][$jezikId];
                $description = 'Pogledajte sta ste kupili';
                break;

            case "saveti":

                $title = $jsonlang[191][$jezikId];
               // $description = 'Pogledajte sta ste kupili';
                break;

            case "search":
                $title = 'Search - '.$_GET['q'];
               // $description = 'Pogledajte sta ste kupili';
                break;

            case "customSearchCat":
                $title = 'Custom search';

                if ($_SESSION['specPodaci']) {
                    if ($_SESSION['kategstranica'] != $stranica) {
                        unset($_SESSION['specPodaci']);
                        $_SESSION['kategstranica'] = $stranica;
                    }

                }

                if (!$_SESSION['kategstranica']) {
                    $kategStranica = $_SESSION['kategstranica'] = $stranica;
                } else {
                    $kategStranica = $_SESSION['kategstranica'];
                }

                $specPodaciPost = $_POST['specPodaci'];

               /* if ($_POST['specPodaci']) {
                    echo 'postoji spec POST';
                    echo '<br>';
                } else {
                    echo 'ne postoji post';
                    echo '<br>';
                }*/

                if ($specPodaciPost) {
                    $specPodaci = $_SESSION['specPodaci'] = $specPodaciPost;
                } else {
                    $specPodaci = $_SESSION['specPodaci'];
                }

                break;


            case "profil":

                $upitIstiProfili = $common->istiProfilLink($KomitentId, $string);
                $mozeDaVidi = ($upitIstiProfili == true) ? 1 : 0;

                $podOdUserName = $common->getPodatkeodUserName($string);
                $idOdUserName = $podOdUserName['KomitentId'];
                $UserKomitentUserName = $podOdUserName['KomitentUserName'];


                if (file_exists('stranice/profil/' . $naziv . '.php')) {
                    $strProf = $naziv;

                } else {

                    $strProf = 'pocetnaProfil';
                    $title = $podOdUserName['KomitentIme'] . ' ' . $podOdUserName['KomitentPrezime'];
                }


                break;

            case "contact-us":
                $title = $jsonlang[58][$jezikId];
                break;
            case "login":
                $title = $jsonlang[289][$jezikId];
                break;
            case "checkout":
                $title = $jsonlang[425][$jezikId];
                break;

            case "proverasifre":
                $title = "Provera Sifre";
                break;
            case "elasticTest":
                $title = "Elastic Test";
                break;

            default:
                $title = "Default strana";
                //die;

        }

        // if(isset($_GET['kojavest'])) {  }
    } else {

        // ako je kateg strana
        $dataKateg = array("KH.*", "KHN.NaslovKategHead","KHT.OpisKategHeadTekst");
        $db->join("kategheadnaslov KHN", "KHN.IdKategHead = KH.IdKategHead AND KHN.IdLanguage = $jezikId");
        $db->join("kategheadtekstnew KHT", "KHT.IdKategHead = KH.IdKategHead AND KHT.IdLanguage = $jezikId");
        $db->where("KH.LinkKategHead", $stranica);
        $db->where("KH.AktivanKategHead", 1);
        $daljestr = $db->getOne("kateghead KH", null, $dataKateg);


        if ($daljestr) {


            $IdKategHead = $daljestr['IdKategHead'];
            $ParentKategHead = $daljestr['ParentKategHead'];
            $LinkKategHead = $daljestr['LinkKategHead'];
            $NazivKategHead = $daljestr['NaslovKategHead'];
            $TekstHead = $daljestr['OpisKategHeadTekst'];


            $title = $NazivKategHead;
            $stranica = 'kateghead';
            $slika_fb = $KategHeadnaslov;


        } else {


            // if is user
            $cols = Array("K.KomitentId", "K.KomitentNaziv", "K.KomitentIme", "K.KomitentPrezime", "K.KomitentAdresa", "K.KomitentPosBroj",
                "K.KomitentMesto", "K.KomitentTelefon", "K.KomitentUserName", "K.KomitentEmail",
                "VK.OpisVerKomit", "VK.OcenaVeriKomi","VK.BojaVeriKomi", "LS.ImeLokSamo","LS.SlikaLokSamo","LS.LinkLokSamo"
                );
            $db->where('K.KomitentUserName', $stranica);
            $db->join('verikomitent VK', "VK.IdVerKomi = K.VerifikovanDib","LEFT");
            $db->join('lokalnasu LS', "LS.IdLokSamo = K.VerifikovanLS","LEFT");
            $usersKomitent = $db->getOne("komitenti K", null, $cols);




            if ($usersKomitent) {

                $title = 'User : '.$usersKomitent['KomitentIme'].' '.$usersKomitent['KomitentPrezime'];
                $OpisVerKomit = $usersKomitent['OpisVerKomit'];
                $OcenaVeriKomi = $usersKomitent['OcenaVeriKomi'];
                $ImeLokSamo = $usersKomitent['ImeLokSamo'];
                $KomitentIdUser = $usersKomitent['KomitentId'];
                $BojaVeriKomi = $usersKomitent['BojaVeriKomi'];
                $SlikaLokSamo = $usersKomitent['SlikaLokSamo'];
                $LinkLokSamo = $usersKomitent['LinkLokSamo'];

                $stranica = 'userKomitent';


            } else {

                $title = 'Pocetna';
                $description = $osnpodaciDescription;
                $keywords = $osnpodaciKeywords;
                $slika_fb = SLIKAFB;
                $stranica = 'error';
            }

        }

    }

} else {
    //masine
    $title = $jsonOsn[$jezikId]["OpisOsnPodaci"];
    //Basta
    //$title = $jsonlang[216][$jezikId]  . ' : ' . $jsonlang[203][$jezikId];
    //title ide u translate sve, translate tab title
    // Direktno iz Baste(Tekst iz tabele OsnPodaci, naslov naslovna strana):  Sajt na kome kupujete zdavo (translate tabela, red 203).'
    $slika_fb = SLIKAFB;

}
?>