<?php
/**
 * Project: masinealati
 * Created by PhpStorm.
 * User: Nikola
 * Date: 21. 09. 2016.
 * Time: 19:50
 */

$db->where("IdLanguage = '$id' ");
$data = $db->get("languagejezik");

foreach ($data as $link) {

    $IdLanguage = $link['IdLanguage'];
    $NameLanguage = $link['NameLanguage'];
    $ShortLanguage = $link['ShortLanguage'];
    $ActiveLanguage = $link['ActiveLanguage'];
}

?>
<div class="row">
    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-reorder"></i> Edit Jezika: <?php echo $NameLanguage; ?></h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>
            <div class="widget-content">
                <div class="widget-content">

                    <form enctype="multipart/form-data" method="post" class="form-horizontal row-border"
                          id="validate-2" action="/akcija.php?action=izmenijezik">

                        <!--Naziv-->
                        <div class="form-group">
                            <label class="col-md-3 control-label">Naziv Jezika </label>

                            <div class="col-md-9">
                                <input type="text" name="NameLanguage" id="NameLanguage"
                                       class="form-control" required="required"
                                       value="<?php echo $NameLanguage; ?>">

                                <input type="hidden" name="IdLanguage" id="IdLanguage"
                                       class="form-control" required="required"
                                       value="<?php echo $IdLanguage; ?>">

                            </div>
                        </div>

                        <!--Short-->
                        <div class="form-group">
                            <label class="col-md-3 control-label">Kratki naziv</label>

                            <div class="col-md-9">
                                <input type="text" name="ShortLanguage" id="ShortLanguage"
                                       class="form-control" required="required"
                                       value="<?php echo $ShortLanguage; ?>">

                            </div>
                        </div>

                        <!--Active-->
                        <div class="form-group">
                            <label class="col-md-3 control-label">Aktivno</label>

                            <div class="col-md-9">
                                <select id="ActiveJezik" name="ActiveLanguage"
                                        class="form-control" required="required"
                                        value="<?php echo $ActiveLanguage; ?>">
                                    <option value="0"<?php echo ($ActiveLanguage == 0) ? 'selected' : ''; ?> >
                                        Neaktivan
                                    </option>
                                    <option value="1"<?php echo ($ActiveLanguage == 1) ? 'selected' : ''; ?> >
                                        Aktivan
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-actions">
                            <input type="submit" value="Izmeni jezik" class="btn btn-primary pull-right">
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
</div>
