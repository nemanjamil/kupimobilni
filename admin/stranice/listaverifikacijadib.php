<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 26. 08. 2015.
 * Time: 18:55
 */


?>
<!--=== Page Content ===-->
<div class="col-md-6">
    <div class="widget box">
        <div class="widget-header">
            <h4><i class="icon-list-alt"></i> Lista ocena verifikacija</h4>

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

                    <th>Ocena verifikacije</th>
                    <th>Kratak opis</th>
                    <!-- <th>Slika</th>-->
                    <th>Izaberi</th>


                </tr>
                </thead>
                <tbody>
                <?php
                //$db->join("kategorijeartikala k", "a.KategorijaArtikalId=k.KategorijaArtikalaId", "LEFT");
                //$db->join("brendovi b", "a.ArtikalBrendId=b.BrendId", "LEFT");
                //$db->join("valuta v", "a.ArtikalValutaId=v.ValutaId", "LEFT");
                // $data = $db->get("artikli a", null, "v.ValutaValuta,b.BrendIme,k.KategorijaArtikalaNaziv, a.KategorijaArtikalId, a.ArtikalId, a.ArtikalNaziv, a.ArtikalVPCena, a.ArtikalMPCena, a.ArtikalKratakOpis");


                $data = $db->get('verikomitent');
                $i = 1;
                foreach ($data as $sds => $link) {
                    $IdVerKomi = $link[IdVerKomi];
                    $OcenaVeriKomi = $link[OcenaVeriKomi];
                    $OpisVerKomit = $link[OpisVerKomit];
                    $SlikaSertVeriKomi = $link[SlikaSertVeriKomi];
                    $tab .=
                        '<tr>


                    <td>' . $OcenaVeriKomi . '</td>
                    <td>' . $OpisVerKomit . '</td>
                    <!--Mesto za sliku!-->
                    <td class="align-center">
                        <div class="btn-group">
                            <button class="btn dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-dashboard"></i> Akcija
                                <span class="caret"></span>
                            </button>
                                <ul class="dropdown-menu">
                                    <li><a href="/admin/index.php?stranica=editverifdib&id=' . $IdVerKomi . '"> <i class="icon-edit"> </i> Izmeni</a></li>
                                    <li><a href="/akcija.php?action=obrisiverifdib&id=' . $IdVerKomi . '"> <i class="icon-remove"> </i> Obrisi</a></li>
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



