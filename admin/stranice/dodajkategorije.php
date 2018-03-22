<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 06. 08. 2015.
 * Time: 3:04 PM
 */
?>

<!--=== Page Content ===-->
<div class="row">
    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-reorder"></i>Dodaj Kategorije</h4>
            </div>
            <div class="widget-content">
                <form enctype="multipart/form-data" method="post" class="form-horizontal row-border" id="validate-2"
                      action="/akcija.php?action=dodajkateg"

                <!--Kategorija artikla-->
                <div class="form-group">
                    <label class="col-md-2 control-label">Kategorije</label>

                    <div class="col-md-10">
                        <div class="zTreeDemoBackground left">
                            <ul id="treeDemo" class="ztree"></ul>
                        </div>
                    </div>
                </div>

                <!--Ime Kategorije-->
                <div class="form-group">
                    <label class="col-md-2 control-label">Ime Kategorije </label>

                    <div class="col-md-10">
                        <input type="text" name="KategorijaArtikalaNaziv" id="KategorijaArtikalaNaziv"
                               class="form-control required"
                               required="required">
                    </div>
                </div>

                <!--Kratak opis kategorije-->
                <div class="form-group">
                    <label class="col-md-2 control-label">Opis kategorije</label>

                    <div class="col-md-10">
                        <textarea rows="10" name="KategorijaArtikalaOpis"
                                  class="form-control required wysiwyg"></textarea>
                    </div>
                </div>

                <!--Button unesi-->
                <div class="form-actions">
                    <input type="submit" value="Dodaj kategoriju" class="btn btn-primary pull-right">
                </div>

                </form>
            </div>
        </div>
    </div>
</div>


<!-- /Page Content -->
