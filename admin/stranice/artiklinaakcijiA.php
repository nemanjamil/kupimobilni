<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 27. 01. 2016.
 * Time: 16:52
 */
?>
<div class="row">
    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-reorder"></i>Artikli na AKCIJI</h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>

            <div class="widget-content">


                <form enctype="multipart/form-data" method="post" class="form-horizontal row-border" id="validate-1"
                      action="/akcija.php?action=dodajsuperponudu">

                    <!--Opis verifikacije-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Artikal</label>

                        <div class="col-md-10">

                            <!-- <select id="ArtikalId" name="ArtikalId"
                                    class="select2 required full-width-fix">
                                <option value=""></option>
                                <?php
                            /*                                $data = $db->get("artikli");
                                                            foreach ($data as $sds => $s) {
                                                                echo '<option value="' . $s['ArtikalId'] . '">' . $s['ArtikalNaziv']  . "\n";
                                                            }
                                                            */ ?>
                            </select>-->
                            <input type="text" class="form-control" value="" id="artNaAkciji">
                            <input type="hidden" value="" name="id" id="artNaAkcijiID">
                            <input type="hidden" value="1" name="br" id="VrstaPonude">


                        </div>
                    </div>


                    <!--Button unesi-->
                    <div class="form-actions">
                        <input type="submit" value="Stavi na akciju" class="btn btn-primary pull-right">
                    </div>

                </form>
            </div>
        </div>
    </div>

    <?php include 'listaartakcijaA.php' ?>
</div>