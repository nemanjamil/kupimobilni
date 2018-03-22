<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 17. 11. 2015.
 * Time: 14:57
 */
?>
<!--=== Page Content ===-->
<div class="col-md-12 col-xs-6">
    <div class="widget box">
        <div class="widget-header">
            <h4><i class="icon-list-alt"></i> Lista kultura, lokacija i senzori</h4>

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
                    <th>Id</th>
                    <!--<th>Naziv</th>-->
                    <th>Kultura</th>
                    <th>Lok. Samoup</th>
                    <th>Senzor</th>
                    <th>Izaberi</th>
                </tr>
                </thead>
                <tbody>
                <?php

                $db->join("kulturalokacija KL", "KL.IdKulturaLokacija = SK.IdKultureKulLok", "LEFT");
                $db->join("lokalnasu LS", "LS.IdLokSamo = KL.PovLokSamouprava", "LEFT");
                $db->join("senzortip ST", "ST.IdSenzorTip = SK.IdTIpKulTipLok", "LEFT");
                $data = $db->get("senzorkullokpodaci SK", null, "SK.IdKulLokPodaci, SK.NazivKulLokPod, KL.NazivKulturaLokacija, LS.ImeLokSamo, ST.senzorTipIme");
               //var_dump($db);

                $i = 1;
                foreach ($data as $sds => $link) {
                    $IdKulLokPodaci = $link['IdKulLokPodaci'];
                    $NazivKulLokPod = $link['NazivKulLokPod'];
                    $senzorTipIme = $link['senzorTipIme'];
                    $ImeLokSamo = $link['ImeLokSamo'];
                    $NazivKulturaLokacija = $link['NazivKulturaLokacija'];

                    $tab .=
                        '<tr>

                    <td>' . $IdKulLokPodaci . '</td>
                    <!--<th>$NazivKulLokPod=</th>-->
                    <td>' . $NazivKulturaLokacija . '</td>
                    <td>' . $ImeLokSamo . '</td>
                    <td>' . $senzorTipIme . '</td>

                    <td class="align-center">
                        <div class="btn-group">
                            <button class="btn dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-dashboard"></i> Akcija
                                <span class="caret"></span>
                            </button>
                                <ul class="dropdown-menu">
                                    <li><a href="/admin/index.php?stranica=editpodkulture&id=' . $IdKulLokPodaci . '"> <i class="icon-edit"> </i> Izmeni</a></li>
                                    <li><a href="/akcija.php?action=obrisipodkulture&id=' . $IdKulLokPodaci . '"> <i class="icon-remove"> </i> Obrisi</a></li>
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