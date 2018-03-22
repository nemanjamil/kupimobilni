<?php
/**
 * Created by PhpStorm.
 * User: Nikola
 * Date: 16.11.2015.
 * Time: 10.54
 */

$db->where("IdKulturaLokacija", $id);
$data = $db->get("kulturalokacija KL", null, "KL.*");

foreach ($data as $link) {

    $IdKulturaLokacija = $link['IdKulturaLokacija'];
    $NazivKulturaLokacija = $link['NazivKulturaLokacija'];
    $PovKulture = $link['PovKulture'];
    $PovLokSamouprava = $link['PovLokSamouprava'];

}
?>
<div class="row">
    <div class="col-md-12 col-xs-6x">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-th-large"></i>Kultura i lokacija</h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>
            <div class="widget-content">

                <form enctype="multipart/form-data" class="form-horizontal row-border" method="post" id="validate-1"
                      action="/akcija.php?action=editlokkulture">

                    <div class="form-group">
                        <label class="col-md-3 control-label">Naziv</label>

                        <div class="col-md-9">
                        <input type="hidden" value="<?php echo $IdKulturaLokacija; ?>" id="IdKulturaLokacija" name="IdKulturaLokacija">

                            <input type="text" name="naziv" id="naziv"
                            class="form-control required"
                            required="required" value="<?php echo $NazivKulturaLokacija; ?>">


                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Kultura</label>

                        <div class="col-md-9">

                            <select id="PovKulture" name="PovKulture"
                                    class="select2 required full-width-fix">

                                <?php
                                $data = $db->get('kulture');
                                foreach ($data as $sds => $s) {
                                    $IdKulture = $s['IdKulture'];
                                    $ImeKulture = $s['ImeKulture'];
                                    $selektovano = ($PovKulture == $IdKulture) ? 'selected' : ''

                                    ?>
                                    <option
                                        value="<?php echo $IdKulture; ?>" <?php echo $selektovano ?>><?php echo $ImeKulture; ?></option>
                                <?php } ?>
                            </select>

                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-3 control-label">Lokacija</label>

                        <div class="col-md-9">

                            <select id="PovLokSamouprava" name="PovLokSamouprava"
                                    class="select2 required full-width-fix">

                                <?php
                                $data = $db->get('lokalnasu');
                                foreach ($data as $sds => $s) {
                                    $IdLokSamo = $s['IdLokSamo'];
                                    $ImeLokSamo = $s['ImeLokSamo'];
                                    $selektovano = ($PovLokSamouprava == $IdLokSamo) ? 'selected' : ''

                                    ?>
                                    <option
                                        value="<?php echo $IdLokSamo; ?>" <?php echo $selektovano ?>><?php echo $ImeLokSamo; ?></option>
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
