<!-- ============================================== BLOG CATEGORY ============================================== -->
<div class="blog-category minvisina">


    <form class="form-group form-horizontal row-border" id="promPp" action="#">

        <input id="idUser" value="<?php echo $idOdUserName;  ?>" type="hidden">
        <div class="form-group">
            <label class="col-md-3 control-label"><?php  echo $jsonlang[215][$jezikId]; ?> <span class="required">*</span></label>
            <div class="col-md-9">
                <input name="pass1" id="pass1" class="form-control" required minlength="5" type="password">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label"><?php  echo $jsonlang[34][$jezikId]; ?> <span class="required">*</span></label>
            <div class="col-md-9">
                <input name="cpass1" id="cpass1" class="form-control required" minlength="5" equalto="[name='pass1']" type="password">
            </div>
        </div>

        <div class="form-actions">
            <input value="<?php  echo $jsonlang[211][$jezikId]; ?>" class="btn btn-primary pull-right" type="submit">
        </div>
    </form>


</div><!-- /.blog-category -->
<!-- ============================================== BLOG CATEGORY : END ============================================== -->