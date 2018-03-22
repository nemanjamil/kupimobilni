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
<div class="row">
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
                    class="table table-striped table-bordered table-hover table-checkable datatable ">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>Ime</th>
                        <th>Prezime</th>
                        <th>Vreme</th>
                        <!-- <th>Adresa</th>
                         <th>Mesto</th>
                         <th>PostBroj</th>
                         <th>Email</th>
                         <th>Mob</th>
                         <th>tel</th>-->
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

                    $db->where('UserNarudz', $id);
                    $data = $db->get('narudzbine');
                    //  var_dump($data);
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


                        $tab .= '<tr>';
                        $tab .= '<td>' . $IdNarudzbine . '</td>';
                        $tab .= '<td>' . $ImeNarudz . '</td>';
                        $tab .= '<td>' . $PrezimeNarudz . '</td>';
                        $tab .= '<td>' . $VremeNarudz . '</td>';
                        //  $tab .= '<td>' . $AdresaNarudz . '</td>';
                        //  $tab .= '<td>' . $MestoNarudz . '</td>';
                        //  $tab .= '<td>' . $PostBrojNarudz . '</td>';
                        // $tab .= '<td>' . $EmailNarudz . '</td>';
                        //  $tab .= '<td>' . $MobNarudz . '</td>';
                        //  $tab .= '<td>' . $FixNarudz . '</td>';
                        $tab .= '<td>' . $NapomenaNarudz . '</td>';

                        $tab .= '<td class="align-center" >';
                        $tab .= '<div class="btn-group" >';
                        $tab .= '<a href = "' . DPROOT . '/admin/str/vidiporudzbinu/' . $IdNarudzbine . '" > <button class="btn btn-primary"> Pogledaj </button ></a >';


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


