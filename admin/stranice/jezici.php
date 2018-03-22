<?php
/**
 * Project: masinealati
 * Created by PhpStorm.
 * User: Nikola
 * Date: 21. 09. 2016.
 * Time: 19:24
 */
?>
<div class="col-md-12">

<div class="row">

    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-reorder"></i>Dodaj jezik</h4>
            </div>
            <div class="widget-content">
                <form id="validate-1" method="post" class="form-horizontal row-border"
                      action="/akcija.php?action=dodajjezik" enctype="multipart/form-data">

                    <div class="form-group">
                        <label class="col-md-3 control-label">Naziv jezika: <span class="required">*</span></label>

                        <div class="col-md-9">
                            <input type="text" class="form-control required" name="naziv">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Skraceni naziv jezika: <span
                                class="required">*</span></label>

                        <div class="col-md-9">
                            <input type="text" class="form-control required" name="string">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Jezik Aktivan: <span class="required">*</span></label>

                        <div class="col-md-9">
                            <select id="br" name="br" class="form-control">
                                <option value=""></option>
                                <option value="0">Neaktivno</option>
                                <option value="1">Aktivno</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-actions">
                        <input type="submit" class="btn btn-primary pull-right" value="Dodaj">
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
                <h4><i class="icon-reorder"></i> Lista jezika</h4>
            </div>
            <div class="widget-content">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th>Id jezika</th>
                        <th>Opis jezika</th>
                        <th>Skraceno</th>
                        <th>Aktivno</th>
                        <th>Izmeni</th>
                        <th>Obrisi</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    $i = 1;

                    $data = $db->get('languagejezik');

                    foreach ($data as $sds => $link) {
                        $IdLanguage = $link['IdLanguage'];
                        $NameLanguage = $link['NameLanguage'];
                        $ShortLanguage = $link['ShortLanguage'];
                        $ActiveLanguage = $link['ActiveLanguage'];
                        $akt = ($ActiveLanguage) ? 'checked="checked"' : '';

                        $jezici .=
                            '<tr>


                    <td>' . $IdLanguage . '</td>
                    <td>' . $NameLanguage . '</td>
                    <td>' . $ShortLanguage . '</td>
                    <td><input type="checkbox" class="uniform" value="' . $ActiveLanguage . '" ' . $akt . '/></td>
                    <td>
                    <span class="btn-group">
                    <a title="Izmeni" class="btn btn-sm bs-tooltip btn-info" href="' . DPROOT . '/admin/str/editjezika/' . $IdLanguage . '"
                    data-original-title="Search">
                     <i class="icon-pencil"></i>
                     </a>
                    </span>
                    </td>
                    <td>
                    <span class="btn-group">
                    <a title="Obrisi" class="btn btn-sm bs-tooltip btn-danger"
                    onclick="return confirmSubmit()" href="' . DPROOT . '/akcija.php?action=obrisijezik&id=' . $IdLanguage . '" data-original-title="Obrisi">
                     <i class="icon-remove-sign"></i>
                     </a>
                    </span>
                    </td>
                </tr>';
                    }
                    echo $jezici; ?>

                    </tbody>
                </table>
            </div>
        </div>
        <!-- /Validation Example 1 -->
    </div>


</div>
</div>
