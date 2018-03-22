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
            <h4><i class="icon-list-alt"></i>Lista brendova</h4>

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
                    <!--<th>Kratak opis</th>-->
                    <th>Aktivno</th>
                    <th>Naslovna</th>
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

                //"BO.BrendOpis",
                $cols = Array("BR.BrendId","BR.BrendLink", "BR.BrendNaslovna", "BR.BrendActive", "BR.BrendSlika", "BI.BrendIme", "BrendSajt","BrendSajtMasine");
                $db->join("brendoviime BI", "BI.BrendId = BR.BrendId");
                //$db->join("brendoviopis BO", "BO.BrendId = BR.BrendId","LEFT");
                $db->where("BI.IdLanguage = 5"); // BR.BrendSajt = 2 AND AND BO.IdLanguage = 5
                $db->orderBy("BI.BrendIme","ASC");
                $data = $db->get("brendovi BR", null, $cols);

                $i = 1;
                foreach ($data as $sds => $link) {
                    $BrendId = $link['BrendId'];
                    $BrendIme = $link['BrendIme'];
                    $BrendOpis = $link['BrendOpis'];
                    $BrendActive = $link['BrendActive'];
                    $akt = ($BrendActive) ? 'checked="checked"' : '';

                    $BrendNaslovna = $link['BrendNaslovna'];
                    $bs = ($BrendNaslovna) ? 'checked="checked"' : '';

                    $BrendSajt = $link['BrendSajt'];
                    $bsag = ($BrendSajt) ? 'checked="checked"' : '';

                    $BrendSajtMasine = $link['BrendSajtMasine'];
                    $bsmas = ($BrendSajtMasine) ? 'checked="checked"' : '';

                    $BrendSlika = $link['BrendSlika'];

                    $slaa = $common->locationslikaOstalo(BRENDSLIKELOK, $BrendId);

                    $ext = pathinfo($BrendSlika, PATHINFO_EXTENSION);
                    $fileName = pathinfo($BrendSlika, PATHINFO_FILENAME);

                    //$mala_slika = $fileName . '_mala.' . $ext;
                    $mala_slika = $fileName . '.' . $ext;

                    //$lok = DCROOT . $slaa . '/' . $mala_slika;
                    $lok = DCROOT.'/'.BRENDSLIKELOK.'/'.$mala_slika;


                    if (file_exists($lok)) {
                        //$slikaBr =  '<img src="' . $slaa . '/' . $mala_slika . '" alt="Slika - Brend">';
                        $slikaBr = '<img src="/' . BRENDSLIKELOK.'/'.$mala_slika . '" alt="Slika - Brend">';
                    } else {
                        $slikaBr = '';
                    }

                    $tab .=
                        '<tr>

                    <td>' . $BrendIme . '</td>
                    <!--<td>' . $BrendOpis . '</td>-->
                    <td class="align-center"><input type="checkbox" class="uniform" readonly="readonly" value="' . $BrendActive . '" ' . $akt . '/></td>

                    <td class="align-center">
                        <input type="checkbox" class="uniform" value="' . $BrendNaslovna . '" ' . $bs . '/>
                    </td>
                    ';
                    $tab .= '<td class="align-center">'.$slikaBr.'</td>';

                    $tab .= '<td class="align-center">
                        <div class="btn-group">
                            <button class="btn dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-dashboard"></i> Akcija
                                <span class="caret"></span>
                            </button>
                                <ul class="dropdown-menu">
                                    <li><a href="/admin/index.php?stranica=editbrend&id=' . $BrendId . '"> <i class="icon-edit"> </i> Izmeni</a></li>
                                    <li><a href="/akcija.php?action=obrisibrend&id=' . $BrendId . '"> <i class="icon-remove"> </i> Obrisi</a></li>
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



