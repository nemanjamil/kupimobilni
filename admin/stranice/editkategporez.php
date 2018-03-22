<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 24.11.15.
 * Time: 16.48
 */

$db->where("IdPdvKategZemlja", $id);

$data = $db->get("pdvkategzemlja");


foreach ($data as $link) {

    $IdPdvKategZemlja = $link['IdPdvKategZemlja'];
    $IdKategPdvKatZem = $link['IdKategPdvKatZem'];
    $IdZemljePdvKatZem = $link['IdZemljePdvKatZem'];
    $PdvKategZemlja = $link['PdvKategZemlja'];


}
?>
<div class="row">
    <div class="col-md-12 col-xs-6x">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-th-large"></i> Lista poreza po kategorijama</h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>
            <div class="widget-content">

                <form enctype="multipart/form-data" class="form-horizontal row-border" method="post" id="validate-1"
                      action="/akcija.php?action=editkategporez">

                    <div class="form-group">
                        <label class="col-md-3 control-label">Kategorije artikala</label>

                        <div class="col-md-9">

                            <select id="IdKategPdvKatZem" name="IdKategPdvKatZem"
                                    class="select2 required full-width-fix">

                                <?php
                                $data = $db->get('kategorijeartikala');
                                foreach ($data as $sds => $s) {
                                    $KategorijaArtikalaId = $s['KategorijaArtikalaId'];
                                    $Katsrblat = $s['Katsrblat'];
                                    $selektovano = ($IdKategPdvKatZem == $KategorijaArtikalaId) ? 'selected' : ''

                                    ?>
                                    <option
                                        value="<?php echo $KategorijaArtikalaId; ?>" <?php echo $selektovano ?>><?php echo $Katsrblat; ?></option>
                                <?php } ?>
                            </select>

                            <input type="hidden" value="<?php echo $IdPdvKategZemlja; ?>" id="IdPdvKategZemlja"
                                   name="IdPdvKategZemlja">

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Zemlja</label>

                        <div class="col-md-9">

                            <select id="IdZemljePdvKatZem" name="IdZemljePdvKatZem"
                                    class="select2 required full-width-fix">

                                <?php
                                $data = $db->get('zemlja');
                                foreach ($data as $sds => $s) {
                                    $IdZemlja = $s['IdZemlja'];
                                    $ImeZemlja = $s['ImeZemlja'];
                                    $selektovano = ($IdZemljePdvKatZem == $IdZemlja) ? 'selected' : ''

                                    ?>
                                    <option
                                        value="<?php echo $IdZemlja; ?>" <?php echo $selektovano ?>><?php echo $ImeZemlja; ?></option>
                                <?php } ?>
                            </select>

                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-3 control-label">Porez</label>

                        <div class="col-md-9">

                            <select id="PdvKategZemlja" name="PdvKategZemlja"
                                    class="select2 required full-width-fix">

                                <?php
                                $data = $db->get('pdvlistaporeza');
                                foreach ($data as $sds => $s) {
                                    $IdPdvListaPoreza = $s['IdPdvListaPoreza'];
                                    $PorezVrednost = $s['PorezVrednost'];
                                    $selektovano = ($PdvKategZemlja == $IdPdvListaPoreza) ? 'selected' : ''

                                    ?>
                                    <option
                                        value="<?php echo $IdPdvListaPoreza; ?>" <?php echo $selektovano ?>><?php echo $PorezVrednost; ?></option>
                                <?php } ?>

                            </select>
                        </div>
                    </div>

                    <div class="form-actions">
                        <input type="submit" value="Izmeni porez kategorije" class="btn btn-primary pull-right">
                    </div>
                </form>

            </div>
        </div>
        <!-- /Validation Example 1 -->
    </div>


</div>
