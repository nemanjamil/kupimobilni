<?php
/**
 * Created by PhpStorm.
 * User: NemanjaMilivojevic
 * Date: 30.7.15.
 * Time: 22.40
 */

?>

<!--=== Page Content ===-->
<div class="row">

    <?php include 'listatag.php' ?>

    <div class="col-md-6">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-tag"></i> Dodaj Tag</h4>
            </div>
            <div class="widget-content">
                <form enctype="multipart/form-data" method="post" class="form-horizontal row-border" id="validate-2"
                      action="/akcija.php?action=dodajtag">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Naziv </label>
                        <div class="col-md-9">
                            <input type="text" name="nazivtag" id="nazivtag" class="form-control required">
                        </div>
                    </div>

                    <div class="form-actions">
                        <input type="submit" value="Unesi tag" class="btn btn-primary pull-right">
                    </div>
                </form>
            </div>
        </div>
        <!-- /Validation Example 1 -->
    </div>
</div>

<!-- /Page Content -->
