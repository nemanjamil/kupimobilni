<?php
/**
 * Created by PhpStorm.
 * User: Nikola Markovic
 * Date: 12.10.2017.
 * Time: 8:23
 */
$KomitentId = $_GET['id'];

$db->where('KomitentId', $KomitentId);
$upit = $db->getOne('komitenti', null);
$KomitentIdUpit = $upit['KomitentId'];
$KomitentSaltUpit = $upit['KomitentSalt'];

?>



<div class="col-md-12">
    <div class="widget box">
        <div class="widget-header">
            <h4><i class="icon-reorder"></i>Izmeni lozinku</h4>

            <div class="toolbar no-padding">
                <div class="btn-group">
                    <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                </div>
            </div>
        </div>
        <div class="widget-content">
            <form enctype="multipart/form-data" method="post" class="form-horizontal row-border" id="validate-1"
                  action="/akcija.php?action=izmenilozinkukorisnika">

                <div class="form-group">
                    <label class="col-md-2 control-label">Lozinka<span class="required">*</span></label>

                    <div class="col-md-10">
                        <input type="password" name="pass" id="password" class="form-control required">
                        <input type="hidden" name="id" value="<?php echo $KomitentIdUpit; ?>"
                               class="form-control required">
                        <input type="hidden" name="salt" value="<?php echo $KomitentSaltUpit; ?>"
                               class="form-control required">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">Ponovi lozinku<span class="required">*</span></label>

                    <div class="col-md-10">
                        <input type="password" name="passduo" id="confirm_password" class="form-control required">
                    </div>
                </div>

                <div class="form-actions">
                    <input type="submit" value="Izmeni lozniku" class="btn btn-primary pull-right">
                </div>
            </form>
        </div>
    </div>
</div>
