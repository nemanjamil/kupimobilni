<?php
/**
 * Project: masine
 * Created by PhpStorm.
 * User: Nikola
 * Date: 05. 02. 2016.
 * Time: 12:17staa
 */
?>
<div class="container">
    <div class="row contact-us">
        <div class="col-md-2"></div>

        <div class="col-md-8 centriraj send-mail wow fadeInUp" data-wow-delay="0.4s">
            <h3><?php echo $jsonlang[335][$jezikId] ?></h3>

            <div class="row">

                <div class="col-md-12">
                    <form class="form-horizontal row-border" role="form" method="post"
                          action="/akcija.php?action=dodajzaposao">

                        <div>
                            <label class="centriraj"><h3><?php echo $jsonlang[336][$jezikId] ?></h3></label>
<!--ime i prezime-->
                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo $jsonlang[337][$jezikId] ?></label>

                                <div class="col-md-9">
                                    <input type="text" name="ime" class="form-control text-input required" id="ime"
                                           placeholder="<?php echo $jsonlang[337][$jezikId] ?>">
                                </div>
                            </div>
<!--email-->
                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo $jsonlang[270][$jezikId] ?></label>

                                <div class="col-md-9">
                                    <input type="email" name="email" class="form-control text-input required" id="email"
                                           placeholder="<?php echo $jsonlang[168][$jezikId] ?>">
                                </div>
                            </div>
<!--telefon-->
                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo $jsonlang[148][$jezikId] ?></label>

                                <div class="col-md-9">
                                    <input type="text" name="telefon" class="form-control digits required" id="telefon"
                                           placeholder="<?php echo $jsonlang[338][$jezikId] ?>">
                                </div>
                            </div>
<!--mesto-->
                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo $jsonlang[155][$jezikId] ?></label>

                                <div class="col-md-9">
                                    <input type="text" name="adresa" id="adresa" class="form-control required"
                                           placeholder="<?php echo $jsonlang[339][$jezikId] ?>">
                                </div>
                            </div>

                        </div>

                        <div class="clearfix"></div>

                        <div>

                            <label class="centriraj"><h3><?php echo $jsonlang[340][$jezikId] ?></h3></label>
<!--Iskustvo-->
                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo $jsonlang[341][$jezikId] ?> </label>

                                <div class="col-md-9">
                                <textarea name="iskustvo" id="iskustvo" class="form-control"
                                          placeholder="<?php echo $jsonlang[341][$jezikId] ?>"></textarea>


                                </div>
                            </div>

<!--Poruka-->
                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo $jsonlang[169][$jezikId] ?></label>

                                <div class="col-md-9">
                                <textarea name="poruka" id="poruka" class="form-control"
                                          placeholder="<?php echo $jsonlang[169][$jezikId] ?>"></textarea>

                                </div>
                            </div>

                        </div>

<!--Verifikuj-->
                        <div>
                            <label class="centriraj"><h3><?php echo $jsonlang[343][$jezikId] ?></h3></label>

                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo $jsonlang[344][$jezikId] ?></label>

                                <div class="col-md-9">
                                    <div class="form-group">
                                        <div class="g-recaptcha" data-sitekey="6LdTzEkUAAAAAEreCXfL0G6ZMdqw9BdQ-2b7wfKH"></div>
                                        <!--<div class="g-recaptcha" data-sitekey="6LeTYBcTAAAAAKMZUwVza2pFopZsbQRk99E5LoIT"></div>-->
                                    </div>
                                </div>
                            </div>

                        </div>
                        
                        
                        <button type="submit" class="btn-upper btn btn-primary checkout-page-button pull-right">
                             <?php echo $jsonlang[346][$jezikId] ?></button>
                    
                    </form>
                
                </div>
                <!-- /.col -->



                <div class="col-md-12 outer-bottom-small outer-top-bd" >
                   <b> <?php echo $jsonlang[152][$jezikId].' : '.$jsonlang[347][$jezikId] ?></b>

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>

        <div class="col-md-2"></div>

    </div>
    <!-- /.row -->
</div>