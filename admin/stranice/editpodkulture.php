<?php
/**
 * Created by PhpStorm.
 * User: Nikola
 * Date: 16.11.2015.
 * Time: 10.54
 */

$db->where("IdKulLokPodaci", $id);

$data = $db->get("senzorkullokpodaci SK", null, "SK.*");

foreach ($data as $link) {

    $IdKulLokPodaci = $link['IdKulLokPodaci'];
    $NazivKulLokPod = $link['NazivKulLokPod'];
    $IdTipKulTipLok = $link['IdTipKulTipLok'];
    $IdKultureKulLok = $link['IdKultureKulLok'];



}
?>
<div class="row">
    <div class="col-md-12 col-xs-6x">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-th-large"></i> Kultura, lokacija i senzori</h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>
            <div class="widget-content">

                <form enctype="multipart/form-data" class="form-horizontal row-border" method="post" id="validate-1"
                      action="/akcija.php?action=editpodkulture">

                    <div class="form-group">
                        <label class="col-md-3 control-label">Naziv</label>

                        <div class="col-md-9">

                            <input type="text" name="naziv" id="naziv"
                                   class="form-control required"
                                   required="required" value="<?php echo $NazivKulLokPod; ?>">

                            <input type="hidden" value="<?php echo $IdKulLokPodaci; ?>" id="IdKulLokPodaci" name="IdKulLokPodaci">

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Kultura</label>

                        <div class="col-md-9">

                            <select id="IdKultureKulLok" name="IdKultureKulLok"
                                    class="select2 required full-width-fix">

                                <?php
                                $data = $db->get('kulturalokacija');
                                foreach ($data as $sds => $s) {
                                    $IdKulture = $s['IdKulturaLokacija'];
                                    $ImeKulture = $s['NazivKulturaLokacija'];
                                    $selektovano = ($IdKultureKulLok == $IdKulture) ? 'selected' : ''

                                    ?>
                                    <option
                                        value="<?php echo $IdKulture; ?>" <?php echo $selektovano ?>><?php echo $ImeKulture; ?></option>
                                <?php } ?>
                            </select>

                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-3 control-label">Senzor</label>

                        <div class="col-md-9">

                            <select id="senzorTipIme" name="senzorTipIme"
                                    class="select2 required full-width-fix">

                                <?php
                                $data = $db->get('senzortip');
                                foreach ($data as $sds => $s) {
                                    $IdSenzorTip = $s['IdSenzorTip'];
                                    $senzorTipIme = $s['senzorTipIme'];
                                    $selektovano = ($IdTipKulTipLok == $IdSenzorTip) ? 'selected' : ''

                                    ?>
                                    <option
                                        value="<?php echo $IdSenzorTip; ?>" <?php echo $selektovano ?>><?php echo $senzorTipIme; ?></option>
                                <?php } ?>


                            </select>

                        </div>
                    </div>

                    <div class="form-actions">
                        <input type="submit" value="Izmeni podatke" class="btn btn-primary pull-right">
                    </div>
                </form>

            </div>
        </div>
        <!-- /Validation Example 1 -->
    </div>


</div>
