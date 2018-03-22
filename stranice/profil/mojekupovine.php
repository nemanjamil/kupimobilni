<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 18. 09. 2015.
 * Time: 11:45
 */

?>
<!--=== Page Content ===-->
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-list-alt"></i> <?php echo $jsonlang[237][$jezikId]; ?></h4>

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
                        <th><?php echo $jsonlang[238][$jezikId]; ?></th>
                        <th><?php echo $jsonlang[239][$jezikId]; ?></th>
                        <th><?php echo $jsonlang[152][$jezikId]; ?></th>
                        <th><?php echo $jsonlang[241][$jezikId]; ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    //$db->join("kategorijeartikala k", "a.KategorijaArtikalId=k.KategorijaArtikalaId", "LEFT");
                    //$db->join("brendovi b", "a.ArtikalBrendId=b.BrendId", "LEFT");
                    //$db->join("valuta v", "a.ArtikalValutaId=v.ValutaId", "LEFT");
                    // $data = $db->get("artikli a", null, "v.ValutaValuta,b.BrendIme,k.KategorijaArtikalaNaziv, a.KategorijaArtikalId, a.ArtikalId, a.ArtikalNaziv, a.ArtikalVPCena, a.ArtikalMPCena, a.ArtikalKratakOpis");

                    $db->where("EmailNarudz", $KomitentEmail);
                    $data = $db->get('narudzbine');
                    $i = 1;
                    foreach ($data as $sds => $link) {
                        $IdNarudzbine = $link['IdNarudzbine'];
                        $VremeNarudz = $link['VremeNarudz'];
                        $fdate = date('d.m.Y. H:i', strtotime($VremeNarudz));
                        $NapomenaNarudz = $link['NapomenaNarudz'];

                        $tab .= '<tr>';
                        $tab .= '<td>' . $IdNarudzbine . '</td>';
                        $tab .= '<td>' . $fdate . '</td>';
                        $tab .= '<td>' . $NapomenaNarudz . '</td>';

                        $tab .= '<td class="align-center" >';
                        $tab .= '<div class="btn-group" >';
                        $tab .= '<a href="/p/str/vidimojuporudzbinu/' . $UserKomitentUserName . '/' . $IdNarudzbine . '"> <button class="btn btn-primary"> ' . $jsonlang[242][$jezikId] . '</button > </a>';
                        $tab .= '</div >';
                        $tab .= '</td > ';
                        $tab .= '</tr>';
                    }
                    echo $tab; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>