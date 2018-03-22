<?php
/**
 * Project: masinealati
 * Created by PhpStorm.
 * User: Nikola
 * Date: 21. 09. 2016.
 * Time: 19:50
 */

$db->where("MagacinId = '$id' ");
$data = $db->get("magacin");

foreach ($data as $link) {

    $MagacinId = $link['MagacinId'];
    $MagacinNaziv = $link['MagacinNaziv'];
    $MagacinSifra = $link['MagacinSifra'];
    $MagacinActive = $link['MagacinActive'];
}

?>
<div class="row">
    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-reorder"></i> Izmeni magacin: <?php echo $MagacinNaziv; ?></h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>
            <div class="widget-content">
                <div class="widget-content">

                    <form enctype="multipart/form-data" method="post" class="form-horizontal row-border"
                          id="validate-2" action="/akcija.php?action=izmenimagacin">

                        <!--Naziv-->
                        <div class="form-group">
                            <label class="col-md-3 control-label">Naziv Jezika </label>

                            <div class="col-md-9">
                                <input type="text" name="MagacinNaziv" id="MagacinNaziv"
                                       class="form-control" required="required"
                                       value="<?php echo $MagacinNaziv; ?>">

                                <input type="hidden" name="MagacinId" id="MagacinId"
                                       class="form-control" required="required"
                                       value="<?php echo $MagacinId; ?>">

                            </div>
                        </div>

                        <!--Short-->
                        <div class="form-group">
                            <label class="col-md-3 control-label">Sifra magacina</label>

                            <div class="col-md-9">
                                <input type="text" name="MagacinSifra" id="MagacinSifra"
                                       class="form-control" required="required"
                                       value="<?php echo $MagacinSifra; ?>">

                            </div>
                        </div>

                        <!--Active-->
                        <div class="form-group">
                            <label class="col-md-3 control-label">Aktivno</label>

                            <div class="col-md-9">
                                <select id="MagacinActive" name="MagacinActive"
                                        class="form-control" required="required"
                                        value="<?php echo $MagacinActive; ?>">
                                    <option value="0"<?php echo ($MagacinActive == 0) ? 'selected' : ''; ?> >
                                        Neaktivan
                                    </option>
                                    <option value="1"<?php echo ($MagacinActive == 1) ? 'selected' : ''; ?> >
                                        Aktivan
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-actions">
                            <input type="submit" value="Izmeni magacin" class="btn btn-primary pull-right">
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
</div>
