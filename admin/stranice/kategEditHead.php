<?php
/**
 * Created by PhpStorm.
 * User: NemanjaMilivojevic
 * Date: 1.8.15.
 * Time: 11.54
 */


$cols = Array("kateghead.IdKategHead", "ParentKategHead", "LinkKategHead","AktivanKategHead","MestoKategHead","KHN.NaslovKategHead");
$db->join("kategheadnaslov KHN","KHN.IdKategHead = kateghead.IdKategHead AND KHN.IdLanguage = $jezikId");
$db->where("kateghead.IdKategHead", $id);
$kat = $db->getOne("kateghead", null, $cols);


$IdKategHead = $kat['IdKategHead'];
$ParentKategHead = $kat['ParentKategHead'];
$LinkKategHead = $kat['LinkKategHead'];
$AktivanKategHead = $kat['AktivanKategHead'];
$MestoKategHead = $kat['MestoKategHead'];
$NaslovKategHead = $kat['NaslovKategHead'];


?>
<div class="row">
    <!--=== Validation Example 1 ===-->
    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">

                <h4><i class="icon-reorder"></i> Izmeni Head kategoriju</h4>
            </div>
            <div class="widget-content">

                <form enctype="multipart/form-data" class="form-horizontal row-border" method="post" id="validate-1"
                      action="/akcija.php?action=editKategHead">

                    <input type="hidden" name="id" id="id" value="<?php echo $IdKategHead ?>">

                    <?php

                    $naziv = '';
                    foreach ($jezLan as $k => $v):
                        $ShortLanguage = $v['ShortLanguage'];
                        $IdLanguage = $v['IdLanguage'];

                        $cols = Array ("NaslovKategHead");
                        $db->where ('IdKategHead', $id);
                        $db->where ('IdLanguage', $IdLanguage);
                        $artNazivNewUpit = $db->getOne("kategheadnaslov", null, $cols);
                        $OpisArtikla = $artNazivNewUpit['NaslovKategHead'];

                        $naziv .= '<div class="form-group">';
                        $naziv .= '<label class="col-md-2 control-label bg-success"><strong>Ime Kategorije New ' . $ShortLanguage . ' </strong></label>';
                        $naziv .= '<div class="col-md-10">';
                        $naziv .= '<input placeholder="Naziv" type="text" id="ArtNaz' . $ShortLanguage . '" name="NazivKategHead['.$IdLanguage.']" class="form-control" value="' . $OpisArtikla . '">';
                        $naziv .= '</div>';
                        $naziv .= '</div>';
                    endforeach;

                    echo $naziv;

                    ?>



                    <div class="form-group">
                        <label class="col-md-2 control-label">Parent Head Kategorije <span
                                class="required">*</span></label>

                        <div class="col-md-10">

                            <select class="form-control required" name="ParentKategHead"
                                    id="ParentKategHead" value="<?php echo $ParentKategHead; ?>">
                                <option value=""></option>

                                <?php
                                $cols = Array("kateghead.IdKategHead","KHN.NaslovKategHead");
                                $db->join("kategheadnaslov KHN","KHN.IdKategHead = kateghead.IdKategHead AND KHN.IdLanguage = $jezikId");
                                $data = $db->get('kateghead');
                                if ($data) {
                                    foreach ($data as $sds => $s) {
                                        $IdKategHead = $s['IdKategHead'];
                                        $NazivKategHeadsrb = $s['NaslovKategHead'];
                                        $selektovano = ($ParentKategHead == $IdKategHead) ? 'selected' : '';


                                        $katHeArry .= '<option  value="' . $IdKategHead . '" ' . $selektovano . '>' . $NazivKategHeadsrb . '</option>';
                                    }
                                    echo $katHeArry;
                                } ?>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-2 control-label">Link Head Kategorije <span
                                class="required">*</span></label>

                        <div class="col-md-10">
                            <input type="text" name="LinkKategHead" value="<?php echo $LinkKategHead; ?>"
                                   class="form-control required ">

                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-2 control-label">Aktivna head kategorija</label>

                        <div class="col-md-10">
                            <select id="AktivanKategHead" name="AktivanKategHead" class=" form-control  required"
                                    value="<?php echo $AktivanKategHead; ?>">
                                <option value="0"<?php echo ($AktivanKategHead == 0) ? 'selected' : ''; ?> >Neaktivno
                                </option>
                                <option value="1"<?php echo ($AktivanKategHead == 1) ? 'selected' : ''; ?> >Aktivno
                                </option>
                            </select>
                        </div>

                    </div>


                    <div class="form-group">
                        <label class="col-md-2 control-label">Mesto <span class="required">*</span></label>

                        <div class="col-md-10">
                            <input type="number" name="MestoKategHead"
                                   placeholder="0 - 100" value="<?php echo $MestoKategHead; ?>"
                                   class="form-control digits required">
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

                        $cols = Array ("OpisKategHeadTekst");
                        $db->where ('IdKategHead', $id);
                        $db->where ('IdLanguage', $IdLanguage);
                        $artNazivNewUpit = $db->getOne("kategheadtekstnew", null, $cols);
                        $OpisArtikla = $artNazivNewUpit['OpisKategHeadTekst'];

                        $naziv .= '<div class="form-group">';
                        $naziv .= '<label class="col-md-2 control-label bg-success"><strong>Opis Kategorije New ' . $ShortLanguage . ' </strong></label>';
                        $naziv .= '<div class="col-md-10">';
                        $naziv .= '<textarea placeholder="Naziv" id="KategNaz' . $ShortLanguage . '" name="TekstHead['.$IdLanguage.']" class="form-control mceEditor">' . $OpisArtikla . '</textarea>';
                        $naziv .= '</div>';
                        $naziv .= '</div>';
                    endforeach;

                    echo $naziv;

                    ?>

                   <!-- <div class="form-group">
                        <label class="col-md-2 control-label ">Tekst <b>SRB LAT</b></label>

                        <div class="col-md-10">
                            <textarea rows="9" name="TekstHeadsrblat" id="TekstHeadsrblat"
                                      class="form-control mceEditor"><?php /*echo $TekstHeadsrblat; */?></textarea>
                        </div>
                    </div>-->


                    <!--/KategHeadTekstovi-->


                    <div class="form-actions">
                        <input type="submit" value="Izmeni kategoriju" class="btn btn-primary pull-right">
                    </div>
                </form>

            </div>
        </div>
        <!-- /Validation Example 1 -->
    </div>

</div>





