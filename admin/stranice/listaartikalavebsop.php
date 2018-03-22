<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 13. 01. 2016.
 * Time: 9:32 AM
 */
//$limitlista = $common->clearvariable($_POST[limit]);
$limitlistaOd = $id;
$limitlistaDo = $br;

if (!$id) {
    $id = 0;
}

if (!$br) {
    $br = 5;
}


?>
<div class="row">
    <div class="col-md-12 col-xs-6x">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-th-large"></i> Podaci po artiklu VEBSOP BOSCH</h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>
            <div class="widget-content">

                <form enctype="multipart/form-data" class="form-horizontal row-border" method="post">

                    <div class="form-group">
                        <label class="col-md-2 control-label">Limit OD</label>

                        <div class="col-md-10">
                            <input type="text" name="id" class="form-control digits" max="5"
                                   value="<?php echo $id ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Limit DO</label>

                        <div class="col-md-10">
                            <input type="text" name="br" class="form-control digits" max="5"
                                   value="<?php echo $br ?>">
                        </div>
                    </div>


                    <div class="form-actions">
                        <input type="submit" value="Ucitaj podatke" class="btn btn-primary pull-right">
                    </div>
                </form>

            </div>
        </div>
        <!-- /Validation Example 1 -->
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-reorder"></i> Lista artikala VEBSOP BOSCH</h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>
            <div class="widget-content">
                <table class="table table-striped table-bordered table-hover datatable">
                    <thead>
                    <tr>
                        <th>Redni br</th>
                        <th>Id Artikla</th>
                        <th>R V</th>
                        <th>Code Bosch Link DODATNA OPR</th>
                        <th>R A</th>
                        <th>Code Bosch Link MASINE</th>
                        <th>Code Bosch</th>
                        <th>Model</th>
                        <th>URL</th>
                        <th>Agro Baza ID</th>
                        <th>Akcija</th>
                        <th>Spec</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    //$db->setTrace (true);
                    echo 'ne postoji ova skripta vise';

                    die;

                    $vendorDodatna = 45;
                    $limit = Array($id, $br);
                    $cols = Array("v.id, v.model, v.title, v.url_artikla", "v.codeboschlink", "v.codebosch", "A.ArtikalId", "A.CodeBoschLink as CodeBoschLinkAgro","A.povuciSpec");
                    $db->join("artikli A", "A.ArtikalIdDodatna = v.id", "LEFT");
                    $db->where("v.vendor", $vendorDodatna);
                    //$db->where("v.codeboschlink LIKE '%bosch-professional%'");
                    $data = $db->get("vebsop v", $limit, $cols);



                    // $data = $db->get("vebsop v",  Array ($id, $br) ,);

                    //var_dump($db);
                    //var_dump($db->trace);

                    $i = 1;
                    foreach ($data as $sds => $link) {
                        $id = $link['id'];
                        $ArtikalId = $link['ArtikalId'];
                        $CodeBoschLinkAgro = $link['CodeBoschLinkAgro'];

                        $model = $link['model'];
                        $title = $link['title'];
                        $url_artikla = $link['url_artikla'];
                        $codeboschlink = $link['codeboschlink'];
                        $codebosch = $link['codebosch'];

                        $povuciSpec = $link['povuciSpec'];

                        $path_partsBosch = pathinfo($codeboschlink);
                        $htmlDaLiImaBosch = $path_partsBosch['extension'];
                        $DlOkBosch = ($htmlDaLiImaBosch == 'html') ? '<span class="label label-success">OK</span>' : '<span class="label label-danger">NE</span>';



                        $path_parts = pathinfo($CodeBoschLinkAgro);
                        $htmlDaLiIma = $path_parts['extension'];
                        $DlOk = ($htmlDaLiIma == 'html') ? '<span class="label label-success">OK</span>' : '<span class="label label-danger">NE</span>';

                        $imaABID = ($ArtikalId) ? '<a target="_blank" href="' . DPROOTADMIN . '/str/editartikal/' . $ArtikalId . '">LINK ' . $ArtikalId . '</a>' :
                            '<a class="small" target="_blank" href="' . DPROOTADMIN . '/povuciArtikleVendor">Povuci</a>';



                        if ($DlOkBosch=='<span class="label label-success">OK</span>' && $DlOk=='<span class="label label-success">OK</span>' && $povuciSpec == 1 ) {
                            continue;
                        }

                        /*<a data-original-title="Delete" href="javascript:void(0);" class="btn btn-xs bs-tooltip" title="">
                                <i class="icon-trash"></i>
                            </a>
                        <a data-original-title="Edit" href="javascript:void(0);" class="btn btn-xs bs-tooltip" title="">
                                <i class="icon-pencil"></i>
                            </a>
                        */


                        $r .= '<tr>
                        <td>' . $i . '</td>
                        <td><code><a target="_blank" href="http://dodatnaoprema.com/testagro/testagrokateg/' . $id . '">' . $id . '</a></code></td>
                        <td>' . $DlOkBosch . '</td>
                        <td>' . $codeboschlink . '</td>
                        <td>' . $DlOk . '</td>
                        <td>' . $CodeBoschLinkAgro . '</td>
                        <td>' . $codebosch . '</td>
                        <td><a target="_blank" class="text-danger" href="' . DPROOT . '/test/' . $ArtikalId . '">' . $model . '</a></td>
                        <td>' . $url_artikla . '</td>
                        <td>' . $imaABID . '</td>

                        <td class="align-center">
                            <span class="btn-group">
                                <a target="_blank" data-original-title="Izmeni" href="/admin/str/editartikalvebsop/' . $id . '" class="btn btn-xs bs-tooltip" title="">
                                    <i class="icon-search"></i>
                                </a>


                            </span>
                        </td>
                        <td>' . $povuciSpec . '</td>



                    </tr>';

                        $i++;
                    }
                    echo $r;
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!--=== Page Content ===-->