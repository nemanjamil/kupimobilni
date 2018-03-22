<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 13. 08. 2015.
 * Time: 16:47
 */

$id = $common->clearvariable($_GET[id]);

$db->where("IdListaSenzora", $id);
$senz = $db->getOne("listasenzora");


$SenzorSifra = $senz['SenzorSifra'];
$IdSenzArt = $senz['IdSenzArt'];

?>
<div class="row">
    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-reorder"></i> Izmeni novi senzor: (<code><?php echo $SenzorSifra; ?></code>)</h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>

            <div class="widget-content">

                <form enctype="multipart/form-data" method="post" class="form-horizontal row-border" id="validate-2"
                      action="/akcija.php?action=editsenzid">

                    <div class="form-group">
                        <label class="col-md-2 control-label">Novi senzor </label>

                        <div class="col-md-10">
                            <div class="col-md-10">
                                <select id="SenzorSifra" name="SenzorSifra"
                                        class="select2 required full-width-fix">
                                    <?php
                                    $data = $db->get('listasenzora');
                                    foreach ($data as $sds => $s) {
                                        echo '<option value="' . $s['IdListaSenzora'] . '">' . $s['SenzorSifra'] . '</option>' . "\n";
                                    }
                                    ?>
                                </select>
                            </div>
                            <input type="hidden" name="IdListaSenzora" id="IdListaSenzora" value="<?php echo $id ?>">
                        </div>
                    </div>

                    <div class="form-actions">
                        <input type="submit" value="Izmeni senzor" class="btn btn-primary pull-right">
                    </div>
                </form>
            </div>
        </div>
        <!-- /Validation Example 1 -->
    </div>
    <!-- /no-padding -->
</div>