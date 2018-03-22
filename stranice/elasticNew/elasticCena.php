<? if ($itemsEs) { ?>
<div class="table_cell">
    <fieldset>
        <legend>Cena</legend>
        <div class="range">
            Range :
            <?

            if ($VpKorisnik) {
                $minCenaSlider = (int) $minCenaVp;
                $maxCenaSlider = (int) $maxCenaVp;
            } else {
                $minCenaSlider = (int) ($minCenaMp*$dnevniKurs);
                $maxCenaSlider = (int) ($maxCenaMp*$dnevniKurs);
            }


            ?>

            <span class="min_val"><? echo $minCenaSlider; ?></span> -
            <span class="max_val"><? echo $maxCenaSlider; ?></span>

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
    </fieldset>
</div>

<? } ?>