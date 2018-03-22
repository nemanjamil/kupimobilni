<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 17. 08. 2015.
 * Time: 3:32 PM
 */
?>

<script language="JavaScript"></script>

<div class="row">
    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-user"></i> Dodaj Komitenta</h4>
            </div>
            <div class="widget-content">
                <form enctype="multipart/form-data" method="post" class="form-horizontal row-border" id="validate-2" action="/akcija.php?action=dodajkomitenta">

                    <div class="form-group required">
                        <label class="col-md-3 control-label ">Izabrati tip komitenta:</label>

                        <div class="col-md-9">

                            <!--
                            <input type="radio" id="vrstaKomitenta1" name="komitenttipusera" value="1" onclick="hide();"><label>Obican korisnik</label>
                            <br>
                            <input type="radio" id="vrstaKomitenta1" name="komitenttipusera" value="2" checked onclick="hide();"><label> User 1</label>
                            <br>
                            <input type="radio" id="vrstaKomitenta2" name="komitenttipusera" value="3" onclick="show();"><label> User 2</label>&nbsp;&nbsp;
                            <br>
                            <input type="radio" id="vrstaKomitenta3" name="komitenttipusera" value="10" onclick="hide();"><label> Admin</label>
                            <br>
                            <input type="radio" id="vrstaKomitenta3" name="komitenttipusera" value="15" onclick="hide();"><label>Super Admin</label>
                            -->

                            <?php
                            $AdimiUser = '';
                            $data = $db->get('tipusera');
                            foreach ($data as $sds => $s) {

                                $IdTipUsera = $s['IdTipUsera'];
                                $OpisTipUsera = $s['OpisTipUsera'];

                                $AdimiUser .= '<label class="radio">';
                                $AdimiUser .= '<input name="komitenttipusera" value="' . $IdTipUsera . '" type="radio" required>';
                                $AdimiUser .= $OpisTipUsera;
                                $AdimiUser .= '</label>';

                                // echo '<input type="radio" name="komitenttipusera" ' . $selektovano . ' value="' . $IdTipUsera . '"   onclick="hide();"><label>' . $OpisTipUsera . '</label>';

                            }
                            echo $AdimiUser;
                            ?>

                        </div>

                    </div>

                    <!--<script>
                        function hide() {
                            $('#veleprodaja').hide();
                            $('#veleprodaja input').val("");
                            $('#maloprodaja input').val("");

                        }
                        function show() {
                            $('#veleprodaja').show();
                            $('#maloprodaja input').val("");

                        }
                    </script>-->

                    <div class="form-group strip" ><!--id="veleprodaja" hidden -->
                        <div>
                            <label class="col-md-3 control-label">Firma: </label>

                            <div class="col-md-9">
                                <input type="text" name="komitentfirma" id="komitentfirma" class="form-control">
                            </div>
                        </div>
                        &nbsp;
                        <div>
                            <label class="col-md-3 control-label">PIB: </label>

                            <div class="col-md-9">
                                <input type="text" name="komitentpib" id="komitentpib" class="form-control digits" min="9" maxlength="9">
                            </div>
                        </div>
                        &nbsp;
                        <div>
                            <label class="col-md-3 control-label">Maticni broj: </label>

                            <div class="col-md-9">
                                <input type="text" name="komitentmatbr" id="komitentmatbr" class="form-control digits" min="8" maxlength="8">
                            </div>
                            &nbsp;

                            <div>
                                <label class="col-md-3 control-label">Firma adresa: </label>

                                <div class="col-md-9">
                                    <input type="text" name="komitentfirmaadresa" id="komitentfirmaadresa" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Ime </label>

                        <div class="col-md-9">
                            <input type="text" name="komitentime" id="komitentime" class="form-control required">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Prezime </label>

                        <div class="col-md-9">
                            <input type="text" name="komitentprezime" id="komitentprezime" class="form-control required">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Adresa </label>

                        <div class="col-md-9">
                            <input type="text" name="komitentadresa" id="komitentadresa" class="form-control required">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Postanski broj </label>

                        <div class="col-md-9">
                            <input type="text" name="komitentposbroj" id="komitentposbroj" class="form-control digits required" maxlength="5">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Mesto </label>

                        <div class="col-md-9">
                            <input type="text" name="komitentmesto" id="komitentmesto" class="form-control required">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Drzava </label>

                        <div class="col-md-9">

                            <select class="form-control required" name="KomitentiZemlja" id="KomitentiZemlja">
                                <option value=""></option>

                                <?php
                                $data = $db->get('zemlja');
                                foreach ($data as $sds => $s) {
                                    $IdZemlja = $s['IdZemlja'];
                                    $ImeZemlja = $s['ImeZemlja'];
                                    $selektovano = ($ImeZemlja == $IdZemlja) ? 'selected' : ''

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
                            <input type="text" name="komitenttelefon" id="komitenttelefon" class="form-control digits" maxlength="12">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Mobilni telefon </label>

                        <div class="col-md-9">
                            <input type="text" name="komitentmobtel" id="komitentmobtel" class="form-control digits required" maxlength="12">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Email </label>

                        <div class="col-md-9">
                            <input type="email" name="komitentemail" id="komitentemail" class="form-control required">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Korisnicko ime </label>

                        <div class="col-md-9">
                            <input type="text" name="komitentusername" id="komitentusername" class="form-control required">
                        </div>
                    </div>

                    <!--<div class="form-group">
                            <label class="col-md-3 control-label">Lozinka </label>

                            <div class="col-md-9">
                                <input type="password" name="komitentpassword" id="komitentpassword"
                                       class="form-control  required">
                            </div>
                        </div>-->

                    <input type="hidden" name="komitentpassword" id="komitentpassword" class="form-control" value="1234">

                    <div class="form-group">
                        <label class="col-md-3 control-label">Valuta</label>

                        <div class="col-md-9">

                            <select class="form-control required" name="komitentivaluta" id="komitentivaluta">
                                <option value=""></option>

                                <?php
                                $data = $db->get('valuta');
                                foreach ($data as $sds => $s) {
                                    $ValutaId = $s['ValutaId'];
                                    $ValutaNaziv = $s['ValutaNaziv'];
                                    $selektovano = ($ValutaNaziv == $ValutaId) ? 'selected' : ''

                                    ?>
                                    <option value="<?php echo $ValutaId; ?>" <?php echo $selektovano ?> >
                                        <?php echo $ValutaNaziv; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <!--<div class="form-group">
                        <label class="col-md-3 control-label">Verifikovan - Nasa ocena</label>

                        <div class="col-md-9">

                            <select class="form-control" name="VerifikovanDib"
                                    id="VerifikovanDib">
                                <option value=""></option>

                                <?php
/*                                $data = $db->get('verikomitent');
                                foreach ($data as $sds => $s) {
                                    $IdVerKomi = $s['IdVerKomi'];
                                    $OcenaVeriKomi = $s['OcenaVeriKomi'];
                                    $OpisVerKomit = $s['OpisVerKomit'];
                                    $selektovano = ($OpisVerKomit == $IdVerKomi) ? 'selected' : ''

                                    */?>
                                    <option
                                        value="<?php /*echo $IdVerKomi; */?>" <?php /*echo $selektovano */?>>
                                        <?php /*echo $OcenaVeriKomi, ' = ', $OpisVerKomit; */?>
                                    </option>
                                <?php /*} */?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Verifikovan - Lokalna samouprava</label>

                        <div class="col-md-9">

                            <select class="form-control" name="VerifikovanLS"
                                    id="VerifikovanLS">
                                <option value=""></option>

                                <?php
/*                                $data = $db->get('lokalnasu');
                                foreach ($data as $sds => $s) {
                                    $IdLokSamo = $s['IdLokSamo'];
                                    $ImeLokSamo = $s['ImeLokSamo'];
                                    $selektovano = ($ImeLokSamo == $IdLokSamo) ? 'selected' : ''

                                    */?>
                                    <option
                                        value="<?php /*echo $IdLokSamo; */?>" <?php /*echo $selektovano */?>>
                                        <?php /*echo $ImeLokSamo; */?>
                                    </option>
                                <?php /*} */?>
                            </select>
                        </div>
                    </div>-->

                    <div class="form-actions">
                        <input type="submit" value="Dodaj komitenta" class="btn btn-primary pull-right">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
