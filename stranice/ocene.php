<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 21. 01. 2016.
 * Time: 10:29
 */

if ($KomitentActive == 1 and $id) {

?>
<div class="blog-comments wow fadeInUp" data-wow-delay="0.2s">

    <?php

    $db->join("artikalnazivnew AN", "AN.ArtikalId = A.ArtikalId", "LEFT");
    $db->where("A.ArtikalId", $id);
    $db->where("IdLanguage", $jezikId);
    $list = $db->getOne("artikli A", null, 'A.ArtikalId, AN.OpisArtikla');

    $model = $list['OpisArtikla'];
    $idd = $list['ArtikalId'];


    $data = $db->get('mojibodovi');
    foreach ($data as $sds => $s) {
        $MojiBodoviId = $s['MojiBodoviId'];
        $OpisBodaMojiBodovi = $s['OpisBodaMojiBodovi'];
        $vrednostboda = $s['VrednostBodaMojiBodovi'];

    }

    ?>

    <div class="blog-comments">

        <?php

        $osc = "SELECT COUNT(IdRecenzije) AS bod FROM recenzije WHERE KomitentRecenzije = '$KomitentId' AND KomentarAktivanRecenzije = '1' AND IskoriscenRecenzije = '0'";
        $bro = $db->rawQueryOne($osc);

        $bod = $bro['bod'];
        $ukbodoce = $bod * $vrednostboda;

        if ($bod <= 20) {

        ?>
        <div class="container">
            <div class="col-md-12">
                <div
                    class="col-md-3 text-center"> <?php require RB_ROOT . '/parts/navigation/sidebar/linkovi-ocene.php'; ?>
                </div>

                <div class="col-md-9 text-center">

                    <div class="widget box">
                        <div class="widget-header ">
                            <h2 class="text-center ocenanaslov"><a href="<?php echo URLVRATI?>" class="bojacrna"><?php echo $model; ?> </a></h2>
                        </div>
                        <div class="widget-content">
                            <form enctype="multipart/form-data" method="post" id="validate-4"
                                  class="form-horizontal row-border" action="/akcija.php?action=dodajocenu">


                                <input name="KomitentRecenzije" type="hidden" value="<?php echo $KomitentId; ?>"/>

                                <input name="ProizvodRecenzije" type="hidden" value="<?php echo $idd; ?>"/>


                                <div class="form-group">
                                    <label class="col-md-4 control-label"><?php echo $jsonlang[71][$jezikId]; ?><span class="bojacrvena">*</span></label>

                                    <div class="col-md-7 star-rating-control">

                                        <input name="StarCenaRecenzije" class="star" type="radio" value="1" title="1"/>
                                        <input name="StarCenaRecenzije" class="star" type="radio" value="2" title="2"/>
                                        <input name="StarCenaRecenzije" class="star" type="radio" value="3" title="3"/>
                                        <input name="StarCenaRecenzije" class="star" type="radio" value="4" title="4"/>
                                        <input name="StarCenaRecenzije" class="star" type="radio" value="5" title="5"/>

                                    </div>
                                    <div class="col-md-1"></div>
                                </div>



                                <div class="form-group">
                                    <label class="col-md-4 control-label"><?php echo $jsonlang[304][$jezikId]; ?><span
                                            class="bojacrvena">*</span></label>

                                    <div class="col-md-7 star-rating-control">

                                        <input name="StarKvalitetRecenzije" class="star" type="radio" value="1"
                                               title="1"/>
                                        <input name="StarKvalitetRecenzije" class="star" type="radio" value="2"
                                               title="2"/>
                                        <input name="StarKvalitetRecenzije" class="star" type="radio" value="3"
                                               title="3"/>
                                        <input name="StarKvalitetRecenzije" class="star" type="radio" value="4"
                                               title="4"/>
                                        <input name="StarKvalitetRecenzije" class="star" type="radio" value="5"
                                               title="5"/>

                                    </div>

                                    <div class="col-md-1"></div>

                                </div>



                                <div class="form-group ">
                                    <label class="col-md-4 control-label"><?php echo $jsonlang[305][$jezikId]; ?><span
                                            class="bojacrvena">*</span></label>

                                    <div class="col-md-7 star-rating-control">

                                        <input name="StarLakocaRecenzije" class="star" type="radio" value="1"
                                               title="1"/>
                                        <input name="StarLakocaRecenzije" class="star" type="radio" value="2"
                                               title="2"/>
                                        <input name="StarLakocaRecenzije" class="star" type="radio" value="3"
                                               title="3"/>
                                        <input name="StarLakocaRecenzije" class="star" type="radio" value="4"
                                               title="4"/>
                                        <input name="StarLakocaRecenzije" class="star" type="radio" value="5"
                                               title="5"/>

                                    </div>
                                    <div class="col-md-1"></div>

                                </div>



                                <div class="form-group ">
                                    <label class="col-md-4 control-label"><?php echo $jsonlang[306][$jezikId]; ?><span
                                            class="bojacrvena">*</span></label>

                                    <div class="col-md-7 star-rating-control">

                                        <input name="StarKorisnostRecenzije" class="star" type="radio" value="1"
                                               title="1"/>
                                        <input name="StarKorisnostRecenzije" class="star" type="radio" value="2"
                                               title="2"/>
                                        <input name="StarKorisnostRecenzije" class="star" type="radio" value="3"
                                               title="3"/>
                                        <input name="StarKorisnostRecenzije" class="star" type="radio" value="4"
                                               title="4"/>
                                        <input name="StarKorisnostRecenzije" class="star" type="radio" value="5"
                                               title="5"/>

                                    </div>
                                    <div class="col-md-1"></div>

                                </div>



                                <div class="form-group ">
                                    <label class="col-md-4 control-label"><?php echo $jsonlang[19][$jezikId]; ?><span
                                            class="bojacrvena">*</span> </label>

                                    <div class="col-md-7">

                                        <input type="text" name="NaslovRecenzije" id="NaslovRecenzije"
                                               class="form-control required"
                                               required="required">

                                    </div>
                                    <div class="col-md-1"></div>

                                </div>



                                <div class="form-group">
                                    <label class="col-md-4 control-label"><?php echo $jsonlang[307][$jezikId]; ?><span class="bojacrvena">*</span> </label>

                                    <div class="col-md-7">

                                        <textarea class="form-control" id="KomentarZaRecenzije"
                                                  name="KomentarZaRecenzije"> </textarea>

                                    </div>
                                    <div class="col-md-1"></div>

                                </div>



                                <div class="form-group">
                                    <label class="col-md-4 control-label"><?php echo $jsonlang[308][$jezikId]; ?><span
                                            class="bojacrvena">*</span></label>

                                    <div class="col-md-7">

                                        <textarea class="form-control" id="KomentarProtivRecenzije"
                                                  name="KomentarProtivRecenzije"> </textarea>

                                    </div>
                                    <div class="col-md-1"></div>

                                </div>


                                <div class="form-group">
                                    <label class="col-md-4 control-label"><?php echo $jsonlang[309][$jezikId]; ?><span
                                            class="bojacrvena">*</span></label>

                                    <div class="col-md-7">

                                        <select class="form-control required" name="KolikoDugoRecenzije"
                                                id="KolikoDugoRecenzije">
                                            <option value=""></option>

                                            <?php
                                            $data = $db->get('kolikodugotabela');
                                            foreach ($data as $sds => $s) {
                                                $ValutaId = $s['KolikoDugoTabelaId'];
                                                $ValutaNaziv = $s['KolikoDugoTabelaOpis' . $jezik];
                                                $selektovano = ($ValutaNaziv == $ValutaId) ? 'selected' : ''

                                                ?>
                                                <option value="<?php echo $ValutaId; ?>" <?php echo $selektovano ?>>
                                                    <?php echo $ValutaNaziv; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-1"></div>

                                </div>

<!--
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Da li je proizvod za poklon<span
                                            class="bojacrvena">*</span></label>

                                    <div class="col-md-7">

                                        <select id="PoklonRecenzije" name="PoklonRecenzije" class="form-control">
                                            <option value=""></option>
                                            <option value="0">Ne</option>
                                            <option value="1">Da</option>
                                        </select>
                                    </div>
                                    <div class="col-md-1"></div>

                                </div>
-->


                                <div class="form-group">
                                    <div class="col-md-6 kepcalevo"></div>
                                    <div class="col-md-6 col-xs-12">
                                        <div class="form-group">
                                            <div class="g-recaptcha" data-sitekey="6LcU3k4UAAAAAJmLj_y3H9nkgfiP4MabaSNyMkQ4"></div>
                                            <!--<div class="g-recaptcha" data-sitekey="6LeTYBcTAAAAAKMZUwVza2pFopZsbQRk99E5LoIT"></div>-->
                                        </div>
                                    </div>
                                </div>



                                <div class="form-group">
                                    <p>
                                        <?php echo $jsonlang[310][$jezikId] .' '.  $jsonOsn[$jezikId]["TelefonOsnPodaci"] .' '. $jsonlang[311][$jezikId] ?>
                                        <strong><a href="mailto:<?php echo GLAVNIMAIL; ?>"
                                                   class="bojacrvena"><?php echo GLAVNIMAIL; ?></a></strong>
                                    </p>
                                </div>


                                <div class="form-actions">
                                    <input type="submit" value="Posalji ocenu" class="btn btn-primary centriraj">
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

            </div>


            <?php } else {
                echo '<strong class="bojacrvenaprod">' .  $jsonlang[312][$jezikId] . '</strong>';
            } ?>


            <div class="col-md-12">

                <?php include_once('pravilarecenzije.php'); ?>


            </div>

        </div>

    </div>
    <?php } elseif ($id) {
        $db->join("artikalnazivnew AN", "AN.ArtikalId = A.ArtikalId", "LEFT");
        $db->where("A.ArtikalId", $id);
        $db->where("IdLanguage", $jezikId);
        $list = $db->getOne("artikli A", null, 'A.ArtikalId, AN.OpisArtikla');

        $modela = $list['OpisArtikla'];
        $ArtikalId = $list['ArtikalId'];


        ?>

        <div>
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h3 class="centriraj"><?php echo $modela; ?> </h3>
                <h4 class="centriraj"><?php echo $jsonlang[313][$jezikId]; ?></h4>

                <div class="list-group centriraj">
                    <a href="/login" target="_blank" class="list-group-item basic-alert centriraj"><b class="bojaplavat"><?php echo $jsonlang[33][$jezikId]; ?></b></a>
                </div>

            </div>
            <div class="col-md-3"></div>
        </div>


        <?php include_once('uslovirecenzije.php'); ?>


        <div class="clearfloat"></div>


    <?php } else { ?>

        <div class="review_clew naslovrec">


            <?php include_once('uslovirecenzije.php'); ?>


        </div> <?php } ?>

    <div class="clearfloat"></div>


</div>

<!-- /wrapper -->



