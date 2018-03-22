<?php
/**
 * Project: masine
 * Created by PhpStorm.
 * User: Nikola
 * Date: 08. 03. 2016.
 * Time: 13:12
 */

$katmaterijal = 11182;
$podmasine = $db->rawQueryOne("SELECT svePodkat($katmaterijal) as svePodk");
$katmasine = rtrim($podmasine['svePodk'], ",");

?>
<div class="row">
    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-reorder"></i>Auto - pocetna stranica</h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>

            <div class="widget-content">


                <form enctype="multipart/form-data" method="post" class="form-horizontal row-border" id="validate-1"
                                      action="/akcija.php?action=dodajalpotrosnimaterijalnapocetnu">

                    <!--Opis verifikacije-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Odaberi artikal</label>

                        <div class="col-md-10">

                            <select id="id" name="id"
                                    class="select2 full-width-fix">
                                <option value=""></option>
                                <?php
                                $db->where('KategorijaArtikalId IN ('.$katmasine.')' );
                                $db->join("artikalnazivnew ANN", "A.ArtikalId=ANN.ArtikalId", "LEFT");
                                $db->where("ANN.IdLanguage = 5");
                                $data = $db->get('artikli A', null, 'A.ArtikalId, ANN.OpisArtikla, A.ArtikalMPCena');
                                foreach ($data as $sds => $s) {
                                    echo '<option value="' . $s['ArtikalId'] . '">' . $s['OpisArtikla'] . ' ;  MpCena: '.$s['ArtikalMPCena']. ' RSD'. "\n";
                                }
                                ?>
                            </select>
                            <!--<input type="text" class="form-control" value="" id="artNaAkciji">
                            <input type="hidden" value="" name="id" id="artNaAkcijiID">-->
                        </div>
                    </div>

                    <!--Button unesi-->
                    <div class="form-actions">
                        <input type="submit" value="Stavi na pocetnu" class="btn btn-primary pull-right">
                    </div>

                </form>
            </div>
        </div>
    </div>

    <?php include 'lista-potrosnimaterijal.php' ?>
</div>