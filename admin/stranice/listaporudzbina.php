<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 31. 08. 2015.
 * Time: 11:45
 */


?>
<!--=== Page Content ===-->

<div class="col-md-12">
    <div class="widget box">
        <div class="widget-header">
            <h4><i class="icon-list-alt"></i> Lista porudzbina</h4>

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
                    <th>id</th>
                    <th>Ime</th>
                    <th>Prezime</th>
                    <th>Vreme</th>
                    <th>Adresa</th>
                    <th>Mesto</th>
                    <th>PostBroj</th>
                    <th>Email</th>
                    <th>Mob</th>
                    <th>tel</th>
                    <th>Napomena</th>
                    <th>Izaberi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                //$db->join("kategorijeartikala k", "a.KategorijaArtikalId=k.KategorijaArtikalaId", "LEFT");
                //$db->join("brendovi b", "a.ArtikalBrendId=b.BrendId", "LEFT");
                //$db->join("valuta v", "a.ArtikalValutaId=v.ValutaId", "LEFT");
                // $data = $db->get("artikli a", null, "v.ValutaValuta,b.BrendIme,k.KategorijaArtikalaNaziv, a.KategorijaArtikalId, a.ArtikalId, a.ArtikalNaziv, a.ArtikalVPCena, a.ArtikalMPCena, a.ArtikalKratakOpis");

                $data = $db->get('narudzbine');
                //var_dump($db);
                $i = 1;
                foreach ($data as $sds => $link) {
                    $IdNarudzbine = $link[IdNarudzbine];
                    $VremeNarudz = $link[VremeNarudz];
                    $ImeNarudz = $link[ImeNarudz];
                    $PrezimeNarudz = $link[PrezimeNarudz];
                    $AdresaNarudz = $link[AdresaNarudz];
                    $MestoNarudz = $link[MestoNarudz];
                    $PostBrojNarudz = $link[PostBrojNarudz];
                    $EmailNarudz = $link[EmailNarudz];
                    $MobNarudz = $link[MobNarudz];
                    $FixNarudz = $link[FixNarudz];
                    $NapomenaNarudz = $link[NapomenaNarudz];


                    $tab .=
                        '<tr>

                    <td>' . $IdNarudzbine . '</td>
                    <td>' . $ImeNarudz . '</td>
                    <td>' . $PrezimeNarudz . '</td>
                    <td>' . $VremeNarudz . '</td>
                    <td>' . $AdresaNarudz . '</td>
                    <td>' . $MestoNarudz . '</td>
                    <td>' . $PostBrojNarudz . '</td>
                    <td>' . $EmailNarudz . '</td>
                    <td>' . $MobNarudz . '</td>
                    <td>' . $FixNarudz . '</td>
                    <td>' . $NapomenaNarudz . '</td>


                    <td class="align-center">
                        <div class="btn-group">
                            <button class="btn dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-dashboard"></i> Akcija
                                <span class="caret"></span>
                            </button>
                                <ul class="dropdown-menu">
                                    <li><a href="' . DPROOT . '/admin/str/editnarudzbinu/' . $IdNarudzbine . '"> <i class="icon-edit"> </i> Izmeni</a></li>
                                    <li><a href="/akcija.php?action=obrisinarudzbinu&id=' . $IdNarudzbine . '"> <i class="icon-remove"> </i> Obrisi</a></li>
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



