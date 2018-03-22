<?php
/**
 * Created by PhpStorm.
 * User: NemanjaMilivojevic
 * Date: 1.8.15.
 * Time: 11.54
 */


$db->where('SenzorZaArtikal', $id);
$gdePripIme = $db->get('senzorizaartikal');

$gr = Array("SA.*, LS.SenzorSifra, A.ArtikalNaziv");
$db->join("artikli A", "A.ArtikalId = SA.SenzorZaArtikal", "LEFT");
$db->join("listasenzora LS ", "LS.IdListaSenzora = SA.SenzorSifraSenzora", "LEFT");
$db->where("SA.SenzorZaArtikal", $id);
$gdePrip = $db->get("senzorizaartikal SA", null, $gr);

$ArtikalNaziv1 = $gdePrip[0]['ArtikalNaziv'];
$SenzorSifraSenzora = $gdePrip[0]['SenzorSifraSenzora'];
$SenzorSifra = $gdePrip[0]['SenzorSifra'];
$SenzorZaArtikal = $gdePrip[0]['SenzorZaArtikal'];



?>

<div class="row">

    <!--dodaj senzor-->
    <div class="col-md-6">
        <div class="widget box">
            <div class="widget-header">

                <h4><i class="icon-reorder"></i> Dodaj Senzor proizvodu: (<code><?php echo $ArtikalNaziv1; ?></code>)
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
                      action="/akcija.php?action=dodajSenzorSenz">


                    <input type="hidden" name="id" value="<?php echo $SenzorZaArtikal; ?>">

                    <div class="form-group">
                        <label class="col-md-2 control-label">Dodaj senzor</label>
                        <div class="col-md-10">
                        <select id="ArtikalId" name="ArtikalId"
                                class="select2 required full-width-fix">
                            <?php
                            $data = $db->get('listasenzora');
                            foreach ($data as $sds => $s) {
                                echo '<option value="' . $s['IdListaSenzora'] . '">' . $s['SenzorSifra'] . '</option>' . "\n";
                            }
                            ?>
                        </select>
                        </div></div>

                    <div class="form-actions">
                        <input type="submit" value="Dodaj senzor" class="btn btn-primary pull-right">
                    </div>
                </form>

            </div>
        </div>
        <!-- /Validation Example 1 -->
    </div>
    <!-- /no-padding -->

    <div class="col-md-6">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-reorder"></i> Senzori za proizvod: (<code><?php echo $ArtikalNaziv1; ?></code>)</h4>

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
                        <th class="checkbox-column"><input type="checkbox" class="uniform"></th>
                        <th>Ime</th>
                        <th>Akcija</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php

                    if ($gdePrip) {
                        foreach ($gdePrip as $kat => $val) {
                            $SenzorZaArtikal = $val['SenzorZaArtikal'];
                            $SenzorSifraSenzora = $val['SenzorSifraSenzora'];
                            $SenzorSifraa = $val['SenzorSifra'];

                            ?>
                            <tr>
                                <td class="checkbox-column"><input type="checkbox" class="uniform"></td>
                                <td><i class="icol-cog"></i> <?php echo $SenzorSifraa; ?></td>

                                <td class="align-center">
                                    <span class="btn-group">
                         <a data-original-title="Izmeni"
                            href="/admin/index.php?stranica=editsenzor&id=<?php echo $SenzorSifraSenzora; ?>"
                            class="btn btn-xs bs-tooltip " title=""><i class=" icon-edit"></i> </a>
                                    </span>
                                    <span class="btn-group">
                         <a data-original-title="Delete" href="/akcija.php?action=obrisisenzor&id=<?php echo $SenzorSifraSenzora; ?>"
                            class="btn btn-xs bs-tooltip " title=""><i class="icon-trash"></i></a>
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
</div>