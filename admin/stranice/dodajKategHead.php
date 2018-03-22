<?php
/**
 * Created by PhpStorm.
 * User: NemanjaMilivojevic
 * Date: 1.8.15.
 * Time: 11.54
 */

?>
<div class="row">
    <!--=== Validation Example 1 ===-->
    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">

                <h4><i class="icon-reorder"></i> Dodaj Head kategoriju</h4>
            </div>
            <div class="widget-content">

                <form enctype="multipart/form-data" class="form-horizontal row-border" method="post" id="validate-1"
                      action="/akcija.php?action=dodajKategHead">
                    <!--KategHead-->
                    <?php

                    $naziv = '';
                    foreach ($jezLan as $k => $v):
                        $ShortLanguage = $v['ShortLanguage'];
                        $IdLanguage = $v['IdLanguage'];

                        $naziv .= '<div class="form-group">';
                        $naziv .= '<label class="col-md-2 control-label bg-success"><strong>Naziv ' . $ShortLanguage . ' </strong></label>';
                        $naziv .= '<div class="col-md-10">';
                        $naziv .= '<input type="text" id="ArtNaz' . $ShortLanguage . '" name="NaslovKategHead[' . $IdLanguage . ']" class="form-control" value="">';
                        $naziv .= '</div>';
                        $naziv .= '</div>';
                    endforeach;

                    echo $naziv;

                    ?>
<!--
                    <div class="form-group">
                        <label class="col-md-2 control-label"><b>ENG</b> Naziv Head Kategorije <span
                                class="required">*</span></label>

                        <div class="col-md-10">
                            <input type="text" name="NazivKategHeadeng" id="NazivKategHeadeng"
                                   class="form-control required" placeholder="Naziv na engleskom jeziku">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><b>GER</b> Naziv Head Kategorije <span
                                class="required">*</span></label>

                        <div class="col-md-10">
                            <input type="text" name="NazivKategHeadger" id="NazivKategHeadger"
                                   class="form-control required" placeholder="Naziv na nemackom jeziku">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><b>RUS</b> Naziv Head Kategorije <span
                                class="required">*</span></label>

                        <div class="col-md-10">
                            <input type="text" name="NazivKategHeadrus" id="NazivKategHeadrus"
                                   class="form-control required" placeholder="Naziv na ruskom jeziku">
                        </div>
                    </div>
                    <!--Gotovo sa jezicima-->

                    <div class="form-group">
                        <label class="col-md-2 control-label">Parent Head Kategorije <span
                                class="required">*</span></label>

                        <div class="col-md-10">

                            <select class="form-control required" name="ParentKategHead"
                                    id="ParentKategHead">
                                <option value=""></option>

                                <?php
                                $cols = Array("KH.IdKategHead", "KHN.IdLanguage", "KHN.NaslovKategHead");
                                $db->join("kategheadnaslov KHN", "KH.IdKategHead = KHN.IdKategHead");
                                $db->where("KHN.IdLanguage = 5 ");
                                $data = $db->get("kateghead KH", null, $cols);
                                if ($data) {
                                foreach ($data as $sds => $s) {
                                    $IdKategHead = $s[IdKategHead];
                                    $NazivKategHeadsrb = $s[NaslovKategHead];
                                    $selektovano = ($NazivKategHeadsrb == $id) ? 'selected' : '' ;


                                    ?>
                                    <option
                                        value="<?php echo $id; ?>" <?php echo $selektovano ?>><?php echo $NazivKategHeadsrb; ?></option>
                                <?php }
                                }

                               ?>
                            </select>
                        </div>
                    </div>



                    <div class="form-group">
                        <label class="col-md-2 control-label">Link Head Kategorije <span
                                class="required">*</span></label>

                        <div class="col-md-10">
                            <input type="text" name="LinkKategHead" class="form-control required ">

                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-2 control-label">Aktivna head kategorija</label>

                        <div class="col-md-10">
                            <select id="AktivanKategHead" name="AktivanKategHead" class=" form-control  required">
                                <option value="1"<?php echo ($AktivanKategHead == 1) ? 'selected' : ''; ?> >Aktivno
                                </option>
                                <option value="0"<?php echo ($AktivanKategHead == 0) ? 'selected' : ''; ?> >Neaktivno
                                </option>
                            </select>
                        </div>

                    </div>


                    <div class="form-group">
                        <label class="col-md-2 control-label">Mesto <span class="required">*</span></label>

                        <div class="col-md-10">
                            <input type="number" name="MestoKategHead"
                                   placeholder="0 - 100" class="form-control digits required">
                        </div>
                    </div>

                    <!--/KategHead-->

                    <!-- /Ovde zavrsavamo tabelu KategHead i pocinjemo KategHeadTekstovi-->

                    <!--KategHeadTekstovi-->

                    <?php

                    $naziv = '';
                    foreach ($jezLan as $k => $v):
                        $ShortLanguage = $v['ShortLanguage'];
                        $IdLanguage = $v['IdLanguage'];

                        $naziv .= '<div class="form-group">';
                        $naziv .= '<label class="col-md-2 control-label bg-success"><strong>Veliki Opis ' . $ShortLanguage . ' </strong></label>';
                        $naziv .= '<div class="col-md-10">';
                        $naziv .= '<textarea rows=15  name="OpisKategHeadTekst['.$IdLanguage.']" class="form-control mceEditor"></textarea>';
                        $naziv .= '</div>';
                        $naziv .= '</div>';

                    endforeach;

                    echo $naziv;

                    ?>
<!--
                    <div class="form-group">
                        <label class="col-md-2 control-label ">Tekst <b>ENG</b></label>

                        <div class="col-md-10">
                            <textarea rows="7" name="TekstHeadeng" id="TekstHeadeng"
                                      class="form-control mceEditor"></textarea>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-2 control-label ">Tekst <b>GER</b></label>

                        <div class="col-md-10">
                            <textarea rows="7" name="TekstHeadger" id="TekstHeadger"
                                      class="form-control mceEditor"></textarea>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-2 control-label ">Tekst <b>RUS</b></label>

                        <div class="col-md-10">
                            <textarea rows="7" name="TekstHeadrus" id="TekstHeadrus"
                                      class="form-control mceEditor"></textarea>
                        </div>
                    </div>
-->

                    <!--/KategHeadTekstovi-->
                    <div class="form-actions">
                        <input type="submit" value="Dodaj stranicu" class="btn btn-primary pull-right">
                    </div>
                </form>

            </div>
        </div>
        <!-- /Validation Example 1 -->
    </div>


</div>
