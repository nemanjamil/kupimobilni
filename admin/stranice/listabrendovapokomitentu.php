<?php
/**
 * Project: masinealati
 * Created by PhpStorm.
 * User: Nikola
 * Date: 21. 06. 2016.
 * Time: 16:02
 */
?>
<div class="row">
    <div class="col-md-6">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-tag"></i> Brendovi po Vendoru</h4>

                <div class="toolbar">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>

            <div class="widget-content">
                <form enctype="multipart/form-data" method="post" class="form-horizontal row-border" id="validate-2"
                    >

                    <div class="form-group">
                        <label class="col-md-2 control-label">Komitent </label>

                        <div class="col-md-10">

                            <select class="select2 full-width-fix" name="id"
                                    id="id">
                                <option value=""></option>

                                <?php
                                $data = $db->get('vendor');

                                foreach ($data as $sds => $s) {
                                    $KomitentId = $s['id'];
                                    $KomitentIme = $s['vendorime'];
                                    $selektovano = ($id == $KomitentId) ? 'selected' : '';
                                    $veopiZem .= '<option  value="' . $KomitentId . '" ' . $selektovano . '>' . $KomitentIme . ' </option>';

                                }
                                echo $veopiZem;
                                ?>
                            </select>
                        </div>
                    </div>


                    <div class="form-actions">
                        <input type="submit" value="Prikazi brendove" class="btn btn-primary pull-right">
                    </div>
                </form>
            </div>
        </div>
        <!-- /Validation Example 1 -->
    </div>

    <?php if ($id) { ?>
        <div class="col-md-6">
            <div class="widget box">
                <div class="widget-header">
                    <h4><i class="icon-list-alt"></i>Lista brendova</h4>

                    <div class="toolbar">
                        <div class="btn-group">
                            <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                        </div>
                    </div>
                </div>
                <div class="widget-content">
                    <table class="table table-striped table-bordered table-hover ">
                        <thead>
                        <tr>
                            <th>Brend Id</th>
                            <th>Ime brenda</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        $cols = Array("b.brand_name", "b.id");
                        $db->join("brand b", "b.id = v.brend");
                        $db->where("v.vendor = $id GROUP BY brend");
                        $data = $db->get("vebsop v", null, $cols);

                        $i = 1;
                        foreach ($data as $sds => $link) {
                            $BrendId = $link[id];
                            $BrendIme = $link[brand_name];

                            $tab .=
                                '<tr>

                    <td>' . $BrendId . '</td>
                    <td>' . $BrendIme . '</td>


                </tr>';
                        }
                        echo $tab; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php } ?>

</div>
