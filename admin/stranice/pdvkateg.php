<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 24.11.15.
 * Time: 16.54
 */

?>
<div class="row">
    <div class="col-md-12 col-xs-6x">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-th-large"></i> Porezi na kategorije</h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>
            <div class="widget-content">

                <form enctype="multipart/form-data" class="form-horizontal row-border" method="post" id="validate-1"
                      action="/akcija.php?action=dodajkategporez">

                    <div class="form-group">
                        <label class="col-md-3 control-label">Kategorije artikala</label>

                        <div class="col-md-9">

                            <select id="IdKategPdvKatZem" name="IdKategPdvKatZem"
                                    class="select2 required full-width-fix">
                                <?php
                                $db->join("kategorijeartikalanaslov kn", "kn.IdKategorije=k.KategorijaArtikalaId", "LEFT");
                                $db->where("kn.IdLanguage = 5");
                                $data = $db->get('kategorijeartikala k', null, 'k.KategorijaArtikalaId, kn.NazivKategorije');
                                foreach ($data as $sds => $s) {
                                    echo '<option value="' . $s['KategorijaArtikalaId'] . '">' . $s['NazivKategorije'] . '</option>' . "\n";
                                }
                                ?>
                            </select>
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
                                    echo '<option value="' . $s['IdZemlja'] . '">' . $s['ImeZemlja'] . '</option>' . "\n";
                                }
                                ?>
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
                                    echo '<option value="' . $s['IdPdvListaPoreza'] . '">' . $s['PorezVrednost'] . '</option>' . "\n";
                                }
                                ?>
                            </select>

                        </div>
                    </div>


                    <div class="form-actions">
                        <input type="submit" value="Dodaj porez" class="btn btn-primary pull-right">
                    </div>
                </form>

            </div>
        </div>
        <!-- /Validation Example 1 -->
    </div>


    <?php include 'listakatporez.php' ?>
</div>
