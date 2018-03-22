<?php
/**
 * Created by PhpStorm.
 * User: Nikola
 * Date: 17.11.15.
 * Time: 11.54
 */

?>
<div class="row">
    <div class="col-md-12 col-xs-6x">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-th-large"></i> Podaci kulture </h4>
                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>
            <div class="widget-content">

                <form enctype="multipart/form-data" class="form-horizontal row-border" method="post" id="validate-1"
                      action="/akcija.php?action=dodajpodkulturisve">



                    <div class="form-group">
                        <label class="col-md-2 control-label">Kultura</label>

                        <div class="col-md-10">

                            <select id="IdSenzorKulPodLok" name="IdSenzorKulPodLok"
                                    class="select2 required full-width-fix">
                                <option value=""></option>
                                <?php
                                $data = $db->get("senzorkullokpodaci" );
                                foreach ($data as $sds => $s) {
                                    echo '<option value="' . $s['IdKulLokPodaci'] . '">' . $s['NazivKulLokPod']  . "\n";
                                }
                                ?>
                            </select>

                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-2 control-label">Idealno od </label>

                        <div class="col-md-10">

                            <input type="number" step="0.1" min="0"  name="OdPodaciIdeal" id="OdPodaciIdeal"
                                   class="form-control required"
                                   required="required">

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Idealno do </label>

                        <div class="col-md-10">

                            <input type="number" step="0.1" min="0"  name="DoPodaciIdeal" id="DoPodaciIdeal"
                                    class="form-control required"
                                    required="required">

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Zuto od </label>

                        <div class="col-md-10">

                            <input type="number" step="0.1" min="0"  name="OdZutoIdeal" id="OdZutoIdeal"
                                   class="form-control required"
                                   required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Zuto do </label>

                        <div class="col-md-10">

                            <input type="number" step="0.1" min="0"  name="DoZutoIdeal" id="DoZutoIdeal"
                                   class="form-control required"
                                   required="required">

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



    <?php include 'listapodacikulturesve.php' ?>
</div>
