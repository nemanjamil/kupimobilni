<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 01. 09. 2015.
 * Time: 09:54
 */
?>
<!--=== Page Content ===-->
<div class="col-md-12">
    <div class="widget box">
        <div class="widget-header">
            <h4><i class="icon-comments"></i> Lista komentara</h4>

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
                    <th>Id</th>
                    <th>Artikal</th>
                    <th>ArtikalId</th>
                    <th>Komentar</th>
                    <!--  <th>Naslov komentara</th>-->
                    <th>User</th>
                    <!--  <th>E-mail</th>
                      <th>ip_add</th>-->
                    <th>Vreme</th>
                    <th>Aktivan</th>
                    <th>Izaberi</th>

                </tr>
                </thead>
                <tbody>

                <?php
                $db->join("artikli a", "k.ArtikalKomentar=a.ArtikalId", "LEFT");
                $db->join("artikalnazivnew ANN", "a.ArtikalId=ANN.ArtikalId", "LEFT");
                $db->where("ANN.IdLanguage = 5");

                $data = $db->get("komentari k", null, "a.ArtikalId,k.IdKomentari,k.KomentarKomentari,k.ImeKomentar,k.UserKomentari,k.ActiveKomentar,k.EmailKomentar,k.IpKomentar,k.VremeKomentar,ANN.OpisArtikla");
                // var_dump($db);
                $i = 1;
                foreach ($data as $sds => $link) {

                    $IdKomentari = $link[IdKomentari];
                    $ArtikalId = $link[ArtikalId];
                    $KomentarKomentari = $link[KomentarKomentari];
                    $ImeKomentar = $link[ImeKomentar];
                    $UserKomentari = $link[UserKomentari];
                    $EmailKomentar = $link[EmailKomentar];
                    $IpKomentar = $link[IpKomentar];
                    $VremeKomentar = $link[VremeKomentar];
                    $ArtikalKomentar = $link[OpisArtikla];
                    $ActiveKomentar = $link[ActiveKomentar];
                    $akt = ($ActiveKomentar) ? 'checked="checked"' : '';
                    //Ukoliko se ne vidi da li je aktivan, promeniti u tabeli komentari, polje
                    //ActiveKomentar, lenght na 2!
                    $tab .= '<tr>';
                    $tab .= '<td>' . $IdKomentari . '</td>';
                    $tab .= '<td>' . $ArtikalKomentar . '</td>';
                    $tab .= '<td>' . $ArtikalId . '</td>';
                    $tab .= '<td>' . $KomentarKomentari . '</td>';
                    //  $tab .= '<td>' . $ImeKomentar . '</td>';
                    $tab .= '<td>' . $UserKomentari . '</td>';
                    //     $tab .= '<td>' . $EmailKomentar . '</td>';
                    //   $tab .= '<td>' . $IpKomentar . '</td>';
                    $tab .= '<td>' . $VremeKomentar . '</td>';
                    $tab .= ' <td class="align-center"><input type="checkbox" class="uniform" value="' . $ActiveKomentar . '" ' . $akt . '/></td>';

                    $tab .= '<td class="algin-center">';
                    $tab .= ' <div class="btn-group "> ';
                    $tab .= '<button class="btn btn-xs btn-primary " data-toggle="dropdown">';
                    $tab .= ' <i class="icol-cog"></i> Akcija';
                    $tab .= '<span class="caret"></span>';
                    $tab .= '</button>';
                    $tab .= '<ul class="dropdown-menu">';
                    $tab .= '<li><a href="' . DPROOT . '/admin/str/editkomentar/' . $IdKomentari . '">  Izmeni</a></li>';
                    $tab .= '<li><a href="/akcija.php?action=obrisikomentar&id=' . $IdKomentari . '"> Obrisi</a></li>';
                    $tab .= '</ul>';
                    $tab .= '</div>';
                    $tab .= '</tr>';
                }
                echo $tab; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>



