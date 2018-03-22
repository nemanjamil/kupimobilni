<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 20. 08. 2015.
 * Time: 14:32 PM
 */


$db->where("IdSpecGrupe", $id);
$spec = $db->getOne("specifikacijagrupe");
$IdSpecGrupe = $spec['IdSpecGrupe'];
$OpisSpecGrupe = $spec['OpisSpecGrupe'];
$OtvZarvSpecGrupe = $spec['OtvZarvSpecGrupe'];
$MestoSpecGrupe = $spec['MestoSpecGrupe'];

?>
<div class="row">
    <div class="col-md-9 col-xs-12">
        <div class="widget box">
            <div class="widget-header">

                <h4><i class="icon-edit"></i> Izmeni specifikaciju grupe</h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>
            <div class="widget-content">

                <form enctype="multipart/form-data" class="form-horizontal row-border" method="post" id="validate-1"
                      action="/akcija.php?action=editgrupuspec">


                    <input type="hidden" name="id" id="id" class="form-control required" value="<?php echo $IdSpecGrupe; ?>">


                    <?php

                    $naziv = '';
                    foreach ($jezLan as $k => $v):
                        $ShortLanguage = $v['ShortLanguage'];
                        $IdLanguage = $v['IdLanguage'];

                        /*$gr = Array("SVN.SpecVredNaziv");
                        $db->join('specvrednaziv SVN', "SVN.IdSpecVrednosti = SV.IdSpecVrednosti AND SVN.IdLanguage = $IdLanguage");
                        $db->where("SV.IdSpecVrednosti", $id);
                        $gdePrip = $db->getOne("specvrednosti SV", null, $gr);
                        */

                        $db->join('specgrupenaz SGN', "SGN.IdSpecGrupe = SG.IdSpecGrupe AND SGN.IdLanguage = $IdLanguage");
                        $db->where('SG.IdSpecGrupe', $id);
                        $gdePripIme = $db->getOne("specifikacijagrupe SG", null, "SG.IdSpecGrupe, SGN.NazivSpecGrupe");


                        $naziv .= '<div class="form-group">';
                        $naziv .= '<label class="col-md-2 control-label bg-success"><strong>Ime Grupe ' . $ShortLanguage . ' </strong></label>';
                        $naziv .= '<div class="col-md-10">';
                        $naziv .= '<input type="text" id="ArtNaz' . $ShortLanguage . '" name="grupe['.$IdLanguage.']" class="form-control" value="' . $gdePripIme['NazivSpecGrupe'] . '">';
                        $naziv .= '</div>';
                        $naziv .= '</div>';
                    endforeach;

                    echo $naziv;

                    ?>



                    <div class="form-group">
                        <label class="col-md-2 control-label">Otvorena za prikaz</label>

                        <div class="col-md-10">
                            <select id="otvzarvspecgrupe" name="brSpec"
                                    class="form-control  required" value="<?php echo $OtvZarvSpecGrupe; ?>">
                                <option value="0"<?php echo ($OtvZarvSpecGrupe == 0) ? 'selected' : ''; ?> >Nije
                                    otvoreno
                                </option>
                                <option value="1"<?php echo ($OtvZarvSpecGrupe == 1) ? 'selected' : ''; ?> >Otvoreno
                                </option>
                            </select>
                        </div>

                    </div>

                    <div class="form-group">
                        <div>
                            <label class="col-md-2 control-label">Pozicija </label>

                            <div class="col-md-10">
                                <input type="number" name="br" id="mestospecgrupe"
                                       class="form-control digits required" maxlength="3"
                                       value="<?php echo $MestoSpecGrupe; ?>" placeholder="0-127"
                                    >
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Kratak opis</label>

                        <div class="col-md-10">
                            <textarea rows="3" id="string" name="string" class="form-control"
                                      placeholder="Opis na srpskom jeziku"><?php echo $OpisSpecGrupe; ?></textarea>

                        </div>
                    </div>


                    <div class="form-actions">
                        <input type="submit" value="Izmeni grupu" class="btn btn-primary pull-right">
                    </div>
                </form>

            </div>
        </div>
        <!-- /Validation Example 1 -->
    </div>
</div>
