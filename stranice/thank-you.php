<?php
/**
 * Created by PhpStorm.
 * User: NemanjaMilivojevic
 * Date: 24.8.15.
 * Time: 11.10
 */
?>

<div class="container" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
    <div class="row contact-us minvisina">
        <div class="col-md-6 details wow fadeInUp" data-wow-delay="0.2s">
            <h3><?php echo $jsonlang[204][$jezikId]; ?></h3>
            <p class="tag-line">
                <h4><?php echo $jsonlang[206][$jezikId]; ?></h4>
                    <br>
                <p><?php echo $jsonlang[284][$jezikId]; ?></p>
                <p><?php echo $jsonlang[285][$jezikId]; ?></p>
            </p>
            <div><i class="fa fa-map-marker"></i><?php echo  $jsonlang[207][$jezikId] . ' ' .$jsonOsn[$jezikId]["UlicaiBrOsnPodaci"] . ', ' . $jsonOsn[$jezikId]["PosBrOsnPodaci"] . ' ' . $jsonOsn[$jezikId]["GradOsnPodaci"] ?></div>
            <div><i class="fa fa-phone"></i> <?php echo $jsonlang[208][$jezikId] . ' ' .$jsonOsn[$jezikId]["TelefonOsnPodaci"]; ?></div>
            <div><i class="fa fa-envelope"></i><?php echo $jsonOsn[$jezikId]["EmailOsnPodaci"]; ?></div>
        </div><!-- /.details -->

        <!--<div class="col-md-6 send-mail wow fadeInUp" data-wow-delay="0.4s">
            <h3>send us an email</h3>
            <div class="row">
                <div class="col-md-6">
                    <form class="register-form" role="form">
                        <div class="form-group">
                            <input type="email" class="form-control text-input" id="exampleInputName" placeholder="Your website">
                        </div>
                    </form>
                </div>

                <div class="col-md-6">
                    <form class="register-form" role="form">
                        <div class="form-group">
                            <input type="email" class="form-control text-input" id="exampleInputTitle" placeholder="Your website">
                        </div>
                    </form>
                </div>

                <div class="col-md-12">
                    <form class="register-form" role="form">
                        <div class="form-group">
                            <textarea class="form-control" id="exampleInputComments" placeholder="Your Comment"></textarea>
                        </div>
                    </form>
                </div>

                <div class="col-md-12 outer-bottom-small">
                    <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Send Message</button>
                </div>
            </div>
        </div>-->
    </div>
</div><!-- /.container -->
