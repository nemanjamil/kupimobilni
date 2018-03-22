<?php
/**
 * Created by PhpStorm.
 * User: NemanjaMilivojevic
 * Date: 1.8.15.
 * Time: 11.54
 */


$db->join('specgrupenaz SGN', "SGN.IdSpecGrupe = SG.IdSpecGrupe AND SGN.IdLanguage = $jezikId");
$db->where('SG.IdSpecGrupe', $id);
$gdePripIme = $db->get("specifikacijagrupe SG", null, "SG.IdSpecGrupe, SGN.NazivSpecGrupe");


$gr = Array("SV.*","SVN.SpecVredNaziv");
$db->join('specvrednaziv SVN', "SVN.IdSpecVrednosti = SV.IdSpecVrednosti AND SVN.IdLanguage = $jezikId");
$db->where("SV.IdSpecVrednostiGrupe", $id);
$gdePrip = $db->get("specvrednosti SV", null, $gr);


$ImeSpecGrupe = $gdePripIme[0]['NazivSpecGrupe'];
$IdSpecGrupe = $gdePripIme[0]['IdSpecGrupe'];


?>
<div class="row">
    <div class="col-md-6">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-reorder"></i> Vrednost spec kateg: (<code><?php echo $ImeSpecGrupe; ?></code>)
                </h4>

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
                        <th class="checkbox-column">
                            <input type="checkbox" class="uniform">
                        </th>
                        <th>Ime</th>
                        <th>Akcija</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php


                    if ($gdePrip) {
                        foreach ($gdePrip as $kat => $val) {
                            $IdSpecVrednosti = $val['IdSpecVrednosti'];
                            $IdSpecVrednostiIme = $val['SpecVredNaziv'];


                            ?>
                            <tr>
                                <td class="checkbox-column">
                                    <input type="checkbox" class="uniform">
                                </td>
                                <td><i class="icol-cog"></i> <?php echo $IdSpecVrednostiIme; ?></td>

                                <td class="align-center"><span class="btn-group">
                    <a data-original-title="Izmeni"
                       href="/admin/str/editspecchild/<?php echo $IdSpecVrednosti; ?>"
                       class="btn btn-xs bs-tooltip " title=""><i class=" icon-edit"></i>
                    </a>
                    </span>
                    <span class="btn-group">
                    <a data-original-title="Delete" href="javascript:void(0);"
                       idart="<?php echo $IdSpecVrednosti; ?>"
                       class="btn btn-xs bs-tooltip obrisiSpecVrednost" title=""><i class="icon-trash"></i>
                    </a>
                    </span>


                                </td>


                            </tr>
                            <?php
                        }
                    } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="widget box">
            <div class="widget-header">

                <h4><i class="icon-reorder"></i> Dodaj Spec Vrednost u grupi(<code><?php echo $ImeSpecGrupe; ?></code>)
                </h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>
            <div class="widget-content">
                <?php $imekategUpit = $adminfunkc->getKatodID($id); ?>

                <form enctype="multipart/form-data" class="form-horizontal row-border" method="post" id="validate-1"
                      action="/akcija.php?action=dodajSpecVrednost">


                    <input type="hidden" name="id" value="<?php echo $IdSpecGrupe; ?>">


                    <?php
                    $naziv = '';
                    foreach ($jezLan as $k => $v):
                        $ShortLanguage = $v['ShortLanguage'];
                        $IdLanguage = $v['IdLanguage'];

                        $naziv .= '<div class="form-group">';
                        $naziv .= '<label class="col-md-3 control-label">Ime Spec '.$ShortLanguage.' </label>';
                        $naziv .= '<div class="col-md-9">';
                        $naziv .= '<input type="text" id="grupe'.$ShortLanguage.'" name="grupe['.$IdLanguage.']"  class="form-control required">';
                        $naziv .= '</div>';
                        $naziv .= '</div>';
                    endforeach;

                    echo $naziv;
                    ?>




                    <div class="form-actions">
                        <input type="submit" value="Dodaj spec" class="btn btn-primary pull-right">
                    </div>
                </form>

            </div>
        </div>
        <!-- /Validation Example 1 -->
    </div>
    <!-- /no-padding -->
</div>
