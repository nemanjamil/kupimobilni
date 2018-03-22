<?php

$db->join("KategImeZdravlje KIZ","KIZ.IdKategZdravlje = K.KategorijaArtikalaIdZdravlje", "LEFT");
$db->join("KategZdravljeOpis KZO","KZO.IdKategZdravljeOpis = K.KategorijaArtikalaIdZdravlje", "LEFT");
$db->where("K.KategorijaArtikalaIdZdravlje", $id);
$kat = $db->getOne("kategorijezdravlje K");

$KategorijaArtikalaId = $kat['KategorijaArtikalaIdZdravlje'];
$ParentKategorijaArtikalaId = $kat['ParentKategorijaArtikalaIdZdravlje'];
$KategorijaArtikalaLink = $kat['KategorijaArtikalaLinkZdravlje'];

$KategorijaArtikalaActive = $kat['KategorijaArtikalaActiveZdravlje'];
$katAkt = ($KategorijaArtikalaActive) ? 'checked' : '';

$KategorijaArtikalaMesto = $kat['KategorijaArtikalaMestoZdravlje'];
$KategorijaArtikalaKratak = $kat['KategorijaArtikalaKratakZdravlje'];

$KategorijaArtikalaSlika = $kat['KategorijaArtikalaSlikaZdravlje'];


?>
<div class="row">
    <!--=== Validation Example 1 ===-->
    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">

                <h4><i class="icon-edit"></i> Edit Kategorije Zdravlje</h4>


            </div>
            <div class="widget-content">
                <?php // $imekategUpit = $adminfunkc->getKatodID($id); ?>

                <form enctype="multipart/form-data" class="form-horizontal row-border" method="post" id="validate-1"
                      action="/akcija.php?action=editujKategZasebnoZdravlje">


                    <input type="hidden" name="id" id="idodKateg" value="<?php echo $KategorijaArtikalaId; ?>">



                    <?php
                    $naziv = '';
                    foreach ($jezLan as $k => $v):
                        $ShortLanguage = $v['ShortLanguage'];
                        $IdLanguage = $v['IdLanguage'];

                        $cols = Array("NazivKategZdravlje");
                        $db->where('IdKategZdravlje', $id);
                        $db->where('IdLanguage', $IdLanguage);
                        $artNazivNewUpit = $db->getOne("kategorijezdravljenew", null, $cols);
                        $OpisArtikla = $artNazivNewUpit['NazivKategZdravlje'];

                        $naziv .= '<div class="form-group">';
                        $naziv .= '<label class="col-md-2 control-label bg-success"><strong>Ime Kategorije ' . $ShortLanguage . ' </strong></label>';
                        $naziv .= '<div class="col-md-10">';
                        $naziv .= '<input type="text" id="naziv' . $ShortLanguage . '" name="naziv[' . $IdLanguage . ']" class="form-control" value="' . $OpisArtikla . '">';
                        $naziv .= '</div>';
                        $naziv .= '</div>';
                    endforeach;

                    echo $naziv;

                    ?>



                    <div class="form-group">
                        <label class="col-md-2 control-label">Kategorija Link <span class="required">*</span></label>

                        <div class="col-md-10">
                            <input type="text" name="KategorijaArtikalaLink"
                                   value="<?php echo $KategorijaArtikalaLink; ?>" class="form-control required ">
                            <!-- izbacili smo url u klasi-->
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Aktivna Kategorija <span class="required">*</span></label>

                        <div class="col-md-10">
                            <label class="checkbox">
                                <div class="checker"><span>
                                        <input name="KategorijaArtikalaActive" <?php echo $katAkt; ?> class="uniform"
                                               type="checkbox">
                                    </span></div>
                                - </label>
                            <label for="KategorijaArtikalaActive" class="has-error help-block" generated="true"
                                   style="display:none;"></label>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-2 control-label">Mesto <span class="required">*</span></label>

                        <div class="col-md-10">
                            <input type="number" name="KategorijaArtikalaMesto"
                                   value="<?php echo $KategorijaArtikalaMesto; ?>" class="form-control digits">
                        </div>
                    </div>




                    <div class="form-group">
                        <label class="col-md-2 control-label">Kratak opis kategorije </label>

                        <div class="col-md-10">
                            <input type="text" name="KategorijaArtikalaKratak"
                                   value="<?php echo $KategorijaArtikalaKratak; ?> " class="form-control">
                        </div>
                    </div>


                    <!--Multi slike-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Kategorija Slika</label>

                        <div class="col-md-4">
                            <input type="file" name="slikeMultiple"
                                   class="with-preview accept-gif|jpg|png fileIgnorisi"/>

                        </div>
                        <div class="col-md-5">

                            <?php

                            $lokrel = $common->locationslikaOstalo(KATSLIKELZDRAVLJE, $KategorijaArtikalaId);

                            $ext = pathinfo($KategorijaArtikalaSlika, PATHINFO_EXTENSION);
                            $fileName = pathinfo($KategorijaArtikalaSlika, PATHINFO_FILENAME);

                            $mala_slika = $fileName . '_mala.' . $ext;


                            $lok = $lok = DCROOT . $lokrel . '/' . $mala_slika;
                            if (file_exists($lok)) {
                                echo '<img src="' . $lokrel . '/' . $mala_slika . '" alt="">';
                            }

                            ?>

                        </div>
                    </div>


                    <?php

                    $nazivOp = '';
                    foreach ($jezLan as $k => $v):
                        $ShortLanguage = $v['ShortLanguage'];
                        $IdLanguage = $v['IdLanguage'];

                        $cols = Array("TekstKategZdr");
                        $db->where('IdKategZdravlje', $id);
                        $db->where('IdLanguage', $IdLanguage);
                        $artKratakNewUpit = $db->getOne("kategorijezdravljetekst", null, $cols);
                        $OpisArtTekst = $artKratakNewUpit['TekstKategZdr'];

                        $nazivOp .= '<div class="form-group">';
                        $nazivOp .= '<label class="col-md-2 control-label bg-success">Veliki Opis <b>' . $ShortLanguage . '</b> </label>';
                        $nazivOp .= '<div class="col-md-10">';
                        $nazivOp .= '<textarea rows="9" id="velikiopis' . $ShortLanguage . '" name="velikiopis[' . $IdLanguage . ']" class="form-control mceEditor">' . $OpisArtTekst . '</textarea>';
                        $nazivOp .= '</div>';
                        $nazivOp .= '</div>';

                    endforeach;

                    echo $nazivOp;
                    ?>


                    <div class="form-actions">
                        <input type="submit" value="Imeni kategoriju" class="btn btn-primary pull-right">
                    </div>
                </form>

            </div>
        </div>
        <!-- /Validation Example 1 -->
    </div>



</div>
