<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 10. 12. 2015.
 * Time: 09:11
 */

?>
<div class="row">
    <div class="col-md-12 col-xs-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-th-large"></i> Opis notifikacija senzora</h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>
            <div class="widget-content">

                <form enctype="multipart/form-data" class="form-horizontal row-border" method="post" id="validate-1"
                      action="/akcija.php?action=dodajopisnotif">

                    <div class="form-group">
                        <label class="col-md-2 control-label">Tip notifikacije</label>

                        <div class="col-md-10">

                            <select id="IdSenNotNotifikacija" name="IdSenNotNotifikacija"
                                    class="select2 required full-width-fix">
                                <option value=""></option>
                                <?php
                                $data = $db->get('tipnotifikacije');
                                foreach ($data as $sds => $s) {
                                    echo '<option value="' . $s['IdTipNotifikacijeIncr'] . '">' . $s['OpisNotifikacije'] . '</option>' . "\n";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Tip senzora</label>

                        <div class="col-md-10">

                            <select id="IdSenNotSenzor" name="IdSenNotSenzor"
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


                    <div class="form-group">
                        <label class="col-md-2 control-label">Zuta zona</label>

                        <div class="col-md-10">
                            <select id="IdSenNotVecaManja" name="IdSenNotVecaManja"
                                    class="select2 required full-width-fix">
                                <option value=""></option>
                                <option value="0">Donja zona</option>
                                <option value="1">Gornja zona</option>
                            </select>
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Opis Notifikacije</label>

                        <div class="col-md-10">
                            <textarea rows="3" name="OpisSenNot" class="form-control"> </textarea>
                        </div>
                    </div>

                    <div class="form-actions">
                        <input type="submit" value="Dodaj notifikaciju" class="btn btn-primary pull-right">
                    </div>
                </form>

            </div>
        </div>
        <!-- /Validation Example 1 -->
    </div>
</div>
<?php include 'listasenznotif.php' ?>