<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 16.10.15.
 * Time: 11:37
 */
?>

<!--=== Page Content ===-->
<div class="row">
    <div class="col-md-7">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-reorder"></i>Varijable</h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>

            <div class="widget-content">

                <form enctype="multipart/form-data" method="post" class="form-horizontal row-border" id="validate-1"
                      action="/akcija.php?action=dodajsetvarijablu">

                    <div class="form-group">
                        <label class="col-md-3 control-label">Naziv varijable</label>

                        <div class="col-md-9">
                            <input type="text" name="imestanja" id="imestanja" class="form-control" required="required">
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
                        <input type="submit" value="Dodaj varijablu" class="btn btn-primary pull-right">
                    </div>

                </form>
            </div>
        </div>
    </div>

    <?php include 'listavarijablistanja.php' ?>
</div>

<!-- /Page Content -->
