<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 12. 08. 2015.
 * Time: 15:22
 */

$db->where("TagoviId", $id);

$tag = $db->getOne("tagovi");
$TagoviId = $tag['TagoviId'];
$TagoviIme = $tag['TagoviIme'];

//var_dump($tag);

?>

<!--=== Page Content ===-->
<div class="row">

    <div class="col-md-6">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-tag"></i> Izmeni Tag</h4>
            </div>
            <div class="widget-content">
                <form enctype="multipart/form-data" method="post" class="form-horizontal row-border" id="validate-2"
                      action="/akcija.php?action=edittag">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Naziv </label>

                        <div class="col-md-9">
                            <input type="text" name="nazivtag" id="nazivtag" class="form-control required"
                                   value="<?php echo $TagoviIme ?>">
                            <input type="hidden" name="id" id="id" value="<?php echo $TagoviId ?>">

                        </div>
                    </div>

                    <div class="form-actions">
                        <input type="submit" value="Izmeni tag" class="btn btn-primary pull-right">
                    </div>
                </form>
            </div>
        </div>
        <!-- /Validation Example 1 -->
    </div>
</div>

<!-- /Page Content -->
