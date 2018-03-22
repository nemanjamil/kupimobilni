<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 06.10.15.
 * Time: 14:37
 */
$idu = $id + 1;
$db->where("IdOsnPodaci", $idu);
$podaci = $db->getOne("osnpodaci");
$IdOsnPodaci = $podaci['IdOsnPodaci'];
$zdravljeNaslov = $podaci['zdravljeNaslov'];
$zdravljeOpis = $podaci['zdravljeOpis'];
$zdravljeTbNaslov1 = $podaci['zdravljeTbNaslov1'];
$zdravljeTbOpis1 = $podaci['zdravljeTbOpis1'];
$zdravljeTbNaslov2 = $podaci['zdravljeTbNaslov2'];
$zdravljeTbOpis2 = $podaci['zdravljeTbOpis2'];

?>
<!--=== Page Content ===-->
<div class="row">
    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-reorder"></i>Pregled tekstova sa stranice zdravlje</h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>

            <div class="widget-content">

                <form enctype="multipart/form-data" method="post" class="form-horizontal row-border" id="validate-1"
                      action="/akcija.php?action=edittxtzdravlje">

                    <input type="hidden" name="IdOsnPodaci" id="IdOsnPodaci" value="<?php echo $IdOsnPodaci; ?>">

                    <input type="hidden" name="id" id="id" value="<?php echo $idu; ?>">


                    <h4>Veliki Text strana zdravlje:</h4>

                    <!--Naslov na zdravlje-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Naslov glavni zdravlje stranica </label>

                        <div class="col-md-10">
                            <input type="text" name="zdravljeNaslov" class="form-control"
                                   value="<?php echo $zdravljeNaslov; ?>">
                        </div>
                    </div>

                    <!--Opis na zdravlje-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Opis glavni zdravlje stranica </label>

                        <div class="col-md-10">

                            <textarea rows="10" name="zdravljeOpis"
                                      class="form-control mceEditor required"><?php echo $zdravljeOpis; ?></textarea>

                        </div>
                    </div>

                    <hr>
                    <h4>Text box strana zdravlje:</h4>

                    <!--Naslov na Text box levo zdravlje-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Text box levo zdravlje</label>

                        <div class="col-md-10">
                            <input type="text" name="zdravljeTbNaslov1" class="form-control"
                                   value="<?php echo $zdravljeTbNaslov1; ?>">
                        </div>
                    </div>

                    <!--Opis na Text box levo zdravlje-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Text box levo Opis </label>

                        <div class="col-md-10">

                            <textarea rows="5" name="zdravljeTbOpis1"
                                      class="form-control required"><?php echo $zdravljeTbOpis1; ?></textarea>

                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-2 control-label">Text box strana zdravlje </label>

                        <!--Naslov na  Text box desno zdravlje-->
                        <div class="col-md-10">
                            <input type="text" name="zdravljeTbNaslov2" class="form-control"
                                   value="<?php echo $zdravljeTbNaslov2; ?>">
                        </div>
                    </div>

                    <!--Opis na  Text box desno zdravlje-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Text box desno zdravlje</label>

                        <div class="col-md-10">

                            <textarea rows="5" name="zdravljeTbOpis2"
                                      class="form-control  required"><?php echo $zdravljeTbOpis2; ?></textarea>

                        </div>
                    </div>

                    <!--Button unesi-->
                    <div class="form-actions">
                        <input type="submit" value="Izmeni str zdravlje" class="btn btn-primary pull-right">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Page Content -->