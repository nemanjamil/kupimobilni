<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 01. 09. 2015.
 * Time: 11:15
 */

$db->where("IdKomentari", $id);
$tag = $db->getOne("komentari");

$IdKomentari = $tag['IdKomentari'];
$KomentarKomentari = $tag['KomentarKomentari'];
$ArtikalKomentar = $tag['ArtikalKomentar'];
$UserKomentari = $tag['UserKomentari'];
$ImeKomentar = $tag['ImeKomentar'];
$EmailKomentar = $tag['EmailKomentar'];
$ActiveKomentar = $tag['ActiveKomentar'];
$IpKomentar = $tag['IpKomentar'];
$VremeKomentar = $tag['VremeKomentar'];

//var_dump($tag);

?>
<!--=== Page Content ===-->
<div class="row">

    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-comment"></i> Izmeni komentar o artiklu</h4>
            </div>
            <div class="widget-content">
                <form enctype="multipart/form-data" method="post" class="form-horizontal row-border" id="validate-2"
                      action="/akcija.php?action=editkomentar">


                    <input type="hidden" name="id" id="id" value="<?php echo $IdKomentari ?>">

                    <div class="form-group">
                        <label class="col-md-2 control-label">Artikal </label>

                        <div class="col-md-10">

                            <select id="ArtikalKomentar" name="ArtikalKomentar"
                                    class="select2 required full-width-fix" disabled="disabled">
                                <?php

                                $db->join("artikalnazivnew ANN", "ANN.ArtikalId = A.ArtikalId");
                                $db->where("ANN.IdLanguage = 5");
                                $data = $db->get('artikli A', null, 'A.ArtikalId,ANN.OpisArtikla');
                                foreach ($data as $sds => $s) {
                                    $selkom = ($ArtikalKomentar == $s['ArtikalId']) ? 'selected' : '';
                                    echo '<option value="' . $s['ArtikalId'] . '"  ' . $selkom . '>' . $s['OpisArtikla'] . '</option>' . "\n";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Vreme</label>

                        <div class="col-md-10">
                            <input type="text" name="VremeKomentar" id="VremeKomentar"
                                   class="form-control required"
                                   required="required" disabled="disabled" value="<?php echo $VremeKomentar ?>">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-2 control-label">Naslov komentara</label>

                        <div class="col-md-10">
                            <input type="text" name="ImeKomentar" id="ImeKomentar"
                                   class="form-control required"
                                   required="required" value="<?php echo $ImeKomentar ?>">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-2 control-label">Komentar</label>

                        <div class="col-md-10">
                            <textarea rows="5" name="string" id="string"
                                      class="form-control wysiwyg"><?php echo $KomentarKomentari; ?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Aktivno</label>

                        <div class="col-md-10">

                            <select id="ActiveKomentar" name="ActiveKomentar" value="<?php echo $ActiveKomentar ?>"
                                    class="form-control">
                                <option value="0"<?php echo ($ActiveKomentar == 0) ? 'selected' : ''; ?> >Neaktivno
                                </option>
                                <option value="1"<?php echo ($ActiveKomentar == 1) ? 'selected' : ''; ?> >Aktivno
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">User</label>

                        <div class="col-md-10">
                            <input type="text" name="UserKomentari" id="UserKomentari"
                                   class="form-control "
                                   required="required" value="<?php echo $UserKomentari ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">E-mail</label>

                        <div class="col-md-10">
                            <input type="text" name="EmailKomentar" id="EmailKomentar"
                                   class="form-control"
                                   disabled="disabled" value="<?php echo $EmailKomentar ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Ip adresa</label>

                        <div class="col-md-10">
                            <input type="text" name="IpKomentar" id="IpKomentar"
                                   class="form-control required" disabled="disabled"
                                   value="<?php echo $IpKomentar ?>">
                        </div>
                    </div>

                    <div class="form-actions">
                        <input type="submit" value="Izmeni komentar" class="btn btn-primary pull-right">
                    </div>
                </form>
            </div>
        </div>
        <!-- /Validation Example 1 -->
    </div>
</div>
<!-- /Page Content -->