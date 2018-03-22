<?php
/**
 * Project: masinealati
 * Created by PhpStorm.
 * User: Nikola
 * Date: 21. 09. 2016.
 * Time: 11:41
 */
?>
<div class="col-md-12">
    <div class="row">
        <div class="col-md-12">
            <div class="widget box">
                <div class="widget-header">
                    <h4><i class="icon-reorder"></i> Dodaj Translate</h4>
                </div>
                <div class="widget-content">
                    <form id="validate-1" method="post" class="form-horizontal row-border"
                          action="/akcija.php?action=dodajtranslate" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Opis: <span class="required">*</span></label>

                            <div class="col-md-9">
                                <input type="text" class="form-control required" name="naziv">
                            </div>
                        </div>
                        <div class="form-actions">
                            <input type="submit" class="btn btn-primary pull-right" value="Dodaj">
                        </div>
                    </form>
                </div>
            </div>
            <!-- /Validation Example 1 -->
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="widget box">
                <div class="widget-header">
                    <h4><i class="icon-reorder"></i> Lista translate</h4>
                </div>
                <div class="widget-content">
                    <table class="table table-hover table-striped datatable">
                        <thead>
                        <tr>
                            <th>Id translate</th>
                            <th>Opis translate</th>
                            <th>Izmeni vrednost</th>
                            <!--<th>Dodaj vrednost</th>-->
                            <th>Izmeni translate</th>
                            <th>Obrisi</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php
                        //$db->join("kategorijeartikala k", "a.KategorijaArtikalId=k.KategorijaArtikalaId", "LEFT");
                        //$db->join("brendovi b", "a.ArtikalBrendId=b.BrendId", "LEFT");
                        //$db->join("valuta v", "a.ArtikalValutaId=v.ValutaId", "LEFT");
                        // $data = $db->get("artikli a", null, "v.ValutaValuta,b.BrendIme,k.KategorijaArtikalaNaziv, a.KategorijaArtikalId, a.ArtikalId, a.ArtikalNaziv, a.ArtikalVPCena, a.ArtikalMPCena, a.ArtikalKratakOpis");

                        $i = 1;

                        $data = $db->get('translate');

                        foreach ($data as $sds => $link) {
                            $IdTranslate = $link['IdTranslate'];
                            $srblat = $link['srblat'];


                            $tab .=
                                '<tr>


                    <td>' . $IdTranslate . '</td>
                    <td>' . $srblat . '</td>
                    <td>
                    <span class="btn-group">
                    <a title="Izmeni" class="btn btn-sm bs-tooltip btn-warning"
                    href="' . DPROOT . '/admin/str/izmenivrednosttranslate/' . $IdTranslate . '" data-original-title="Search">
                     <i class="icon-star"></i>
                     </a>
                    </span>
                    </td>
                    <td>
                    <span class="btn-group">
                    <a title="Izmeni" class="btn btn-sm bs-tooltip btn-info"
                    href="' . DPROOT . '/admin/str/edittranslate/' . $IdTranslate . '" data-original-title="Search">
                     <i class="icon-pencil"></i>
                     </a>
                    </span>
                    </td>
                    <td>
                    <span class="btn-group">
                    <a title="Obrisi" class="btn btn-sm bs-tooltip btn-danger"
                    onclick="return confirmSubmit()" href="' . DPROOT . '/akcija.php?action=obrisitranslate&id=' . $IdTranslate . '" data-original-title="Obrisi">
                     <i class="icon-remove-sign"></i>
                     </a>
                    </span>
                    </td>
                </tr>';
                        }
                        echo $tab; ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /Validation Example 1 -->
        </div>
    </div>
</div>