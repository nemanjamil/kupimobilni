<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 13. 08. 2015.
 * Time: 16:47
 */

?>
<div class="row">
    <div class="col-md-12 col-xs-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-th-large"></i> Dodaj senzor</h4>
                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>
            <div class="widget-content">

                <form enctype="multipart/form-data" class="form-horizontal row-border" method="post" id="validate-1"
                      action="/akcija.php?action=dodajSenzorArt">

                    <div class="form-group">
                        <label class="col-md-2 control-label">Proizvod</label>

                        <div class="col-md-10">

                            <select id="ArtikalId" name="ArtikalId"
                                    class="select2 required full-width-fix">
                                <option value=""></option>
                                <?php
                                $db->join("kategorijeartikala KA", "KA.KategorijaArtikalaId = A.KategorijaArtikalId");
                                $db->join("artikalnazivnew ANN", "ANN.ArtikalId = A.ArtikalId");
                                $db->where("KA.Kategorija_dodatna IS NULL");
                                $db->where("ANN.IdLanguage", 5);
                                $data = $db->get('artikli A');
                                foreach ($data as $sds => $s) {
                                    echo '<option value="' . $s['ArtikalId'] . '">' . $s['OpisArtikla'] . '</option>' . "\n";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Senzor</label>

                        <div class="col-md-10">

                            <select id="SenzorSifraSenzora" name="SenzorSifraSenzora"
                                    class="select2 required full-width-fix">
                                <option value=""></option>
                                <?php
                                $data = $db->get('listasenzora');
                                foreach ($data as $sds => $s) {
                                    echo '<option value="' . $s['IdListaSenzora'] . '">' . $s['SenzorSifra'] . '</option>' . "\n";
                                }
                                ?>
                            </select>

                        </div>
                    </div>

                    <div class="form-actions">
                        <input type="submit" value="Dodaj senzor" class="btn btn-primary pull-right">
                    </div>
                </form>

            </div>
        </div>
        <!-- /Validation Example 1 -->
    </div>
</div>


<div class="row">
    <div class="col-md-12 col-xs-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-reorder"></i>Lista proizvoda <!--(<code>no-padding</code>)--></h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>
            <div class="widget-content no-padding">
                <table class="table table-striped table-bordered table-hover table-checkable datatable">
                    <thead>
                    <tr>
                        <th class="checkbox-column"><input type="checkbox" class="uniform"></th>
                        <th>Ime proizvoda</th>
                        <th>Dodaj/Izmeni Senzor</th>
                        <th>Edit proizvoda</th>
                        <!--<th>Obrisi</th>-->

                    </tr>
                    </thead>
                    <tbody>

                    <?php

                    $db->where('SenzorZaArtikal', $id);
                    $gdePrip = $db->get('senzorizaartikal', null, 'SenzorSifraSenzora');

                    if ($gdePrip) {
                        foreach ($gdePrip as $kat => $val) {
                            $arrsta[] = $val['SenzorSifraSenzora'];

                        }
                    }

                    $db->join("artikli sv", "sg.SenzorZaArtikal = sv.ArtikalId", "LEFT");
                    $db->join("artikalnazivnew ann", "ann.ArtikalId = sv.ArtikalId");
                    $db->groupBy("sg.SenzorZaArtikal");
                    $senzpovez = $db->get("senzorizaartikal sg", null, "sg.SenzorZaArtikal, sg.SenzorSifraSenzora, ann.OpisArtikla");


                    if ($senzpovez) {
                        foreach ($senzpovez as $kat => $val) {
                            $SenzorZaArtikal = $val['SenzorZaArtikal'];
                            $ArtikalNaziv = $val['OpisArtikla'];

                            if (is_array($arrsta)) {
                                $cekiKat = (in_array($SenzorZaArtikal, $arrsta)) ? 'checked' : '';
                            }

                            $db->join("artikli sv", "sg.SenzorZaArtikal = sv.ArtikalId");
                            $db->join("artikalnazivnew ann", "ann.ArtikalId = sv.ArtikalId");
                            $db->where("sg.SenzorZaArtikal", $SenzorZaArtikal);
                            $products = $db->get("senzorizaartikal sg", null, "ann.OpisArtikla, sv.ArtikalId, sg.SenzorSifraSenzora");

                            ?>
                            <tr>
                                <td class="checkbox-column">
                                    <input type="checkbox" class="uniform">

                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-xs dropdown-toggle" data-toggle="dropdown">
                                            <i class="icol-cog"></i> <?php echo $ArtikalNaziv; ?> <span
                                                class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <?php if ($products) {
                                                foreach ($products as $kljuc => $vrednost) {
                                                    $ArtikalId = $vrednost['ArtikalId'];
                                                    $SenzorSifraSenzora = $vrednost['SenzorSifraSenzora'];
                                                    ?>
                                                    <li><a href="#"><i class="icol-color-swatch-1"></i> <?php echo $SenzorSifraSenzora; ?></a></li>

                                                <?php }
                                            } ?>
                                        </ul>
                                    </div>
                                </td>
                                <td> <input type="hidden" name="id" value="<?php echo $ArtikalId; ?>">

                                    <a href="/admin/str/dodajsenz/<?php echo $SenzorZaArtikal; ?>">Dodaj i izmeni senzor
                                        za <?php echo $ArtikalNaziv; ?> </a></td>
                                <td><a href="/admin/str/editartikal/<?php echo $SenzorZaArtikal; ?>">Edituj
                                        proizvod <?php echo $ArtikalNaziv; ?> </a></td>

                            </tr>
                            <?php
                        }
                    } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
