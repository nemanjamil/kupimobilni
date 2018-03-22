<div class="body-content">
    <div class="container">
        <div class="minheight">
            <div class="row">

                <?php
                if ($logged) { ?>

                    <div class="col-md-3 col-sm-3">
                        <a href="#" class="izlogujse"><?php echo $jsonlang[29][$jezikId]; ?></a>
                    </div>


                <?php } else {
                    $errGet = $_GET['err'];


                    switch ($errGet) {
                        case 'nije-sesn-kako-user-nije-aktivan-komitent':
                            $mesLog = 'Nije aktivan user. Pozovite administratora sajta.';
                        break;


                        default:
                            $mesLog = '';
                    }
                    if ($mesLog) {
                        echo '<div class="alert alert-warning"> <strong>Greška! </strong> '.$mesLog.'</div>';;
                    }
                    ?>

                    <div class="col-md-6 col-sm-6 login">
                        <h5 class="checkout-subtitle"><?php echo $jsonlang[18][$jezikId]; ?></h5>

                        <form role="form" method="post" action="" class="register-form toggleform" id="logujse">
                            <div class="form-group">
                                <label for="emaillog" class="info-title"><?php echo $jsonlang[31][$jezikId]; ?>
                                    <span>*</span></label>
                                <input placeholder="<?php echo $jsonlang[31][$jezikId]; ?>" id="emaillog" name="email" class="form-control text-input"
                                       type="email">
                            </div>
                            <div class="form-group">
                                <label for="passwordlog" class="info-title"><?php echo $jsonlang[32][$jezikId]; ?>
                                    <span>*</span></label>
                                <input placeholder="<?php echo $jsonlang[32][$jezikId]; ?>" id="passwordlog" name="password" class="form-control text-input"
                                       type="password">
                            </div>
                            <button class="btn-upper btn btn-primary checkout-page-button" type="submit"><?php echo $jsonlang[18][$jezikId]; ?>
                                <!--onclick="return formhash(this.form,this.form.email,this.form.password);"-->
                            </button>

                        </form>

                        <form role="form" method="post" action="" class="register-form toggleform" style="display:none;"
                              id="izgsifr">
                            <div class="form-group">
                                <label for="emaillog" class="info-title"><?php echo $jsonlang[31][$jezikId]; ?>
                                    <span>*</span></label>
                                <input placeholder="" id="emaillog" name="email" class="form-control text-input"
                                       type="email">
                            </div>
                            <button class="btn-upper btn btn-primary checkout-page-button"
                                    type="submit"><?php echo $jsonlang[36][$jezikId]; ?>
                            </button>

                        </form>

                        <br>
                        <br>

                        <a class="forgot-password" href="#" id="zaboravljenasifra"><?php echo $jsonlang[35][$jezikId]; ?>
                            ?</a>
                        <br>
                        <br>

                        <!--<FORM>
                            <INPUT Type="button" VALUE="Reload Page" onClick="history.go(0)">
                        </FORM>-->
                    </div>

                    <!-- already-registered-login -->
                    <div class="col-md-6 col-sm-6">
                        <h5 class="checkout-subtitle"><?php echo $jsonlang[33][$jezikId]; ?></h5>

                        <form role="form" class="register-form" action="#" id="registracijasamo" data-id="registracija"
                              autocomplete="on" method="post">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="info-title"><?php echo $jsonlang[31][$jezikId]; ?>
                                    <span>*</span></label>
                                <input type="email" name="email" placeholder="<?php echo $jsonlang[31][$jezikId]; ?>" id="email"
                                       class="form-control text-input">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1"
                                       class="info-title"><?php echo $jsonlang[32][$jezikId]; ?>
                                    <span>*</span></label>
                                <input type="password" name="password" placeholder="<?php echo $jsonlang[32][$jezikId]; ?>" id="password"
                                       class="form-control text-input">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1confirm"
                                       class="info-title"><?php echo $jsonlang[34][$jezikId]; ?>
                                    <span>*</span></label>
                                <input type="password" name="confirmpwd" placeholder="<?php echo $jsonlang[32][$jezikId]; ?>" id="confirmpwd"
                                       class="form-control text-input">
                            </div>
                            <button class="btn-upper btn btn-primary checkout-page-button" type="submit"
                                    onclick="return regformhash(this.form,this.form.email,this.form.password,this.form.confirmpwd);">
                                <?php echo $jsonlang[33][$jezikId]; ?>
                            </button>
                        </form>
                    </div>
                    <!-- already-registered-login -->
                <?php } ?>

            </div>
            <!-- /.minheight -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.body-content -->