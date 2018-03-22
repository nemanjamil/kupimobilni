<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 28. 08. 2015.
 * Time: 21:18
 */


$cols = Array("*");
$db->join("vestinaslov VN", "VN.IdVestiNaslov = V.IdVesti");
$db->join("vestiopis VO", "VO.IdVestiOpis = V.IdVesti");
$db->where("V.IdVesti", $id);
$tag = $db->getOne("vesti V", null, $cols);


$IdVesti = $tag['IdVesti'];
$NaslovVesti = $tag['NaslovVesti'];
$KratakOpisVesti = $tag['KratakOpisVesti'];
$OpisVesti = $tag['OpisVesti'];
$UrlVesti = $tag['UrlVesti'];
$DatumVesti = $tag['DatumVesti'];
$MestoVesti = $tag['MestoVesti'];
$SlikaVesti = $tag['SlikaVesti'];
$IdKomitentVesti = $tag['IdKomitentVesti'];
$IdKategVesti = $tag['IdKategVesti'];

//var_dump($tag);
?>

<!--=== Page Content ===-->
<div class="row">
    <div class="col-md-12 col-xs-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-envelope-alt"></i> Izmeni vest</h4>
            </div>
            <div class="widget-content">
                <form enctype="multipart/form-data" method="post" class="form-horizontal row-border" id="validate-2"
                      action="/akcija.php?action=editvest">


                    <input type="hidden" value="<?php echo $id; ?>" name="id">


                    <?php
                    $naziv = '';
                    foreach ($jezLan as $k => $v):
                        $ShortLanguage = $v['ShortLanguage'];

                        $naziv .= '<div class="form-group">';
                        $naziv .= '<label class="col-md-2 control-label">Naslov ' . $ShortLanguage . ' </label>';
                        $naziv .= '<div class="col-md-10">';
                        $naziv .= '<input type="text" id="VestiNaslov' . $ShortLanguage . '" name="VestiNaslov' . $ShortLanguage . '" class="form-control required" value="' . $tag['VestiNaslov' . $ShortLanguage] . '">';
                        $naziv .= '</div>';
                        $naziv .= '</div>';
                    endforeach;

                    echo $naziv;
                    ?>

                    <?php
                    $naziv = '';
                    foreach ($jezLan as $k => $v):
                        $ShortLanguage = $v['ShortLanguage'];

                        // wysiwyg
                        $vestOpis = $tag['VestiOpis' . $ShortLanguage];
                        $naziv .= '<div class="form-group">';
                        $naziv .= '<label class="col-md-2 control-label">Opis vesti  ' . $ShortLanguage . ' </label>';
                        $naziv .= '<div class="col-md-10">';
                        $naziv .= '<textarea rows="5" name="VestiOpis' . $ShortLanguage . '"  class="form-control mceEditor"  placeholder="Opis na ' . $ShortLanguage . ' jeziku">' . $vestOpis . '</textarea>';
                        $naziv .= '</div>';
                        $naziv .= '</div>';
                    endforeach;

                    echo $naziv;
                    ?>


                    <div class="form-group">
                        <label class="col-md-2 control-label">Mesto vesti</label>

                        <div class="col-md-10">
                            <input type="number" name="MestoVesti"
                                   placeholder="0 - 100" class="form-control digits required"
                                   value="<?php echo $MestoVesti ?>">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-2 control-label">Datum vesti</label>

                        <div class="col-md-10">
                            <input type="text" name="DatumVesti" id="DatumVesti"
                                   class="form-control" disabled="disabled"
                                   value="<?php echo $DatumVesti ?>">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-2 control-label">Kategorija</label>

                        <div class="col-md-10">
                            <select id="IdKategVesti" name="IdKategVesti"
                                    class="select2 required full-width-fix">

                                <?php
                                $pieces = SVEKATEGORIJEMASINE;
                                $upitkateg = "SELECT
                              K.KategorijaArtikalaId,
                              KAN.NazivKategorije
                          FROM
                              kategorijeartikala K
                          LEFT JOIN kategorijeartikalanaslov KAN
                                ON KAN.IdKategorije = K.KategorijaArtikalaId
                          WHERE K.KategorijaArtikalaId IN ($pieces) AND KAN.IdLanguage = 5";

                                $data = $db->rawQuery($upitkateg);
                                foreach ($data as $sds => $s) {
                                    $KategorijaArtikalaId = $s['KategorijaArtikalaId'];
                                    $sel = ($IdKategVesti == $KategorijaArtikalaId) ? 'selected' : '';
                                    $lisKateg .= '<option value="' . $KategorijaArtikalaId . '"  ' . $sel . '>' . $s['NazivKategorije'] . '</option>';
                                }
                                echo $lisKateg;
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Komitenti</label>

                        <div class="col-md-10">
                            <select id="komitentId" name="br"
                                    class="select2 required full-width-fix">

                                <?php
                                $data = $db->get('komitenti');
                                foreach ($data as $sds => $s) {
                                    $komID = $s['KomitentId'];

                                    $sel = ($IdKomitentVesti == $komID) ? 'selected' : '';
                                    $lisKom .= '<option value="' . $komID . '"  ' . $sel . '>' . $s['KomitentIme'] . ' ' . $s['KomitentPrezime'] . ' - ' .  $s['KomitentUserName'] .'</option>';
                                }
                                echo $lisKom;
                                ?>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-2 control-label">Slika za vest</label>


                        <div class="col-md-5">
                            <input type="file" name="slikeMultipleVest"
                                   class="with-preview accept-gif|jpg|png fileIgnorisi"/>
                        </div>
                        <div class="col-md-5">

                            <?php

                            $slika = $common->locationslikaOstalo(VESTISLIKELOK, $IdVesti);

                            $ext = pathinfo($SlikaVesti, PATHINFO_EXTENSION);
                            $fileName = pathinfo($SlikaVesti, PATHINFO_FILENAME);

                            $mala_slika = $fileName . '.' . $ext;


                            $lok = DCROOT . $slika . '/' . $mala_slika;
                            if (file_exists($lok)) {
                                echo '<img src="' . $slika . '/' . $mala_slika . '" alt="">';
                            }

                            ?>

                        </div>
                    </div>

                    <div class="form-actions">
                        <input type="submit" value="Izmeni vest" class="btn btn-primary pull-right">
                    </div>
                </form>
            </div>
        </div>
        <!-- /Validation Example 1 -->
    </div>
</div>

<!-- /Page Content -->
