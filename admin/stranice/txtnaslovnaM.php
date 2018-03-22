<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 9.9.15.
 * Time: 11:42
 */

$podaci = $db->getOne("osnpodacimasine");
$IdOsnPodaci = $podaci['IdOsnPodaci'];
$welcomeNas = $podaci['welcomeNas'];
$welcomeOpis = $podaci['welcomeOpis'];
$welcomeTbNas1 = $podaci['welcomeTbNas1'];
$welcomeTbOpis1 = $podaci['welcomeTbOpis1'];
$welcomeTbNas2 = $podaci['welcomeTbNas2'];
$welcomeTbOpis2 = $podaci['welcomeTbOpis2'];
$welcomeTbNas3 = $podaci['welcomeTbNas3'];
$welcomeTbOpis3 = $podaci['welcomeTbOpis3'];

?>
<!--=== Page Content ===-->
<div class="row">
    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-reorder"></i>Naslovna strana - tekst</h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>

            <div class="widget-content">
                <h3 class="icon-cog" > Izaberi jezik za izmenu:</h3>
                <hr>

                <?php
                $naziv = '';
                //var_dump($jezLan);

                foreach ($jezLan as $k => $v):
                    $ShortLanguage = $v['ShortLanguage'];

                    $naziv .= '<div class="form-group clearfix ">';
                    $naziv .= '<label class="col-md-3 control-label">Naslovna stranica '.$ShortLanguage.' </label>';
                    $naziv .= '<div class="col-md-9">';
                    $naziv .= '<a class="icon-cog" href="/admin/str/edittxtnaslovnaM/'.$k.'"> Izmeni na <strong>'.$ShortLanguage.'</strong> jeziku</a>';
                    $naziv .= '</div>';
                    $naziv .= '</div>';
                endforeach;

                echo $naziv;
                ?>
                <hr>

                <h2 style="text-align: center">Pregled tekstova sa naslovne strane</h2>

                <div class="clearfix"></div>


                <form enctype="multipart/form-data" method="post" class="form-horizontal row-border" id="validate-1"
                      action="/akcija.php?action=editosnovnipodaci">

                    <input type="hidden" name="id" id="id" value="<?php echo $IdOsnPodaci; ?>">


                    <hr>
                    <h4>Veliki Text pocetna strana:</h4>

                    <!--Naslov na pocetnoj-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Naslov pocetna </label>

                        <div class="col-md-10">
                            <input type="text" name="welcomeNas" class="form-control"
                                   value="<?php echo $welcomeNas; ?>">
                        </div>
                    </div>

                    <!--Opis na pocetnoj-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Opis pocetna </label>

                        <div class="col-md-10">

                            <textarea rows="3" name="welcomeOpis"
                                      class="form-control required"><?php echo $welcomeOpis; ?></textarea>

                        </div>
                    </div>

                    <hr>
                    <h4>Text box pocetna strana:</h4>


                    <div class="form-group">
                        <label class="col-md-2 control-label">Text box levo naslov</label>

                        <div class="col-md-10">
                            <input type="text" name="welcomeTbNas1" class="form-control"
                                   value="<?php echo $welcomeTbNas1; ?>">
                        </div>
                    </div>

                    <!--Opis na pocetnoj-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Text box levo Opis </label>

                        <div class="col-md-10">

                            <textarea rows="3" name="welcomeTbOpis1"
                                      class="form-control required"><?php echo $welcomeTbOpis1; ?></textarea>

                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-2 control-label">Text box sredina naslov</label>

                        <div class="col-md-10">
                            <input type="text" name="welcomeTbNas2" class="form-control"
                                   value="<?php echo $welcomeTbNas2; ?>">
                        </div>
                    </div>

                    <!--Opis na pocetnoj-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Text box sredina Opis</label>

                        <div class="col-md-10">

                            <textarea rows="3" name="welcomeTbOpis2"
                                      class="form-control required"><?php echo $welcomeTbOpis2; ?></textarea>

                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-2 control-label">Text box desno naslov </label>

                        <div class="col-md-10">
                            <input type="text" name="welcomeTbNas3" class="form-control"
                                   value="<?php echo $welcomeTbNas3; ?>">
                        </div>
                    </div>

                    <!--Opis na pocetnoj-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Text box desno Opis</label>

                        <div class="col-md-10">

                            <textarea rows="3" name="welcomeTbOpis3"
                                      class="form-control required"><?php echo $welcomeTbOpis3; ?></textarea>

                        </div>
                    </div>



                    <!--Button unesi-->
                  <!--  <div class="form-actions">
                        <input type="submit" value="Izmeni podatke    " class="btn btn-primary pull-right">
                    </div>-->

                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Page Content -->