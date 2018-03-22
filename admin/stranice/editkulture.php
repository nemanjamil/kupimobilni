<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 26. 08. 2015.
 * Time: 00:22
 */

$db->where("IdKulture", $id);

$tag = $db->getOne("kulture");
$IdKulture = $tag['IdKulture'];
$ImeKulture = $tag['ImeKulture'];
$SlikaKulture = $tag['SlikaKulture'];
$scientific = $tag['scientific'];
$opisKultura = $tag['opisKultura'];
$kulturaVoda = $tag['kulturaVoda'];
$kulturaSun = $tag['kulturaSun'];
$kulturaTemp = $tag['kulturaTemp'];
$kulturaMoisture = $tag['kulturaMoisture'];
?>

<!--=== Page Content ===-->
<div class="row">

    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-tag"></i> Izmeni kulturu</h4>
            </div>
            <div class="widget-content">
                <form enctype="multipart/form-data" method="post" class="form-horizontal row-border" id="validate-2"
                      action="/akcija.php?action=editkulture">


                    <div class="form-group">
                        <label class="col-md-3 control-label">Naziv kulture</label>
                        <div class="col-md-9">
                            <input type="text" name="naziv" id="naziv" class="form-control required"
                                   value="<?php echo $ImeKulture ?>">
                            <input type="hidden" name="id" id="id" value="<?php echo $IdKulture ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Slika za Kulturu - MALA</label>
                        <div class="col-md-4">
                            <input type="file" name="slikeMultipleKulture"
                                   class="with-preview accept-gif|jpg|png fileIgnorisi"/>
                            <span class="help-block">treba da bude srazmerna slika min 400x400 px i da BUDE PNG</span>
                        </div>
                        <div class="col-md-5">
                            <?php
                            $slika = $common->locationslikaOstalo(KULTURESLIKELOK, $IdKulture);

                            $ext = pathinfo($SlikaKulture, PATHINFO_EXTENSION);
                            $fileName = pathinfo($SlikaKulture, PATHINFO_FILENAME);

                            $mala_slika = $fileName . '.' . $ext;
                            $lok = DCROOT . $slika . '/' . $mala_slika;

                            if (file_exists($lok)) {
                                echo '<img src="' . $slika . '/' . $mala_slika . '" alt="">';
                            }
                            ?>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-3 control-label">Scientific name:</label>
                        <div class="col-md-9"><input name="scientific" class="form-control required" type="text" value="<?php echo $scientific; ?>"></div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-3 control-label">Opis:</label>
                        <div class="col-md-9">
                            <textarea rows="10" name="opisKultura" class="form-control required mceEditor"><?php echo $opisKultura; ?></textarea>
                            <!--<textarea rows="10" name="opisKultura" class="form-control required wysiwyg"></textarea>-->
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Water:</label>
                        <div class="col-md-9">
                            <select id="kulturaVoda" name="kulturaVoda" class="select2 required full-width-fix">
                                <option value="" ></option>
                                <?php
                                for ($i=0;$i<=10;$i++) {
                                    $sel = ($i==$kulturaVoda) ? 'selected' : '';
                                    echo '<option value="'.$i.'" '.$sel.'>'.$i.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">SunLight:</label>
                        <div class="col-md-9">
                            <select id="kulturaSun" name="kulturaSun" class="select2 required full-width-fix">
                                <option value=""></option>
                                <?php
                                for ($i=0;$i<=10;$i++) {
                                    $sel = ($i==$kulturaSun) ? 'selected' : '';
                                    echo '<option value="'.$i.'" '.$sel.'>'.$i.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">SunLight:</label>
                        <div class="col-md-9">
                            <select id="kulturaTemp" name="kulturaTemp" class="select2 required full-width-fix">
                                <option value=""></option>
                                <?php
                                for ($i=0;$i<=10;$i++) {
                                    $sel = ($i==$kulturaTemp) ? 'selected' : '';
                                    echo '<option value="'.$i.'" '.$sel.'>'.$i.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">SunLight:</label>
                        <div class="col-md-9">
                            <select id="kulturaMoisture" name="kulturaMoisture" class="select2 required full-width-fix">
                                <option value=""></option>
                                <?php
                                for ($i=0;$i<=10;$i++) {
                                    $sel = ($i==$kulturaMoisture) ? 'selected' : '';
                                    echo '<option value="'.$i.'" '.$sel.'>'.$i.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>


                    <div class="form-actions">
                        <input type="submit" value="Izmeni kulturu" class="btn btn-primary pull-right">
                    </div>
                </form>
            </div>
        </div>
        <!-- /Validation Example 1 -->
    </div>

    <?php
    require "listaPodatakaOkulturi.php";
    ?>

</div>


<?php
require "dodajPodatkeFloatZaKulturu.php";
?>
