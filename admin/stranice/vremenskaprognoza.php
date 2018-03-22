<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 05. 08. 2015.
 * Time: 3:32 PM
 * Edited: 09:13 PM
 */

?>


<div class="row">
    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-reorder"></i> Vremenska prognoza mala</h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs"><?php echo '<a href="'.DPROOT.'/cron/vremeprogubacmala.php">--Upucaj prognozu--</a>'; ?></span>
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>
            <div class="widget-content">
                <table class="table table-striped table-bordered table-hover table-checkable table-colvis datatable">
                    <thead>
                    <tr>
                        <th>Datum</th>
                        <th>Grad</th>
                        <th>Minimalna</th>
                        <th>Maksimalna</th>
                        <th>Opis</th>

                    </tr>
                    </thead>
                    <tbody>

                    <?php


                    $db->orderBy("DatumVremeVremenskaMala","asc");
                    $podaci = $db->get('vremenskamala');

                    $i = 1;

                    foreach ($podaci as $sds => $link) {
                        $ImeGradaVremenskaMala = $link['ImeGradaVremenskaMala'];
                       // $DatumVremeVremenskaMala = $link[DatumVremeVremenskaMala];
                        $DatumVremeVremenskaMala = date( 'd. M Y.', strtotime( $link['DatumVremeVremenskaMala'] ) ); //H:i:s
                        $MinimalnaVremenskaMala = $link['MinimalnaVremenskaMala'];
                        $MaksimalnaVremenskaMala = $link['MaksimalnaVremenskaMala'];
                        $OpisVremenskaMala = $link['OpisVremenskaMala'];

                        $r .= '<tr>
                        <td>' . $DatumVremeVremenskaMala . '</td>
                        <td>' . $ImeGradaVremenskaMala . '</td>
                        <td>' . $MinimalnaVremenskaMala . ' C</td>
                        <td>' . $MaksimalnaVremenskaMala . ' C</td>
                        <td>' . $OpisVremenskaMala . '</td>

                    </tr>';

                    }
                    echo $r;
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!--=== Page Content ===-->
