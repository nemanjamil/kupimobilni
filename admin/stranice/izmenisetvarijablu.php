<?php
/**
 * Created by PhpStorm.
 * User: Nikola
 * Date: 19.10.15.
 * Time: 10:37
 */


$db->where("BR.imestanja = '$string'");
$links = $db->get("setovanjevarijabli BR", null);


if ($links) {
    foreach ($links as $link) {

        $imestanja = $link['imestanja'];
        $vrednoststanja = $link['vrednoststanja'];
    }
} else {
    echo 'Nema nesto od informacija';
    die;

}

?>

<!--=== Page Content ===-->
<div class="row">
    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-reorder"></i>Izmena varijabli</h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>

            <div class="widget-content">

                <form enctype="multipart/form-data" method="post" class="form-horizontal row-border" id="validate-1"
                      action="/akcija.php?action=izmenisetvarijablu">

                  <div class="form-group">
                        <label class="col-md-3 control-label">Brend link </label>

                        <div class="col-md-9">
                            <input type="text" required="required" disabled
                                   class="form-control" value="<?php echo $imestanja; ?>">

                            <input type="hidden" required="required" name="imestanja" id="imestanja" hidden="hidden"
                                   class="form-control" value="<?php echo $imestanja; ?>">

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Vrednost stanja</label>

                        <div class="col-md-9">
                            <select id="vrednoststanja" name="vrednoststanja"
                                    class="form-control  required" value="<?php echo $vrednoststanja; ?>">
                                <option value="0"<?php echo ($vrednoststanja == 0) ? 'selected' : ''; ?> >Neaktivan
                                </option>
                                <option value="1"<?php echo ($vrednoststanja == 1) ? 'selected' : ''; ?> >Aktivan
                                </option>
                            </select>
                        </div>
                    </div>


                    <!--Button unesi-->
                    <div class="form-actions">
                        <input type="submit" value="Izmeni varijablu" class="btn btn-primary pull-right">
                    </div>

                </form>
            </div>
        </div>
    </div>

</div>

<!-- /Page Content -->
