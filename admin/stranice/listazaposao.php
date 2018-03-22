<?php
/**
 * Project: masine
 * Created by PhpStorm.
 * User: Nikola
 * Date: 08. 02. 2016.
 * Time: 11:36
 */
?>
<div class="col-md-12">
    <div class="widget box">
        <div class="widget-header">
            <h4><i class="icon-list-alt"></i> Lista prijavljenih za posao</h4>

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

                    <th>Ime i prezime</th>
                    <th>Email</th>
                    <th>Telefon</th>
                    <th>Akcija</th>


                </tr>
                </thead>
                <tbody>
                <?php
                //$db->join("kategorijeartikala k", "a.KategorijaArtikalId=k.KategorijaArtikalaId", "LEFT");
                //$db->join("brendovi b", "a.ArtikalBrendId=b.BrendId", "LEFT");
                //$db->join("valuta v", "a.ArtikalValutaId=v.ValutaId", "LEFT");
                // $data = $db->get("artikli a", null, "v.ValutaValuta,b.BrendIme,k.KategorijaArtikalaNaziv, a.KategorijaArtikalId, a.ArtikalId, a.ArtikalNaziv, a.ArtikalVPCena, a.ArtikalMPCena, a.ArtikalKratakOpis");


                $data = $db->get('posao');
                $i = 1;
                foreach ($data as $sds => $link) {
                    $PosaoId = $link[PosaoId];
                    $PosaoIme = $link[PosaoIme];
                    $PosaoEmail = $link[PosaoEmail];
                    $PosaoTelefon = $link[PosaoTelefon];
                    $tab .=
                        '<tr>

                    <td>' . $PosaoIme . '</td>
                    <td>' . $PosaoEmail . '</td>
                    <td>'. $PosaoTelefon . '</td>
                    <!--Mesto za sliku!-->
                    <td class="align-center">
                        <div class="btn-group">
                            <button class="btn dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-dashboard"></i> Akcija
                                <span class="caret"></span>
                            </button>
                                <ul class="dropdown-menu">
                                    <li><a href="/admin/index.php?stranica=zaposao&id=' . $PosaoId . '"> <i class="icon-edit"> </i>Pogledaj</a></li>
                                    <li><a href="/akcija.php?action=obrisiprijavu&id=' . $PosaoId . '"> <i class="icon-remove"> </i> Obrisi</a></li>
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

