<div class="col-md-6 col-xs-6">
    <div class="widget box">
        <div class="widget-header">
            <h4><i class="icon-list-alt"></i>Vlažnost Vazduha</h4>

            <div class="toolbar">
                <div class="btn-group">
                    <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                </div>
            </div>
        </div>
        <div class="widget-content">

            <?php

            /* $cols = Array("K.ImeKulture","ST.senzorTipIme", "LSU.ImeLokSamo", "KL.NazivKulturaLokacija", "SKL.NazivKulLokPod", "PKL.*");
             $db->join("kulturalokacija KL", "KL.IdKulturaLokacija = LS.PripadaKulLok");
             $db->join("kulture K", "KL.PovKulture = K.IdKulture");
             $db->join("lokalnasu LSU", "KL.PovLokSamouprava = LSU.IdLokSamo");
             $db->join("senzorkullokpodaci SKL", "SKL.IdKultureKulLok = LS.PripadaKulLok");
             $db->join("senzortip ST", "ST.IdSenzorTip = SKL.IdTipKulTipLok");
             $db->join("podacikultiplok PKL", "PKL.IdSenzorKulPodLok = SKL.IdKulLokPodaci");
             $db->where("LS.SenzorSifra", '18FE349DB7E6');
             $link = $db->get("listasenzora LS", null, $cols);

             foreach ($link as $k=> $v):

                 $links[$v['IdPodaciKulTipLok']] = $v;

                 $data = Array("idSenzorTemp" => $idSifra,
                     "vredSenzorTemp" => $temperature
                 );
                 $id = $db->insert('senzortemp', $data);


             endforeach;*/





            $cols = Array("PN.idPodatka","PN.idNotInc","PN.vecaManjaNoti", "SV.vredSenzorVlaznosti", "PN.vremeNotifikacije","PN.tipNotifikacije", "TN.OpisNotifikacije","PN.poslatMail");
            $db->join("senzortip ST", "ST.IdSenzorTip = PN.tipSenzora");
            $db->join("listasenzora LS", "LS.SenzorSifra = PN.notSifraSenzora");
            $db->join("senzorvlaznosti SV ", "SV.idSenVlazVazIcnr = PN.idPodatka"); // ovo menjamo
            $db->join("tipnotifikacije TN", "TN.IdTipNotifikacijeIncr = PN.tipNotifikacije");
            $db->where("PN.notSifraSenzora", $SenzorSifra);
            // $db->where("PN.tipNotifikacije", 2);
            $db->where("ST.IdSenzorTip", $vlaznovId);
            $db->orderBy("PN.vremeNotifikacije","DESC");
            $link = $db->get("podacinotifikacija PN", $limitNotifikacija, $cols);

            //var_dump($db);

            /*$w = json_encode($link);
            $someObject = json_decode($w);
            echo $idSifra = $someObject[0]->ImeKulture;*/


            ?>

            <!--success info warning danger-->

            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Poslat Mail</th>
                    <th>Vrednost Vlaznost Vazduha</th>
                    <th>vremeNotifikacije</th>
                    <th>Status</th>
                    <th>Gornji Donji</th>
                    <th>Detalji</th>
                </tr>
                </thead>
                <tbody>

                <?php

                if ($link) {
                    $poN = '';
                    foreach ($link as $k=> $v):


                        $idPodatka = $v['idPodatka'];
                        $idNotInc = $v['idNotInc'];
                        $vredSenzorVlaznosti = $v['vredSenzorVlaznosti'];
                        $vremeNotifikacije = $v['vremeNotifikacije'];
                        $tipNotifikacije = $v['tipNotifikacije'];
                        $OpisNotifikacije = $v['OpisNotifikacije'];
                        $poslatMail = $v['poslatMail'];
                        $vecaManjaNoti = $v['vecaManjaNoti'];

                        $vecaManjaNoti = ($vecaManjaNoti==1) ? '<i class="icon-circle-arrow-up"></i>' : '<i class="icon-circle-arrow-down"></i>';

                        switch ($tipNotifikacije) {
                            case 1:
                                $opisKocka = "success";
                                break;
                            case 2:
                                $opisKocka = "warning";
                                break;
                            case 3:
                                $opisKocka = "danger";
                                break;
                        }


                        switch ($poslatMail) {
                            case 0:
                                $pmail = "info";
                                $tk = '<i class="icon-fixed-width">&#xf00d;</i>';
                                break;
                            case 1:
                                $pmail = "success";
                                $tk = '<i class="icon-check">&#xf046;</i>';
                                break;

                        }

                        $poN .= '<tr>';
                        $poN .= '<td>'.$tk.'</td>';
                        $poN .= '<td>'.$vredSenzorVlaznosti.'</td>';
                        $poN .= '<td>'.$vremeNotifikacije.'</td>';
                        $poN .= '<td><span class="label label-'.$opisKocka.'">'.$opisKocka.'</span></td>';
                        $poN .= '<td>'.$vecaManjaNoti.'</td>';
                        $poN .= '<td class="align-center"><span class="btn-group"> <a data-original-title="Search"
                                                                         href="javascript:void(0);"
                                                                         class="btn btn-xs bs-tooltip" title=""><i
                                    class="icon-search"></i></a> <a data-original-title="Edit"
                                                                    href="javascript:void(0);"
                                                                    class="btn btn-xs bs-tooltip" title=""><i
                                    class="icon-pencil"></i></a> <a data-original-title="Delete"
                                                                    href="javascript:void(0);"
                                                                    class="btn btn-xs bs-tooltip" title=""><i
                                    class="icon-trash"></i></a> </span></td>';

                        $poN .= '</tr>';

                    endforeach;


                }

                echo $poN;
                ?>


                </tbody>
            </table>

            <br>
            <br>
            <br>

            <table
                class="table table-striped table-bordered table-hover ">
                <thead>
                <tr>
                    <th>Senzor</th>
                    <th>Zuto od</th>
                    <th>Idealno od</th>
                    <th>Idealno do</th>
                    <th>Zuto do</th>
                    <th>Izaberi</th>
                </tr>
                </thead>
                <tbody>

                <?php


                $cols = Array("PKL.IdSenzorKulPodLok","PKL.IdPodaciKulTipLok", "SKL.NazivKulLokPod", "PKL.OdPodaciIdeal", "PKL.DoPodaciIdeal", "PKL.OdZutoIdeal", "PKL.DoZutoIdeal");
                $db->join("senzorkullokpodaci SKL", "SKL.IdKultureKulLok = LS.PripadaKulLok");
                $db->join("podacikultiplok PKL", "PKL.IdSenzorKulPodLok = SKL.IdKulLokPodaci");
                $db->where("LS.SenzorSifra", $SenzorSifra);
                $db->where("SKL.IdTipKulTipLok", 1); // vlaznost vazduha 1
                $link = $db->get("listasenzora LS", null, $cols);

                $IdPodKulTipLok = $link[0]['IdPodaciKulTipLok'];
                $OdPodaciIdeal = $link[0]['OdPodaciIdeal'];
                $DoPodaciIdeal = $link[0]['DoPodaciIdeal'];
                $OdZutoIdeal = $link[0]['OdZutoIdeal'];
                $DoZutoIdeal = $link[0]['DoZutoIdeal'];
                $NazivKulLokPod = $link[0]['NazivKulLokPod'];
                $IdPodaciKulTipLok = $link[0]['IdPodaciKulTipLok'];

                echo $tab = '
                    <td>' . $NazivKulLokPod . '</td>
                    <td>' . $OdZutoIdeal . '</td>
                    <td>' . $OdPodaciIdeal . '</td>
                    <td>' . $DoPodaciIdeal . '</td>

                    <td>' . $DoZutoIdeal . '</td>

                    <td class="align-center">
                    <span class="btn-group"> <a data-original-title="Search"
                                                                         target="_blank" href="/admin/str/editpodkulturesve/' . $IdPodaciKulTipLok . '"
                                                                         class="btn btn-xs bs-tooltip" title=""><i
                                    class="icon-search"></i></a> </span>

                    </td>
                </tr>';

                ?>

                </tbody>
            </table>

            <table
                class="table table-striped table-bordered table-hover ">
                <thead>
                <tr>
                    <!--<th>Id</th>-->
                    <th>Vrednost</th>
                    <th>Vreme</th>
                    <th>Izaberi</th>
                </tr>
                </thead>
                <tbody>
                <?php

                $limit = 5;
                $cols = Array("SV.vredSenzorVlaznosti", "SV.vremeSenzorVlaznosti");
                $db->orderBy("vremeSenzorVlaznosti", "DESC");;
                $data = $db->get("senzorvlaznosti  SV", $limit, $cols);

                $tab = ''; // resetujemo varijablu
                $i = 1;
                foreach ($data as $sds => $link) {
                    $vredSenzorVlaznosti = $link['vredSenzorVlaznosti'];
                    $vremeSenzorVlaznosti = $link['vremeSenzorVlaznosti'];
                    // <td>' . $i . '</td>

                    $tab .=
                        //ovde ide dugme da te vodi na senzor
                        '<tr>


                    <td>' . $vredSenzorVlaznosti . '</td>
                    <td>' . $vremeSenzorVlaznosti . '</td>
                    <td class="align-center">
                       <span class="btn-group"> <a data-original-title="Search"
                                                                         target="_blank" href="/admin/str/editpodkulturesve/' . $IdPodaciKulTipLok . '"
                                                                         class="btn btn-xs bs-tooltip" title=""><i
                                    class="icon-pencil"></i></a> </span>
                    </td>
                </tr>';
                    $i++;
                }
                echo $tab; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>