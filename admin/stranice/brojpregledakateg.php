<?php
/**
 * Project: masine
 * Created by PhpStorm.
 * User: Nikola
 * Date: 04. 03. 2016.
 * Time: 11:24
 */
?>

<div class="row">
    <div class="col-md-12 col-xs-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-reorder"></i> Broj pregleda kategorija</h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>

            <div class="widget-content no-padding">

                <table
                    class="table table-striped table-bordered table-hover table-checkable table-columnfilter datatable"
                    data-columnFilter='{"aoColumns": [ null, {"type": "text"}, {"type": "text"}, {"type": "text"}, { "type": "select" } ]}'
                    data-columnFilter-select2="true">
                    <thead>
                    <tr>
                        <th class="checkbox-column">
                            <input type="checkbox" class="uniform">
                        </th>
                        <th>Id Kateg</th>
                        <th>Ime kategorije</th>
                        <th>Parent</th>
                        <th>Broj pregleda</th>
                        <th>Specifikacija</th>
                        <th>Specifikacija</th>
                        <th>Izmeni kategoriju</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php

                    $svekateg = SVEKATEGORIJEMASINE;

                    $upitkateg = "
                                   SELECT
                                   K.KategorijaArtikalaId,
                                   KAN.NazivKategorije,
                                   K.ParentKategorijaArtikalaId,
                                   K.KategorijeBrojPregleda,
                                   K.KategorijaArtikalaLink,
                                   SK.IdSpecKategorija,
                                   SGN.NazivSpecGrupe
                                   FROM
                                   kategorijeartikala K
                                   JOIN kategorijeartikalanaslov KAN ON KAN.IdKategorije = K.KategorijaArtikalaId  AND KAN.IdLanguage = $jezikId
                                   LEFT JOIN speckategorija SK ON SK.IdSpecKategorija = K.KategorijaArtikalaId
                                   LEFT JOIN specifikacijagrupe SG ON SG.IdSpecGrupe = SK.IdGrupeSpecKategorija
                                   LEFT JOIN specgrupenaz SGN ON SGN.IdSpecGrupe = SG.IdSpecGrupe AND SGN.IdLanguage = $jezikId
                                   WHERE K.ParentKategorijaArtikalaId IN ($svekateg)
                                   ORDER BY K.KategorijeBrojPregleda DESC ";

                    $keyArtAr = $db->rawQuery($upitkateg);

                    $i = 1;
                    foreach ($keyArtAr as $sds => $link) {
                        $KategorijaArtikalaId = $link['KategorijaArtikalaId'];
                        $Katsrblat = $link['NazivKategorije'];
                        $NazivSpecGrupe = $link['NazivSpecGrupe'];
                        $KategorijaArtikalaLink = $link['KategorijaArtikalaLink'];
                        $KategorijeBrojPregleda = $link['KategorijeBrojPregleda'];
                        $ParentKategorijaArtikalaId = $link['ParentKategorijaArtikalaId'];
                        $IdSpecKategorija = $link['IdSpecKategorija'];
                        $akt = ($IdSpecKategorija) ? 'checked="checked"' : '';

                        $daliimapodkat = "SELECT daLiImaPodkat($KategorijaArtikalaId,0,5) AS kolikoImaPodkat";
                        $kolikoImaPodkatRes = $db->rawQuery($daliimapodkat);

                    foreach ($kolikoImaPodkatRes as $sdsaa => $linkaa) {
                        $imaPodkat = $linkaa['kolikoImaPodkat'];

                        if (!$imaPodkat) {

                            $pregled .= '<tr>';
                            $pregled .= '<td class="checkbox-column"><input type="checkbox" class="uniform" value="' . $IdSpecKategorija . '" ' . $akt . '></td>';
                            $pregled .= '<td>' . $KategorijaArtikalaId . '</td>';
                            $pregled .= '<td><a data-original-title="Kategorija" target="_blank" href="' . DPROOT . '/' . $KategorijaArtikalaLink . '" title="' . $Katsrblat . '">' . $Katsrblat . '</a></td>';
                            $pregled .= '<td class="align-center">' . $ParentKategorijaArtikalaId . '</td>';
                            $pregled .= '<td class="align-center">' . $KategorijeBrojPregleda . '</td>';
                            $pregled .= '<td class="checkbox-column"><input type="checkbox" class="uniform" value="' . $IdSpecKategorija . '" ' . $akt . '></td>';
                            $pregled .= '<td class="align-center">' . $NazivSpecGrupe . '</td>';
                            $pregled .= '<td class="align-center"><a data-original-title="Izmeni" target="_blank" href="' . DPROOTADMIN . '/kat/' . $KategorijaArtikalaId . '" class="btn btn-md bs-tooltip " title=""><i class=" icon-edit"></i></a></td>';
                            $pregled .= '</tr>';
                        }
                    }
                    }
                    echo $pregled;
                    $i++;
                    ?>


                    </tbody>
                    <tfoot>
                    <tr>
                        <th></th>
                        <th>Id</th>
                        <th>Kategorija</th>
                        <th>Id</th>
                        <th class="hidden"></th>
                        <th class="hidden"></th>
                        <th class="hidden"></th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>



