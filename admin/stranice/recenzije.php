<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 19. 01. 2016.
 * Time: 12:31
 */
?>
<div class="row">
    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-reorder"></i> Recenzije</h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>
            <div class="widget-content">
                <table class="table table-striped table-bordered table-hover datatable">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Artikal</th>
                        <th>ArtikalId</th>
                        <th>Komentar Za</th>
                        <th>Komentar Protiv</th>
                        <th>Komitent</th>
                        <th>Aktivan</th>
                        <th>Iskoriscen</th>
                        <th>Akcija</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php

                    $db->join("komitenti K", "K.KomitentId = R.KomitentRecenzije", "LEFT");
                    $db->join("artikli A", "A.ArtikalId = R.ProizvodRecenzije", "LEFT");
                    $db->join("artikalnazivnew ANN", "A.ArtikalId=ANN.ArtikalId AND ANN.IdLanguage = 5", "LEFT");
                    //$db->where("ANN.IdLanguage = 5");
                    $data = $db->get("recenzije R", null, "ANN.OpisArtikla, A.ArtikalId, K.KomitentUserName, K.KomitentIme, K.KomitentPrezime, K.KomitentId, R.*");
                    $i = 1;

                    foreach ($data as $sds => $link) {
                        $IdRecenzije = $link['IdRecenzije'];
                        $ArtikalNaziv = $link['OpisArtikla'];
                        $ArtikalId = $link['ArtikalId'];
                        $KomentarZaRecenzije = $link['KomentarZaRecenzije'];
                        $KomentarProtivRecenzije = $link['KomentarProtivRecenzije'];


                        $KomitentId = $link['KomitentId'];
                        $KomitentIme = $link['KomitentIme'];
                        $KomitentPrezime = $link['KomitentPrezime'];
                        $KomitentUserName = $link['KomitentUserName'];

                        $KomentarAktivanRecenzije = $link['KomentarAktivanRecenzije'];
                        $aktivan = ($KomentarAktivanRecenzije) ? 'checked="checked"' : '';
                        $IskoriscenRecenzije = $link['IskoriscenRecenzije'];
                        $iskoriscen = ($IskoriscenRecenzije) ? 'checked="checked"' : '';


                        $rec .= '<tr>
                        <td>' . $IdRecenzije . '</td>
                        <td><a target="_blank" href="' . DPROOT . '/proizvod/' . $ArtikalId . '">' . $ArtikalNaziv . '</a></td>
                        <td>' . $ArtikalId . '</td>
                        <td>' . $KomentarZaRecenzije . '</td>
                        <td>' . $KomentarProtivRecenzije . '</td>
                        <td><a target="_blank" class="text-danger" href="/' . $KomitentUserName . '">' . $KomitentIme . ' ' . $KomitentPrezime .' </a></td>
                        <td class="align-center">
                        <input type="checkbox" class="uniform" disabled="disabled" value="' . $KomentarAktivanRecenzije . '" ' . $aktivan . '/>
                        </td>
                        <td class="align-center">
                        <input type="checkbox" class="uniform" disabled="disabled" value="' . $IskoriscenRecenzije . '" ' . $iskoriscen . '/>
                        </td>
                        <td class="align-center">
                        <div class="btn-group">
                            <button class="btn dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-dashboard"></i>
                                <span class="caret"></span>
                            </button>
                                <ul class="dropdown-menu">
                                    <li><a href="/admin/index.php?stranica=editrecenzije&id=' . $IdRecenzije . '"> <i class="icon-edit"> </i> Izmeni</a></li>
                                    <li><a href="/akcija.php?action=obrisirecenzije&id=' . $IdRecenzije . '"> <i class="icon-remove"> </i> Obrisi</a></li>
                                </ul>
                        </div>
                    </td>
                    </tr>';

                        $i++;
                    }
                    echo $rec;
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!--=== Page Content ===-->