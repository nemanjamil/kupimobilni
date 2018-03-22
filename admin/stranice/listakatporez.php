<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 24.11.15.
 * Time: 16.44
 */
?>
<!--=== Page Content ===-->
<div class="col-md-12 col-xs-6">
    <div class="widget box">
        <div class="widget-header">
            <h4><i class="icon-list-alt"></i> Lista poreza po kategorijama</h4>

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
                    <th>Kategorija</th>
                    <th>Zemlja</th>
                    <th>Vrednost</th>
                    <th>Izaberi</th>
                </tr>
                </thead>
                <tbody>
                <?php

                $db->join("kategorijeartikala KA", "KA.KategorijaArtikalaId = PKZ.IdKategPdvKatZem", "LEFT");
                $db->join("kategorijeartikalanaslov KAN", "KAN.IdKategorije=KA.KategorijaArtikalaId", "LEFT");
                $db->join("zemlja Z", "Z.IdZemlja = PKZ.IdZemljePdvKatZem", "LEFT");
                $db->join("pdvlistaporeza PLP", "PLP.IdPdvListaPoreza = PKZ.PdvKategZemlja", "LEFT");
                $db->where("KAN.IdLanguage = 5");
                $data = $db->get("pdvkategzemlja PKZ", null, "KAN.NazivKategorije, Z.ImeZemlja, PLP.PorezVrednost, PKZ.IdPdvKategZemlja");
                $i = 1;
                foreach ($data as $sds => $link) {

                    $IdPdvKategZemlja = $link['IdPdvKategZemlja'];
                    $Katsrblat = $link['NazivKategorije'];
                    $ImeZemlja = $link['ImeZemlja'];
                    $PorezVrednost = $link['PorezVrednost'];

                    $tab .=

                        '<tr>

                    <td>' . $Katsrblat . '</td>
                    <td>' . $ImeZemlja . '</td>
                    <td>' . $PorezVrednost . '</td>

                    <td class="align-center">
                        <div class="btn-group">
                            <button class="btn dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-dashboard"></i> Akcija
                                <span class="caret"></span>
                            </button>
                                <ul class="dropdown-menu">
                                    <li><a href="/admin/index.php?stranica=editkategporez&id=' . $IdPdvKategZemlja . '"> <i class="icon-edit"> </i> Izmeni</a></li>
                                    <li><a href="/akcija.php?action=obrisikategporez&id=' . $IdPdvKategZemlja . '"> <i class="icon-remove"> </i> Obrisi</a></li>
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



