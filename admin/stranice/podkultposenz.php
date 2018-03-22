<?php
/**
 * Created by PhpStorm.
 * User: Nikola
 * Date: 20.11.2015.
 * Time: 10.54
 */
?>
<div class="row">
    <div class="col-md-12 col-xs-6x">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-th-large"></i> Podaci po kulturi i senzoru</h4>

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

                                <?php
                                $data = $db->get('kulturalokacija');
                                foreach ($data as $sds => $s) {
                                    $IdKulture = $s['IdKulturaLokacija'];
                                    $ImeKulture = $s['NazivKulturaLokacija'];
                                    $selektovano = ($IdKultureKulLok == $IdKulture) ? 'selected' : ''

                                    ?>
                                    <option
                                        value="<?php echo $IdKulture; ?>" <?php echo $selektovano ?>><?php echo $ImeKulture; ?></option>
                                <?php } ?>
                            </select>

                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-3 control-label">Senzor</label>

                        <div class="col-md-9">

                            <select id="senzorTipIme" name="senzorTipIme"
                                    class="select2 required full-width-fix">
                                <?php
                                $data = $db->get('senzortip');
                                foreach ($data as $sds => $s) {
                                    echo '<option value="' . $s['IdSenzorTip'] . '">' . $s['senzorTipIme'] . '</option>' . "\n";
                                }
                                ?>
                            </select>

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

    <!--=== Page Content ===-->
    <?php

    $IdTipKulTipLok = $common->clearvariable($_POST[senzorTipIme]);
    $IdKultureKulLok = $common->clearvariable($_POST[IdKultureKulLok]);

    if ($IdTipKulTipLok && $IdKultureKulLok) {
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
                        $db->join("senzorkullokpodaci SK", "SK.IdKulLokPodaci = PK.IdSenzorKulPodLok", "LEFT");
                        $db->join("kulturalokacija KL", "KL.IdKulturaLokacija = SK.IdKultureKulLok", "LEFT");
                        $db->join("senzortip ST", "ST.IdSenzorTip = SK.IdTipKulTipLok", "LEFT");
                        $db->where("SK.IdKultureKulLok", $IdKultureKulLok);
                        $db->where("SK.IdTipKulTipLok", $IdTipKulTipLok);

                        $data = $db->get("podacikultiplok PK", null, "PK.IdPodaciKulTipLok, SK.NazivKulLokPod, SK.IdKultureKulLok, KL.NazivKulturaLokacija,
                        SK.IdTipKulTipLok, ST.senzorTipIme, PK.OdPodaciIdeal, PK.DoPodaciIdeal, PK.OdZutoIdeal, PK.DoZutoIdeal ");

                        $i = 1;
                        foreach ($data as $sds => $link) {

                            $IdPodaciKulTipLok = $link[IdPodaciKulTipLok];

                            $NazivKulturaLokacija = $link[NazivKulturaLokacija];
                            $senzorTipIme = $link[senzorTipIme];
                            $OdPodaciIdeal = $link[OdPodaciIdeal];

                            $DoPodaciIdeal = $link[DoPodaciIdeal];
                            $OdZutoIdeal = $link[OdZutoIdeal];
                            $DoZutoIdeal = $link[DoZutoIdeal];


                            $tab .=

                                //ovde ide dugme da te vodi na senzor
                                '<tr>


                    <td>' . $NazivKulturaLokacija . '</td>
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
    <?php } ?>
    t

</div>
