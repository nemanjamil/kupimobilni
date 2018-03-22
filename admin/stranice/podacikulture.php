<?php
/**
 * Created by PhpStorm.
 * User: NemanjaMilivojevic
 * Date: 1.8.15.
 * Time: 11.54
 */

?>
<div class="row">
    <div class="col-md-12 col-xs-6x">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-th-large"></i> Kultura, lokacija i senzori - Podaci Kulture</h4>
                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>
            <div class="widget-content">

                <form enctype="multipart/form-data" class="form-horizontal row-border" method="post" id="validate-1"
                      action="/akcija.php?action=dodajpodkulturi">

                    <div class="form-group">
                        <label class="col-md-3 control-label">Naziv </label>

                        <div class="col-md-9">

                            <input type="text" name="naziv" id="naziv"
                                   class="form-control required"
                                   required="required">

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Kultura</label>

                        <div class="col-md-9">

                            <select id="IdKultureKulLok" name="IdKultureKulLok"
                                    class="select2 required full-width-fix">
                                <option value=""></option>
                                <?php
                                $data = $db->get('kulturalokacija');
                                foreach ($data as $sds => $s) {
                                    echo '<option value="' . $s['IdKulturaLokacija'] . '">' . $s['NazivKulturaLokacija'] . '</option>' . "\n";
                                }
                                ?>
                            </select>

                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-3 control-label">Senzor</label>

                        <div class="col-md-9">

                            <select id="senzorTipIme" name="senzorTipIme"
                                    class="select2 required full-width-fix">
                                <option value=""></option>
                                <?php
                                $data = $db->get('senzortip');
                                foreach ($data as $sds => $s) {
                                    echo '<option value="' . $s['IdSenzorTip'] . '">' . $s['senzorTipIme'] . '</option>' . "\n";
                                }
                                ?>
                            </select>

                        </div>
                    </div>


                    <div class="form-actions">
                        <input type="submit" value="Dodaj podatke" class="btn btn-primary pull-right">
                    </div>
                </form>

            </div>
        </div>
        <!-- /Validation Example 1 -->
    </div>



    <?php include 'listapodacikulture.php' ?>
</div>
