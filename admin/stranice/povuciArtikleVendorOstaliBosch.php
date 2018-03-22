<?php
require_once(DCROOT . '/thumblib/ThumbLib.inc.php');
$kategorijeDodatna = new kategorijeDodatna($db);

if (!$id) {
    $id = 0;
}

if (!$br) {
    $br = 5;
}

/*ob_start();
echo "Hello World";
$out2 = ob_get_contents();
ob_end_clean();*/

/**
 * Flush output buffer
 */
function myFlush()
{
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
$brendAgro = ($_POST['brendartikla']) ? $_POST['brendartikla'] : 31;
$vendorDodatna = ($_POST['vendorDodatna']) ? $_POST['vendorDodatna'] : 45;
$vendorAgro = ($_POST['KomitentId']) ? $_POST['KomitentId'] : 29;

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
                                $db->orderBy("BI.BrendIme","asc");
                                $db->where("BI.IdLanguage = 5 AND B.BrendSajtMasine = 1");
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
                        <input type="submit"
                               onclick="this.value='Submitting ..';this.disabled='disabled'; this.form.submit();"
                               value="Ucitaj podatke" class="btn btn-primary pull-right">
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
                    <div>$vendorDodatna = <?php echo $vendorDodatna; ?> // VENDOR tabeli na dodatnojopremi</div>
                    <div>$vendorAgro = <?php echo $vendorAgro; ?> // KOMITENTI u nasoj tabeli</div>
                </div>
                <div>


                    <?php


                    if (!$brendAgro || !$vendorDodatna || !$vendorAgro) {
                        echo 'Nema neki od podataka';
                        die;
                    }


                    // Sada pravimo upit u vebsop po VENDORU
                    // primer SELECT * FROM vebsop WHERE Vendor = '45'
                    $limit = Array($id, $br);
                    $cols = Array("*");
                    $db->where("V.vendor", $vendorDodatna);
                    //$db->where("V.codeboschlink", '');
                    //$db->where("CodeBoschLink LIKE '%bosch-professional%'");
                    $users = $db->get("vebsop V", $limit, $cols);

                    if (!$users) {
                        //error_log("Nema artikala u vebsop bazi - linija 64 PovuciArtikleBrend!", 0);
                        echo "Nema artikala u vebsop bazi PO ZADATIM KRITERIJUMIMA";
                        die;
                    }

                    echo '<br/> Ukupno Bosch -> ';
                    echo $db->count;
                    echo '<br/>';

                    $y = 0;
                    $i = 0;
                    $start = $common->microtime_float();

                    $pokazi .= '';

                    if ($db->count > 0) {
                        foreach ($users as $v) {

                            $y = $y+1;
                            usleep(10000);





                            $pokazi .= '<hr style="border: 1px solid grey" />';
                            $pokazi .= '<div>ID : ' . $i . '</div>';
                            $pokazi .= '<div>BR : ' . $y . '</div>';

                            $prolazno = $common->microtime_float();
                            $vrm = $prolazno - $start;
                            $pokazi .= '<div>Vreme  : ' . $vrm .'</div>';


                            $idArtDodatna = $v['id'];
                            $kategorija_id = $v['kategorija_id'];
                            $brend = $v['brend'];
                            $model = $v['model'];
                            $cena = $v['cena'];
                            $cenaeuro = $v['cenaeuro'];
                            $opisDetaljan = $v['opis'];
                            $kratopis = $v['kratopis'];
                            $url_artikla = $v['url_artikla'];
                            $url_artikla = substr($url_artikla, 0, 65);
                            $vendor = $v['vendor'];
                            $codebosch = $v['codebosch'];
                            $codeboschlink = $v['codeboschlink'];
                            $marzaid = $v['marzaid'];

                            if ($kategorija_id == 961) {
                                continue;
                            }


                            $path_parts = pathinfo($codeboschlink);
                            $htmlDaLiIma = $path_parts['extension'];
                            $DlOk = ($htmlDaLiIma == 'html') ? 'OK' : 'NE';


                            /*  echo '<br />';
                              echo htmlspecialchars($v['opis']);
                              echo '<br />';*/
                            /* $rest = substr($opisDetaljan, -10, 10);
                             $staKod = htmlspecialchars($rest);
                             $staKodOpis = htmlspecialchars('</p></div>');
                             $daliJeLosOpis = ($staKod == $staKodOpis) ? 1 : 0;

                             if ($daliJeLosOpis) {
                                 $daliJeLosOpis = substr($opisDetaljan, 0, -10);
                             }*/
                            //htmlspecialchars($daliJeLosOpis);

                            $bojaCBL = ($codeboschlink) ? 'green' : 'red';

                            $pokazi .= '<ul>';
                                $pokazi .= '<li><h3>Model : ' . $model . '</h3></li>';
                                $pokazi .= '<li>ID : ' . $idArtDodatna . '</li>';
                                $pokazi .= '<li>CENA MP: ' . $cena . '</li>';
                                $pokazi .= '<li>CENA VP: ' . $cenaeuro . '</li>';
                                $pokazi .= '<li>$codebosch : ' . $codebosch . '</li>';
                                $pokazi .= '<li><strong style="color: ' . $bojaCBL . '">$codeboschlink</strong> : ' . $codeboschlink . '</li>';
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


                            // Provera da li ima codebosch vec u bazi
                            $cols = Array("ArtikalId");
                            $db->where("CodeBosch", $codebosch);
                            if ($userUrlArt = $db->getOne("artikli", NULL, $cols)) {
                                $pokazi .= '<strong class="bojacrvena">UBACEN JE KOD NAS U BAZU </strong> <br>
                                        Ima duplikat CodeBosch na ID od vebsop -> ' . $idArtDodatna . ' i kod nas u bazi ID : ' . $userUrlArt['ArtikalId'];

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

                                $kategorijaAgro = (int)$users['KategorijaArtikalaId'];
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

                            $pokazi .= $common->microtime_floatProlaz($start);

                            $pokazi .= '<ul style="background-color: #d1edff">';
                                require('povuciArtikleVendorOstaliBoschDeo.php');
                            $pokazi .= '</ul>';

                            $pokazi .= $common->microtime_floatProlaz($start);


                            // ubacuje samo 2
                            if ($i == 100) break;
                            $i++;
                            /*echo $pokazi;
                            myFlush();
                            $i++;
                            sleep(1);*/


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