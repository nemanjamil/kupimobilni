<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 31. 08. 2015.
 * Time: 09:55
 */


?>
<!--=== Page Content ===-->
<div class="row">

    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-user"></i>Korisnici rekli o nama</h4>

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
                        <th>Id coment</th>
                        <th>Komitent</th>
                        <th>Komentar</th>
                        <th>Izaberi</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    //$db->join("kategorijeartikala k", "a.KategorijaArtikalId=k.KategorijaArtikalaId", "LEFT");
                    //$db->join("brendovi b", "a.ArtikalBrendId=b.BrendId", "LEFT");
                    //$db->join("valuta v", "a.ArtikalValutaId=v.ValutaId", "LEFT");
                    // $data = $db->get("artikli a", null, "v.ValutaValuta,b.BrendIme,k.KategorijaArtikalaNaziv, a.KategorijaArtikalId, a.ArtikalId, a.ArtikalNaziv, a.ArtikalVPCena, a.ArtikalMPCena, a.ArtikalKratakOpis");

                    $db->join("komitenti k", "r.KomitRekOnama=k.KomitentId", "LEFT");
                    //$db ->where("r.SajtOnama = '1' ");
                    $data = $db->get("rekonama r", null, "r.idRekOnam,r.OpisRekONama,r.KomitRekOnama,k.KomitentIme, k.KomitentUserName");

                    $i = 1;
                    foreach ($data as $sds => $link) {
                        $idRekOnam = $link['idRekOnam'];
                        $OpisRekONama = $link['OpisRekONama'];
                        $KomitRekOnama = $link['KomitentIme'];
                        $KomitentUserName = $link['KomitentUserName'];

                        $tab .=
                            '<tr>


                    <td>' . $idRekOnam . '</td>
                    <td>' . $KomitRekOnama .' - ' .$KomitentUserName. '</td>
                    <td>' . $OpisRekONama . '</td>
                    <td class="align-center">
                        <div class="btn-group">
                            <button class="btn dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-dashboard"></i> Akcija
                                <span class="caret"></span>
                            </button>
                                <ul class="dropdown-menu">
                                    <li><a href="' . DPROOT . '/admin/str/editonama/' . $idRekOnam . '"> <i class="icon-edit"> </i> Izmeni</a></li>
                                    <li><a href="/akcija.php?action=obrisionama&id=' . $idRekOnam . '"> <i class="icon-remove"> </i> Obrisi</a></li>
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

    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-tag"></i> Unesi komentar o nama</h4>

                <div class="toolbar">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>

            <div class="widget-content">
                <form enctype="multipart/form-data" method="post" class="form-horizontal row-border" id="validate-2"
                      action="/akcija.php?action=dodajonama">

                    <div class="form-group">
                        <label class="col-md-2 control-label">Komitent </label>

                        <div class="col-md-10">

                            <select class="form-control required" name="id"
                                    id="id">
                                <option value=""></option>

                                <?php
                                $data = $db->get('komitenti');
                                foreach ($data as $sds => $s) {
                                    $KomitentId = $s['KomitentId'];
                                    $KomitentIme = $s['KomitentIme'];
                                    $KomitentPrezime = $s['KomitentPrezime'];
                                    $KomitentUserName = $s['KomitentUserName'];
                                    $selektovano = ($KomitentIme == $KomitentId) ? 'selected' : '';
                                    $veopiZem .= '<option  value="' . $KomitentId . '" ' . $selektovano . '>' . $KomitentIme . ' ' . $KomitentPrezime. ' - ' . $KomitentUserName. '</option>';

                                }
                                echo $veopiZem;
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Komentar</label>

                        <div class="col-md-10">

                            <input type="text" name="string" id="string"
                                   class="form-control required">

                        </div>
                    </div>

                    <div class="form-actions">
                        <input type="submit" value="Dodaj komentar" class="btn btn-primary pull-right">
                    </div>
                </form>
            </div>
        </div>
        <!-- /Validation Example 1 -->
    </div>

</div>



