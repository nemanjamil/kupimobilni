<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 24.11.15.
 * Time: 16.43
 */

$db->where("IdPdvListaPoreza", $id);
$data = $db->get("pdvlistaporeza");

foreach ($data as $link) {

    $IdPdvListaPoreza = $link['IdPdvListaPoreza'];
    $PorezVrednost = $link['PorezVrednost'];
}

?>
<div class="row">
    <div class="col-md-12 col-xs-6x">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-th-large"></i>Izmeni porez</h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>
            <div class="widget-content">

                <form enctype="multipart/form-data" class="form-horizontal row-border" method="post" id="validate-1"
                      action="/akcija.php?action=editporez">

                    <div class="form-group">
                        <label class="col-md-3 control-label">Naziv</label>

                        <div class="col-md-9">
                        <input type="hidden" value="<?php echo $IdPdvListaPoreza; ?>" id="IdPdvListaPoreza" name="IdPdvListaPoreza">

                            <input type="number" min="0" name="naziv" id="naziv"
                            class="form-control required"
                            required="required" value="<?php echo $PorezVrednost; ?>">


                        </div>
                    </div>


                    <div class="form-actions">
                        <input type="submit" value="Izmeni porez" class="btn btn-primary pull-right">
                    </div>
                </form>

            </div>
        </div>
        <!-- /Validation Example 1 -->
    </div>


</div>
