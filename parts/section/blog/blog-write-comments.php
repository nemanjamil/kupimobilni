<!-- ============================================== BLOG WRITE COMMENTS ============================================== -->
<div class="blog-write-comment"><!--wow fadeInUp-->
    <div class="row">
        <form class="register-form" action="/akcija.php?action=dodajKometar" enctype="multipart/form-data" method="post"
              role="form">
            <input name="id" type="hidden" value="<?php echo $ArtikalId; ?>">
            <input name="br" type="hidden" value="<?php echo $KomitentId; ?>">

            <div class="col-md-12">
                <h4><?php echo $jsonlang[197][$jezikId]; ?></h4>
            </div>
            <!-- /.col -->
            <div class="col-md-6">

                <div class="form-group">
                    <input type="text" class="form-control text-input" required name="string" id="exampleInputName"
                           value="<?php echo $KomitentIme . ' ' . $KomitentPrezime; ?>"
                           placeholder="<?php echo $jsonlang[140][$jezikId]; ?> ">
                </div>

            </div>
            <!-- /.col -->
            <div class="col-md-6">
                <div class="form-group">
                    <input type="email" class="form-control text-input" required name="email" id="exampleInputEmail1"
                           value="<?php echo $KomitentEmail; ?>" placeholder="<?php echo $jsonlang[168][$jezikId]; ?>">
                </div>
            </div>
            <!-- /.col -->

            <div class="col-md-12">
                <div class="form-group">
					<textarea class="form-control" id="exampleInputComments" name="komentar"
                              placeholder="<?php echo $jsonlang[169][$jezikId]; ?>"></textarea>
                </div>
            </div>

            <div class="col-md-6 col-xs-12">
                <div class="form-group">
                    <div class="g-recaptcha" data-sitekey="6LcU3k4UAAAAAJmLj_y3H9nkgfiP4MabaSNyMkQ4"></div>
                    <!--<div class="g-recaptcha" data-sitekey="6LeTYBcTAAAAAKMZUwVza2pFopZsbQRk99E5LoIT"></div>-->
                   </div>
            </div>


            <div class="col-md-12 outer-bottom-small">
                <button type="submit"
                        class="btn-upper btn btn-primary checkout-page-button"><?php echo $jsonlang[197][$jezikId]; ?></button>
            </div>
            <!-- /.col -->
    </div>
    <!-- /.row -->
    </form>
</div><!-- /.blog-write-comment -->
<!-- ============================================== BLOG WRITE COMMENTS : END ============================================== -->
