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

    <div class="col-md-8">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-reorder"></i> Izmeni Vrednost: (<code><?php echo $IdSpecVrednostiIme; ?></code>)</h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>
            <div class="widget-content">

                <form enctype="multipart/form-data" method="post" class="form-horizontal row-border" id="validate-2"
                      action="/akcija.php?action=editSpecVrednost">
                    <input type="hidden" name="id" id="id" value="<?php echo $id ?>">


                    <?php

                    $naziv = '';
                    foreach ($jezLan as $k => $v):
                        $ShortLanguage = $v['ShortLanguage'];
                        $IdLanguage = $v['IdLanguage'];

                        $gr = Array("SVN.SpecVredNaziv");
                        $db->join('specvrednaziv SVN', "SVN.IdSpecVrednosti = SV.IdSpecVrednosti AND SVN.IdLanguage = $IdLanguage");
                        $db->where("SV.IdSpecVrednosti", $id);
                        $gdePrip = $db->getOne("specvrednosti SV", null, $gr);

                        $naziv .= '<div class="form-group">';
                        $naziv .= '<label class="col-md-3 control-label bg-success"><strong>Ime Spec Vrednosti ' . $ShortLanguage . ' </strong></label>';
                        $naziv .= '<div class="col-md-9">';
                        $naziv .= '<input type="text" id="ArtNaz' . $ShortLanguage . '" name="grupe['.$IdLanguage.']" class="form-control" value="' . $gdePrip['SpecVredNaziv'] . '">';
                        $naziv .= '</div>';
                        $naziv .= '</div>';
                    endforeach;

                    echo $naziv;

                    ?>

                    <div class="form-actions">
                        <input type="submit" value="Izmeni spec" class="btn btn-primary pull-right">
                    </div>
                </form>

            </div>
        </div>
        <!-- /Validation Example 1 -->
    </div>


    <!-- /no-padding -->

</div>
