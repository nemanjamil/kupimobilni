<?php
/**
 * Created by PhpStorm.
 * User: NemanjaMilivojevic
 * Date: 30.7.15.
 * Time: 19.47
 */
?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<title>Dashboard | Melon - Flat &amp; Responsive Admin Template</title>

<!--=== CSS ===-->

<!-- Bootstrap -->
<link href="<?php echo DPROOTADMIN.'/'; ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

<!-- jQuery UI -->
<!--<link href="plugins/jquery-ui/jquery-ui-1.10.2.custom.css" rel="stylesheet" type="text/css" />-->
<!--[if lt IE 9]>
<link rel="stylesheet" type="text/css" href="<?php echo DPROOTADMIN.'/'; ?>plugins/jquery-ui/jquery.ui.1.10.2.ie.css"/>
<![endif]-->



<!-- Theme -->
<link href="<?php echo DPROOTADMIN.'/'; ?>assets/css/main.css" rel="stylesheet" type="text/css" />
<link href="<?php echo DPROOTADMIN.'/'; ?>assets/css/plugins.css" rel="stylesheet" type="text/css" />
<link href="<?php echo DPROOTADMIN.'/'; ?>assets/css/responsive.css" rel="stylesheet" type="text/css" />
<link href="<?php echo DPROOTADMIN.'/'; ?>assets/css/icons.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="<?php echo DPROOTADMIN.'/'; ?>assets/css/fontawesome/font-awesome.min.css">
<!--[if IE 7]>
<link rel="stylesheet" href="<?php echo DPROOTADMIN.'/'; ?>assets/css/fontawesome/font-awesome-ie7.min.css">
<![endif]-->

<!--[if IE 8]>
<link href="<?php echo DPROOTADMIN.'/'; ?>assets/css/ie8.css" rel="stylesheet" type="text/css" />
<![endif]-->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>

<!--=== JavaScript ===-->

<script type="text/javascript" src="<?php echo DPROOTADMIN.'/'; ?>assets/js/libs/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="<?php echo DPROOTADMIN.'/'; ?>plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>

<script type="text/javascript" src="<?php echo DPROOTADMIN.'/'; ?>bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo DPROOTADMIN.'/'; ?>assets/js/libs/lodash.compat.min.js"></script>


<!--Z3 CSS-->
<link rel="stylesheet" href="<?php echo DPROOTADMIN.'/'; ?>assets/css/zTreeStyle/zTreeStyle.css" type="text/css">
<!--Z3 CSS-->




<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="<?php echo DPROOTADMIN.'/'; ?>assets/js/libs/html5shiv.js"></script>
<![endif]-->

<!-- Smartphone Touch Events -->
<script type="text/javascript" src="<?php echo DPROOTADMIN.'/'; ?>plugins/touchpunch/jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript" src="<?php echo DPROOTADMIN.'/'; ?>plugins/event.swipe/jquery.event.move.js"></script>
<script type="text/javascript" src="<?php echo DPROOTADMIN.'/'; ?>plugins/event.swipe/jquery.event.swipe.js"></script>

<!-- General -->
<script type="text/javascript" src="<?php echo DPROOTADMIN.'/'; ?>assets/js/libs/breakpoints.js"></script>
<script type="text/javascript" src="<?php echo DPROOTADMIN.'/'; ?>plugins/respond/respond.min.js"></script> <!-- Polyfill for min/max-width CSS3 Media Queries (only for IE8) -->
<script type="text/javascript" src="<?php echo DPROOTADMIN.'/'; ?>plugins/cookie/jquery.cookie.min.js"></script>
<script type="text/javascript" src="<?php echo DPROOTADMIN.'/'; ?>plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script type="text/javascript" src="<?php echo DPROOTADMIN.'/'; ?>plugins/slimscroll/jquery.slimscroll.horizontal.min.js"></script>

<!-- Page specific plugins -->
<!-- Charts -->
<!--[if lt IE 9]>
<script type="text/javascript" src="<?php echo DPROOTADMIN.'/'; ?>plugins/flot/excanvas.min.js"></script>
<![endif]-->
<script type="text/javascript" src="<?php echo DPROOTADMIN.'/'; ?>plugins/sparkline/jquery.sparkline.min.js"></script>
<script type="text/javascript" src="<?php echo DPROOTADMIN.'/'; ?>plugins/flot/jquery.flot.min.js"></script>
<script type="text/javascript" src="<?php echo DPROOTADMIN.'/'; ?>plugins/flot/jquery.flot.tooltip.min.js"></script>
<script type="text/javascript" src="<?php echo DPROOTADMIN.'/'; ?>plugins/flot/jquery.flot.resize.min.js"></script>
<script type="text/javascript" src="<?php echo DPROOTADMIN.'/'; ?>plugins/flot/jquery.flot.time.min.js"></script>
<script type="text/javascript" src="<?php echo DPROOTADMIN.'/'; ?>plugins/flot/jquery.flot.growraf.min.js"></script>
<script type="text/javascript" src="<?php echo DPROOTADMIN.'/'; ?>plugins/easy-pie-chart/jquery.easy-pie-chart.min.js"></script>

<script type="text/javascript" src="<?php echo DPROOTADMIN.'/'; ?>plugins/daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="<?php echo DPROOTADMIN.'/'; ?>plugins/daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="<?php echo DPROOTADMIN.'/'; ?>plugins/blockui/jquery.blockUI.min.js"></script>

<script type="text/javascript" src="<?php echo DPROOTADMIN.'/'; ?>plugins/fullcalendar/fullcalendar.min.js"></script>


<!-- Forms -->
<script type="text/javascript" src="<?php echo DPROOTADMIN.'/'; ?>plugins/uniform/jquery.uniform.min.js"></script> <!-- Styled radio and checkboxes -->
<script type="text/javascript" src="<?php echo DPROOTADMIN.'/'; ?>plugins/select2/select2.min.js"></script> <!-- Styled select boxes -->
<script type="text/javascript" src="<?php echo DPROOTADMIN.'/'; ?>plugins/fileinput/fileinput.js"></script>

<!-- Form Validation -->
<script type="text/javascript" src="<?php echo DPROOTADMIN.'/'; ?>plugins/validation/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo DPROOTADMIN.'/'; ?>plugins/validation/additional-methods.min.js"></script>

<!-- Noty -->
<script type="text/javascript" src="<?php echo DPROOTADMIN.'/'; ?>plugins/noty/jquery.noty.js"></script>
<script type="text/javascript" src="<?php echo DPROOTADMIN.'/'; ?>plugins/noty/layouts/top.js"></script>
<script type="text/javascript" src="<?php echo DPROOTADMIN.'/'; ?>plugins/noty/themes/default.js"></script>

<!-- App -->
<script type="text/javascript" src="<?php echo DPROOTADMIN.'/'; ?>assets/js/app.js"></script>
<script type="text/javascript" src="<?php echo DPROOTADMIN.'/'; ?>assets/js/plugins.js"></script>
<script type="text/javascript" src="<?php echo DPROOTADMIN.'/'; ?>assets/js/plugins.form-components.js"></script>

<!--<script type="text/javascript" src="<?php /*echo DPROOTADMIN.'/'; */?>plugins/bootstrap-wysihtml5/wysihtml5.min.js"></script>
<script type="text/javascript" src="<?php /*echo DPROOTADMIN.'/'; */?>plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.min.js"></script>-->





<script>
    $(document).ready(function(){
        "use strict";

        App.init(); // Init layout and core plugins
        Plugins.init(); // Init all plugins
        FormComponents.init(); // Init all form-specific plugins
    });
</script>

<!-- Demo JS -->
<script type="text/javascript" src="<?php echo DPROOTADMIN.'/'; ?>assets/js/custom.js"></script>
<script type="text/javascript" src="<?php echo DPROOTADMIN.'/'; ?>assets/js/demo/form_validation.js"></script>
<!--Z3 JS-->
<script type="text/javascript" src="<?php echo DPROOTADMIN.'/'; ?>assets/css/zTreeStyle/jquery.ztree.all-3.5.js"></script>



<!--<script type="text/javascript" src="assets/js/demo/pages_calendar.js"></script>
<script type="text/javascript" src="assets/js/demo/charts/chart_filled_blue.js"></script>
<script type="text/javascript" src="assets/js/demo/charts/chart_simple.js"></script>-->

