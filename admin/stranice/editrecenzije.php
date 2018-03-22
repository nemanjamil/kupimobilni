<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 19. 01. 2016.
 * Time: 13:50
 */


$db->where("IdRecenzije", $id);
$rec = $db->getOne("recenzije");

$IdRecenzije = $rec['IdRecenzije'];
$ProizvodRecenzije = $rec['ProizvodRecenzije'];
$KomitentRecenzije = $rec['KomitentRecenzije'];
$NaslovRecenzije = $rec['NaslovRecenzije'];
$KomentarProizvodRecenzije = $rec['KomentarProizvodRecenzije'];
$KomentarZaRecenzije = $rec['KomentarZaRecenzije'];
$KomentarProtivRecenzije = $rec['KomentarProtivRecenzije'];
$PoklonRecenzije = $rec['PoklonRecenzije'];
$KomentarAktivanRecenzije = $rec['KomentarAktivanRecenzije'];
$StarCenaRecenzije = $rec['StarCenaRecenzije'];
$StarKvalitetRecenzije = $rec['StarKvalitetRecenzije'];
$StarLakocaRecenzije = $rec['StarLakocaRecenzije'];
$StarKorisnostRecenzije = $rec['StarKorisnostRecenzije'];
$StarKvalitetRecenzije = $rec['StarKvalitetRecenzije'];
$StarLakocaRecenzije = $rec['StarLakocaRecenzije'];
$StarKorisnostRecenzije = $rec['StarKorisnostRecenzije'];
$KolikoDugoRecenzije = $rec['KolikoDugoRecenzije'];
$IskoriscenRecenzije = $rec['IskoriscenRecenzije'];

//var_dump($rec);

?>

<!--=== Page Content ===-->
<div class="row">
    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-rec"></i> Izmeni Recenziju</h4>
            </div>
            <div class="widget-content">
                <form enctype="multipart/form-data" method="post" class="form-horizontal row-border" id="validate-2"
                      action="/akcija.php?action=editrecenzije">


                    <input type="hidden" name="IdRecenzije" id="IdRecenzije" value="<?php echo $IdRecenzije ?>">

                    <div class="form-group">
                        <label class="col-md-2 control-label">Artikal </label>

                        <div class="col-md-10">

                            <select id="ProizvodRecenzije" name="ProizvodRecenzije"
                                    class="select2 required full-width-fix" disabled="disabled">
                                <?php
                                $db->join("artikalnazivnew ANN", "A.ArtikalId=ANN.ArtikalId", "LEFT");
                                $data = $db->get('artikli A', null, 'A.ArtikalId, ANN.OpisArtikla');
                                foreach ($data as $sds => $s) {
                                    $selkom = ($ProizvodRecenzije == $s['ArtikalId']) ? 'selected' : '';
                                    echo '<option value="' . $s['ArtikalId'] . '"  ' . $selkom . '>' . $s['OpisArtikla'] . '</option>' . "\n";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Komitent </label>

                        <div class="col-md-10">

                            <select id="KomitentRecenzije" name="KomitentRecenzije"
                                    class="select2 required full-width-fix" disabled="disabled">
                                <?php
                                $data = $db->get('komitenti', null, 'KomitentId,KomitentIme, KomitentPrezime');
                                foreach ($data as $sds => $s) {
                                    $selkom = ($KomitentRecenzije == $s['KomitentId']) ? 'selected' : '';
                                    echo '<option value="' . $s['KomitentId'] . '"  ' . $selkom . '>' . $s['KomitentIme'] . ' '.  $s['KomitentPrezime'] .'</option>' . "\n";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Naslov recenzije</label>

                        <div class="col-md-10">
                            <input type="text" name="NaslovRecenzije" id="NaslovRecenzije"
                                   class="form-control required"
                                   required="required" value="<?php echo $NaslovRecenzije ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Komentar ZA</label>

                        <div class="col-md-10">
                            <textarea rows="5" name="KomentarZaRecenzije" id="KomentarZaRecenzije"
                                      class="form-control wysiwyg"><?php echo $KomentarZaRecenzije; ?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Komentar PROTIV</label>

                        <div class="col-md-10">
                            <textarea rows="5" name="KomentarProtivRecenzije" id="KomentarProtivRecenzije"
                                      class="form-control wysiwyg"><?php echo $KomentarProtivRecenzije; ?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Aktivna recenzija</label>

                        <div class="col-md-10">

                            <select id="KomentarAktivanRecenzije" name="KomentarAktivanRecenzije" value="<?php echo $KomentarAktivanRecenzije ?>"
                                    class="form-control">
                                <option value="0"<?php echo ($KomentarAktivanRecenzije == 0) ? 'selected' : ''; ?> >Neaktivno
                                </option>
                                <option value="1"<?php echo ($KomentarAktivanRecenzije == 1) ? 'selected' : ''; ?> >Aktivno
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Iskoriscen</label>

                        <div class="col-md-10">

                            <select id="IskoriscenRecenzije" name="IskoriscenRecenzije" value="<?php echo $IskoriscenRecenzije ?>"
                                    class="form-control"  disabled="disabled">
                                <option value="0"<?php echo ($IskoriscenRecenzije == 0) ? 'selected' : ''; ?> >Nije
                                </option>
                                <option value="1"<?php echo ($IskoriscenRecenzije == 1) ? 'selected' : ''; ?> >Jeste
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Poklon</label>

                        <div class="col-md-10">

                            <select id="PoklonRecenzije" name="PoklonRecenzije" value="<?php echo $PoklonRecenzije ?>"
                                    class="form-control" disabled="disabled">
                                <option value="0"<?php echo ($PoklonRecenzije == 0) ? 'selected' : ''; ?> >NE
                                </option>
                                <option value="1"<?php echo ($PoklonRecenzije == 1) ? 'selected' : ''; ?> >DA
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Ocena cena</label>

                        <div class="col-md-10">

                            <select id="StarCenaRecenzije" name="StarCenaRecenzije" value="<?php echo $StarCenaRecenzije ?>"
                                    class="form-control" disabled="disabled">
                                <option value="0"<?php echo ($StarCenaRecenzije == 0) ? 'selected' : ''; ?> >Nema ocenu
                                </option>
                                <option value="1"<?php echo ($StarCenaRecenzije == 1) ? 'selected' : ''; ?> >1
                                </option>
                                <option value="2"<?php echo ($StarCenaRecenzije == 2) ? 'selected' : ''; ?> >2
                                </option>
                                <option value="3"<?php echo ($StarCenaRecenzije == 3) ? 'selected' : ''; ?> >3
                                </option>
                                <option value="4"<?php echo ($StarCenaRecenzije == 4) ? 'selected' : ''; ?> >4
                                </option>
                                <option value="5"<?php echo ($StarCenaRecenzije == 5) ? 'selected' : ''; ?> >5
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Ocena Kvaliteta</label>

                        <div class="col-md-10">

                            <select id="StarKvalitetRecenzije" name="StarKvalitetRecenzije" value="<?php echo $StarKvalitetRecenzije ?>"
                                    class="form-control" disabled="disabled">
                                <option value="0"<?php echo ($StarKvalitetRecenzije == 0) ? 'selected' : ''; ?> >Nema ocenu
                                </option>
                                <option value="1"<?php echo ($StarKvalitetRecenzije == 1) ? 'selected' : ''; ?> >1
                                </option>
                                <option value="2"<?php echo ($StarKvalitetRecenzije == 2) ? 'selected' : ''; ?> >2
                                </option>
                                <option value="3"<?php echo ($StarKvalitetRecenzije == 3) ? 'selected' : ''; ?> >3
                                </option>
                                <option value="4"<?php echo ($StarKvalitetRecenzije == 4) ? 'selected' : ''; ?> >4
                                </option>
                                <option value="5"<?php echo ($StarKvalitetRecenzije == 5) ? 'selected' : ''; ?> >5
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Ocena Lakoce koriscenja</label>

                        <div class="col-md-10">

                            <select id="StarLakocaRecenzije" name="StarLakocaRecenzije" value="<?php echo $StarLakocaRecenzije ?>"
                                    class="form-control" disabled="disabled">
                                <option value="0"<?php echo ($StarLakocaRecenzije == 0) ? 'selected' : ''; ?> >Nema ocenu
                                </option>
                                <option value="1"<?php echo ($StarLakocaRecenzije == 1) ? 'selected' : ''; ?> >1
                                </option>
                                <option value="2"<?php echo ($StarLakocaRecenzije == 2) ? 'selected' : ''; ?> >2
                                </option>
                                <option value="3"<?php echo ($StarLakocaRecenzije == 3) ? 'selected' : ''; ?> >3
                                </option>
                                <option value="4"<?php echo ($StarLakocaRecenzije == 4) ? 'selected' : ''; ?> >4
                                </option>
                                <option value="5"<?php echo ($StarLakocaRecenzije == 5) ? 'selected' : ''; ?> >5
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Ocena korisnosti</label>

                        <div class="col-md-10">

                            <select id="StarKorisnostRecenzije" name="StarKorisnostRecenzije" value="<?php echo $StarKorisnostRecenzije ?>"
                                    class="form-control" disabled="disabled">
                                <option value="0"<?php echo ($StarKorisnostRecenzije == 0) ? 'selected' : ''; ?> >Nema ocenu
                                </option>
                                <option value="1"<?php echo ($StarKorisnostRecenzije == 1) ? 'selected' : ''; ?> >1
                                </option>
                                <option value="2"<?php echo ($StarKorisnostRecenzije == 2) ? 'selected' : ''; ?> >2
                                </option>
                                <option value="3"<?php echo ($StarKorisnostRecenzije == 3) ? 'selected' : ''; ?> >3
                                </option>
                                <option value="4"<?php echo ($StarKorisnostRecenzije == 4) ? 'selected' : ''; ?> >4
                                </option>
                                <option value="5"<?php echo ($StarKorisnostRecenzije == 5) ? 'selected' : ''; ?> >5
                                </option>
                            </select>
                        </div>
                    </div>


                    <div class="form-actions">
                        <input type="submit" value="Izmeni recenziju" class="btn btn-primary pull-right">
                    </div>
                </form>
            </div>
        </div>
        <!-- /Validation Example 1 -->
    </div>
</div>

<!-- /Page Content -->
