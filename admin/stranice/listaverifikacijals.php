<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 27. 08. 2015.
 * Time: 00:45
 */


?>
<!--=== Page Content ===-->
<div class="col-md-5">
    <div class="widget box">
        <div class="widget-header">
            <h4><i class="icon-list-alt"></i> Lista Lokalnih samouprava</h4>

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
                    <th>Id su</th>
                    <th>Ime lok su</th>
                    <th>Zemlja lok su</th>
                    <!-- <th>Podaci lok su</th>-->
                    <th>Izaberi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                //$db->join("kategorijeartikala k", "a.KategorijaArtikalId=k.KategorijaArtikalaId", "LEFT");
                //$db->join("brendovi b", "a.ArtikalBrendId=b.BrendId", "LEFT");
                //$db->join("valuta v", "a.ArtikalValutaId=v.ValutaId", "LEFT");
                // $data = $db->get("artikli a", null, "v.ValutaValuta,b.BrendIme,k.KategorijaArtikalaNaziv, a.KategorijaArtikalId, a.ArtikalId, a.ArtikalNaziv, a.ArtikalVPCena, a.ArtikalMPCena, a.ArtikalKratakOpis");

                $db->join("zemlja z", "l.ZemljaLokSamo=z.IdZemlja", "LEFT");
                $data = $db->get("lokalnasu l", null, "z.ImeZemlja,l.ImeLokSamo,l.PodaciLokSamo,l.IdLokSamo");

                //var_dump($db);
                $i = 1;
                foreach ($data as $sds => $link) {
                    $IdLokSamo = $link[IdLokSamo];
                    $ImeLokSamo = $link[ImeLokSamo];
                    $ZemljaLokSamo = $link[ImeZemlja];
                    $PodaciLokSamo = $link[PodaciLokSamo];
                    $tab .=
                        '<tr>

                    <td>' . $IdLokSamo . '</td>
                    <td>' . $ImeLokSamo . '</td>
                    <td>' . $ZemljaLokSamo . '</td>

                    <td class="align-center">
                        <div class="btn-group">
                            <button class="btn dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-dashboard"></i> Akcija
                                <span class="caret"></span>
                            </button>
                                <ul class="dropdown-menu">
                                    <li><a href="'.DPROOT.'/admin/str/editverifls/' . $IdLokSamo . '"> <i class="icon-edit"> </i> Izmeni</a></li>
                                    <li><a href="/akcija.php?action=obrisiverifls&id=' . $IdLokSamo . '"> <i class="icon-remove"> </i> Obrisi</a></li>
                                </ul>
                        </div>
                    </td>
                </tr>';
                }
                echo $tab; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>



