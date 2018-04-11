<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 14. 08. 2015.
 * Time: 15:20
 */

$db->where("BanerId", $id);
$slider = $db->getOne("baneri");
$BanerId = $slider['BanerId'];
$BanerNaziv = $slider['BanerNaziv'];
$BanerLink = $slider['BanerLink'];
$BanerOpis = $slider['BanerOpis'];
$BanerSlika = $slider['BanerSlika'];
$BanerAktivan = $slider['BanerAktivan'];
$BanerKategorijaArtiklaId = $slider['BanerKategorijaArtiklaId'];
$BanerUrl = $slider['BanerUrl'];
$BanerDodatniOpis = $slider['BanerDodatniOpis'];
$BanerLokacija = $slider['BanerLokacija'];


//var_dump($slider);


?>

<!--=== Page Content ===-->
<div class="row">

    <div class="col-md-10">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-adjust"></i> Izmeni Slajder</h4>

                <div class="toolbar">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>
            <div class="widget-content">
                <form enctype="multipart/form-data" method="post" class="form-horizontal row-border" id="validate-1"
                      action="/akcija.php?action=editslider">


                    <div class="form-group">
                        <label class="col-md-3 control-label">Naziv slajda </label>

                        <div class="col-md-9">
                            <input type="text" name="naziv" class="form-control required"
                                   value="<?php echo $BanerNaziv ?>">
                            <input type="hidden" name="id" id="id" class="form-control required"
                                   value="<?php echo $BanerId ?>">
                        </div>
                    </div>

                    <!--<div class="form-group">
                        <label class="col-md-3 control-label">Dodatni opis </label>

                        <div class="col-md-9">
                            <input type="text" name="string" class="form-control required"
                                   value="<?php /*echo $BanerDodatniOpis */?>">
                        </div>
                    </div>-->

                    <div class="form-group">
                        <label class="col-md-3 control-label">URL Banera </label>

                        <div class="col-md-9">
                            <input type="text" name="BanerUrl" class="form-control required"
                                   value="<?php echo $BanerUrl ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Kratak opis</label>

                        <div class="col-md-9">
                            <textarea rows="5" name="baneropis"
                                      class="form-control wysiwyg"><?php echo $BanerOpis ?></textarea>
                        </div>
                    </div>


                    <!--Multi slike-->
                    <div class="form-group">
                        <label class="col-md-3 control-label">Slika</label>

                        <div class="col-md-4">
                            <input type="file" name="slikeMultiple"
                                   class="with-preview accept-gif|jpg|png fileIgnorisi"/>

                        </div>
                        <div class="col-md-5">

                            <?php

                            $lokrel = $common->locationslikaOstalo(BANERSLIKELOK, $BanerId);

                            $ext = pathinfo($BanerSlika, PATHINFO_EXTENSION);
                            $fileName = pathinfo($BanerSlika, PATHINFO_FILENAME);

                            $mala_slika = $fileName . '_mala.' . $ext;


                            $lok = DCROOT . $lokrel . '/' . $mala_slika;
                            if (file_exists($lok)) {
                                echo '<img src="' . $lokrel . '/' . $mala_slika . '" alt="">';
                            }


                            ?>

                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-3 control-label">Aktivno</label>

                        <div class="col-md-9">

                            <select id="baneraktivan" name="baneraktivan" value="<?php echo $BanerAktivan ?>"
                                    class="form-control">
                                <option value="0"<?php echo ($BanerAktivan == 0) ? 'selected' : ''; ?> >Neaktivno
                                </option>
                                <option value="1"<?php echo ($BanerAktivan == 1) ? 'selected' : ''; ?> >Aktivno</option>
                            </select>
                        </div>


                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Pozicija banera</label>

                        <div class="col-md-9">
                            <select id="banerlokacija" name="banerlokacija" class=" form-control required bs-tooltip"  data-placement="left"
                                    data-original-title="Gde ce se baner prikazivati">
                                <option value="0"<?php echo ($BanerLokacija == 0) ? 'selected' : ''; ?> >Pocetna gore
                                </option>
                                <option value="1"<?php echo ($BanerLokacija == 1) ? 'selected' : ''; ?> >Pocetna dole</option>
                            </select>
                        </div>

                    </div>


                    <!--<div class="form-group">
                        <label class="col-md-3 control-label">Kategorije</label>

                        <div class="col-md-9">

                            <select id="br" name="br" value="<?php /*echo $BanerKategorijaArtikalaId */?>"
                                    class="select2 full-width-fix">
                                <?php
/*                                $pieces = SVEKATEGORIJEMASINE;
                                $upitkateg = "
                          SELECT
                              K.KategorijaArtikalaId,
                              KAN.NazivKategorije
                          FROM
                              kategorijeartikala K
                          LEFT JOIN kategorijeartikalanaslov KAN
                                ON KAN.IdKategorije = K.KategorijaArtikalaId
                          WHERE K.KategorijaArtikalaId IN ($pieces) AND KAN.IdLanguage = 5";

                                $data = $db->rawQuery($upitkateg);

                                echo '<option value=""  > -- </option>';

                                foreach ($data as $sds => $s) {
                                    $KategorijaArtikalaId = $s['KategorijaArtikalaId'];
                                    $KategorijaArtikalaNaziv = $s['NazivKategorije'];
                                    $selected = ($BanerKategorijaArtiklaId == $KategorijaArtikalaId) ? 'selected' : '';
                                    echo '<option value="' . $s['KategorijaArtikalaId'] . '"   ' . $selected . '>' . $s['NazivKategorije'] . '</option>' . "\n";

                                }
                                */?>
                            </select>
                        </div>-->
                    </div>

                    <div class=" form-actions">
                        <input type="submit" value="Izmeni slajder" class="btn btn-primary pull-right">
                    </div>
                </form>
            </div>
        </div>
        <!-- /Validation Example 1 -->
    </div>
</div>
<!-- /Page Content -->
