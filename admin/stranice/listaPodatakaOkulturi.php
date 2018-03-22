<div class="col-md-12 col-xs-6">
    <div class="widget box">
        <div class="widget-header">
            <h4><i class="icon-list-alt"></i> Lista podataka o kulturi</h4>

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

                    <th>Senzor</th>
                    <th>Senzor</th>
                    <th>Idealno od</th>
                    <th>Idealno do</th>
                    <th>Zuto od</th>
                    <th>Zuto do</th>
                    <th>Izaberi</th>
                </tr>
                </thead>
                <tbody>
                <?php


                $cols = Array("PK.IdPodaciKulTipLok, PK.OdPodaciIdeal, PK.DoPodaciIdeal, PK.OdZutoIdeal, PK.DoZutoIdeal,  K.ImeKulture, ST.senzorTipIme");
                $db->join("senzorkullokpodaci SKL", "SKL.IdKulLokPodaci = PK.IdKulLokPodaci");
                $db->join("senzortip ST", "ST.IdSenzorTip = SKL.IdSenzorTip");
                // $db->join("kulturalokacija KL", "KL.IdKulturaLokacija = SKL.IdKultureKulLok");
                $db->join("kulture K", "K.IdKulture = SKL.IdKulture");
                $db->where("K.IdKulture", $id);
                $data = $db->get("podacikultiplok PK", null, $cols);


                if ($data) {

                    $i = 1;
                    foreach ($data as $sds => $link) {
                        $IdPodKulTipLok = $link['IdPodaciKulTipLok'];
                        $OdPodaciIdeal = $link['OdPodaciIdeal'];
                        $DoPodaciIdeal = $link['DoPodaciIdeal'];
                        $OdZutoIdeal = $link['OdZutoIdeal'];
                        $DoZutoIdeal = $link['DoZutoIdeal'];
                        $ImeKulture = $link['ImeKulture'];
                        $senzorTipIme = $link['senzorTipIme'];


                        $tab .=

                            //ovde ide dugme da te vodi na senzor
                            '<tr>
                    <td>' . $ImeKulture . '</td>
                    <td>' . $senzorTipIme . '</td>
                    <td>' . $OdPodaciIdeal . '</td>
                    <td>' . $DoPodaciIdeal . '</td>
                    <td>' . $OdZutoIdeal . '</td>
                    <td>' . $DoZutoIdeal . '</td>

                    <td class="align-center">
                        <div class="btn-group">
                            <button class="btn dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-dashboard"></i> Akcija
                                <span class="caret"></span>
                            </button>
                                <ul class="dropdown-menu">
                                    <li><a href="/admin/str/editpodkulturesve/' . $IdPodKulTipLok . '"> <i class="icon-edit"> </i> Izmeni</a></li>
                                    <li><a href="/akcija.php?action=obrisipodkulturesve&id=' . $IdPodKulTipLok . '"> <i class="icon-remove"> </i> Obrisi</a></li>
                                </ul>
                        </div>
                    </td>
                </tr>';
                    }
                    echo $tab;
                }
                ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
