<?php
require_once(DCROOT . '/thumblib/ThumbLib.inc.php');
$kategorijeDodatna = new kategorijeDodatna($db);

if (!$id) {
    $id = 0;
}

if (!$br) {
    $br = 1;
}

/*ob_start();
echo "Hello World";
$out2 = ob_get_contents();
ob_end_clean();*/

/**
 * Flush output buffer
 */
function myFlush() {
    //echo(str_repeat(' ', 256));
    if (ob_get_contents()) { // pokupi sve echo
        ob_end_flush(); // odstampaj to sto je pokupio // Flush (send) the output buffer and turn off output buffering
    }
    flush();
}




// DodatnaOprema Link
$linkDodatnaSajt = 'http://dodatnaoprema.com';

/*
 * Definisemo id brenda koji ubacujemo
 * BRENDOVI
 * Kod nas u bazi je Brend bosch = 31
 */

$brendAgro = ($_POST['brendartikla']) ? $_POST['brendartikla'] : 36; // // AGRO BREND -  MARKER
$vendorDodatna = ($_POST['vendorDodatna']) ? $_POST['vendorDodatna'] : 53; // DODATNA VENDOR - MARKER
$vendorAgro = ($_POST['KomitentId']) ? $_POST['KomitentId'] : 55; // AGRO VENDOR - MARKER
$brendDodatnaUpit = ($_POST['brendartikladodatna']) ? $_POST['brendartikladodatna'] : 735; // BREND DODATNA - MARKER

/*
 * Definisemo brend od dodatne opreme
 * U bazi vebsop brend BOSCH je 456
 */
// $brendDodatna = 456;

/*
 * vendor dodatne oprema BOSCH je 45 u tabeli VENDOR na dodatnojopremi bazi -
 * TODO ne prebacujes tabelu vendor iz dodatne opreme
 * ali pogledaj koji je ID Vendora
 */
//$vendorDodatna = 45;

/*
 * Vendor kod Agro Komitenti je Bosch - KOMITENTI
 */
//$vendorAgro = 29;

// ovo je kategorija koju smo uzeli kao testnu
$kategorijaDodatna = '1506';

?>
<div class="row">
    <div class="col-md-12 col-xs-6x">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-th-large"></i> Podaci po artiklu VEBSOP</h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>
            <div class="widget-content">

                <form enctype="multipart/form-data" class="form-horizontal row-border" method="post">

                    <div class="form-group">
                        <label class="col-md-2 control-label">Limit OD</label>

                        <div class="col-md-10">
                            <input type="text" name="id" class="form-control digits" max="5"
                                   value="<?php echo $id ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Limit DO</label>

                        <div class="col-md-10">
                            <input type="text" name="br" class="form-control digits" max="5"
                                   value="<?php echo $br ?>">
                        </div>
                    </div>

                    <!--Brend artikla-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Brend</label>

                        <div class="col-md-10">
                            <select id="brendartikla" name="brendartikla"
                                    class="form-control required" value="<?php echo $ArtikalBrend ?>">
                                <option value=""></option>
                                <?php
                                $cols = Array("B.BrendId", "BI.BrendIme", "B.BrendSajt");
                                $db->join("brendoviime BI", "BI.BrendId = B.BrendId");
                                $db->where("BI.IdLanguage = 5 AND B.BrendSajt = 1");
                                $data = $db->get('brendovi B', null, $cols);
                                foreach ($data as $key => $value) {
                                    $BrendId = $value['BrendId'];
                                    $BrendIme = $value['BrendIme'];
                                    $selektovano = ($brendAgro == $BrendId) ? 'selected' : '';
                                    echo '<option value="' . $BrendId . '" ' . $selektovano . '>' . $BrendIme . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Vendor dodatna</label>

                        <div class="col-md-10">
                            <input type="text" name="vendorDodatna" class="form-control digits" max="5"
                                   value="<?php echo $vendorDodatna; ?>">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-2 control-label">Komitenti</label>

                        <div class="col-md-10">
                            <select id="komitentId" name="KomitentId"
                                    class="select2 required full-width-fix">
                                <?php
                                $data = $db->get('komitenti', null, 'KomitentId,KomitentIme,KomitentPrezime,KomitentKolona');
                                foreach ($data as $sds => $s) {
                                    $selkom = ($vendorAgro == $s['KomitentId']) ? 'selected' : '';
                                    echo '<option value="' . $s['KomitentId'] . '"  ' . $selkom . '>' . $s['KomitentIme'] . ' ' . $s['KomitentPrezime'] . '</option>' . "\n";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-actions">
                        <input type="submit" onclick="this.value='Submitting ..';this.disabled='disabled'; this.form.submit();" value="Ucitaj podatke" class="btn btn-primary pull-right">
                    </div>
                </form>

            </div>
        </div>
        <!-- /Validation Example 1 -->
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-xs-6x">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-sitemap"></i> Povuci Artikle Vendor</h4>
            </div>
            <div class="widget-content">
                <div class="well">
                    Povuci Artikle Vendor
                    <div>$brendAgro = <?php echo $brendAgro; ?> // u nasoj tabeli BRENDOVI</div>
                    <div>$vendorDodatna = <?php echo $vendorDodatna; ?> //  VENDOR tabeli na dodatnojopremi </div>
                    <div>$vendorAgro = <?php echo $vendorAgro; ?> // KOMITENTI u nasoj tabeli</div>
                </div>
                <div>


                    <?php
                    $start = $common->microtime_float();

                    if (!$brendAgro || !$vendorDodatna || !$vendorAgro) {
                        echo 'Nema neki od podataka';
                        die;
                    }


                    // Sada pravimo upit u vebsop po VENDORU
                    // primer SELECT * FROM vebsop WHERE Vendor = '45'
                    $limit = Array($id, $br);
                    $cols = Array("*");
                    $db->where("V.vendor", $vendorDodatna);
                    $db->where("V.brend", 735); // dodali smo brend da bi dobili tu lisut Marker srafovi
                    $users = $db->get("vebsop V", $limit, $cols);


                    if (!$users) {
                        //error_log("Nema artikala u vebsop bazi - linija 64 PovuciArtikleBrend!", 0);
                        echo "Nema artikala u vebsop bazi PO ZADATIM KRITERIJUMIMA";
                        die;
                    }


                    $i = 0;
                    if ($db->count > 0) {
                        foreach ($users as $v) {


                            usleep(10000);

                            $pokazi .= '';

                            $pokazi .= '<hr style="border: 1px solid grey" />';
                            $pokazi .= '<div>ID : ' . $i . '</div>';

                            $idArtDodatna = $v['id'];
                            $kategorija_id = $v['kategorija_id'];
                            $brend = $v['brend'];
                            $model = $v['model'];
                            $cena = $v['cena'];
                            $cenaeuro = $v['cenaeuro'];
                            $opisDetaljan = $v['opis'];
                            $kratopis = $v['kratopis'];
                            $url_artikla = $v['url_artikla'];
                            $url_artikla =  substr($url_artikla, 0, 65);
                            $vendor = $v['vendor'];
                            $codelumen = $v['codelumen'];
                            $codelumenlink = $v['codelumenlink'];

                            $marzaid = $v['marzaid'];


                            $bojaCBL = ($codelumenlink) ? 'green' : 'red';

                            $pokazi .= '<ul>';
                            $pokazi .= '<li><h3>Model : ' . $model . '</h3></li>';
                            $pokazi .= '<li>ID : ' . $idArtDodatna . '</li>';
                            $pokazi .= '<li>$codelumen : ' . $codelumen . '</li>';
                            $pokazi .= '<li><strong style="color: ' . $bojaCBL . '">$codelumenlink</strong> : ' . $codelumenlink . '</li>';
                            $pokazi .= '<li>$marzaid : ' . $marzaid . '</li>';
                            $pokazi .= '<li>$url_artikla : ' . $url_artikla . '</li>';

                            $pokazi .= '</ul>';



                            // Provera da li je UNIQUE Artikal Link
                            // require('uniqueArtikalLink.php'); // nece da radi sa CONTINUE
                            $cols = Array("ArtikalId");
                            $db->where("ArtikalLink", $url_artikla);
                            if ($userUrlArt = $db->getOne("artikli", NULL, $cols)) {
                                $pokazi .= '<strong class="bojacrvena">UBACEN JE KOD NAS U BAZU </strong> <br>
                                   Ima duplikat ArtikalLink na ID od vebsop -> ' . $idArtDodatna . ' i kod nas u bazi ID : ' . $userUrlArt['ArtikalId'];

                                continue;

                            }

                            // SADA PROVERAVAMO DA LI IMA KATEGORIJA U KOJU TREBA DA UBACUJEMO ARTIKLE
                            //require('dodatna/cekirajKateg.php');
                            // problem kod continue

                            $cols = Array("KategorijaArtikalaId", "KategorijaArtikalaLink");
                            $db->where("Kategorija_dodatna", $kategorija_id);
                            $users = $db->getOne("kategorijeartikala", null, $cols);


                            if ($db->count <= 0) {

                                $pokazi .= '<ul style="border: 1px dashed darkgray">';
                                $pokazi .= '<li> <strong style="color: red">Ne postoji kategoija za artikal id Vebsop ' . $idArtDodatna . '</strong></li>';
                                $pokazi .= '<li>Kategorija Vebsop je : ' . $kategorija_id . '</li>';
                                $pokazi .= '<li>Znaci da moras da napravis na AGRO bazi kategoriju gde upada artikal. To je na linku povuciKategorijeOpstalo</li>';
                                $pokazi .= '</ul>';

                                //echo $pokazi;
                                continue;


                            } else {

                                $kategorijaAgro = (int) $users['KategorijaArtikalaId'];
                                $KategorijaArtikalaLink = $users['KategorijaArtikalaLink'];

                                $pokazi .= '<ul style="border: 1px dashed coral">';
                                $pokazi .= '<li> <strong style="color: red">Pripada kategoriji <a target="_blank" href="' . DPROOTADMIN . '/kat/' . $kategorijaAgro . '">' . $KategorijaArtikalaLink . '</a></strong></li>';
                                $pokazi .= '<li>Id kategorije ' . $kategorijaAgro . '</li>';
                                $pokazi .= '</ul>';
                                //echo $pokazi;
                            }


                            if (!$kategorijaAgro) {
                                echo $pokazi;
                                die;
                            }



                            $db->startTransaction();

                            /*
                             * SADA radimo INSERT datih podataka u nasu bazu
                             */
                            $db->setTrace(true);
                            $data = Array(

                                'ArtikalIdDodatna' => $idArtDodatna,
                                'KategorijaArtikalId' => $kategorijaAgro,  // ovo dobijamo od upita sa linije 52
                                'ArtikalBrendId' => $brendAgro, // bosch
                                'ArtikalLink' => $url_artikla,
                                'ArtikalMarzaId' => $marzaid,
                                'ArtikalKomitent' => $vendorAgro, // to je komitent nemanja je VENDOR
                                'TipKatUnitArt' => 8,  // kom
                                'ArtikalMPCena' => $cena,
                                'ArtikalVPCena' => $cena
                            );


                            $idArt = $db->insert('artikli', $data);
                            if (!$idArt) {
                                echo '<div><strong style="color: red;"> Fail INSTER u bazu -> ARTIKLI : </strong></div><br>   ' . $db->getLastError();
                                print_r($db->trace);
                                die;
                            }


                            // UBACUJEMO ARTIKAL NAZIV I CIRILICA OLD
                            //require('arikalNazivUbaci.php');

                            // nova tabela za Nazive Artikala NEW
                            $pokazi .=  '<ul class="pozadinasvplava">';
                            require('ubaciNaziveArtNewVendor.php');
                            $pokazi .=  '</ul>';



                            /*
                             * SADA UBACUJEMO SLIKE ARTIKLA
                             */
                            if ($idTekstNew) {
                                require('dodatna/ubaciSlikeAriklaDodatna.php');
                            }

                            //var_dump($db->trace);

                            /*
                           * UBACUJEMO OPIS
                           * ArtikliTekstovi
                           */

                            $db->where("ArtikalId", $idArt);
                            $user = $db->getOne("artiklitekstovinew");
                            $IdArtikliTekstovi = $user['ArtikalId'];

                            $sve = '<div class="opisBoschUvlacenje">' . $opisDetaljan . '</div>';
                            require(DCROOT . '/admin/stranice/dodatna/ubaciArtNazivArtOpisBosch.php');



                            // ubacuje samo 2
                            if ($i == 200) die;
                            echo $pokazi;
                            myFlush();
                            $i++;
                            sleep(1);


                        }
                    } else {
                        echo 'Nema artikala';
                    }


                    ?>

                </div>
            </div>
        </div>
        <!-- /Validation Example 1 -->
    </div>
</div>


<!-- /Wells -->