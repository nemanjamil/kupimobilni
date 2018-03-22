<?php
/**
 * Created by PhpStorm.
 * User: Nikola
 * Date: 25.8.15.
 * Time: 11:37
 */
$idu = $id + 1;
$db->where("IdOsnPodaci", $idu);
$podaci = $db->getOne("osnpodacimasine");
$IdOsnPodaci = $podaci['IdOsnPodaci'];
$ImeSajtaOsnPodaci = $podaci['ImeSajtaOsnPodaci'];
$ImeFirmeOsnPodaci = $podaci['ImeFirmeOsnPodaci'];
$UlicaiBrOsnPodaci = $podaci['UlicaiBrOsnPodaci'];
$GradOsnPodaci = $podaci['GradOsnPodaci'];
$PosBrOsnPodaci = $podaci['PosBrOsnPodaci'];
$TelefonOsnPodaci = $podaci['TelefonOsnPodaci'];
$MobTelOsnPodaci = $podaci['MobTelOsnPodaci'];
$EmailOsnPodaci = $podaci['EmailOsnPodaci'];
$RadnoVremeOsnPodaci = $podaci['RadnoVremeOsnPodaci'];
$TitleOsnPodaci = $podaci['TitleOsnPodaci'];
$OpisOsnPodaci = $podaci['OpisOsnPodaci'];
$KeywordsOsnPodaci = $podaci['KeywordsOsnPodaci'];
$SeoTekstOsnPodaci = $podaci['SeoTekstOsnPodaci'];
$PodaciZaKorisnikaOsnPodaci = $podaci['PodaciZaKorisnikaOsnPodaci'];
$PibOsnPodaci = $podaci['PibOsnPodaci'];
$MatBrOsnPodaci = $podaci['MatBrOsnPodaci'];
$ZiroRacunOsnPodaci = $podaci['ZiroRacunOsnPodaci'];
$BankaOsnPodaci = $podaci['BankaOsnPodaci'];
$ZiroRacun1Osnpodaci = $podaci['ZiroRacun1Osnpodaci'];
$Banka1OsnPodaci = $podaci['Banka1OsnPodaci'];
$NacinKupovineOsnPodaci = $podaci['NacinKupovineOsnPodaci'];
$NacinPlacanjaOsnPodaci = $podaci['NacinPlacanjaOsnPodaci'];
$NacinDostaveOsnPodaci = $podaci['NacinDostaveOsnPodaci'];
$FbOsnPodaci = $podaci['FbOsnPodaci'];
$GoogleOsnPodaci = $podaci['GoogleOsnPodaci'];
$TwitterOsnPodaci = $podaci['TwitterOsnPodaci'];
$YoutubeOsnPodaci = $podaci['YoutubeOsnPodaci'];
$InstagramOsnPodaci = $podaci['InstagramOsnPodaci'];
$OstaliPodaciOsnPodaci = $podaci['OstaliPodaciOsnPodaci'];
$PravilaRecenzije = $podaci['PravilaRecenzije'];
/*
$welcomeNas = $podaci['welcomeNas'];
$welcomeOpis = $podaci['welcomeOpis'];
$welcomeTbNas1 = $podaci['welcomeTbNas1'];
$welcomeTbOpis1 = $podaci['welcomeTbOpis1'];
$welcomeTbNas2 = $podaci['welcomeTbNas2'];
$welcomeTbOpis2 = $podaci['welcomeTbOpis2'];
$welcomeTbNas3 = $podaci['welcomeTbNas3'];
$welcomeTbOpis3 = $podaci['welcomeTbOpis3'];
*/

//var_dump($db);
?>
<!--=== Page Content ===-->
<div class="row">
    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-reorder"></i>Osnovni podaci - izmena</h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>

            <div class="widget-content">

               <?php /*echo $id; */?>
                <form enctype="multipart/form-data" method="post" class="form-horizontal row-border" id="validate-1"
                      action="/akcija.php?action=editosnovnipodaciM">

                    <input type="hidden" name="IdOsnPodaci" id="IdOsnPodaci" value="<?php echo $IdOsnPodaci; ?>">


                    <input type="hidden" name="id" id="id" value="<?php echo $idu; ?>">

                    <!--Ime sajta-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Ime sajta </label>

                        <div class="col-md-10">
                            <input type="text" name="naziv" id="naziv" class="form-control required"
                                   required="required" value="<?php echo $ImeSajtaOsnPodaci; ?>">
                        </div>
                    </div>

                    <!--Ime firme-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Ime firme</label>

                        <div class="col-md-10">
                            <input type="text" name="ImeFirmeOsnPodaci" id="ImeFirmeOsnPodaci"
                                   class="form-control required"
                                   required="required" value="<?php echo $ImeFirmeOsnPodaci; ?>">
                        </div>
                    </div>

                    <!--PIB-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">PIB: </label>

                        <div class="col-md-10">
                            <input type="text" name="PibOsnPodaci" class="form-control digits required"
                                   value="<?php echo $PibOsnPodaci; ?>">
                        </div>
                    </div>

                    <!--Maticni broj-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Maticni broj: </label>

                        <div class="col-md-10">
                            <input type="text" name="MatBrOsnPodaci" class="form-control digits required" min="9"
                                   maxlength="9" value="<?php echo $MatBrOsnPodaci; ?>">
                        </div>
                    </div>

                    <!--Racun 1-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Ziro racun 1</label>

                        <div class="col-md-10">
                            <input type="text" name="ZiroRacunOsnPodaci"
                                   class="form-control required"
                                   required="required" value="<?php echo $ZiroRacunOsnPodaci; ?>">
                        </div>
                    </div>

                    <!--Banka 1-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Banka 1</label>

                        <div class="col-md-10">
                            <input type="text" name="BankaOsnPodaci"
                                   class="form-control required"
                                   required="required" value="<?php echo $BankaOsnPodaci; ?>">
                        </div>
                    </div>

                    <!--Racun 2-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Ziro racun 2</label>

                        <div class="col-md-10">
                            <input type="text" name="ZiroRacun1OsnPodaci"
                                   class="form-control" value="<?php echo $ZiroRacun1OsnPodaci; ?>">
                        </div>
                    </div>

                    <!--Banka 2-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Banka 2</label>

                        <div class="col-md-10">
                            <input type="text" name="Banka1OsnPodaci"
                                   class="form-control" value="<?php echo $Banka1OsnPodaci; ?>">
                        </div>
                    </div>

                    <!--Adresa-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Adresa</label>

                        <div class="col-md-10">
                            <input type="text" name="UlicaiBrOsnPodaci" id="UlicaiBrOsnPodaci"
                                   class="form-control required"
                                   required="required" value="<?php echo $UlicaiBrOsnPodaci; ?>">
                        </div>
                    </div>

                    <!--Postanski-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Postanski broj</label>

                        <div class="col-md-10">
                            <input type="text" name="PosBrOsnPodaci" class="form-control required digits"
                                   value="<?php echo $PosBrOsnPodaci; ?>">
                        </div>
                    </div>

                    <!--Mesto-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Mesto</label>

                        <div class="col-md-10">
                            <input type="text" name="GradOsnPodaci" id="GradOsnPodaci"
                                   class="form-control required"
                                   required="required" value="<?php echo $GradOsnPodaci; ?>">
                        </div>
                    </div>

                    <!--Telefon-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Telefon</label>

                        <div class="col-md-10">
                            <input type="text" name="TelefonOsnPodaci" class="form-control required"
                                   value="<?php echo $TelefonOsnPodaci; ?>">
                        </div>
                    </div>

                    <!--Mobilni-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Mob telefon</label>

                        <div class="col-md-10">
                            <input type="text" name="MobTelOsnPodaci" class="form-control required "
                                   value="<?php echo $MobTelOsnPodaci; ?>">
                        </div>
                    </div>

                    <!--Mail-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Email</label>

                        <div class="col-md-10">
                            <input type="text" name="EmailOsnPodaci" class="form-control required "
                                   value="<?php echo $EmailOsnPodaci; ?>">
                        </div>
                    </div>

                    <!--Vreme-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Radno vreme</label>

                        <div class="col-md-10">
                            <input type="text" name="RadnoVremeOsnPodaci" class="form-control required"
                                   value="<?php echo $RadnoVremeOsnPodaci; ?>">
                        </div>

                    </div>

                    <!--Title-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Title</label>

                        <div class="col-md-10">
                            <textarea rows="2" name="string" id="string"
                                      class="form-control required"><?php echo $TitleOsnPodaci; ?></textarea>
                        </div>
                    </div>

                    <!--Kratak opis-->
                    <div class="form-group">
                        <label class="col-md-2 control-label ">Kratak opis</label>

                        <div class="col-md-10">
                            <textarea rows="3" name="OpisOsnPodaci"
                                      class="form-control required"><?php echo $OpisOsnPodaci; ?></textarea>
                        </div>
                    </div>

                    <!--Keywords-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Keywords</label>

                        <div class="col-md-10">
                            <textarea rows="2" name="KeywordsOsnPodaci"
                                      class="form-control required"><?php echo $KeywordsOsnPodaci; ?></textarea>
                        </div>
                    </div>

                    <!--SEO-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Seo tekst</label>

                        <div class="col-md-10">
                            <textarea rows="4" name="SeoTekstOsnPodaci"
                                      class="form-control required"><?php echo $SeoTekstOsnPodaci; ?></textarea>
                        </div>
                    </div>

                    <!--Podaci za korisnika-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Podaci za korisnika</label>

                        <div class="col-md-10">
                            <textarea rows="3" name="PodaciZaKorisnikaOsnPodaci"
                                      class="form-control required"><?php echo $PodaciZaKorisnikaOsnPodaci; ?></textarea>
                        </div>
                    </div>

                    <!--Nacin Kupovine-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Nacin kupovine</label>

                        <div class="col-md-10">
                            <textarea rows="6" name="NacinKupovineOsnPodaci"
                                      class="form-control wysiwyg required"><?php echo $NacinKupovineOsnPodaci; ?></textarea>
                        </div>
                    </div>

                    <!--Nacin placanja-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Nacin placanja</label>

                        <div class="col-md-10">
                            <textarea rows="2" name="NacinPlacanjaOsnPodaci"
                                      class="form-control required"><?php echo $NacinPlacanjaOsnPodaci; ?></textarea>
                        </div>
                    </div>

                    <!--Nacin dostave-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Nacin dostave</label>

                        <div class="col-md-10">
                            <textarea rows="2" name="NacinDostaveOsnPodaci"
                                      class="form-control required"><?php echo $NacinDostaveOsnPodaci; ?></textarea>
                        </div>
                    </div>

                    <!--Face-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Facebook: </label>

                        <div class="col-md-10">
                            <input type="text" name="FbOsnPodaci" class="form-control"
                                   value="<?php echo $FbOsnPodaci; ?>">
                        </div>
                    </div>

                    <!--Google+-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Google +: </label>

                        <div class="col-md-10">
                            <input type="text" name="GoogleOsnPodaci" class="form-control"
                                   value="<?php echo $GoogleOsnPodaci; ?>">
                        </div>
                    </div>

                    <!--Twitter-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Twitter: </label>

                        <div class="col-md-10">
                            <input type="text" name="TwitterOsnPodaci" class="form-control"
                                   value="<?php echo $TwitterOsnPodaci; ?>">
                        </div>
                    </div>

                    <!--YouTube-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">YouTube: </label>

                        <div class="col-md-10">
                            <input type="text" name="YouTubeOsnPodaci" class="form-control"
                                   value="<?php echo $YoutubeOsnPodaci; ?>">
                        </div>
                    </div>

                    <!--Instagram-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Instagram: </label>

                        <div class="col-md-10">
                            <input type="text" name="InstagramOsnPodaci" class="form-control"
                                   value="<?php echo $InstagramOsnPodaci; ?>">
                        </div>
                    </div>



                    <!--Ostali podaci osnovnih podataka-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Info o prodavcu za posetioca sajta</label>

                        <div class="col-md-10">
                            <textarea rows="6" name="OstaliPodaciOsnPodaci"
                                      class="form-control wysiwyg required"><?php echo $OstaliPodaciOsnPodaci; ?></textarea>
                        </div>
                    </div>

                    <!--Pravila recenzije-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Pravila Recenzije</label>

                        <div class="col-md-10">
                            <textarea rows="6" name="PravilaRecenzije"
                                      class="form-control mceEditor"><?php echo $PravilaRecenzije; ?></textarea>
                        </div>
                    </div>

                    <!--Button unesi-->
                    <div class="form-actions">
                        <input type="submit" value="Izmeni podatke    " class="btn btn-primary pull-right">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Page Content -->