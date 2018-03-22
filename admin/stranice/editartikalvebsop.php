<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 13. 01. 2016.
 * Time: 10:00 AM
 */

$db->where("v.id", $id);
$db->join("artikli A", "A.ArtikalIdDodatna = v.id", "LEFT");
$links = $db->get("vebsop v", null, "v.id, v.model, v.title, v.codebosch, v.codeboschlink, A.ArtikalId");



foreach ($links as $link) {

    $id = $link['id'];
    $title = $link['title'];
    $model = $link['model'];
    $codebosch = $link['codebosch'];
    $codeboschlink = $link['codeboschlink'];
    $ArtikalId = $link['ArtikalId'];
}

?>
<!--=== Page Content ===-->

<div class="row">
    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-reorder"></i>Izmeni Artikal u vebsop tabeli: <?php echo $title .' '. $model; ?></h4>
            </div>
            <div class="widget-content">
                <form enctype="multipart/form-data" method="post" class="form-horizontal row-border" id="validate-1"
                      action="/akcija.php?action=editartikalvebsop">

                    <input type="hidden" value="<?php echo $ArtikalId; ?>" id="br" name="br">
                    <input type="hidden" value="<?php echo $id; ?>" id="id" name="id">

                    <!--Ime artikla-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Ime artikla</label>

                        <div class="col-md-10">
                            <input type="text" name="title" id="title" value="<?php echo $title; ?>"  class="form-control">
                        </div>

                    </div>

                    <!--Title artikla-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Model artikla</label>

                        <div class="col-md-10">
                            <input type="text" name="model" id="model" value="<?php echo $model; ?>"  class="form-control">
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Code Bosch </label>
                        <div class="col-md-10">
                            <input type="text" name="codebosch" id="codebosch" class="form-control" value="<?php echo $codebosch ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><a target="_blank" href="<?php echo $codeboschlink ?>">Code Bosch Link</a></label>
                        <div class="col-md-10">
                            <input type="text" name="codeboschlink" id="codeboschlink" class="form-control" value="<?php echo $codeboschlink ?>">
                        </div>
                    </div>

                    <!--Button unesi-->
                    <div class="form-actions">
                        <input type="submit" value="Izmeni artikal" class="btn btn-primary pull-right">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>