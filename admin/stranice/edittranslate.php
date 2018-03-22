<?php
/**
 * Created by PhpStorm.
 * User: ITCluster Serbia
 * Date: 27.4.2016.
 * Time: 13:59
 */

$db ->where("IdTranslate = '$id' ");
$data = $db->get("translate ", null, "IdTranslate, srblat");

foreach ($data as $link) {

    $IdTranslate = $link['IdTranslate'];
    $srblat = $link['srblat'];
}
?>
        <div class="row">
            <div class="col-md-12">
                <div class="widget box">
                    <div class="widget-header">
                        <h4><i class="icon-reorder"></i> Edit Jezika: <?php echo $srblat; ?></h4>

                        <div class="toolbar no-padding">
                            <div class="btn-group">
                                <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content">
                        <div class="widget-content">
                            <form enctype="multipart/form-data" method="post" class="form-horizontal row-border"
                                  id="validate-2" action="/akcija.php?action=izmenitranslate">

                                <!--Naziv-->
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Opis Jezika </label>

                                    <div class="col-md-9">
                                        <input type="text" name="br" id="br"
                                               class="form-control" required="required"
                                               value="<?php echo $srblat; ?>">

                                        <input type="hidden" name="id" id="id"
                                               class="form-control" required="required"
                                               value="<?php echo $IdTranslate; ?>">

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
        <!-- /.container -->
