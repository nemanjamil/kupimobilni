<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 31. 08. 2015.
 * Time: 11:45
 */
//Lista artikala za porudzbinu po id = xxx
?>
<!--=== Page Content ===-->
<div class="col-md-12">
    <div class="widget box">
        <div class="widget-header">
            <h4><i class="icon-list-alt"></i> Lista artikala</h4>

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
                    <th>Artikal</th>
                    <th>Kolicina</th>
                    <th>Cena</th>
                    <th>Valuta</th>
                    <th>Jed mere</th>

                </tr>
                </thead>
                <tbody>

                <?php
                //$db->join("kategorijeartikala k", "a.KategorijaArtikalId=k.KategorijaArtikalaId", "LEFT");
                //$db->join("brendovi b", "a.ArtikalBrendId=b.BrendId", "LEFT");
                //$db->join("valuta v", "a.ArtikalValutaId=v.ValutaId", "LEFT");
                // $data = $db->get("artikli a", null, "v.ValutaValuta,b.BrendIme,k.KategorijaArtikalaNaziv, a.KategorijaArtikalId, a.ArtikalId, a.ArtikalNaziv, a.ArtikalVPCena, a.ArtikalMPCena, a.ArtikalKratakOpis");

                $db->join("komitenti k", "r.KomitRekOnama=k.KomitentId", "LEFT");
                $data = $db->get("rekonama r", null, "r.idRekOnam,r.OpisRekONama,r.KomitRekOnama,k.KomitentIme");

                $db->join("artikli a", "n.ArtIdNarudzLista=a.ArtikalId", "LEFT");
                $db->join("valuta v", "n.ValutaNarudzLista=v.ValutaId", "LEFT");
                $db->join("unit u", "n.UnitNarudzLista=u.IdUnit", "LEFT");

                $db->where("IdNarudzPov", $id);
                $data = $db->get("narudzlista n", null, "n.IdNarudzLista,n.CenaNarudzLista,n.KolicinaNarudzlista,a.ArtikalNaziv,v.ValutaNaziv,u.TipUnit");
                // var_dump($db);
                $i = 1;
                foreach ($data as $sds => $link) {

                    $IdNarudzLista = $link[IdNarudzLista];
                    $ArtIdNarudzLista = $link[ArtikalNaziv];
                    $KolicinaNarudzlista = $link[KolicinaNarudzlista];
                    $CenaNarudzLista = $link[CenaNarudzLista];
                    $ValutaNarudzLista = $link[ValutaNaziv];
                    $UnitNarudzLista = $link[TipUnit];

                    $ttt .= '<tr>';
                    $ttt .= '<td>' . $IdNarudzLista . '</td>';
                    $ttt .= '<td>' . $ArtIdNarudzLista . '</td>';
                    $ttt .= '<td>' . $KolicinaNarudzlista . '</td>';
                    $ttt .= '<td>' . $CenaNarudzLista . '</td>';
                    $ttt .= '<td>' . $ValutaNarudzLista . '</td>';
                    $ttt .= '<td>' . $UnitNarudzLista . '</td>';
                    $ttt .= '</tr>';
                }
                echo $ttt; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>



