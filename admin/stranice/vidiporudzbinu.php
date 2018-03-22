<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 01. 09. 2015.
 * Time: 00:57
 */
?>
<div class="row">
    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-reorder"></i> Porudzbina </h4>
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
                        $ImeNarudz = $link['ImeNarudz'];
                        $PrezimeNarudz = $link['PrezimeNarudz'];
                        $AdresaNarudz = $link['AdresaNarudz'];
                        $MestoNarudz = $link['MestoNarudz'];
                        $PostBrojNarudz = $link['PostBrojNarudz'];
                        $MobNarudz = $link['MobNarudz'];
                        $FixNarudz = $link['FixNarudz'];
                        $NapomenaNarudz = $link['NapomenaNarudz'];

                        $ttt .= '<tr>';
                        $ttt .= '<td><strong>' . 'Id porudzbine' . '</strong></td>';
                        $ttt .= '<td colspan="6">' . $IdNarudzbine . '</td>';
                        $ttt .= '</tr>';

                        $ttt .= '<tr>';
                        $ttt .= '<td><strong>' . 'Ime' . '</strong></td>';
                        $ttt .= '<td colspan="6">' . $ImeNarudz . '</td>';
                        $ttt .= '</tr>';

                        $ttt .= '<tr>';
                        $ttt .= '<td><strong>' . 'Prezime' . '</strong></td>';
                        $ttt .= '<td colspan="6">' . $PrezimeNarudz . '</td>';
                        $ttt .= '</tr>';

                        $ttt .= '<tr>';
                        $ttt .= '<td><strong>' . 'Adresa' . '</strong></td>';
                        $ttt .= '<td colspan="6">' . $AdresaNarudz . '</td>';
                        $ttt .= '</tr>';

                        $ttt .= '<tr>';
                        $ttt .= '<td><strong>' . 'Pos.br.' . '</strong></td>';
                        $ttt .= '<td colspan="6">' . $PostBrojNarudz . '</td>';
                        $ttt .= '</tr>';

                        $ttt .= '<tr>';
                        $ttt .= '<td><strong>' . 'Mesto' . '</strong></td>';
                        $ttt .= '<td colspan="6">' . $MestoNarudz . '</td>';
                        $ttt .= '</tr>';

                        $ttt .= '<tr>';
                        $ttt .= '<td><strong>' . 'Vreme' . '</strong></td>';
                        $ttt .= '<td colspan="6">' . $VremeNarudz . '</td>';
                        $ttt .= '</tr>';

                        $ttt .= '<tr>';
                        $ttt .= '<td><strong>' . 'Mob' . '</strong></td>';
                        $ttt .= '<td colspan="6">' . $MobNarudz . '</td>';
                        $ttt .= '</tr>';

                        $ttt .= '<tr>';
                        $ttt .= '<td><strong>' . 'Fix' . '</strong></td>';
                        $ttt .= '<td colspan="6">' . $FixNarudz . '</td>';
                        $ttt .= '</tr>';

                        $ttt .= '<tr>';
                        $ttt .= '<td><strong>' . 'Napomena' . '</strong></td>';
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
                        <th>id</th>
                        <th>Artikal</th>
                        <th>Kolicina</th>
                        <th>Cena</th>
                        <th>Valuta</th>
                        <th>Jed mere</th>
                        <th>Ukupno</th>
                    </tr>

                    </thead>

                    <tbody>
                    <?php

                    $db->join("artikli a", "n.ArtIdNarudzLista=a.ArtikalId", "LEFT");
                    $db->join("artikalnazivnew ann", "ann.ArtikalId=a.ArtikalId AND ann.IdLanguage = '5' ", "LEFT");
                    $db->join("valuta v", "n.ValutaNarudzLista=v.ValutaId", "LEFT");
                    $db->join("unit u", "n.UnitNarudzLista=u.IdUnit", "LEFT");
                    $db->where("IdNarudzPov", $id );
                    $data = $db->get("narudzlista n", null, "n.IdNarudzLista, n.CenaNarudzLista, n.KolicinaNarudzlista, ann.OpisArtikla, v.ValutaNaziv, u.TipUnit");

                    $i = 1;
                    foreach ($data as $casc => $veza) {

                        $IdNarudzLista = $veza['IdNarudzLista'];
                        $ArtIdNarudzLista = $veza['OpisArtikla'];
                        $KolicinaNarudzlista = $veza['KolicinaNarudzlista'];
                        $CenaNarudzLista = $veza['CenaNarudzLista'];
                        $ValutaNarudzLista = $veza['ValutaNaziv'];
                        $UnitNarudzLista = $veza['TipUnit'];

                        $tdd .= '<tr>';
                        $tdd .= '<td>' . $IdNarudzLista . '</td>';
                        $tdd .= '<td>' . $ArtIdNarudzLista . '</td>';
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