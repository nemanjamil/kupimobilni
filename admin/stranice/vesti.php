<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 28. 08. 2015.
 * Time: 17:33
 */

?>

<!--=== Page Content ===-->
<div class="row">
    <?php include 'listavesti.php' ?>
    <div class="col-md-12 col-xs-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-list-alt "></i>Dodaj vest</h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>

            <div class="widget-content">

                <form enctype="multipart/form-data" method="post" class="form-horizontal row-border" id="validate-1"
                      action="/akcija.php?action=dodajvest">


                    <?php
                    $naziv = '';
                    foreach ($jezLan as $k => $v):
                        $ShortLanguage = $v['ShortLanguage'];

                        $naziv .= '<div class="form-group">';
                        $naziv .= '<label class="col-md-2 control-label">Naslov ' . $ShortLanguage . ' </label>';
                        $naziv .= '<div class="col-md-10">';
                        $naziv .= '<input type="text" id="VestiNaslov' . $ShortLanguage . '" name="VestiNaslov' . $ShortLanguage . '" class="form-control required" value="">';
                        $naziv .= '</div>';
                        $naziv .= '</div>';
                    endforeach;

                    echo $naziv;
                    ?>

                    <?php
                    $naziv = '';
                    foreach ($jezLan as $k => $v):
                        $ShortLanguage = $v['ShortLanguage'];

                        $naziv .= '<div class="form-group">';
                        $naziv .= '<label class="col-md-2 control-label">Opis vesti ' . $ShortLanguage . ' </label>';
                        $naziv .= '<div class="col-md-10">';
                        $naziv .= '<textarea rows="5" name="VestiOpis' . $ShortLanguage . '"  class="form-control wysiwyg"  placeholder="Opis na ' . $ShortLanguage . ' jeziku"></textarea>';
                        $naziv .= '</div>';
                        $naziv .= '</div>';
                    endforeach;

                    echo $naziv;
                    ?>


                    <div class="form-group">
                        <label class="col-md-2 control-label">Kategorija</label>

                        <div class="col-md-10">
                            <select id="IdKategVesti" name="IdKategVesti"
                                    class="select2 required full-width-fix">
                                <?php
                                $pieces = SVEKATEGORIJEMASINE;
                                $upitkateg = "
                          SELECT
                              K.KategorijaArtikalaId,
                              KAN.NazivKategorije
                          FROM
                              kategorijeartikala K
                          LEFT JOIN kategorijeartikalanaslov KAN
                                ON KAN.IdKategorije = K.KategorijaArtikalaId
                          WHERE K.KategorijaArtikalaId IN ($pieces) AND KAN.IdLanguage = 5";

                                $data = $db->rawQuery($upitkateg);
                                foreach ($data as $sds => $s) {
                                    echo '<option value="' . $s['KategorijaArtikalaId'] . '">' . $s['NazivKategorije'] . '</option>' . "\n";
                                }

                                ?>
                            </select>

                        </div>
                    </div>


                    <!--koji je uSer-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Komitenti</label>

                        <div class="col-md-10">
                            <select id="komitentId" name="br"
                                    class="select2 required full-width-fix">
                                <option value=""></option>
                                <?php
                                $data = $db->get('komitenti');
                                foreach ($data as $sds => $s) {
                                    echo '<option value="' . $s['KomitentId'] . '">' . $s['KomitentNaziv'] . ' - ' . $s['KomitentUserName'] . '</option>' . "\n";
                                }
                                ?>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-2 control-label">Mesto vesti</label>

                        <div class="col-md-10">
                            <input type="number" name="MestoVesti"
                                   placeholder="0 - 100" class="form-control digits required">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-2 control-label">Slika za vest</label>

                        <div class="col-md-5">
                            <input type="file" name="slikeMultipleVest"
                                   class="with-preview accept-gif|jpg|png fileIgnorisi"/>

                        </div>
                        <div class="col-md-5">
                        </div>
                    </div>

                    <!--Button unesi-->
                    <div class="form-actions">
                        <input type="submit" value="Dodaj Vest" class="btn btn-primary pull-right">
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>

<!-- /Page Content -->
