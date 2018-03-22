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
/*$brendAgro = ($_POST['brendartikla']) ? $_POST['brendartikla'] : 34;
$vendorDodatna = ($_POST['vendorDodatna']) ? $_POST['vendorDodatna'] : 52;
$vendorAgro = ($_POST['KomitentId']) ? $_POST['KomitentId'] : 53;*/

$brendAgro = ($_POST['brendartikla']) ? $_POST['brendartikla'] : 34; // AGRO BREND - WarCraft
$vendorDodatna = ($_POST['vendorDodatna']) ? $_POST['vendorDodatna'] : 52; // DODATNA VENDOR - Mi-lumen
$vendorAgro = ($_POST['KomitentId']) ? $_POST['KomitentId'] : 53; // AGRO VENDOR - Mi Lumen
$brendDodatnaUpit = ($_POST['brendartikladodatna']) ? $_POST['brendartikladodatna'] : 761; // BREND DODATNA - Wolfcraft

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
                        <label class="col-md-2 control-label">Od brenda sa DODATNE OPREME </label>

                        <div class="col-md-10">
                            <select id="brendartikladodatna" name="brendartikladodatna"  class="form-control required" value="<?php echo $brendDodatnaUpit;?>">
                                <option value=""></option>
                                <?php
                                $data = $db->rawQuery("SELECT b.brand_name, v.brend
                                -- ,(SELECT COUNT(*) FROM vebsop vs WHERE vs.vendor = $vendorDodatna AND vs.brend = v.brend)  AS kolikoKomada
                                FROM vebsop v
                                JOIN brand b ON b.id = v.brend
                                WHERE v.vendor = $vendorDodatna
                                GROUP BY v.brend
                                ORDER BY b.brand_name");

                                foreach ($data as $key => $value) {
                                    $idbdod = $value['brend'];
                                    $brArray[] = $idbdod;
                                    $brimeDod = $value['brand_name'];
                                    $kolikoKomada = $value['kolikoKomada'];
                                    $selektovano = ($brendDodatnaUpit == $idbdod) ? 'selected' : '';
                                    echo '<option value="' . $idbdod . '" ' . $selektovano . '>' . $brimeDod . ' '.$kolikoKomada.'</option>';
                                }
                                ?>
                            </select>
                            <span class="help-block">(to koristimo kada od jednog dobavljaca imamo vise brendova)</span>
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
                    $db->where("V.brend", $brendDodatnaUpit);
                    $users = $db->get("vebsop V", $limit, $cols);


                    if (!$users) {
                        //error_log("Nema artikala u vebsop bazi - linija 64 PovuciArtikleBrend!", 0);
                        echo "Nema artikala u vebsop bazi PO ZADATIM KRITERIJUMIMA";
                        die;
                    }


                    //echo $db->count;
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
                            // $url_artikla =  substr($url_artikla, 0, 65);
                            $vendor = $v['vendor'];
                            $codelumen = $v['codelumen'];
                            $CodeAgro = $v['codeagro'];
                            $codelumenlink = $v['codelumenlink'];
                            $codevermax = $v['codevermax'];
                            $codetsmod = $v['codetsmod'];

                            $codeGlavni = $codelumen;
                            $codeSec = 'codelumen';

                            $marzaid = $v['marzaid'];

                            $codeGlavni = ($codeGlavni) ? $codeGlavni : '';

                            $bojaCBL = ($codeGlavni) ? 'green' : 'red';

                            $pokazi .= '<ul>';
                            $pokazi .= '<li><h3>Model : ' . $model . '</h3></li>';
                            $pokazi .= '<li>$idArtDodatna : ' . $idArtDodatna . '</li>';
                            $pokazi .= '<li>$codeGlavni : ' . $codeGlavni . '</li>';
                            $pokazi .= '<li>$marzaid : ' . $marzaid . '</li>';
                            $pokazi .= '<li>$url_artikla : ' . $url_artikla . '</li>';
                            $pokazi .= '</ul>';



                            $cols = Array("ArtikalId","ArtikalIdDodatna");
                            $db->where($codeSec, $codeGlavni);
                            $userUrlArt = $db->getOne("artikli", NULL, $cols);
                            if ($userUrlArt) {
                                $ArtikalId = $userUrlArt['ArtikalId'];
                                $ArtikalIdDodatna = $userUrlArt['ArtikalIdDodatna'];
                                $pokazi .= '<strong class="bojacrvena">IMA Artikla kod nas u bazi '.$ArtikalId.'</strong> <br>';

                                if ($idArtDodatna==$ArtikalIdDodatna) {
                                    $pokazi .= '<div style="padding: 20px;background-color: peru"><strong class="bojacrvena">To je taj Artikal</strong> </div>';
                                } else {
                                    $pokazi .= '<div style="padding: 20px;background-color: red"><strong class="bojacrvena">To nije taj Artikal</strong> </div>';
                                    $pokazi .= '<div style="padding: 20px;background-color: red"><strong class="bojacrvena">$idArtDodatna  DODATNA '.$idArtDodatna.'</strong> </div>';
                                    $pokazi .= '<div style="padding: 20px;background-color: red"><strong class="bojacrvena">$ArtikalIdDodatna AGRO '.$ArtikalIdDodatna.'</strong> </div>';

                                }

                            } else {

                                $pokazi .= '<strong class="bojacrvena">Nema Artikla kod nas u bazi '.$ArtikalId.'</strong> <br>';
                                continue;

                            }


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



                            // UBACUJEMO ARTIKAL NAZIV I CIRILICA OLD
                            //require('arikalNazivUbaci.php');

                            // nova tabela za Nazive Artikala NEW
                            if (!$ArtikalId) {
                                echo 'Nema $ArtikalId ';
                                die;
                            }
                            // !!! OVO JE BITNO DA PREBACIMO ID
                            $idArt = $ArtikalId;

                            if ($idArt) {
                                require('dodatna/ubaciSlikeAriklaDodatna.php');
                            }

                            $sve = '<div class="opisBoschUvlacenje">' . $opisDetaljan . '</div>';
                            require(DCROOT . '/admin/stranice/dodatna/ubaciArtNazivArtOpisBosch.php');



                            // ubacuje samo 2
                            if ($i == 0) break;

                            //myFlush();
                            $i++;
                            sleep(1);


                        }
                    } else {
                        echo 'Nema artikala';
                    }

                    echo $pokazi;



                    ?>

                </div>
            </div>
        </div>
        <!-- /Validation Example 1 -->
    </div>
</div>


<!-- /Wells -->