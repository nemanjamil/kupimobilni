<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 26. 08. 2015.
 * Time: 00:22
 */

$db->where("IdVerKomi", $id);

$tag = $db->getOne("verikomitent");
$IdVerKomi = $tag['IdVerKomi'];
$OpisVerKomit = $tag['OpisVerKomit'];
$OcenaVeriKomi = $tag['OcenaVeriKomi'];

//var_dump($tag);

?>

<!--=== Page Content ===-->
<div class="row">

    <div class="col-md-9">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-tag"></i> Izmeni Verifikaciju</h4>
            </div>
            <div class="widget-content">
                <form enctype="multipart/form-data" method="post" class="form-horizontal row-border" id="validate-2"
                      action="/akcija.php?action=editverifdib">

                    <div class="form-group">
                        <label class="col-md-3 control-label">Ocena verifikacije </label>

                        <div class="col-md-9">
                            <input type="text" name="string" id="string" class="form-control required"
                                   value="<?php echo $OcenaVeriKomi ?>">


                            <input type="hidden" name="id" id="id" value="<?php echo $IdVerKomi ?>">

                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-3 control-label">Opis verifikacije </label>

                        <div class="col-md-9">
                            <input type="text" name="naziv" id="naziv" class="form-control required"
                                   value="<?php echo $OpisVerKomit ?>">

                        </div>
                    </div>

                    <div class="form-actions">
                        <input type="submit" value="Izmeni verifikaciju" class="btn btn-primary pull-right">
                    </div>
                </form>
            </div>
        </div>
        <!-- /Validation Example 1 -->
    </div>
</div>

<!-- /Page Content -->
