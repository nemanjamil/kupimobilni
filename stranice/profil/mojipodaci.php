<!-- ============================================== BLOG CATEGORY ============================================== -->
<?php

$db->where("KomitentId", $idOdUserName);
$komitent = $db->getOne("komitenti");
//var_dump($komitent);

$KomitentId = $komitent['KomitentId'];
$KomitentIme = $komitent['KomitentIme'];
$KomitentPrezime = $komitent['KomitentPrezime'];
$KomitentAdresa = $komitent['KomitentAdresa'];
$KomitentMesto = $komitent['KomitentMesto'];
$KomitentPosBroj = $komitent['KomitentPosBroj'];
$KomitentTelefon = $komitent['KomitentTelefon'];
$KomitentMobTel = $komitent['KomitentMobTel'];
$KomitentEmail = $komitent['KomitentEmail'];
$KomitentUserName = $komitent['KomitentUserName'];
$KomitentiSlika = $komitent['KomitentiSlika'];

?>

<div class="blog-category minvisina">
    <div class="row">
        <div class="col-md-12">
            <div class="widget box">
                <div class="widget-header">
                    <h3><i class="icon-user"></i> <?php  echo $jsonlang[209][$jezikId]; ?><!--moji podaci--></h3>
                </div>
                <div class="widget-content">
                    <form enctype="multipart/form-data" method="post" class="form-horizontal row-border" id="validate-2"
                          action="/akcija.php?action=izmenimojepodatke">

                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php  echo $jsonlang[140][$jezikId]; ?> </label>

                            <div class="col-md-10">
                                <input type="text" name="KomitentIme" id="KomitentIme"
                                       value="<?php echo $KomitentIme; ?>" class="form-control required">

                                <input type="hidden" name="id" id="id" class="form-control required"
                                       value="<?php echo $KomitentId; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php  echo $jsonlang[141][$jezikId]; ?> </label>

                            <div class="col-md-10">
                                <input type="text" name="KomitentPrezime" id="KomitentPrezime"
                                       value="<?php echo $KomitentPrezime; ?>"
                                       class="form-control required">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php  echo $jsonlang[155][$jezikId]; ?> </label>

                            <div class="col-md-10">
                                <input type="text" name="KomitentAdresa" id="KomitentAdresa"
                                       value="<?php echo $KomitentAdresa; ?>" class="form-control required">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php  echo $jsonlang[137][$jezikId]; ?></label>

                            <div class="col-md-10">
                                <input type="text" name="KomitentPosBroj" id="KomitentPosBroj"
                                       value="<?php echo $KomitentPosBroj; ?>"
                                       class="form-control digits required" maxlength="5">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php  echo $jsonlang[143][$jezikId]; ?> </label>

                            <div class="col-md-10">
                                <input type="text" name="KomitentMesto" id="KomitentMesto"
                                       value="<?php echo $KomitentMesto; ?>" class="form-control required">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php  echo $jsonlang[148][$jezikId]; ?> </label>

                            <div class="col-md-10">
                                <input type="text" name="KomitentTelefon" id="KomitentTelefon"
                                       value="<?php echo $KomitentTelefon; ?>" class="form-control digits"
                                       maxlength="12">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php  echo $jsonlang[151][$jezikId]; ?> </label>

                            <div class="col-md-10">
                                <input type="text" name="KomitentMobTel" id="KomitentMobTel"
                                       value="<?php echo $KomitentMobTel; ?>" class="form-control digits"
                                       maxlength="12">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php  echo $jsonlang[31][$jezikId]; ?> </label>

                            <div class="col-md-10">
                                <input type="email" name="KomitentEmail" id="KomitentEmail"
                                       value="<?php echo $KomitentEmail; ?>" class="form-control required">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php  echo $jsonlang[212][$jezikId]; ?> </label>

                            <div class="col-md-10">
                                <input type="text" name="KomitentUserName" id="KomitentUserName"
                                       value="<?php echo $KomitentUserName; ?>"
                                       class="form-control required">
                            </div>
                        </div>

                        <!--<div class="form-group">
                            <label class="col-md-2 control-label"><?php /* echo $jsonlang[213][$jezikId]; */?> </label>


                            <div class="col-md-4">
                                <input type="file" name="slikeMultiple"
                                       class="with-preview accept-gif|jpg|png fileIgnorisi"/>
                            </div>
                            <div class="col-md-6">

                                <?php
/*                                $lokrel = $common->locationslikaOstaloKomitent(KOMSLIKE, $KomitentId);

                                $ext = pathinfo($KomitentiSlika, PATHINFO_EXTENSION);
                                $fileName = pathinfo($KomitentiSlika, PATHINFO_FILENAME);

                                $mala_slika = $fileName . '_mala.' . $ext;


                                $lok = DCROOT . $lokrel . '/' . $mala_slika;
                                if (file_exists($lok)) {
                                    echo '<img src="' . $lokrel . '/' . $mala_slika . '" alt="Avatar">';
                                }

                                */?>

                            </div>
                        </div>-->


                        <div class="form-actions">
                            <input type="submit" value="<?php  echo $jsonlang[214][$jezikId]; ?> " class="btn btn-primary pull-right"
                                   style="margin-bottom: 10px">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Validation Example 1 -->


</div><!-- /.blog-category -->
<!-- ============================================== BLOG CATEGORY : END ============================================== -->