<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 18. 08. 2015.
 * Time: 00:10
 */

$db->where("K.KomitentId", $id);
$db->join("komitentiopisnew KO", "KO.KomitentId = K.KomitentId AND KO.IdLanguage = $jezikId", "LEFT");
$komitent = $db->getOne("komitenti K");

$KomitentId = $id;
$KomitentFirma = $komitent['KomitentFirma'];
$KomitentPib = $komitent['KomitentPib'];
$KomitentMatBr = $komitent['KomitentMatBr'];
$KomitentNaziv = $komitent['KomitentNaziv'];
$KomitentFirmaAdresa = $komitent['KomitentFirmaAdresa'];
$KomitentIme = $komitent['KomitentIme'];
$KomitentPrezime = $komitent['KomitentPrezime'];
$KomitentiAdresa = $komitent['KomitentAdresa'];
$KomitentiMesto = $komitent['KomitentMesto'];
$KomitentPosBroj = $komitent['KomitentPosBroj'];
$KomitentTelefon = $komitent['KomitentTelefon'];
$KomitentiMobTel = $komitent['KomitentMobTel'];
$KomitentEmail = $komitent['KomitentEmail'];
$KomitentiUserName = $komitent['KomitentUserName'];
$KomitentPassword = $komitent['KomitentPassword'];
$KomitentActive = $komitent['KomitentActive'];
$KomitentiValuta = $komitent['KomitentiValuta'];
$KomitentRabat = $komitent['KomitentRabat'];
$KomiRabatKupi = $komitent['KomiRabatKupi'];
$KomitentTipUsera = $komitent['KomitentTipUsera'];
$KomitentiSlika = $komitent['KomitentiSlika'];
$lat = $komitent['lat'];
$lng = $komitent['lng'];
$VerifikovanDib = $komitent['VerifikovanDib'];
$VerifikovanLS = $komitent['VerifikovanLS'];
$KomitentiZemlja = $komitent['KomitentiZemlja'];
$KomitentUPdv = $komitent['KomitentUPdv'];
$InstaliranAppAnd = $komitent['InstaliranAppAnd'];
$KomitentSalt = $komitent['KomitentSalt'];






?>
<div class="row">
    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-user"></i> Izmeni Komitenta</h4>
            </div>
            <div class="widget-content">
                <form enctype="multipart/form-data" method="post" class="form-horizontal row-border" id="validate-2"
                      action="/akcija.php?action=editkomitenta">

                    <input type="hidden" name="id" id="id" class="form-control" value="<?php echo $id; ?>">


                    <div class="form-group">
                        <label class="col-md-3 control-label">Izabrati tip komitenta: </label>
                        <div class="col-md-9">

                            <?php
                            $AdimiUser = '';
                            $data = $db->get('tipusera');
                            foreach ($data as $sds => $s) {

                                $IdTipUsera = $s['IdTipUsera'];
                                $OpisTipUsera = $s['OpisTipUsera'];
                                $selektovano = ($KomitentTipUsera == $IdTipUsera) ? 'checked' : '';

                                $AdimiUser .= '<label class="radio">';
                                $AdimiUser .= '<input name="komitenttipusera" ' . $selektovano . ' value="' . $IdTipUsera . '" type="radio">';
                                    $AdimiUser .= $OpisTipUsera;
                                $AdimiUser .= '</label>';

                               // echo '<input type="radio" name="komitenttipusera" ' . $selektovano . ' value="' . $IdTipUsera . '"   onclick="hide();"><label>' . $OpisTipUsera . '</label>';

                            }
                            echo $AdimiUser;
                            ?>



                        </div>
                    </div>

                    <!--<div class="form-group required">
                        <label class="col-md-3 control-label ">Izabrati tip komitenta: </label>

                        <div class="col-md-9">

                        </div>

                    </div>-->


                    <div class="form-group" id="veleprodaja" class="strip" >
                        <div>
                            <label class="col-md-3 control-label">Firma: </label>

                            <div class="col-md-9">
                                <input type="text" name="komitentfirma" id="komitentfirma" placeholder="Ukoliko je firma u pitanju..."
                                       value="<?php echo $KomitentFirma; ?>" class="form-control ">
                            </div>
                        </div>
                        &nbsp;
                        <div>
                            <label class="col-md-3 control-label">PIB: </label>

                            <div class="col-md-9">
                                <input type="text" name="komitentpib" id="komitentpib" placeholder="Ukoliko je firma u pitanju..."
                                       class="form-control digits " min="9" maxlength="9"
                                       value="<?php echo $KomitentPib; ?>">
                            </div>
                        </div>
                        &nbsp;
                        <div>
                            <label class="col-md-3 control-label">Maticni broj: </label>

                            <div class="col-md-9">
                                <input type="text" name="komitentmatbr" id="komitentmatbr" placeholder="Ukoliko je firma u pitanju..."
                                       class="form-control digits " min="8" maxlength="8"
                                       value="<?php echo $KomitentMatBr; ?>">
                            </div>
                            &nbsp;

                            <div>
                                <label class="col-md-3 control-label">Firma adresa: </label>

                                <div class="col-md-9">
                                    <input type="text" name="komitentfirmaadresa" id="komitentfirmaadresa" placeholder="Ukoliko je firma u pitanju..."
                                           class="form-control " value="<?php echo $KomitentFirmaAdresa; ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Ime </label>

                        <div class="col-md-9">
                            <input type="text" name="komitentime" id="komitentime" class="form-control required"
                                   value="<?php echo $KomitentIme; ?>">


                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Prezime </label>

                        <div class="col-md-9">
                            <input type="text" name="komitentprezime" id="komitentprezime"
                                   class="form-control" value="<?php echo $KomitentPrezime; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Adresa </label>

                        <div class="col-md-9">
                            <input type="text" name="komitentadresa" id="komitentadresa" class="form-control required"
                                   value="<?php echo $KomitentiAdresa; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Postanski broj </label>

                        <div class="col-md-9">
                            <input type="text" name="komitentposbroj" id="komitentposbroj"
                                   class="form-control digits required" maxlength="5"
                                   value="<?php echo $KomitentPosBroj; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Mesto </label>

                        <div class="col-md-9">
                            <input type="text" name="komitentmesto" id="komitentmesto" class="form-control required"
                                   value="<?php echo $KomitentiMesto; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Drzava </label>

                        <div class="col-md-9">

                            <select class="form-control required" name="KomitentiZemlja"
                                    id="KomitentiZemlja">
                                <option value=""></option>

                                <?php
                                $data = $db->get('zemlja');
                                foreach ($data as $sds => $s) {
                                    $IdZemlja = $s['IdZemlja'];
                                    $ImeZemlja = $s['ImeZemlja'];
                                    $selektovano = ($KomitentiZemlja == $IdZemlja) ? 'selected' : ''

                                    ?>
                                    <option
                                        value="<?php echo $IdZemlja; ?>" <?php echo $selektovano ?>><?php echo $ImeZemlja; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Telefon </label>

                        <div class="col-md-9">
                            <input type="text" name="komitenttelefon" id="komitenttelefon" class="form-control digits"
                                   maxlength="12" value="<?php echo $KomitentTelefon; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Mobilni telefon </label>

                        <div class="col-md-9">
                            <input type="text" name="komitentmobtel" id="komitentmobtel" class="form-control digits"
                                   maxlength="12" value="<?php echo $KomitentiMobTel; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Email </label>

                        <div class="col-md-9">
                            <input type="email" name="komitentemail" id="komitentemail" class="form-control required"
                                   value="<?php echo $KomitentEmail; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Korisnicko ime </label>

                        <div class="col-md-9">
                            <input type="text" name="komitentusername" id="komitentusername"
                                   class="form-control required" value="<?php echo $KomitentiUserName; ?>">
                        </div>
                    </div>

                    <!--<div class="form-group">
                        <label class="col-md-3 control-label">Lozinka </label>

                        <div class="col-md-9">
                            <input type="password" name="komitentpassword" id="komitentpassword"
                                   class="form-control  required" value="<?php /*echo $KomitentPassword; */ ?>">
                        </div>
                    </div>-->

                    <div class="form-group">
                        <label class="col-md-3 control-label">Aktivno</label>

                        <div class="col-md-9">
                            <select id="komitentactive" name="komitentactive"
                                    class="form-control  required" value="<?php echo $KomitentActive; ?>">
                                <option value="0"<?php echo ($KomitentActive == 0) ? 'selected' : ''; ?> >Neaktivan
                                </option>
                                <option value="1"<?php echo ($KomitentActive == 1) ? 'selected' : ''; ?> >Aktivan
                                </option>
                            </select>
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Valuta</label>

                        <div class="col-md-9">

                            <select class="form-control required" name="komitentivaluta"
                                    value="<?php echo $KomitentiValuta ?> " id="komitentivaluta">
                                <option value=""></option>

                                <?php
                                $data = $db->get('valuta');
                                foreach ($data as $sds => $s) {
                                    $ValutaId = $s['ValutaId'];
                                    $ValutaNaziv = $s['ValutaNaziv'];
                                    $selektovano = ($KomitentiValuta == $ValutaId) ? 'selected' : '';
                                    echo '<option value="' . $ValutaId . '" ' . $selektovano . ' >' . $ValutaNaziv . '</option>';

                                }
                                ?>
                            </select>
                            <span class="help-block">To je valuta u kojoj korisnik stavlja svoje cene za svoje artikle na sajtu _ ovo je bitno kada se radi posrednistvo B2B za B2B</span>
                        </div>
                    </div>


                    <!--Multi slike-->
                    <div class="form-group">
                        <label class="col-md-3 control-label">Slika Komitenta</label>

                        <div class="col-md-4">
                            <input type="file" name="slikeMultiple"
                                   class="with-preview accept-gif|jpg|png fileIgnorisi"/>

                        </div>
                        <div class="col-md-5">

                            <?php
                            $lokrel = $common->locationslikaOstaloKomitent(KOMSLIKE, $KomitentId);

                            $ext = pathinfo($KomitentiSlika, PATHINFO_EXTENSION);
                            $fileName = pathinfo($KomitentiSlika, PATHINFO_FILENAME);

                            $mala_slika = $fileName . '_mala.' . $ext;


                            $lok = DCROOT . $lokrel . '/' . $mala_slika;
                            if (file_exists($lok)) {
                                echo '<img src="' . $lokrel . '/' . $mala_slika . '" alt="">';
                            }

                            ?>

                        </div>
                    </div>



                    <div class="form-group">
                        <label class="col-md-3 control-label">Galerija slika</label>

                        <div class="col-md-2">
                            <input type="file" multiple="multiple" name="slikeGalerija[]" class="multi with-preview accept-gif|jpg|png fileIgnorisi"/>
                        </div>


                        <?php include 'slikeGalerijaKomitent.php' ?>

                    </div>

                    <!--<div class="form-group">
                        <label class="col-md-3 control-label">Mapa </label>

                        <div class="col-md-9">
                            <div id="map" style="width: 100%;height: 400px"></div>
                            <div id="current"></div>
                        </div>

                    </div>-->


                    <div class="form-group">
                        <label class="col-md-3 control-label">Rabat </label>

                        <div class="col-md-9">
                            <input type="text" name="komitentrabat" id="komitentrabat"
                                   value="<?php echo $KomitentRabat; ?>" class="form-control" placeholder="Koliko komitent daje rabata na svoje artikle za SVE kupce"
                                   maxlength="3">
                            <span class="help-block">Koliko nam komitent daje rabata na njegove artikle koje prodaje na nasem sajtu</span>
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Rabat koji dobija pri kupovini</label>

                        <div class="col-md-9">
                            <input type="number" name="KomiRabatKupi" id="KomiRabatKupi"
                                   value="<?php echo $KomiRabatKupi; ?>" class="form-control" placeholder="Koliko korisnik dobija rabata pri kupovini SVIH artikala na sajtu"
                                   maxlength="3">
                            <span class="help-block">Koliko komitent dobija rabat od sajta</span>
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Da li ima komitent Instaliranu aplikaciju</label>

                        <div class="col-md-9">
                            <input type="number" name="InstaliranAppAnd" id="InstaliranAppAnd"
                                   value="<?php echo $InstaliranAppAnd; ?>" class="form-control" placeholder="Ako je 1 onda je instalirana App"
                                   maxlength="1">
                            <span class="help-block">Ako je 1 onda je instalirana Aplikacija</span>
                        </div>

                    </div>




                    <div class="form-group">
                        <label class="col-md-3 control-label">U sitemu PDV-a </label>

                        <div class="col-md-9">

                            <select class="form-control fileIgnorisi" name="KomitentUPdv" id="KomitentUPdv" ">
                                <option value="1" <?php echo ($KomitentUPdv==1) ? 'selected="selected"' : '';  ?> >U sitemu PDV-a</option>
                                <option value="0" <?php echo ($KomitentUPdv==0) ? 'selected="selected"' : '';  ?>>Nije u sitemu PDV-a</option>
                            </select>

                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Lozinka korisnika</label>

                        <div class="col-md-4">
                            <a onclick="confirmSubmit()" target="_blank" href="/proverasifre/<?php echo $KomitentSalt; ?>"
                               class="btn btn-warning"> Promeni lozinku nasumicno</a>

                        </div>
                        <div class="col-md-1">

                        </div>
                        <div class="col-md-4">
                            <a href="/admin/str/promenasifresvoje/<?php echo $KomitentId ?>" class="btn btn-warning"> Promeni lozinku</a>

                        </div>
                    </div>



                   <!-- <div class="form-group">
                        <label class="col-md-3 control-label">Verifikovan - nasa ocena</label>

                        <div class="col-md-9">

                            <select class="form-control fileIgnorisi" name="VerifikovanDib"
                                    id="VerifikovanDib" value="<?php /*echo $VerifikovanDib */?> ">
                                <option value=""></option>


                                <?php
/*                                $data = $db->get('verikomitent');
                                foreach ($data as $sds => $s) {
                                    $IdVerKomi = $s['IdVerKomi'];
                                    $OcenaVeriKomi = $s['OcenaVeriKomi'];
                                    $OpisVerKomit = $s['OpisVerKomit'];
                                    $selektovano = ($VerifikovanDib == $IdVerKomi) ? 'selected' : ''

                                    */?>
                                    <option
                                        value="<?php /*echo $IdVerKomi; */?>" <?php /*echo $selektovano */?>><?php /*echo $OcenaVeriKomi, ' = ', $OpisVerKomit; */?></option>
                                <?php /*} */?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Verifikovan - Lokalna samouprava</label>

                        <div class="col-md-9">

                            <select class="form-control fileIgnorisi" name="VerifikovanLS"  id="VerifikovanLS" value="<?php /*echo $VerifikovanLS */?> ">
                                <option value=""></option>

                                <?php
/*                                $data = $db->get('lokalnasu');
                                foreach ($data as $sds => $s) {
                                    $IdLokSamo = $s['IdLokSamo'];
                                    $ImeLokSamo = $s['ImeLokSamo'];
                                    $selektovano = ($VerifikovanLS == $IdLokSamo) ? 'selected' : ''
                                    */?>
                                    <option value="<?php /*echo $IdLokSamo; */?>" <?php /*echo $selektovano */?>><?php /*echo $ImeLokSamo; */?></option>
                                <?php /*} */?>
                            </select>
                        </div>
                    </div>-->


                    <?php
                    $naziv = '';
                    foreach ($jezLan as $k => $v):
                        $ShortLanguage = $v['ShortLanguage'];
                        $IdLanguage = $v['IdLanguage'];


                        $cols = Array ("OpisKomitent");
                        $db->where ('KomitentId', $id);
                        $db->where ('IdLanguage', $IdLanguage);
                        $artNazivNewUpit = $db->getOne("komitentiopisnew", null, $cols);
                        $OpisArtikla = $artNazivNewUpit['OpisKomitent'];


                        $naziv .= '<div class="form-group">';
                        $naziv .= '<label class="col-md-2 control-label">Veliki Opis '.$ShortLanguage.'</label>';
                        $naziv .= '<div class="col-md-10">';
                        $naziv .= '<textarea rows="5" name="TekstHead['.$IdLanguage.']" class="form-control required wysiwyg">'.$OpisArtikla.'</textarea>';
                        $naziv .= '</div>';
                        $naziv .= '</div>';

                    endforeach;

                    echo $naziv;
                    ?>

                    <input type="hidden" value="<?php echo $lat; ?>" id="lat" name="lat">
                    <input type="hidden" value="<?php echo $lng; ?>" id="lng" name="lng">

                    <div class="form-actions">
                        <input type="submit" value="Izmeni komitenta" class="btn btn-primary pull-right">
                    </div>
                </form>
            </div>
        </div>
        <!-- /Validation Example 1 -->
    </div>
</div>

<script>

    var latPozTre, lngPozTre, latPozTreBaza, lngPozTreBaza;

    latPozTreBaza = document.getElementById("lat").value;
    lngPozTreBaza = document.getElementById("lng").value;

    if (latPozTreBaza==0) {
        latPozTreBaza = 44.77448476;
    }
    if (lngPozTreBaza==0) {
        lngPozTreBaza = 20.45019;
    }

    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 10,
            center: {lat: 44.77448476, lng: 20.45019}
        });

        //var geocoder = new google.maps.Geocoder;
        //var infowindow = new google.maps.InfoWindow;

        var latlng = {lat: parseFloat(latPozTreBaza), lng: parseFloat(lngPozTreBaza)};

        marker = new google.maps.Marker({
            map: map,
            draggable: true,
            animation: google.maps.Animation.DROP,
            position: {lat: parseFloat(latPozTreBaza), lng: parseFloat(lngPozTreBaza)}
        });


        marker.addListener('click', toggleBounce);

        marker.addListener('dragend', function (evt) {
            lat = marker.getPosition().lat();
            lng = marker.getPosition().lng();

            latPozTre = document.getElementById("lat");
            lngPozTre = document.getElementById("lng");

            latPozTre.value = lat;
            lngPozTre.value = lng;
            //document.getElementById('current').innerHTML = '<p>Marker dropped: Current Lat: ' + evt.latLng.lat().toFixed(3) + ' Current Lng: ' + evt.latLng.lng().toFixed(3) + '</p>';
        });
    }

    function toggleBounce() {
        if (marker.getAnimation() !== null) {
            marker.setAnimation(null);
        } else {
            marker.setAnimation(google.maps.Animation.BOUNCE);
        }
    }

</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?signed_in=true&callback=initMap"></script>
