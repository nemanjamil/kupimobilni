
<script src="/assets/js/jquery-1.11.2.min.js"></script>
<script src="/assets/js/select2/select2.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/bootstrap-slider.min.js"></script>
<script src="/assets/js/owl.carousel.min.js"></script>
<script src="/assets/js/bootstrap-hover-dropdown.min.js"></script>
<script src="/assets/js/jquery.custom-select.js"></script>
<script src="/assets/js/echo.min.js"></script>
<script src="/assets/js/lightbox.min.js"></script>
<!--<script src="/assets/js/pace.min.js"></script>-->
<script src="/assets/js/jquery.easing-1.3.min.js"></script>
<script src="/assets/js/wow.min.js"></script>

<script src='/assets/js/rateit/jquery.MetaData.js' type="text/javascript" language="javascript"></script>
<script src='/assets/js/rateit/jquery.rating.js' type="text/javascript" language="javascript"></script>
<link href='/assets/js/rateit/jquery.rating.css' type="text/css" rel="stylesheet"/>




<!--za search-->
<!--<script src="http://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js"></script>
<script src="/assets/js/typeHead/typeHead.js"></script>-->



<!-- Go to www.addthis.com/dashboard to customize your tools -->
<!--<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-54b609f040a301ca"
        async="async"></script>-->



<script src="/assets/js/scripts.js?<?php echo VERZIJA_JS;?>"></script>
<script src="/assets/js/select2Moj.js"></script>
<script src="/assets/js/fb.js"></script>




<!-- For demo purposes – can be removed on production -->

<!--<script src="switchstylesheet/switchstylesheet.js"></script>-->

<!--<script>
    $(document).ready(function () {
        /*$(".changecolor").switchstylesheet({seperator: "color"});*/

        $('.show-theme-options').click(function () {
            $(this).parent().toggleClass('open');
            return false;
        });
    });
    // comment nemanja ovo je stavljeno da bi se uvukao sa leve strane
    $(window).bind("load", function () {
        $('.show-theme-options').delay(2000).trigger('click');
    });
</script>
<!-- For demo purposes – can be removed on production : End -->
<?php
switch ($stranica) {
    case 'login':
        echo '<script type="text/javascript" src="/assets/js/secure/sha512.js"></script>';
        echo '<script type="text/javascript" src="/assets/js/secure/forms.js?'.VERZIJA_JS.'"></script>';
        echo '<script  type="text/javascript" src="/assets/js/secure/base64Helper.js"></script>';
        break;
    case 'profil':
        echo '<script type="text/javascript" src="/assets/js/secure/sha512.js"></script>';
        echo '<script type="text/javascript" src="/assets/js/secure/forms.js"></script>';
        echo '<script  type="text/javascript" src="/assets/js/secure/base64Helper.js"></script>';
        break;

    case 'contact-us':
    case 'proiz':
        echo '<script src="https://www.google.com/recaptcha/api.js"></script>';
    case 'kategorija':
        echo '<script  type="text/javascript" src="/assets/js/kategorija.js"></script>';
        break;
    case 'search':
        echo '<script  type="text/javascript" src="/assets/js/elasticSearch.js"></script>';
        break;

}
?>