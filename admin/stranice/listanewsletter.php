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
            <h4><i class="icon-list-alt"></i> Lista mailova za newsletter</h4>

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

                    <th>Ime</th>
                    <th>Prezime</th>
                    <th>Mail</th>
                    <th>Izaberi</th>


                </tr>
                </thead>
                <tbody>
                <?php
                //$db->join("kategorijeartikala k", "a.KategorijaArtikalId=k.KategorijaArtikalaId", "LEFT");
                //$db->join("brendovi b", "a.ArtikalBrendId=b.BrendId", "LEFT");
                //$db->join("valuta v", "a.ArtikalValutaId=v.ValutaId", "LEFT");
                // $data = $db->get("artikli a", null, "v.ValutaValuta,b.BrendIme,k.KategorijaArtikalaNaziv, a.KategorijaArtikalId, a.ArtikalId, a.ArtikalNaziv, a.ArtikalVPCena, a.ArtikalMPCena, a.ArtikalKratakOpis");


                $data = $db->get('email');
                $i = 1;
                foreach ($data as $sds => $link) {
                    $idImail = $link['idImail'];
                    $FirstNameMail = $link['FirstNameMail'];
                    $LastNameMail = $link['LastNameMail'];
                    $EmailAddressMail = $link['EmailAddressMail'];

                    $tab .=
                        '<tr>


                    <td>' . $FirstNameMail . '</td>
                    <td>' . $LastNameMail . '</td>
                    <td>' . $EmailAddressMail . '</td>
                    <td class="align-center">
                        <div class="btn-group">
                            <button class="btn dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-dashboard"></i> Akcija
                                <span class="caret"></span>
                            </button>
                                <ul class="dropdown-menu">
                                    <li><a href="' . DPROOT . '/admin/str/editmail/' . $idImail . '"> <i class="icon-edit"> </i> Izmeni</a></li>
                                    <li><a href="/akcija.php?action=obrisimail&id=' . $idImail . '"> <i class="icon-remove"> </i> Obrisi</a></li>
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



