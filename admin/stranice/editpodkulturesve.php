<?php

$db->where("IdPodaciKulTipLok", $id);
$data = $db->get("podacikultiplok PK", null, "PK.*");

foreach ($data as $link) {

    $IdPodaciKulTipLok = $link['IdPodaciKulTipLok'];
    $IdKulLokPodaciGlv = $link['IdKulLokPodaci'];
    $OdPodaciIdeal = $link['OdPodaciIdeal'];
    $DoPodaciIdeal = $link['DoPodaciIdeal'];
    $OdZutoIdeal = $link['OdZutoIdeal'];
    $DoZutoIdeal = $link['DoZutoIdeal'];

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
                      action="/akcija.php?action=editpodkulturesve">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Senzor</label>

                        <div class="col-md-10">
                            <select id="IdSenzorKulPodLok" name="IdSenzorKulPodLok"
                                    class="select2 required full-width-fix">
                                <?php
                                $data = $db->get("senzorkullokpodaci");
                                foreach ($data as $sds => $s) {
                                    $IdKulLokPodaci = $s['IdKulLokPodaci'];
                                    $NazivKulLokPod = $s['NazivKulLokPod'];
                                    $selektovano = ($IdKulLokPodaciGlv == $IdKulLokPodaci) ? 'selected' : '' ?>
                                    <option
                                        value="<?php echo $IdKulLokPodaci; ?>" <?php echo $selektovano ?>><?php echo $NazivKulLokPod; ?></option> <?php } ?>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-2 control-label">Idealno od </label>

                        <div class="col-md-10">
                            <input type="hidden" value="<?php echo $IdPodaciKulTipLok; ?>" id="IdPodaciKulTipLok"
                                   name="IdPodaciKulTipLok">

                            <input type="number" step="0.1" min="0" name="OdPodaciIdeal" id="OdPodaciIdeal"
                                   class="form-control required"
                                   required="required" value="<?php echo $OdPodaciIdeal; ?>">

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Idealno do </label>

                        <div class="col-md-10">

                            <input type="number" step="0.1" min="0" name="DoPodaciIdeal" id="DoPodaciIdeal"
                                   class="form-control required"
                                   required="required" value="<?php echo $DoPodaciIdeal; ?>">

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Zuto od </label>

                        <div class="col-md-10">

                            <input type="number" step="0.1" min="0" name="OdZutoIdeal" id="OdZutoIdeal"
                                   class="form-control required"
                                   required="required" value="<?php echo $OdZutoIdeal; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Zuto do </label>

                        <div class="col-md-10">

                            <input type="number" step="0.1" min="0" name="DoZutoIdeal" id="DoZutoIdeal"
                                   class="form-control required"
                                   required="required" value="<?php echo $DoZutoIdeal; ?>">

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
