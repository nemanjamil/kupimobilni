<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 05. 08. 2015.
 * Time: 3:32 PM
 * Edited: 09:13 PM
 */

?>


<div class="row">
    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-reorder"></i> Lista artikala, <?php echo "korisnik id: $id" ?></h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>
            <div class="widget-content">
                <!--<table class="table table-striped table-bordered table-hover table-checkable table-tabletools table-colvis datatable">-->
                <table class="table table-striped table-bordered table-hover table-checkable table-colvis datatable">
                    <thead>
                    <tr>
                        <th>Rd. br.</th>
                        <th>Id Artikla</th>
                        <th>Naziv</th>
                        <th>Kategorija</th>
                        <th>Brend</th>
                        <th>VP cena</th>
                        <th>MP cena</th>
                        <!-- <th>Valuta</th>-->
                        <th>Akcija</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php

                    //$db->setTrace (true);
                    $pieces = SVEKATEGORIJEMASINE;

                    $db->join("kategorijeartikala k", "a.KategorijaArtikalId=k.KategorijaArtikalaId", "LEFT");
                    $db->join("kategorijeartikalanaslov kn", "kn.IdKategorije=k.KategorijaArtikalaId", "LEFT");
                    $db->join("brendovi b", "a.ArtikalBrendId=b.BrendId", "LEFT");
                    $db->join("brendoviime BI", "BI.BrendId = b.BrendId", "LEFT");
                    $db->join("artikalnazivnew ann", "a.ArtikalId=ann.ArtikalId", "LEFT");

                    if ($id == 0){
                    $db->where("ann.IdLanguage = 5 AND kn.IdLanguage = 5 AND BI.IdLanguage = 5 ORDER BY ann.OpisArtikla ASC");
                    }
                    else
                    {
                    $db->where("ann.IdLanguage = 5 AND a.ArtikalKomitent = $id AND kn.IdLanguage = 5 AND BI.IdLanguage = 5 ORDER BY ann.OpisArtikla ASC");
                    }
                    // ako je nula<td>

                    $limit = array(0,10);
                   /* if ($id) {
                        $db->where("a.ArtikalKomitent", $id);
                    } else {
                        echo 'Nema Komitenta';
                        die;
                    }*/

                    $data = $db->get("artikli a", $limit, "BI.BrendIme,kn.NazivKategorije, a.KategorijaArtikalId, a.ArtikalId, ann.OpisArtikla, a.ArtikalVPCena, a.ArtikalMPCena");

                    //var_dump($db->trace);

                    $i = 1;
                    foreach ($data as $sds => $link) {
                        $ArtikalId = $link[ArtikalId];
                        $ArtikalNaziv = $link[OpisArtikla];
                        $ArtikalKategorija = $link[NazivKategorije];
                        $ArtikalBrend = $link[BrendIme];
                        $ArtikalVPCena = $link[ArtikalVPCena];
                        $ArtikalMPCena = $link[ArtikalMPCena];



                        $r .= '<tr>
                        <td>' . $i . '</td>
                        <td>' . $ArtikalId . '</td>
                        <td>' . $ArtikalNaziv . '</td>
                        <td>' . $ArtikalKategorija . '</td>
                        <td>' . $ArtikalBrend . '</td>
                        <td>' . $ArtikalVPCena . '</td>
                        <td>' . $ArtikalMPCena . '</td>


                        <td>
                        <div class="btn-group">
                        		<button class="btn btn-xs dropdown-toggle" data-toggle="dropdown">
											<i class="icol-cog"></i> Akcija
											<span class="caret"></span>
										</button>
                            <ul class="dropdown-menu">
                                <li><a href="/admin/str/editartikal/' . $ArtikalId . '"> <i class="icon-edit"> </i> Izmeni</a></li>
                                <li><a href="/akcija.php?action=obrisiartikal&id=' . $ArtikalId . '"> <i class="icon-remove"> </i> Obrisi</a></li>
                            </ul>
                        </div>
                    </td>
                    </tr>';

                        $i++;


                    }
                    echo $r;
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!--=== Page Content ===-->
