<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 24.11.15.
 * Time: 16:37
 */
?>

<!--=== Page Content ===-->
<div class="row">
    <div class="col-md-6">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-reorder"></i>PDV</h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>

            <div class="widget-content">

                <form enctype="multipart/form-data" method="post" class="form-horizontal row-border" id="validate-1"
                      action="/akcija.php?action=dodajporez">


                    <input type="hidden" name="id" id="id">

                    <!--Opis verifikacije-->
                    <div class="form-group">
                        <label class="col-md-3 control-label">Vrednost poreza</label>

                        <div class="col-md-9">
                            <input type="number" value="0" min="0" name="PorezVrednost" id="PorezVrednost"
                                   class="form-control required"
                                   required="required">
                        </div>
                    </div>


                    <!--Button unesi-->
                    <div class="form-actions">
                        <input type="submit" value="Dodaj porez" class="btn btn-primary pull-right">
                    </div>

                </form>
            </div>
        </div>
    </div>

    <?php include 'listaporeza.php' ?>
</div>

<!-- /Page Content -->
