<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 10. 08. 2015.
 * Time: 12:11 PM
 */


?>
<!--=== Page Content ===-->
<div class="row">
    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-list-alt"></i> Lista Slajdova</h4>

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
                        <th>Naziv slajda</th>
                        <th>Link</th>
                        <th>Kratak opis</th>
                        <th>Kategorija</th>
                        <th>Slika</th>
                        <th>Izaberi</th>
                        <th>Aktivan</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    $cols = Array ("B.*", "KAN.NazivKategorije");
                    $db->join("kategorijeartikala KA", "B.BanerKategorijaArtiklaId = KA.KategorijaArtikalaId", "LEFT");
                    $db->join("kategorijeartikalanaslov KAN", "KAN.IdKategorije = KA.KategorijaArtikalaId", "LEFT");
                    $db->where("KAN.IdLanguage", 5);
                    $data = $db->get ("baneri B", null, $cols);



                    $i = 1;
                    foreach ($data as $sds => $link) {
                        $BanerId = $link['BanerId'];
                        $BanerNaziv = $link['BanerNaziv'];

                        $BanerKategorijaArtiklaId = $link['BanerKategorijaArtiklaId'];
                        $KategorijaArtikalaNaziv = $link['NazivKategorije'];

                        $BanerLink = $link['BanerLink'];
                        $BanerSlika = $link['BanerSlika'];
                        $BanerAktivan = $link['BanerAktivan'];
                        $akt = ($BanerAktivan) ? 'checked="checked"' : '';
                        $BanerOpis = $link['BanerOpis'];

                        $BanerUrl = $link['BanerUrl'];

                        $lokrel = $common->locationslikaOstalo(BANERSLIKELOK,$BanerId);

                        $ext = pathinfo($BanerSlika, PATHINFO_EXTENSION);
                        $fileName = pathinfo($BanerSlika, PATHINFO_FILENAME);

                        $mala_slika = $fileName . '_mala.' . $ext;


                        $lok = DCROOT.$lokrel.'/'.$mala_slika;
                        if (file_exists($lok)) {
                            $BanerSlika = '<img width="100px" src="'.$lokrel.'/'.$mala_slika.'" alt="">';
                        }


                        $tab .=
                            '<tr>

                    <td>' . $BanerNaziv . '</td>
                    <td>' . $BanerUrl . '</td>
                    <td>' . $BanerOpis . '</td>
                    <td>' . $KategorijaArtikalaNaziv . '</td>

                    <td>' . $BanerSlika . '</td>
                    <td class="align-center">
                        <div class="btn-group">
                            <button class="btn dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-dashboard"></i> Akcija
                                <span class="caret"></span>
                            </button>
                                <ul class="dropdown-menu">
                                    <li><a href="'.DPROOT.'/admin/str/editslider/' . $BanerId . '"> <i class="icon-edit"> </i> Izmeni</a></li>
                                    <li><a href="/akcija.php?action=obrisislider&id=' . $BanerId . '"> <i class="icon-remove"> </i> Obrisi</a></li>
                                </ul>
                        </div>
                    </td>
                     <td class="align-center"><input type="checkbox" class="uniform" value="' . $BanerAktivan . '" ' . $akt . '/></td>

                </tr>';
                    }
                    echo $tab; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


