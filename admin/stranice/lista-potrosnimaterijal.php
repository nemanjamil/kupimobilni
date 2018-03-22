<?php
/**
 * Project: masine
 * Created by PhpStorm.
 * User: Nikola
 * Date: 08. 03. 2016.
 * Time: 13:17
 */
?>

<div class="col-md-12">
    <div class="widget box">
        <div class="widget-header">
            <h4><i class="icon-list-alt"></i> Lista artikala - AUTO - Pocetna stranica</h4>

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


                    <th>id</th>
                    <th>Pozicija</th>
                    <th>Promeni</th>
                    <th>Naziv</th>
                    <th>Kategorija</th>
                    <th>MP cena</th>
                    <th>Akcija</th>
                </tr>
                </thead>
                <tbody>

                <?php

                // $db->setTrace (true);

                $db->join("artikalnazivnew ANN", "a.ArtikalId=ANN.ArtikalId", "LEFT");
                $db->join("kategorijeartikala k", "a.KategorijaArtikalId=k.KategorijaArtikalaId", "LEFT");
                $db->join("kategorijeartikalanaslov kan", "kan.IdKategorije=k.KategorijaArtikalaId", "LEFT");
                $db->where("a.ArtikalNaAkciji", '11');
                $db->where("ANN.IdLanguage = 5 AND kan.IdLanguage = 5");
                $db->orderBy("a.top1", "asc");
                $data = $db->get("artikli a", null, " a.ArtikalId, ANN.OpisArtikla, a.ArtikalLink, a.ArtikalMPCena, a.ArtikalNaAkciji, a.top1, kan.NazivKategorije");
                //var_dump($db->trace);

                $i = 1;
                foreach ($data as $sds => $link) {
                    $ArtikalId = $link[ArtikalId];
                    $ArtikalNaziv = $link[OpisArtikla];
                    $ArtikalLink = $link[ArtikalLink];
                    $ArtikalKategorija = $link[NazivKategorije];
                    $top1 = $link[top1];
                    $ArtikalMPCena = $link[ArtikalMPCena];


                    $r .= '<tr>

                        <td style="vertical-align: middle"><b>' . $ArtikalId . '</b></td>
                        <td style="vertical-align: middle"><b>' . $top1 . '</b></td>
                        <td style="vertical-align: middle">
                           <div class="btn-group">
<div>
     <form enctype="multipart/form-data"  method="post" id="validate-1" action="/akcija.php?action=dodajpozicijusuper">
                <input type="hidden" value="' . $ArtikalId . '" id="id" name="id">

           <div>
                <select id="top1" name="top1" class="form-control " style="margin-bottom: 3px; align:middle;">

                                        <option value="NULL">  </option>
                                        <option value="1"> 1 </option>
                                        <option value="2"> 2 </option>
                                        <option value="3"> 3 </option>
                                        <option value="4"> 4 </option>
                                        <option value="5"> 5 </option>
                                        <option value="6"> 6 </option>
                                        <option value="7"> 7 </option>
                                        <option value="8"> 8 </option>
                                        <option value="9"> 9 </option>
                                        <option value="10"> 10 </option>
                 </select>
           </div>

           <div>
                <input type="submit" value="Pozicija" class="btn btn-xs">
           </div>
     </form>

                        </td>
                        <td style="vertical-align: middle"><b><a target="_blank" href="/' . $ArtikalLink . '/' . $ArtikalId . '">' . $ArtikalNaziv . '</a></b></td>
                        <td style="vertical-align: middle">' . $ArtikalKategorija . '</td>
                        <td style="vertical-align: middle">' . $ArtikalMPCena . '</td>
                        <td style="vertical-align: middle">
                        <div class="btn-group">
                            <div >
                                <button class="btn btn-xs dropdown-toggle" data-toggle="dropdown">
											<i class="icol-cog"></i> Akcija
											<span class="caret"></span>
							    </button>
                                <ul class="dropdown-menu">
                                        <li><a href="/admin/str/editartikal/' . $ArtikalId . '"> <i class="icon-edit"> </i> Izmeni artikal</a></li>
                                        <li><a href="/akcija.php?action=skinisuper&id=' . $ArtikalId . '"> <i class="icon-remove"> </i> Skini akciju</a></li>
                                </ul>

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