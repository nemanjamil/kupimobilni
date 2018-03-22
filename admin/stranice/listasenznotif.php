<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 10. 12. 2015.
 * Time: 11:07
 */

?>

<div class="col-md-12 col-xs-6">
    <div class="widget box">
        <div class="widget-header">
            <h4><i class="icon-list-alt"></i> Opis notifikacija senzora</h4>

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
                    <th>Notifikacija</th>
                    <th>Senzora</th>
                    <th>Zuta zona</th>
                    <th>Opis notifikacije</th>
                    <th>Izaberi</th>
                </tr>
                </thead>
                <tbody>

                <?php

                $db->join("tipnotifikacije TN", "OSN.IdSenNotNotifikacija = TN.IdTipNotifikacijeIncr", "LEFT");
                $db->join("senzortip ST", "OSN.IdSenNotSenzor = ST.IdSenzorTip", "LEFT");

                $data = $db->get("opissenzornotifikacija OSN", null, "OSN.idSenNoti, TN.OpisNotifikacije, ST.senzorTipIme,OSN.IdSenNotVecaManja, OSN.OpisSenNot");
                $i = 1;
                foreach ($data as $sds => $link) {
                    $idSenNoti = $link['idSenNoti'];
                    $OpisNotifikacije = $link['OpisNotifikacije'];
                    $senzorTipIme = $link['senzorTipIme'];
                    $OpisSenNot = $link['OpisSenNot'];
                    $IdSenNotVecaManja = $link['IdSenNotVecaManja'];

                    if ($IdSenNotVecaManja == "1") { $granica = 'Gornja';}
                    elseif ($IdSenNotVecaManja == "0") { $granica = 'Donja'; }
                    else { $granica = 'Nije definisana'; }

                    $tab .=
                        '<tr>

                    <td>' . $idSenNoti . '</td>
                    <td>' . $OpisNotifikacije . '</td>
                    <td>' . $senzorTipIme . '</td>
                    <td>' . $granica . '</td>
                    <td>' . $OpisSenNot . '</td>

                    <td class="align-center">
                        <div class="btn-group">
                            <button class="btn dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-dashboard"></i> Akcija
                                <span class="caret"></span>
                            </button>
                                <ul class="dropdown-menu">
                                    <li><a href="/admin/index.php?stranica=editopisnotif&id=' . $idSenNoti . '"> <i class="icon-edit"> </i> Izmeni</a></li>
                                    <li><a href="/akcija.php?action=obrisiopisnotif&id=' . $idSenNoti . '"> <i class="icon-remove"> </i> Obrisi</a></li>
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