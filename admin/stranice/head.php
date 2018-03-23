<?php
/**
 * Created by PhpStorm.
 * User: NemanjaMilivojevic
 * Date: 30.7.15.
 * Time: 19.47
 */
?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
<title>KupiMobilni | Dashboard - <?php echo $stranica?></title>

<!--=== CSS ===-->

<!-- Bootstrap -->
<link href="<?php echo DPROOTADMIN . '/'; ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

<!-- jQuery UI -->
<!--<link href="plugins/jquery-ui/jquery-ui-1.10.2.custom.css" rel="stylesheet" type="text/css" />-->
<!--[if lt IE 9]> -->
<link rel="stylesheet" type="text/css" href="<?php echo DPROOTADMIN . '/'; ?>plugins/jquery-ui/jquery.ui.1.10.2.ie.css"/>
<!-- <![endif]-->


<!-- Theme -->
<link href="<?php echo DPROOTADMIN . '/'; ?>assets/css/main.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo DPROOTADMIN . '/'; ?>assets/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo DPROOTADMIN . '/'; ?>assets/css/responsive.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo DPROOTADMIN . '/'; ?>assets/css/icons.css" rel="stylesheet" type="text/css"/>

<link rel="stylesheet" href="<?php echo DPROOTADMIN . '/'; ?>assets/css/fontawesome/font-awesome.min.css">
<!--[if IE 7]>-->
<link rel="stylesheet" href="<?php echo DPROOTADMIN . '/'; ?>assets/css/fontawesome/font-awesome-ie7.min.css">
<!-- <![endif]-->

<!--[if IE 8]>-->
<link href="<?php echo DPROOTADMIN . '/'; ?>assets/css/ie8.css" rel="stylesheet" type="text/css"/>
<!-- <![endif]-->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>

<link href="/assets/css/mojcss.css" rel="stylesheet" type="text/css"/>

<!--=== JavaScript ===-->

<script type="text/javascript" src="<?php echo DPROOTADMIN . '/'; ?>assets/js/libs/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="<?php echo DPROOTADMIN . '/'; ?>plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>

<script type="text/javascript" src="<?php echo DPROOTADMIN . '/'; ?>bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo DPROOTADMIN . '/'; ?>assets/js/libs/lodash.compat.min.js"></script>


<!--Z3 CSS-->
<link rel="stylesheet" href="<?php echo DPROOTADMIN . '/'; ?>assets/css/zTreeStyle/zTreeStyle.css" type="text/css">
<!--Z3 CSS-->


<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>-->
<script src="<?php echo DPROOTADMIN . '/'; ?>assets/js/libs/html5shiv.js"></script>
<!--<![endif]-->

<!-- Smartphone Touch Events -->
<script type="text/javascript" src="<?php echo DPROOTADMIN . '/'; ?>plugins/touchpunch/jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript" src="<?php echo DPROOTADMIN . '/'; ?>plugins/event.swipe/jquery.event.move.js"></script>
<script type="text/javascript" src="<?php echo DPROOTADMIN . '/'; ?>plugins/event.swipe/jquery.event.swipe.js"></script>

<!-- General -->
<script type="text/javascript" src="<?php echo DPROOTADMIN . '/'; ?>assets/js/libs/breakpoints.js"></script>
<script type="text/javascript" src="<?php echo DPROOTADMIN . '/'; ?>plugins/respond/respond.min.js"></script> <!-- Polyfill for min/max-width CSS3 Media Queries (only for IE8) -->
<script type="text/javascript" src="<?php echo DPROOTADMIN . '/'; ?>plugins/cookie/jquery.cookie.min.js"></script>
<script type="text/javascript" src="<?php echo DPROOTADMIN . '/'; ?>plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script type="text/javascript" src="<?php echo DPROOTADMIN . '/'; ?>plugins/slimscroll/jquery.slimscroll.horizontal.min.js"></script>

<!-- Page specific plugins -->
<!-- Charts -->
<!--[if lt IE 9]>-->
<script type="text/javascript" src="<?php echo DPROOTADMIN . '/'; ?>plugins/flot/excanvas.min.js"></script>
<!--<![endif]-->
<script type="text/javascript" src="<?php echo DPROOTADMIN . '/'; ?>plugins/sparkline/jquery.sparkline.min.js"></script>
<script type="text/javascript" src="<?php echo DPROOTADMIN . '/'; ?>plugins/flot/jquery.flot.min.js"></script>
<script type="text/javascript" src="<?php echo DPROOTADMIN . '/'; ?>plugins/flot/jquery.flot.tooltip.min.js"></script>
<script type="text/javascript" src="<?php echo DPROOTADMIN . '/'; ?>plugins/flot/jquery.flot.resize.min.js"></script>
<script type="text/javascript" src="<?php echo DPROOTADMIN . '/'; ?>plugins/flot/jquery.flot.time.min.js"></script>
<script type="text/javascript" src="<?php echo DPROOTADMIN . '/'; ?>plugins/flot/jquery.flot.growraf.min.js"></script>
<script type="text/javascript" src="<?php echo DPROOTADMIN . '/'; ?>plugins/easy-pie-chart/jquery.easy-pie-chart.min.js"></script>

<script type="text/javascript" src="<?php echo DPROOTADMIN . '/'; ?>plugins/daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="<?php echo DPROOTADMIN . '/'; ?>plugins/daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="<?php echo DPROOTADMIN . '/'; ?>plugins/blockui/jquery.blockUI.min.js"></script>

<script type="text/javascript" src="<?php echo DPROOTADMIN . '/'; ?>plugins/fullcalendar/fullcalendar.min.js"></script>


<!-- Forms -->
<!--<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
-->

<script type="text/javascript" src="<?php echo DPROOTADMIN . '/'; ?>plugins/uniform/jquery.uniform.min.js"></script> <!-- Styled radio and checkboxes -->

<!--OVAJ JE STARI-->
<!--<script type="text/javascript" src="<?php /*echo DPROOTADMIN . '/'; */?>plugins/select2/select2.min.js"></script> -->

<!--OVAJ SMO ISKPIRALI NOVI SA CDN-a-->

<script type="text/javascript" src="<?php echo DPROOTADMIN . '/'; ?>plugins/select2_4_3/select2.min.js"></script>
<link href="<?php echo DPROOTADMIN . '/'; ?>plugins/select2_4_3/select2.min.css" rel="stylesheet" type="text/css"/>

<script type="text/javascript" src="<?php echo DPROOTADMIN . '/'; ?>plugins/fileinput/fileinput.js"></script>

<!-- Form Validation -->
<script type="text/javascript" src="<?php echo DPROOTADMIN . '/'; ?>plugins/validation/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo DPROOTADMIN . '/'; ?>plugins/validation/additional-methods.min.js"></script>

<!-- Noty -->
<script type="text/javascript" src="<?php echo DPROOTADMIN . '/'; ?>plugins/noty/jquery.noty.js"></script>
<script type="text/javascript" src="<?php echo DPROOTADMIN . '/'; ?>plugins/noty/layouts/top.js"></script>
<script type="text/javascript" src="<?php echo DPROOTADMIN . '/'; ?>plugins/noty/themes/default.js"></script>

<!-- App -->
<script type="text/javascript" src="<?php echo DPROOTADMIN . '/'; ?>assets/js/app.js"></script>
<script type="text/javascript" src="<?php echo DPROOTADMIN . '/'; ?>assets/js/plugins.js"></script>
<script type="text/javascript" src="<?php echo DPROOTADMIN . '/'; ?>assets/js/plugins.form-components.js"></script>

<script type="text/javascript" src="<?php echo DPROOTADMIN . '/'; ?>plugins/bootstrap-wysihtml5/wysihtml5.min.js"></script>
<script type="text/javascript" src="<?php echo DPROOTADMIN . '/'; ?>plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.min.js"></script>


<!--multi file-->
<!--<script src="//github.com/fyneworks/multifile/blob/master/jQuery.MultiFile.min.js" type="text/javascript" language="javascript"></script>-->
<script src='/assets/js/multifile/jquery.MetaData.js' type="text/javascript" language="javascript"></script>
<script src='/assets/js/multifile/jquery.MultiFile.js' type="text/javascript" language="javascript"></script>


<script type="text/javascript" src="<?php echo DPROOTADMIN . '/'; ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo DPROOTADMIN . '/'; ?>plugins/datatables/tabletools/TableTools.min.js"></script>
<!-- optional -->
<script type="text/javascript" src="<?php echo DPROOTADMIN . '/'; ?>plugins/datatables/colvis/ColVis.min.js"></script>
<!-- optional -->
<script type="text/javascript" src="<?php echo DPROOTADMIN . '/'; ?>plugins/datatables/columnfilter/jquery.dataTables.columnFilter.js"></script>
<!-- optional -->
<script type="text/javascript" src="<?php echo DPROOTADMIN . '/'; ?>plugins/datatables/DT_bootstrap.js"></script>

<!--<script type="text/javascript" src="<?php /*echo DPROOTADMIN . '/'; */?>plugins/pickadate/picker.date.js"></script>-->

<script type="text/javascript" src="<?php echo DPROOTADMIN . '/'; ?>plugins/pickadate/picker.js"></script>

<script type="text/javascript" src="<?php echo DPROOTADMIN . '/'; ?>plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.js"></script>


<script>
    $(document).ready(function () {
        "use strict";

        App.init(); // Init layout and core plugins
        Plugins.init(); // Init all plugins
        FormComponents.init(); // Init all form-specific plugins
    });
</script>

<!-- Demo JS -->

<script type="text/javascript" src="<?php echo DPROOTADMIN . '/'; ?>assets/js/customagro.js"></script>

<script type="text/javascript" src="<?php echo DPROOTADMIN . '/'; ?>assets/js/demo/form_validation.js"></script>
<!--Z3 JS-->
<script type="text/javascript" src="<?php echo DPROOTADMIN.'/'; ?>assets/css/zTreeStyle/jquery.ztree.all-3.5.js"></script>

<?php
switch ($stranica) {
    case 'kategorijeZdravlje':
        echo '<script type="text/javascript" src="' . DPROOTADMIN . '/assets/js/kategzdravlje.js"></script>';
        break;
    case 'kategorijeHeader':
        echo '<script type="text/javascript" src="' . DPROOTADMIN . '/assets/js/treehead.js"></script>';
        break;
    case 'kategorije':
        echo '<script type="text/javascript" src="' . DPROOTADMIN . '/assets/js/ztreekateg.js"></script>';
        break;
    case 'editartikal':
        echo '<script type="text/javascript" src="' . DPROOTADMIN . '/assets/js/kategzdravljeArt.js"></script>';
        echo '<script type="text/javascript" src="' . DPROOTADMIN . '/assets/js/upitSearchSelect.js"></script>';
        break;
    case 'artiklinaakcijiM':
    case 'artiklinaakcijiA':
    case 'artiklinajprodavanijiM':
    case 'artiklinajprodavanijiA':
    case 'artiklinoviproizvodiM':
    case 'artiklinoviproizvodiA':
    case 'artikliPreporuceniAndroid':
        echo '<script type="text/javascript" src="' . DPROOTADMIN . '/assets/js/artiklinaakciji.js"></script>';
        break;



}

?>


<!--<script type="text/javascript" src="assets/js/demo/pages_calendar.js"></script>
<script type="text/javascript" src="assets/js/demo/charts/chart_filled_blue.js"></script>
<script type="text/javascript" src="assets/js/demo/charts/chart_simple.js"></script>-->


<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.2.0/css/bootstrap-theme.min.css">-->

<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/themes/github.css">-->

<link rel="stylesheet" href="/admin/plugins/tagmoderni/bootstrap-tagsinput.css">
<link rel="stylesheet" href="/admin/plugins/tagmoderni/app.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.10.4/typeahead.bundle.min.js"></script>
<script src="/admin/plugins/tagmoderni/bootstrap-tagsinput.min.js"></script>


<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.2.0/.js/bootstrap.min.js"></script>
-->


<!--<script src="/admin/plugins/tagmoderni/bootstrap-tagsinput-angular.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.20/angular.min.js"></script>-->

<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/rainbow.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/language/generic.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/language/html.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/language/javascript.js"></script>-->

<!--TABELE HIGH CHART-->
<!--<script src="https://code.highcharts.com/highcharts.js"></script>-->
<!--<script src="<?php /*echo DPROOTADMIN.'/'; */ ?>assets/js/highchart.js"></script>-->
<!--<script src="https://code.highcharts.com/modules/exporting.js"></script>-->
<!--<script type="text/javascript" src="<?php /*echo DPROOTADMIN.'/'; */?>assets/js/highchartadmin/chartsAnd.js"></script>--> <!--imamo tabele chart.js koji treba da izbirsemo kada nam ne treba-->


