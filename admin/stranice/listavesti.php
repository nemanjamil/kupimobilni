<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 28. 08. 2015.
 * Time: 14:55
 */


?>
<!--=== Page Content ===-->
<div class="col-md-12">
    <div class="widget box">
        <div class="widget-header">
            <h4><i class="icon-list-alt"></i> Lista vesti</h4>

            <div class="toolbar">
                <div class="btn-group">
                    <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                </div>
            </div>
        </div>
        <div class="widget-content">
            <table
                class="table table-striped table-bordered table-hover table-checkable datatable ">
                <thead>
                <tr>

                    <th>Naslov</th>
                    <th>Datum</th>
                    <th>Mesto</th>
                    <th>Slika</th>
                    <th>Izaberi</th>


                </tr>
                </thead>
                <tbody>
                <?php
                //$db->join("kategorijeartikala k", "a.KategorijaArtikalId=k.KategorijaArtikalaId", "LEFT");
                //$db->join("brendovi b", "a.ArtikalBrendId=b.BrendId", "LEFT");
                //$db->join("valuta v", "a.ArtikalValutaId=v.ValutaId", "LEFT");
                // $data = $db->get("artikli a", null, "v.ValutaValuta,b.BrendIme,k.KategorijaArtikalaNaziv, a.KategorijaArtikalId, a.ArtikalId, a.ArtikalNaziv, a.ArtikalVPCena, a.ArtikalMPCena, a.ArtikalKratakOpis");


                $cols = Array("V.*", "VN.VestiNaslovsrblat" );
                $db->join("vestinaslov VN", "VN.IdVestiNaslov = V.IdVesti");
                $db->join("vestiopis VO", "VO.IdVestiOpis = V.IdVesti");
                //$db->where("V.SajtVesti = '1'");

                $data = $db->get("vesti V", null, $cols);

                $i = 1;
                foreach ($data as $sds => $link) {
                    $IdVesti = $link['IdVesti'];
                    $NaslovVesti = $link['VestiNaslov' . $jezik];
                    $DatumVesti = $link['DatumVesti'];
                    $SlikaVesti = $link['SlikaVesti'];
                    $MestoVesti = $link['MestoVesti'];

                    $slika = $common->locationslikaOstalo(VESTISLIKELOK, $IdVesti);

                    $ext = pathinfo($SlikaVesti, PATHINFO_EXTENSION);
                    $fileName = pathinfo($SlikaVesti, PATHINFO_FILENAME);

                    $mala_slika = $fileName . '_mala.' . $ext;


                    $lok = DCROOT . $slika . '/' . $mala_slika;
                    if (file_exists($lok)) {
                        $slikaV = '<img src="' . $slika . '/' . $mala_slika . '" alt="">';
                    }


                    $tab .=
                        '<tr>
                    <td>' . $NaslovVesti . '</td>
                    <td>' . $DatumVesti . '</td>
                    <td>' . $MestoVesti . '</td>

                    <td>' . $slikaV . '</td>
                    <!--Mesto za sliku!-->
                    <td class="align-center">
                        <div class="btn-group">
                            <button class="btn dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-dashboard"></i> Akcija
                                <span class="caret"></span>
                            </button>
                                <ul class="dropdown-menu">
                                    <li><a href="' . DPROOT . '/admin/str/editvest/' . $IdVesti . '"> <i class="icon-edit"> </i> Izmeni</a></li>
                                    <li><a href="/akcija.php?action=obrisivest&id=' . $IdVesti . '"> <i class="icon-remove"> </i> Obrisi</a></li>
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



