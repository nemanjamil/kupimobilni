<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 18. 09. 2015.
 * Time: 12:45
 */
?>
<div class="row">
    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-reorder"></i> Porudzbina</h4>
                <!--Dugme skupi listu-->
                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>

            <div class="widget-content no-padding">
                <table
                    class="table table-striped table-bordered table-hover table-checkable table-tabletools datatable">
                    <thead>
                    <?php
                    $prva = $db->where("IdNarudzbine", $id);
                    $podaci = $db->get("narudzbine");
                    //var_dump($data);
                    $i = 1;
                    foreach ($podaci as $aaa => $link) {

                        $IdNarudzbine = $link['IdNarudzbine'];
                        $VremeNarudz = $link['VremeNarudz'];
                        $fdate = date('d.m.Y. H:i', strtotime($VremeNarudz));
                        $ImeNarudz = $link['ImeNarudz'];
                        $PrezimeNarudz = $link['PrezimeNarudz'];
                        $AdresaNarudz = $link['AdresaNarudz'];
                        $MestoNarudz = $link['MestoNarudz'];
                        $PostBrojNarudz = $link['PostBrojNarudz'];
                        $MobNarudz = $link['MobNarudz'];
                        $FixNarudz = $link['FixNarudz'];
                        $NapomenaNarudz = $link['NapomenaNarudz'];

                        $ttt .= '<tr>';
                        $ttt .= '<td><strong> ' . $jsonlang[238][$jezikId] . ' ' . $jsonlang[243][$jezikId].' </strong></td>';
                        $ttt .= '<td colspan="6">' . $IdNarudzbine . '</td>';
                        $ttt .= '</tr>';

                        $ttt .= '<tr>';
                        $ttt .= '<td><strong>' . $jsonlang[140][$jezikId] . '</strong></td>';
                        $ttt .= '<td colspan="6">' . $ImeNarudz . '</td>';
                        $ttt .= '</tr>';

                        $ttt .= '<tr>';
                        $ttt .= '<td><strong>' . $jsonlang[141][$jezikId] . '</strong></td>';
                        $ttt .= '<td colspan="6">' . $PrezimeNarudz . '</td>';
                        $ttt .= '</tr>';

                        $ttt .= '<tr>';
                        $ttt .= '<td><strong>' . $jsonlang[155][$jezikId] . '</strong></td>';
                        $ttt .= '<td colspan="6">' . $AdresaNarudz . '</td>';
                        $ttt .= '</tr>';

                        $ttt .= '<tr>';
                        $ttt .= '<td><strong>' . $jsonlang[137][$jezikId] . '</strong></td>';
                        $ttt .= '<td colspan="6">' . $PostBrojNarudz . '</td>';
                        $ttt .= '</tr>';

                        $ttt .= '<tr>';
                        $ttt .= '<td><strong>' . $jsonlang[143][$jezikId] . '</strong></td>';
                        $ttt .= '<td colspan="6">' . $MestoNarudz . '</td>';
                        $ttt .= '</tr>';

                        $ttt .= '<tr>';
                        $ttt .= '<td><strong>' . $jsonlang[239][$jezikId] . '</strong></td>';
                        $ttt .= '<td colspan="6">' . $fdate . '</td>';
                        $ttt .= '</tr>';

                        $ttt .= '<tr>';
                        $ttt .= '<td><strong>' . $jsonlang[148][$jezikId] . '</strong></td>';
                        $ttt .= '<td colspan="6">' . $FixNarudz . '</td>';
                        $ttt .= '</tr>';

                        $ttt .= '<tr>';
                        $ttt .= '<td><strong>' . $jsonlang[151][$jezikId]. '</strong></td>';
                        $ttt .= '<td colspan="6">' . $MobNarudz . '</td>';
                        $ttt .= '</tr>';

                        $ttt .= '<tr>';
                        $ttt .= '<td><strong>' . $jsonlang[152][$jezikId] . '</strong></td>';
                        $ttt .= '<td colspan="6">' . $NapomenaNarudz . '</td>';
                        $ttt .= '</tr>';
                    }
                    echo $ttt;
                    $ttt = '';
                    ?>

                    <tr>
                        <td colspan="7"></td>
                    </tr>

                    <tr>

                        <th><?php echo $jsonlang[244][$jezikId]; ?></th>
                        <th><?php echo $jsonlang[130][$jezikId]; ?></th>
                        <th><?php echo $jsonlang[71][$jezikId]; ?></th>
                        <th><?php echo $jsonlang[424][$jezikId]; ?></th>
                        <th><?php echo $jsonlang[217][$jezikId]; ?></th>
                        <th><?php echo $jsonlang[131][$jezikId]; ?></th>
                    </tr>

                    </thead>

                    <tbody>
                    <?php

                    $db->join("artikli a", "n.ArtIdNarudzLista=a.ArtikalId", "LEFT");
                    $db->join("artikalnazivnew ann", "a.ArtikalId = ann.ArtikalId AND ann.IdLanguage = $jezikId");
                    $db->join("valuta v", "n.ValutaNarudzLista=v.ValutaId", "LEFT");
                    $db->join("unit u", "n.UnitNarudzLista=u.IdUnit", "LEFT");
                    $db->where("IdNarudzPov", $id);
                    $data = $db->get("narudzlista n", null, "n.IdNarudzLista,n.CenaNarudzLista,n.KolicinaNarudzlista,ann.OpisArtikla,v.ValutaNaziv,u.TipUnit, n.ArtIdNarudzLista");

                    $i = 1;
                    foreach ($data as $casc => $veza) {

                        $IdNarudzLista = $veza['IdNarudzLista'];
                        $ArtikalIdUpit = $veza['ArtIdNarudzLista'];
                        $ArtIdNarudzLista = $veza['OpisArtikla'];
                        $KolicinaNarudzlista = $veza['KolicinaNarudzlista'];
                        $CenaNarudzLista = $veza['CenaNarudzLista'];
                        $ValutaNarudzLista = $veza['ValutaNaziv'];
                        $UnitNarudzLista = $veza['TipUnit'];
                        $artLink = $common->linkoDoArt($ArtikalIdUpit);

                        $tdd .= '<tr>';
                        $tdd .= '<td><a href="'.$artLink.'" target="_blank" style="text-decoration: none !important;" >' . $ArtIdNarudzLista . '</a> </td>';
                        $tdd .= '<td>' . $KolicinaNarudzlista . '</td>';
                        $tdd .= '<td>' . $CenaNarudzLista . '</td>';
                        $tdd .= '<td>' . $ValutaNarudzLista . '</td>';
                        $tdd .= '<td>' . $UnitNarudzLista . '</td>';
                        $tdd .= '<td>' . $KolicinaNarudzlista * $CenaNarudzLista . '</td>';
                        $tdd .= '</tr>';


                    }
                    echo $tdd;
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>