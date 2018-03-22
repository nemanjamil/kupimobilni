<?php
/**
 * Created by PhpStorm.
 * User: NemanjaMilivojevic
 * Date: 1.8.15.
 * Time: 11.54
 */

?>
<div class="row">
    <div class="col-md-12 col-xs-6x">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-th-large"></i> Senzori za artikal</h4>
                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>
            <div class="widget-content">

                <form enctype="multipart/form-data" class="form-horizontal row-border" method="post" id="validate-1"
                      action="/akcija.php?action=dodajsenzorartiklu">



                    <div class="form-group">
                        <label class="col-md-3 control-label">Artikal</label>

                        <div class="col-md-9">

                            <select id="SenzorZaArtikal" name="SenzorZaArtikal"
                                    class="select2 required full-width-fix">
                                <?php
                                $db->join("kategorijeartikala KA", "KA.KategorijaArtikalaId = A.KategorijaArtikalId");
                                $db->where("KA.Kategorija_dodatna IS NULL");
                                $data = $db->get('artikli A');
                                foreach ($data as $sds => $s) {
                                    echo '<option value="' . $s['ArtikalId'] . '">' . $s['ArtikalNaziv'] . '</option>' . "\n";
                                }
                                ?>
                            </select>

                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-3 control-label">Senzor Id </label>

                        <div class="col-md-9">

                            <input  type="text" name="SenzorSifraSenzora" id="SenzorSifraSenzora"
                                   class="form-control required"
                                   required="required">

                        </div>
                    </div>

                    <div class="form-actions">
                        <input type="submit" value="Dodaj podatke" class="btn btn-primary pull-right">
                    </div>
                </form>

            </div>
        </div>
        <!-- /Validation Example 1 -->
    </div>


<!--napraviti posebnu listu, a ne ovu-->
    <?php include 'listapodacikulture.php' ?>
</div>
