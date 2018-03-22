<?php
/**
 * Project: masine
 * Created by PhpStorm.
 * User: Nikola
 * Date: 28. 01. 2016.
 * Time: 16:19
 */
?>

<div class="row">

    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-list-alt"></i> Vrste dokumenata</h4>

                <div class="toolbar">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>
            <div class="widget-content">
                <table class="table table-striped table-bordered table-hover table-checkable table-colvis datatable">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Naziv</th>
                        <th class="centriraj" >Tip dokumenta</th>
                        <th class="centriraj" >Prefiks</th>
                        <th class="centriraj" >Aktivno</th>
                        <th class="centriraj" >Akcija</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php

                    // $db->setTrace (true);

                    $data = $db->get("vrstedokumenata", null);
                    //var_dump($data);

                    //var_dump($db->trace);

                    $i = 1;
                    foreach ($data as $sds => $link) {
                        $VrsteDokumenataId = $link['VrsteDokumenataId'];
                        $VrsteDokumenataNaziv = $link['VrsteDokumenataNaziv'];
                        $TipDokumenataSifra = $link['TipDokumenataSifra'];
                        $VrsteDokumenataPrefiks = $link['VrsteDokumenataPrefiks'];
                        $VrsteDokumenataActive = $link['VrsteDokumenataActive'];
                        if($VrsteDokumenataActive){$aktivno = '<b class="bojacrvena">AKTIVNO</b>';}else{$aktivno = 'Nije aktivno';}

                        $r .= '<tr>
                        <td style="vertical-align: middle">' . $VrsteDokumenataId . '</td>
                        <td style="vertical-align: middle"><b>' . $VrsteDokumenataNaziv . '</b></td>
                        <td style="vertical-align: middle" class="centriraj">' . $TipDokumenataSifra . '</td>
                        <td style="vertical-align: middle" class="centriraj">' . $VrsteDokumenataPrefiks . '</td>
                        <td style="vertical-align: middle" class="centriraj">' . $aktivno . '</td>
                        <td style="vertical-align: middle" class="centriraj">
                        <div class="btn-group">
                            <div >
                                <button class="btn btn-xs dropdown-toggle" data-toggle="dropdown">
											<i class="icol-cog"></i> Akcija
											<span class="caret"></span>
							    </button>
                                <ul class="dropdown-menu pull-right">';
                        if ($VrsteDokumenataActive == 1) {
                            $r .= '<li><a onclick="return confirmSubmit()" href="/akcija.php?action=aktivirajdokumenta&id=' . $VrsteDokumenataId . '&naziv=vrsta&string=deaktiviraj"> <i class="icon-edit"> </i>Deaktiviraj</a></li>';
                        } else {
                            $r .= '<li><a onclick="return confirmSubmit()" href="/akcija.php?action=aktivirajdokumenta&id=' . $VrsteDokumenataId . '&naziv=vrsta&string=aktiviraj"> <i class="icon-remove"> </i> Aktiviraj</a></li>';
                        }

                        $r .= '</ul>
                             </div>
                    </td>

                    </tr>';
                        $i++;
                    }

                    echo $r;
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
