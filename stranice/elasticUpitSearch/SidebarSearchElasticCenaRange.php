<div class="sidebar-filter">
    <?php

    if ($VpKorisnik) {
        $minCenaSlider = (int)$minCenaVp;
        $maxCenaSlider = (int)$maxCenaVp;
    } else {
        $minCenaSlider = (int)($minCenaMp);
        $maxCenaSlider = (int)($maxCenaMp);
    }


    ?>

    <h4 class="sidebar-sub-title"><?php echo $jsonlang[71][$jezikId]; ?>: </h4>

    <div class="sidebar-widget">
        <div class="sidebar-widget-body">
            <div class="slider price-range-holder">

                <div class="range">

                    <input type="hidden" id="minCena" name="minCena" class="min_value" value="<? echo $minCenaSlider; ?>">
                    <input type="hidden" id="maxCena" name="maxCena" class="max_value" value="<? echo $maxCenaSlider; ?>">

                    <input type="hidden" id="minCenaSes" name="minCenaSes" class="min_value" value="<? echo $minCenaSesParam; ?>">
                    <input type="hidden" id="maxCenaSes" name="maxCenaSex" class="max_value" value="<? echo $maxCenaSesParam; ?>">

                    </div>

                <div id="slider" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
                    <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                    <span class="ui-slider-handle ui-state-default ui-corner-all"></span>
                    <span class="ui-slider-handle ui-state-default ui-corner-all"></span>
                </div>

                <div class="centriraj">
                    <span class="min_val"><? echo $minCenaSlider; ?></span> -
                    <span class="max_val"><? echo $maxCenaSlider; ?></span>
                </div>


                <!--Cena broj input STOCK-->
                <!--<input type="text" class="price-input" value="<?php /*echo $minCenaSlider; */?>">
                <i class="fa fa-minus"></i>
                <input type="text" class="price-input" value="<?php /*echo $maxCenaSlider; */?>">

                <a href="#"><?php /*echo $jsonlang[20][$jezikId]; */?></a>-->
                <!--!Cena broj input-->

            </div>
        </div>
    </div>

</div>