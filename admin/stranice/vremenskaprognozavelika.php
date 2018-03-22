<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 13. 11. 2015.
 * Time: 12:14 PM
 */

?>
<div class="row">
    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-reorder"></i> Vremenska prognoza detaljna</h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs"><?php echo '<a href="'.DPROOT.'/cron/vremeprogubac.php">--Upucaj prognozu--</a>'; ?></span>
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>
            <div class="widget-content">
                <table class="table table-striped table-bordered table-hover table-checkable table-colvis datatable">
                    <thead>
                    <tr>
                        <th>Prognoza Od</th>
                        <th>Za</th>
                        <th>Grad</th>
                        <th>Temperatura</th>
                        <th>Pritisak</th>
                        <th>Brzina i smer vetra</th>
                        <th>Vlaga</th>
                        <th>Padavine</th>
                        <th>Opis</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    $podaci = $db->get('vremenska');

                    $i = 1;

                    foreach ($podaci as $sds => $link) {
                        $imegrada= $link['imegrada'];
                        $start = date( 'd. M  H:i', strtotime( $link['prognoza_start'] ) ); //H:i:s
                        $termin = date( 'd. M  H:i', strtotime( $link['prognoza_termin'] ) ); //H:i:s
                        $temperatura = $link['temperatura'];
                        $pritisak = $link['pritisak'];
                        $brzina_vetra = $link['brzina_vetra'];
                        $smer_vetra = $link['smer_vetra'];
                        $vlaga = $link['vlaga'];
                        $padavine = $link['padavine'];
                        $opis = $link['opis'];

                        $r .= '<tr>
                        <td>' . $start . '</td>
                        <td>' . $termin . '</td>
                        <td>' . $imegrada . '</td>
                        <td>' . $temperatura . ' C</td>
                        <td>' . $pritisak . ' mbr</td>
                        <td>' . $brzina_vetra. ' km/h ' . $pritisak . 'mb</td>
                        <td>' . $vlaga . '%</td>
                        <td>' . $padavine . '</td>
                        <td>' . $opis . '</td>
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
