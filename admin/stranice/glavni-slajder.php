<?php
/**
 * Created by PhpStorm.
 * User: NemanjaMilivojevic
 * Date: 30.7.15.
 * Time: 22.40
 */

?>
<?php include 'listaslider.php' ?>

<!--=== Page Content ===-->
<div class="row">
    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-ok"></i> Dodaj Slajder</h4>

                <div class="toolbar">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>
            <div class="widget-content">
                <form enctype="multipart/form-data" method="post" class="form-horizontal row-border" id="validate-1"
                      action="/akcija.php?action=dodajslider">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Naziv slajda </label>

                        <div class="col-md-9">
                            <input type="text" name="banernaziv" class="form-control required">
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Kratak opis</label>

                        <div class="col-md-9">
                            <textarea rows="5" name="baneropis" class="form-control wysiwyg"></textarea>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-3 control-label">Slika</label>

                        <div class="col-md-4">
                            <input type="file" name="slikeMultiple"
                                   class="with-preview accept-gif|jpg|png fileIgnorisi"/>

                        </div>
                        <div class="col-md-5">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-3 control-label">Aktivno</label>

                        <div class="col-md-9">
                            <select id="baneraktivan" name="baneraktivan" class=" form-control  required">
                                <option value="0"<?php echo ($BanerAktivno == 0) ? 'selected' : ''; ?> >Neaktivno
                                </option>
                                <option value="1"<?php echo ($BanerAktivno == 1) ? 'selected' : ''; ?> >Aktivno</option>
                            </select>
                        </div>

                    </div>


                    <div class="form-group">
                        <label class="col-md-3 control-label">Kategorije</label>

                        <div class="col-md-9">

                            <select id="br" name="br"
                                    class="select2 required full-width-fix">
                                <?php
                                $pieces = SVEKATEGORIJEMASINE;
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
                                foreach ($data as $sds => $s) {
                                    echo '<option value="' . $s['KategorijaArtikalaId'] . '">' . $s['NazivKategorije'] . '</option>' . "\n";
                                }

                                ?>
                            </select>
                        </div>
                    </div>


                    <div class="form-actions">
                        <input type="submit" value="Dodaj slajder" class="btn btn-primary pull-right">
                    </div>
                </form>
            </div>
        </div>
        <!-- /Validation Example 1 -->
    </div>
</div>
<!-- /Page Content -->
