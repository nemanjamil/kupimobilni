<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 27. 08. 2015.
 * Time: 00:57
 */

$db->where("LS.IdLokSamo", $id);

$link = $db->get("lokalnasu LS", null, "LS.*"/*$cols*/);

foreach ($link as $links) {

    $IdLokSamo = $links['IdLokSamo'];
    $ImeLokSamo = $links['ImeLokSamo'];
    $ZemljaLokSamo = $links['ZemljaLokSamo'];
    $LinkLokSamo = $links['LinkLokSamo'];
    $SlikaLokSamo = $links['SlikaLokSamo'];
}

?>
<!--=== Page Content ===-->
<div class="row">

    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-tag"></i> Izmeni Lokalnu samoupravu</h4>
            </div>
            <div class="widget-content">
                <form enctype="multipart/form-data" method="post" class="form-horizontal row-border" id="validate-2"
                      action="/akcija.php?action=editverifls">

                    <div class="form-group">
                        <label class="col-md-2 control-label">Ime Lokalne samouprave </label>

                        <div class="col-md-10">
                            <input type="text" name="ImeLokSamo" id="ImeLokSamo" class="form-control required"
                                   value="<?php echo $ImeLokSamo ?>">

                            <input type="hidden" name="id" id="id" value="<?php echo $IdLokSamo ?>">
                        </div>
                    </div>

                    <?php

                    $naziv = '';
                    foreach ($jezLan as $k => $v):
                        $ShortLanguage = $v['ShortLanguage'];
                        $IdLanguage = $v['IdLanguage'];

                        $cols = Array("LokSamoNaslov");
                        $db->where('IdLokSamo', $id);
                        $db->where('IdLanguage', $IdLanguage);
                        $artNazivNewUpit = $db->getOne("loksamotextnew", null, $cols);
                        $OpisArtikla = $artNazivNewUpit['LokSamoNaslov'];

                        $naziv .= '<div class="form-group">';
                        $naziv .= '<label class="col-md-2 control-label bg-success"><strong>Naziv Lok samouprave ' . $ShortLanguage . ' </strong></label>';
                        $naziv .= '<div class="col-md-10">';
                        $naziv .= '<input type="text" id="naziv' . $ShortLanguage . '" name="naziv[' . $IdLanguage . ']" class="form-control" value="' . $OpisArtikla . '">';
                        $naziv .= '</div>';
                        $naziv .= '</div>';
                    endforeach;

                    echo $naziv;

                    ?>


                    <div class="form-group">
                        <label class="col-md-2 control-label">Zemlja lokalne samouprave </label>

                        <div class="col-md-10">

                            <select class="form-control required" name="ZemljaLokSamo"
                                    id="ZemljaLokSamo">
                                <option value=""></option>

                                <?php
                                $data = $db->get('zemlja');
                                foreach ($data as $sds => $s) {
                                    $IdZemlja = $s['IdZemlja'];
                                    $ImeZemlja = $s['ImeZemlja'];
                                    $selektovano = ($ZemljaLokSamo == $IdZemlja) ? 'selected' : '';


                                    $arryZemlj .= '<option value="'.$IdZemlja.'" '.$selektovano.'>'.$ImeZemlja.'</option>';
                                 }
                                echo $arryZemlj;
                                ?>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-2 control-label">WEB adresa Lokalne samouprave </label>

                        <div class="col-md-10">
                            <input type="text" name="LinkLokSamo" id="LinkLokSamo" class="form-control"
                                   value="<?php echo $LinkLokSamo ?>">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-2 control-label">Slika </label>


                        <div class="col-md-4">
                            <input type="file" name="slikeMultipleLs"
                                   class="with-preview accept-gif|jpg|png fileIgnorisi"/>
                        </div>
                        <div class="col-md-6">

                            <?php
                            $slika = $common->locationslikaOstalo(LSSLIKE, $IdLokSamo);
                            $ext = pathinfo($SlikaLokSamo, PATHINFO_EXTENSION);
                            $fileName = pathinfo($SlikaLokSamo, PATHINFO_FILENAME);
                            $mala_slika = $fileName . '.' . $ext;
                            $lok = DCROOT . $slika . '/' . $mala_slika;
                            if (file_exists($lok)) {
                                echo '<img src="' . $slika . '/' . $mala_slika . '" alt="Slika - logo samouprave">';
                            }

                            ?>

                        </div>
                    </div>


                    <?php

                    $nazivOp = '';
                    foreach ($jezLan as $k => $v):
                        $ShortLanguage = $v['ShortLanguage'];
                        $IdLanguage = $v['IdLanguage'];

                        $cols = Array("LokSamoOpis");
                        $db->where('IdLokSamo', $id);
                        $db->where('IdLanguage', $IdLanguage);
                        $artKratakNewUpit = $db->getOne("loksamoopisnew", null, $cols);
                        $OpisArtTekst = $artKratakNewUpit['LokSamoOpis'];

                        $nazivOp .= '<div class="form-group">';
                        $nazivOp .= '<label class="col-md-2 control-label">Kratak Opis <b>' . $ShortLanguage . '</b> </label>';
                        $nazivOp .= '<div class="col-md-10">';
                        $nazivOp .= '<textarea rows="5" id="kratakopis' . $ShortLanguage . '" name="kratakopis[' . $IdLanguage . ']" class="form-control wysiwyg">' . $OpisArtTekst . '</textarea>';
                        $nazivOp .= '</div>';
                        $nazivOp .= '</div>';

                    endforeach;

                    echo $nazivOp;
                    ?>


                    <div class="form-actions">
                        <input type="submit" value="Izmeni lokalnu samoupravu" class="btn btn-primary pull-right">
                    </div>
                </form>
            </div>
        </div>
        <!-- /Validation Example 1 -->
    </div>
</div>

<!-- /Page Content -->
