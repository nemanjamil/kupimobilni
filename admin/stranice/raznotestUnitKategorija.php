<div class="row">
    <div class="col-md-12 col-xs-6x">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-th-large"></i> Razno Test Nemanja</h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>
            <div class="widget-content">

                <!-- <form enctype="multipart/form-data" class="form-horizontal row-border" method="post">

                    <div class="form-group">
                        <label class="col-md-2 control-label">Limit OD</label>

                        <div class="col-md-10">
                            <input type="text" name="id" class="form-control digits" max="5"
                                   value="<?php /*echo $id */ ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Limit DO</label>

                        <div class="col-md-10">
                            <input type="text" name="br" class="form-control digits" max="5"
                                   value="<?php /*echo $br */ ?>">
                        </div>
                    </div>


                    <div class="form-actions">
                        <input type="submit" value="Ucitaj podatke" class="btn btn-primary pull-right">
                    </div>
                </form>-->

            </div>
        </div>
        <!-- /Validation Example 1 -->
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-reorder"></i> Nemanja Test</h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>
            <div class="widget-content">
                <table class="table table-striped table-bordered table-hover datatable">
                    <thead>
                    <tr>
                        <th>Redni br</th>
                        <th>Id Artikla</th>
                        <th>R V</th>
                        <th>Code Bosch Link DODATNA OPR</th>
                        <th>R A</th>
                        <th>Code Bosch Link MASINE</th>
                        <th>Code Bosch</th>
                        <th>Model</th>
                        <th>URL</th>
                        <th>Agro Baza ID</th>
                        <th>Akcija</th>
                        <th>Spec</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php

                    $limit = Array(0, 1000);
                    $cols = Array("KA.KategorijaArtikalaId");
                    $data = $db->get("kategorijeartikala KA", $limit, $cols);


                    $i = 1;
                    if ($data) {
                        foreach ($data as $sds => $link) {

                            echo $KategorijaArtikalaId = $link['KategorijaArtikalaId'];
                            echo '<br/>';

                            // UNIT
                            $data = Array(
                                'TipKatUnit' => 8
                            );
                            $db->where('KategorijaArtikalaId', $KategorijaArtikalaId);
                            if ($db->update('kategorijeartikala', $data)) {
                                echo $db->count . ' records were updated => ' . $KategorijaArtikalaId;
                                echo '<br/>';
                            } else {
                                echo 'update failed: ' . $db->getLastError();
                                echo '<br/>';
                            }

                            // PDV
                            $users = $db->rawQuery("
                        INSERT INTO pdvkategzemlja
                        (IdKategPdvKatZem,IdZemljePdvKatZem,PdvKategZemlja)
                        VALUES
                        ($KategorijaArtikalaId,1,4),
                        ($KategorijaArtikalaId,2,1),
                        ($KategorijaArtikalaId,3,1),
                        ($KategorijaArtikalaId,4,1)
                        ");



                        }
                    }


                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!--=== Page Content ===-->