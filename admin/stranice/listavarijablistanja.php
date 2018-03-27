<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 18. 10. 2015.
 * Time: 18:55
 */


?>
<!--=== Page Content ===-->
<div class="col-md-5">
    <div class="widget box">
        <div class="widget-header">
            <h4><i class="icon-list-alt"></i>Lista varijabli</h4>

            <div class="toolbar">
                <div class="btn-group">
                    <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                </div>
            </div>
        </div>
        <div class="widget-content">
            <table class="table table-striped table-bordered table-hover ">
                <thead>
                <tr>

                    <th>Ime brenda</th>
                    <th>Aktivno</th>
                    <th>Izaberi</th>

                </tr>
                </thead>
                <tbody>
                <?php
                //$db->join("kategorijeartikala k", "a.KategorijaArtikalId=k.KategorijaArtikalaId", "LEFT");
                //$db->join("brendovi b", "a.ArtikalBrendId=b.BrendId", "LEFT");
                //$db->join("valuta v", "a.ArtikalValutaId=v.ValutaId", "LEFT");
                // $data = $db->get("artikli a", null, "v.ValutaValuta,b.BrendIme,k.KategorijaArtikalaNaziv, a.KategorijaArtikalId, a.ArtikalId, a.ArtikalNaziv, a.ArtikalVPCena, a.ArtikalMPCena, a.ArtikalKratakOpis");

                $data = $db->get("setovanjevarijabli SV", null);

                $i = 1;
                foreach ($data as $sds => $link) {
                    $imestanja = $link['imestanja'];
                    $vrednoststanja = $link['vrednoststanja'];
                    $akt = ($vrednoststanja) ? 'checked="checked"' : '';

                    $tab .=
                        '<tr>

                    <td >' . $imestanja . '</td>
                    
                    <td class="align-center"> <input type="checkbox" data-id="'.$imestanja.'" class="AktivirajStanjeVarijable uniform" value="' . $vrednoststanja . '" ' . $akt . ' /> </td> ';

                    $tab .= '<td class="align-center">
                        <div class="btn-group">
                            <button class="btn dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-dashboard"></i> Akcija
                                <span class="caret"></span>
                            </button>
                                <ul class="dropdown-menu">
                                    <li><a href="/admin/index.php?stranica=izmenisetvarijablu&string=' . $imestanja . '"> <i class="icon-edit"> </i> Izmeni</a></li>
                                    <li><a href="/akcija.php?action=obrisisetvarijablu&string=' . $imestanja . '"> <i class="icon-remove"> </i> Obrisi</a></li>
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



