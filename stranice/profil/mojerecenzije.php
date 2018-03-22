<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 19. 01. 2016.
 * Time: 15:25
 */

$db->join("komitenti K", "K.KomitentId = R.KomitentRecenzije", "LEFT");
$db->join("artikli A", "A.ArtikalId = R.ProizvodRecenzije", "LEFT");
$db->join("artikalnazivnew ANN", "ANN.ArtikalId = A.ArtikalId");
$db->where("R.KomitentRecenzije", $idOdUserName);
$data = $db->get("recenzije R", null, "ANN.OpisArtikla, A.ArtikalId, K.KomitentIme, K.KomitentPrezime, K.KomitentId, R.*");

?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-list-alt"></i><?php echo $jsonlang[298][$jezikId]; ?></h4>

                <div class="toolbar">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>
            <div class="widget-content">

              <?php if($data){?>
                <table
                    class="table table-striped table-bordered table-hover table-checkable datatable ">
                    <thead>
                    <tr>
                        <th><?php echo $jsonlang[244][$jezikId]; ?></th>
                        <th><?php echo $jsonlang[19][$jezikId]; ?></th>
                        <th><?php echo $jsonlang[239][$jezikId]; ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php


                    $i = 1;
                    foreach ($data as $sds => $link) {
                        $IdRecenzije = $link['IdRecenzije'];
                        $ArtikalNaziv = $link['OpisArtikla'];
                        $ArtikalId = $link['ArtikalId'];
                        $NaslovRecenzije = $link['NaslovRecenzije'];
                        $DatumRecenzije = $link['DatumRecenzije'];
                        $fdate = date('d.m.Y. H:i', strtotime($DatumRecenzije));

                        $tab .= '<tr>';
                        $tab .= '<td>' . $ArtikalNaziv . '</td>';
                        $tab .= '<td>' . $NaslovRecenzije . '</td>';
                        $tab .= '<td>' . $fdate . '</td>';

                        $tab .= '<td class="align-center" >';
                        $tab .= '<div class="btn-group" >';
                        $tab .= '<a target="_blank" href="/artikal/' . $ArtikalId . '"> <button class="btn btn-primary"> ' . $jsonlang[242][$jezikId] . '</button > </a>';
                        $tab .= '</div >';
                        $tab .= '</td > ';
                        $tab .= '</tr>';
                    }
                    echo $tab; ?>

                    </tbody>
                </table>
                <?php }else{

                  echo 'Niste ostavljali recenzije na proizvode.';
              }?>

            </div>
        </div>
    </div>
</div>


