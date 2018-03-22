<?php
/**
 * Created by PhpStorm.
 * User: Nikola
 * Date: 25.8.15.
 * Time: 11:37
 */
?>

<!--=== Page Content ===-->
<div class="row">
    <div class="col-md-6">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-reorder"></i>Kulture</h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>

            <div class="widget-content">

                <form enctype="multipart/form-data" method="post" class="form-horizontal row-border" id="validate-1"
                      action="/akcija.php?action=dodajkulturu">


                    <input type="hidden" name="id" id="id">

                    <!--Opis verifikacije-->
                    <div class="form-group">
                        <label class="col-md-3 control-label">Naziv kulture</label>

                        <div class="col-md-9">
                            <input type="text" name="naziv" id="naziv"
                                   class="form-control required"
                                   required="required">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-3 control-label">Slika kulture</label>

                        <div class="col-md-4">
                            <input type="file" name="slikeMultipleKulture"
                                   class="with-preview accept-gif|jpg|png fileIgnorisi"/>

                        </div>
                        <div class="col-md-5">
                        </div>
                    </div>

                    <!--Button unesi-->
                    <div class="form-actions">
                        <input type="submit" value="Dodaj kulturu" class="btn btn-primary pull-right">
                    </div>

                </form>
            </div>
        </div>
    </div>

    <?php include 'listakultura.php' ?>
</div>

<!-- /Page Content -->
