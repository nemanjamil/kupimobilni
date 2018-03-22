<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 10. 12. 2015.
 * Time: 09:30
 */

$db->where("idSenNoti", $id);
$data = $db->get("opissenzornotifikacija OS", null, "OS.*");

foreach ($data as $link) {

    $idSenNoti = $link['idSenNoti'];
    $IdSenNotNotifikacija = $link['IdSenNotNotifikacija'];
    $IdSenNotSenzor = $link['IdSenNotSenzor'];
    $IdSenNotVecaManja = $link['IdSenNotVecaManja'];
    $OpisSenNot = $link['OpisSenNot'];

}
?>
<div class="row">
    <div class="col-md-12 col-xs-6x">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-th-large"></i> Podaci kulture</h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>

            <div class="widget-content">
                <form enctype="multipart/form-data" class="form-horizontal row-border" method="post" id="validate-1"
                      action="/akcija.php?action=editopisnotif">


                    <input type="hidden" name="id" id="id" value="<?php echo $idSenNoti ?>">

                    <div class="form-group">
                        <label class="col-md-2 control-label">Tip notifikacije</label>

                        <div class="col-md-10">

                            <select id="IdSenNotNotifikacija" name="IdSenNotNotifikacija"
                                    class="select2 required full-width-fix">
                                <?php
                                $data = $db->get("tipnotifikacije");
                                foreach ($data as $sds => $s) {
                                    $IdTipNotifikacije = $s['IdTipNotifikacijeIncr'];
                                    $OpisNotifikacije = $s['OpisNotifikacije'];
                                    $selektovano = ($IdSenNotNotifikacija == $IdTipNotifikacije) ? 'selected' : '' ?>
                                    <option
                                        value="<?php echo $IdTipNotifikacije; ?>" <?php echo $selektovano ?>><?php echo $OpisNotifikacije; ?></option> <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Tip senzora</label>

                        <div class="col-md-10">

                            <select id="IdSenNotSenzor" name="IdSenNotSenzor"
                                    class="select2 required full-width-fix">
                                <?php
                                $data = $db->get("senzortip");
                                foreach ($data as $sds => $s) {
                                    $IdSenzorTip = $s['IdSenzorTip'];
                                    $senzorTipIme = $s['senzorTipIme'];
                                    $selektovano = ($IdSenNotSenzor == $IdSenzorTip) ? 'selected' : '' ?>
                                    <option
                                        value="<?php echo $IdSenzorTip; ?>" <?php echo $selektovano ?>><?php echo $senzorTipIme; ?></option> <?php } ?>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-2 control-label">Zuta zona</label>

                        <div class="col-md-10">
                            <select id="IdSenNotVecaManja" name="IdSenNotVecaManja"
                                    class="select2 required full-width-fix">
                                <option value="0"<?php echo ($IdSenNotVecaManja == 0) ? 'selected' : ''; ?> >Donja
                                    zona
                                </option>
                                <option value="1"<?php echo ($IdSenNotVecaManja == 1) ? 'selected' : ''; ?> >Gornja
                                    zona
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Opis</label>

                        <div class="col-md-10">
                            <textarea rows="3" name="OpisSenNot"
                                      class="form-control"><?php echo $OpisSenNot ?> </textarea>
                        </div>
                    </div>
            </div>

            <div class="form-actions">
                <input type="submit" value="Izmeni notifikaciju" class="btn btn-primary pull-right">
            </div>
            </form>

        </div>
    </div>
    <!-- /Validation Example 1 -->
</div>
