<!-- ============================================== OPTION SEARCH BAR ============================================== -->
<?php
$question = $_GET['q'];
if($question){
    $valQues = 'value = "'.$question.'"';
}

?>
<div class="option-search-bar">
    <form action="/search" method="get">
      <div class="input-group borderMoj2XXX clearfix" id="prefetch">
            <input type="text" name="q" id="stajeUkucano" class="form-control typeahead" <?php echo $valQues; ?>
                   placeholder="<?php /*echo $jsonlang[20][$jezikId]; */?>" >
            <span class="input-group-btn" style="width: auto">
                <button class="btn" id="klikekteSearch"><i class="fa fa-search"></i></button>
            </span>
        </div>

        <style>
            .bigdrop {
                width: 700px !important;
            }
        </style>
        <div class="input-group borderMoj2XX" style="width: 100%">

            <!--<input type="text" class="form-control typeaheadXXX"  name="q" id="stajeUkucano" placeholder="<?php /*echo $jsonlang[20][$jezikId]; */?>">
            <span class="input-group-btnXXX" style="width: 0%;vertical-align: top;">
                <button id="kliketeSearch" class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
            </span>-->
           <!-- <select class="js-data-example-ajax" name="q" style="width: 100%"> </select>-->




        </div>

    </form>
    <!-- /input-group -->
</div><!-- /option-search-bar -->

<div  class="col-xs-12 col-sm-12 boldirano font16 bojacrnadef text-left header-phone">
    <?php echo $jsonlang[1][$jezikId] . ': ' . $jsonOsn[$jezikId]["TelefonOsnPodaci"] . ' '. $jsonlang[414][$jezikId] .' ' . $jsonOsn[$jezikId]["MobTelOsnPodaci"] ?>
</div>

<!-- ============================================== OPTION SEARCH BAR : END============================================== -->

<!--<input type="text" id="hiddenInputElement" value=" ">-->

