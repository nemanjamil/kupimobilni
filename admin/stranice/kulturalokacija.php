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
                <h4><i class="icon-th-large"></i> Kultura i lokacija</h4>
                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>
            <div class="widget-content">

                <form enctype="multipart/form-data" class="form-horizontal row-border" method="post" id="validate-1"
                      action="/akcija.php?action=dodajlokkulturi">

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

                            <select id="PovKulture" name="PovKulture"
                                    class="select2 required full-width-fix">
                                <option value=""></option>
                                <?php
                                $data = $db->get('kulture');
                                foreach ($data as $sds => $s) {
                                    echo '<option value="' . $s['IdKulture'] . '">' . $s['ImeKulture'] . '</option>' . "\n";
                                }
                                ?>
                            </select>

                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-3 control-label">Lokacija</label>

                        <div class="col-md-9">

                            <select id="PovLokSamouprava" name="PovLokSamouprava"
                                    class="select2 required full-width-fix">
                                <option value=""></option>
                                <?php
                                $data = $db->get('lokalnasu');
                                foreach ($data as $sds => $s) {
                                    echo '<option value="' . $s['IdLokSamo'] . '">' . $s['ImeLokSamo'] . '</option>' . "\n";
                                }
                                ?>
                            </select>

                        </div>
                    </div>


                    <div class="form-actions">
                        <input type="submit" value="Dodaj lokaciju" class="btn btn-primary pull-right">
                    </div>
                </form>

            </div>
        </div>
        <!-- /Validation Example 1 -->
    </div>



    <?php include 'listalokacijakulture.php' ?>
</div>
