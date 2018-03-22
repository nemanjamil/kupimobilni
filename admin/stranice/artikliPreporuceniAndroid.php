<?php
/**
 * Project: masine
 * Created by PhpStorm.
 * User: Nikola
 * Date: 28. 01. 2016.
 * Time: 16:19
 */
?>

<div class="row">
    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-reorder"></i>artikli Preporuceni Android</h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>

            <div class="widget-content">

                <form enctype="multipart/form-data" method="post" class="form-horizontal row-border" id="validate-1"
                      action="/akcija.php?action=dodajakcijaPrepAndroid">

                    <!--Opis verifikacije-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Artikal</label>

                        <div class="col-md-10">

                            <input type="text" class="form-control" value="" id="artNaAkciji">
                            <input type="hidden" value="" name="id" id="artNaAkcijiID">

                        </div>
                    </div>


                    <!--Button unesi-->
                    <div class="form-actions">
                        <input type="submit" value="Stavi na najprodavanije" class="btn btn-primary pull-right">
                    </div>

                </form>
            </div>
        </div>
    </div>

    <?php include 'listaartakcijaAndroid.php' ?>
</div>
