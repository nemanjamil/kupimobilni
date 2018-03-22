<?php
/**
 * Created by PhpStorm.
 * User: Nikola
 * Date: 20.11.2015.
 * Time: 10.54
 */

$IdKultureKulLok = $common->clearvariable($_POST[IdKultureKulLok]);
$IdLokSamoUpr = $common->clearvariable($_POST[IdLokSamoUpr]);
$IdTipKulTipLok = $common->clearvariable($_POST[senzorTipIme]);

?>
<div class="row">
    <div class="col-md-12 col-xs-6x">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-th-large"></i> Lista po kulturi, tipu sernzora i lokaciji</h4>
                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>

            <div class="widget-content">
                <form enctype="multipart/form-data" class="form-horizontal row-border" method="post">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Kultura</label>
                        <div class="col-md-9">
                            <select id="IdKultureKulLok" name="IdKultureKulLok"
                                    class="select2 required full-width-fix">
                                <option value=""></option>

                                <?php
                                $data = $db->get('kulture');
                                foreach ($data as $sds => $s) {
                                    $IdKulture = $s['IdKulture'];
                                    $ImeKulture = $s['ImeKulture'];
                                    $selektovano = ($IdKultureKulLok == $IdKulture) ? 'selected' : ''

                                    ?>
                                    <option
                                        value="<?php echo $IdKulture; ?>" <?php echo $selektovano ?>><?php echo $ImeKulture; ?></option>
                                <?php } ?>
                            </select>

                        </div>
                    </div>

                    <?php if ($IdKultureKulLok) { ?>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Lokacija</label>
                            <div class="col-md-9">
                                <select id="IdLokSamoUpr" name="IdLokSamoUpr"
                                        class="select2 required full-width-fix">
                                    <option value=""></option>


                                    <?php
                                    $data = $db->get('lokalnasu');
                                    foreach ($data as $sds => $s) {
                                        $IdLokSamo = $s['IdLokSamo'];
                                        $ImeLokSamo = $s['ImeLokSamo'];
                                        $selektovano = ($IdLokSamoUpr == $IdLokSamo) ? 'selected' : ''

                                        ?>
                                        <option
                                            value="<?php echo $IdLokSamo; ?>" <?php echo $selektovano ?>><?php echo $ImeLokSamo; ?></option>
                                    <?php } ?>


                                </select>

                            </div>
                        </div>
                    <?php } ?>

                    <?php if ($IdKultureKulLok && $IdLokSamoUpr) { ?>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Senzor</label>

                            <div class="col-md-9">

                                <select id="senzorTipIme" name="senzorTipIme"
                                        class="select2 required full-width-fix">

                                    <option value=""></option>

                                    <?php
                                    $data = $db->get('senzortip');
                                    foreach ($data as $sds => $s) {
                                        $IdSenzorTip = $s['IdSenzorTip'];
                                        $senzorTipIme = $s['senzorTipIme'];
                                        $selektovano = ($IdTipKulTipLok == $IdSenzorTip) ? 'selected' : ''

                                        ?>
                                        <option
                                            value="<?php echo $IdSenzorTip; ?>" <?php echo $selektovano ?>><?php echo $senzorTipIme; ?></option>
                                    <?php } ?>


                                </select>

                            </div>
                        </div>
                    <?php } ?>

                    <div class="form-actions">
                        <input type="submit" value="Ucitaj podatke" class="btn btn-primary pull-right">
                    </div>
                </form>

            </div>
        </div>
        <!-- /Validation Example 1 -->
    </div>

    <!--=== Page Content ===-->
    <?php

    if ($IdTipKulTipLok && $IdKultureKulLok && $IdLokSamoUpr) {
        ?>
        <div class="col-md-12 col-xs-6">
            <div class="widget box">
                <div class="widget-header">
                    <h4><i class="icon-list-alt"></i> Lista podataka po kulturi i senzoru</h4>

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

                            <th>Kultura</th>
                            <th>Lokacija</th>
                            <th>Senzor</th>
                            <th>Od</th>
                            <th>Do</th>
                            <th>Zuto Od</th>
                            <th>Zuto Do</th>
                            <th>Izaberi</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        $db->join("senzorkullokpodaci SKL", "PK.IdSenzorKulPodLok = SKL.IdKulLokPodaci", "LEFT");
                        $db->join("kulturalokacija  KL", "SKL.IdKultureKulLok = KL.IdKulturaLokacija", "LEFT");
                        $db->join("kulture K", "KL.PovKulture = K.IdKulture", "LEFT");
                        $db->join("lokalnasu LS", "KL.PovLokSamouprava = LS.IdLokSamo", "LEFT");
                        $db->join("senzortip ST", " SKL.IdTipKulTipLok = ST.IdSenzorTip", "LEFT");

                        $db->where("K.IdKulture", $IdKultureKulLok);
                        $db->where("LS.IdLokSamo", $IdLokSamoUpr);
                        $db->where("ST.IdSenzorTip", $IdTipKulTipLok);

                        $data = $db->get("podacikultiplok PK", null, "PK.IdPodaciKulTipLok, PK.OdPodaciIdeal, PK.DoPodaciIdeal, PK.OdZutoIdeal, PK.DoZutoIdeal, K.IdKulture,
                        K.ImeKulture, LS.IdLokSamo, LS.ImeLokSamo, ST.IdSenzorTip, ST.senzorTipIme");

                        $i = 1;
                        foreach ($data as $sds => $link) {

                            $IdPodaciKulTipLok = $link[IdPodaciKulTipLok];
                            $NazivKulturaLokacija = $link[ImeKulture];
                            $ImeLokSamo = $link[ImeLokSamo];
                            $senzorTipIme = $link[senzorTipIme];
                            $OdPodaciIdeal = $link[OdPodaciIdeal];
                            $DoPodaciIdeal = $link[DoPodaciIdeal];
                            $OdZutoIdeal = $link[OdZutoIdeal];
                            $DoZutoIdeal = $link[DoZutoIdeal];

                            $tab .=

                                '<tr>


                    <td>' . $NazivKulturaLokacija . '</td>
                    <td>' . $ImeLokSamo . '</td>
                    <td>' . $senzorTipIme . '</td>
                    <td>' . $OdPodaciIdeal . '</td>
                    <td>' . $DoPodaciIdeal . '</td>
                    <td>' . $OdZutoIdeal . '</td>
                    <td>' . $DoZutoIdeal . '</td>
                    <td class="align-center">
                        <div class="btn-group">
                            <button class="btn dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-dashboard"></i> Akcija
                                <span class="caret"></span>
                            </button>
                                <ul class="dropdown-menu">
                                    <li><a href="/admin/index.php?stranica=editpodkulturesve&id=' . $IdPodaciKulTipLok . '"> <i class="icon-edit"> </i> Izmeni</a></li>
                                    <li><a href="/akcija.php?action=editpodkulturesve&id=' . $IdPodaciKulTipLok . '"> <i class="icon-remove"> </i> Obrisi</a></li>
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
    <?php }

    ?>


</div>
