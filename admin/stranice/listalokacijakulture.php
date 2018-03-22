<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 23. 11. 2015.
 * Time: 11:52
 */

?>
<!--=== Page Content ===-->
<div class="col-md-12 col-xs-6">
    <div class="widget box">
        <div class="widget-header">
            <h4><i class="icon-list-alt"></i> Lista kultura i lokacija</h4>

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
                    <th>Lokacija</th>
                    <th>Kultura</th>
                    <th>Izaberi</th>
                </tr>
                </thead>
                <tbody>
                <?php

                $db->join("kulture K", "K.IdKulture = KL.PovKulture", "LEFT");
                $db->join("lokalnasu LS", "LS.IdLokSamo = KL.PovLokSamouprava", "LEFT");
                $db->orderBy("LS.IdLokSamo", "ASC");

                $data = $db->get("kulturalokacija KL", null, "KL.IdKulturaLokacija, KL.NazivKulturaLokacija ,  K.ImeKulture, LS.ImeLokSamo");
                $i = 1;
                foreach ($data as $sds => $link) {
                    $IdKulturaLokacija = $link['IdKulturaLokacija'];
                    $NazivKulturaLokacija= $link['NazivKulturaLokacija'];
                    $ImeKulture = $link['ImeKulture'];
                    $ImeLokSamo = $link['ImeLokSamo'];


                    $tab .=
                        '<tr>

                    <td >' . $IdKulturaLokacija . '</td>
                    <td>' . $ImeLokSamo . '</td>
                    <td data-toggle="tooltip" title="'.$NazivKulturaLokacija. '!" >' . $ImeKulture . '</td>


                    <td class="align-center">
                        <div class="btn-group">
                            <button class="btn dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-dashboard"></i> Akcija
                                <span class="caret"></span>
                            </button>
                                <ul class="dropdown-menu">
                                    <li><a href="/admin/index.php?stranica=editlokkulture&id=' . $IdKulturaLokacija . '"> <i class="icon-edit"> </i> Izmeni</a></li>
                                    <li><a href="/akcija.php?action=obrisilokkulture&id=' . $IdKulturaLokacija . '"> <i class="icon-remove"> </i> Obrisi</a></li>
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



