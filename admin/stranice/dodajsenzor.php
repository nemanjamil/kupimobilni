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
    <div class="col-md-12 col-xs-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-th-large"></i> Dodaj senzor</h4>
                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>
            <div class="widget-content">

                <form enctype="multipart/form-data" class="form-horizontal row-border" method="post" id="validate-1"
                      action="/akcija.php?action=dodajsenz">

                  <!--  <div class="form-group">
                        <label class="col-md-2 control-label">Kultura</label>

                        <div class="col-md-10">

                            <select id="PripadaKomitentu" name="PripadaKomitentu"
                                    class="select2 required full-width-fix">
                                <option value=""></option>
                                <?php
/*                                $data = $db->get('kulture');
                                foreach ($data as $sds => $s) {
                                    echo '<option value="' . $s['IdKulture'] . '">' . $s['ImeKulture'] . '</option>' . "\n";
                                }
                                */?>
                            </select>
                        </div>
                    </div>-->


                    <div class="form-group">
                        <label class="col-md-2 control-label">Komitent</label>

                        <div class="col-md-10">

                            <select id="PripadaKomitentu" name="PripadaKomitentu"
                                    class="select2 required full-width-fix">
                                <option value=""></option>
                                <?php
                                $data = $db->get('komitenti');
                                foreach ($data as $sds => $s) {
                                    echo '<option value="' . $s['KomitentId'] . '">' . $s['KomitentIme'] . ' ' . $s['KomitentPrezime'] . '</option>' . "\n";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Sifra senzora </label>

                        <div class="col-md-10">

                            <input type="text" name="SenzorSifra" id="SenzorSifra" class="form-control required"
                                   required="required">

                        </div>
                    </div>

                    <div class="form-actions">
                        <input type="submit" value="Dodaj senzor" class="btn btn-primary pull-right">
                    </div>
                </form>

            </div>
        </div>
        <!-- /Validation Example 1 -->
    </div>
</div>


<div class="col-md-12 col-xs-6">
    <div class="widget box">
        <div class="widget-header">
            <h4><i class="icon-list-alt"></i>Lista senzora</h4>

            <div class="toolbar">
                <div class="btn-group">
                    <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                </div>
            </div>
        </div>
        <div class="widget-content">
            <table
                class="table table-striped table-bordered table-hover ">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Senzor</th>
                    <th>Proizvodjac</th>
                    <!--<th>Notifikacija</th>-->
                    <th>Izaberi</th>
                </tr>
                </thead>
                <tbody>
                <?php


                //$db->join("kulturalokacija K", "K.IdKulturaLokacija = LS.PripadaKulLok", "LEFT");
                //$db->join("kulture KU", "KU.IdKulture = K.PovKulture");
                $db->join("komitenti KO", "KO.KomitentId = LS.KomitentId ", "LEFT");
                $data = $db->get("listasenzora LS", null, "LS.IdListaSenzora, LS.SenzorSifra, KO.KomitentIme, KO.KomitentPrezime");

                $i = 1;
                foreach ($data as $sds => $link) {
                    $IdListaSenzora = $link['IdListaSenzora'];
                    $SenzorSifra = $link['SenzorSifra'];
                    $NazivKulturaLokacija = $link['ImeKulture'];
                    $KomitentIme = $link['KomitentIme'];
                    $KomitentPrezime = $link['KomitentPrezime'];
                    /*<td><a href="/admin/str/notifikacije/' . $IdListaSenzora . '"> <i class="icon-edit"> </i> Lista notifikacija</a></td>*/
                    $tab .=
                        '<tr>

                    <td>' . $IdListaSenzora . '</td>
                    <td>' . $SenzorSifra . '</td>
                    <td>' . $KomitentIme . ' ' . $KomitentPrezime . '</td>


                    <td class="align-center">
                        <div class="btn-group">
                            <button class="btn dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-dashboard"></i> Akcija
                                <span class="caret"></span>
                            </button>
                                <ul class="dropdown-menu">
                                    <li><a href="/admin/str/editsenz/' . $IdListaSenzora . '"> <i class="icon-edit"> </i> Izmeni</a></li>
                                    <li><a onclick="return confirmSubmit()"  href="/akcija.php?action=obrisisenz&id=' . $IdListaSenzora . '"> <i class="icon-remove"> </i> Obrisi</a></li>
                                </ul>
                        </div>
                    </td>
                </tr>';
                }
                echo $tab; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>


