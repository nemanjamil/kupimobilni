<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 26.8.15.
 * Time: 23:37
 */
?>

<!--=== Page Content ===-->
<div class="row">
    <div class="col-md-7">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-reorder"></i>Verifikacija Lokalna samouprava</h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>

            <div class="widget-content">

                <form enctype="multipart/form-data" method="post" class="form-horizontal row-border" id="validate-1"
                      action="/akcija.php?action=dodajverifikacijuls">

                    <!--Ime samouprave-->
                    <div class="form-group">
                        <label class="col-md-3 control-label">Ime Lokalne samouprave </label>

                        <div class="col-md-9">
                            <input type="text" name="ImeLokSamo" id="ImeLokSamo" class="form-control required"
                                   required="required">
                        </div>
                    </div>


                    <?php
                    $naziv = '';
                    foreach ($jezLan as $k => $v):
                        $ShortLanguage = $v['ShortLanguage'];
                        $IdLanguage = $v['IdLanguage'];

                        $naziv .= '<div class="form-group">';
                        $naziv .= '<label class="col-md-3 control-label">Ime Lok samouprave na <u><strong>' . $ShortLanguage . '</strong></u> jeziku</label>';
                        $naziv .= '<div class="col-md-9">';
                        $naziv .= '<input type="text" id="naziv' . $ShortLanguage . '" name="naziv[' . $IdLanguage . ']" class="form-control required" value="' . $v['naziv[' . $IdLanguage] . '">';
                        $naziv .= '</div>';
                        $naziv .= '</div>';
                    endforeach;

                    echo $naziv;
                    ?>

                    <!--Zemlja samouprave-->
                    <div class="form-group">
                        <label class="col-md-3 control-label">Zemlja lokalne samouprave </label>

                        <div class="col-md-9">

                            <select class="form-control required" name="ZemljaLokSamo"
                                    id="ZemljaLokSamo">
                                <option value=""></option>

                                <?php
                                $data = $db->get('zemlja');
                                foreach ($data as $sds => $s) {
                                    $IdZemlja = $s['IdZemlja'];
                                    $ImeZemlja = $s['ImeZemlja'];
                                    $selektovano = ($ImeZemlja == $IdZemlja) ? 'selected' : '';

                                    $veopiZem .= '<option  value="' . $IdZemlja . '" ' . $selektovano . '>' . $ImeZemlja . '</option>';

                                }
                                echo $veopiZem;
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">WEB adresa Lokalne samouprave </label>

                        <div class="col-md-9">
                            <input type="text" name="LinkLokSamo" id="LinkLokSamo" class="form-control">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-3 control-label">Logo </label>


                        <div class="col-md-4">
                            <input type="file" name="slikeMultipleLs"
                                   class="with-preview accept-gif|jpg|png fileIgnorisi"/>
                        </div>
                        <div class="col-md-5">

                            <?php
                            $slika = $common->locationslikaOstalo(LSSLIKE, $IdLokSamo);
                            $ext = pathinfo($SlikaLokSamo, PATHINFO_EXTENSION);
                            $fileName = pathinfo($SlikaLokSamo, PATHINFO_FILENAME);
                            $mala_slika = $fileName . '.' . $ext;
                            $lok = DCROOT . $slika . '/' . $mala_slika;
                            if (file_exists($lok)) {
                                echo '<img src="' . $slika . '/' . $mala_slika . '" alt="Slika - logo samouprave">';
                            }

                            ?>

                        </div>
                    </div>

                    <!-- opis-->


                    <?php
                    $naziv = '';
                    foreach ($jezLan as $k => $v):
                        $ShortLanguage = $v['ShortLanguage'];
                        $IdLanguage = $v['IdLanguage'];

                        $naziv .= '<div class="form-group">';
                        $naziv .= '<label class="col-md-3 control-label">Podaci na <u><strong>' . $ShortLanguage . ' </strong></u> jeziku</label>';
                        $naziv .= '<div class="col-md-9">';
                        $naziv .= '<textarea rows="7" id="velikiopis' . $ShortLanguage . '" name="velikiopis[' . $IdLanguage . ']" class="form-control wysiwyg" value="' . $link['velikiopis' . $ShortLanguage] . '"></textarea>';
                        $naziv .= '</div>';
                        $naziv .= '</div>';
                    endforeach;

                    echo $naziv;
                    ?>

                    <!--Button unesi-->
                    <div class="form-actions">
                        <input type="submit" value="Dodaj Lokalnu SU" class="btn btn-primary pull-right">
                    </div>

                </form>
            </div>
        </div>
    </div>
    <?php include 'listaverifikacijals.php' ?>

</div>


<!-- /Page Content -->
