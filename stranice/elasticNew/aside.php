<!--Right Part Start -->
<aside class="col-sm-4 col-md-3" id="column-left">

<div class="module latest-product titleLine">
    <h3 class="modtitle">Filter </h3>

    <div class="modcontent ">
        <form class="type_2">

            <div class="table_layout filter-shopby">
                <div class="table_row">

                    <?
                    require('elasticReset.php');
                    require('elasticBrendovi.php');
                    require('elasticKategorije.php');
                    require('elasticModeli.php');
                    require('elasticCena.php');
                    require('elasticSpecifikacije.php');
                    require('elasticStatistika.php');
                    ?>

                    <!--<div class="table_cell">
                        <fieldset>
                            <legend>Manufacturer</legend>
                            <ul class="checkboxes_list">
                                <li>
                                    <input type="checkbox" checked="" name="manufacturer" id="manufacturer_1">
                                    <label for="manufacturer_1">Manufacturer 1</label>
                                </li>
                                <li>
                                    <input type="checkbox" name="manufacturer" id="manufacturer_2">
                                    <label for="manufacturer_2">Manufacturer 2</label>
                                </li>
                                <li>
                                    <input type="checkbox" name="manufacturer" id="manufacturer_3">
                                    <label for="manufacturer_3">Manufacturer 3</label>
                                </li>
                            </ul>
                        </fieldset>
                    </div>-->


                    <!--<div class="table_cell">
                        <fieldset>
                            <legend>Price</legend>
                            <div class="range">
                                Range :
                                <span class="min_val">$188.73</span> -
                                <span class="max_val">$335.15</span>
                                <input type="hidden" name="" class="min_value" value="188.73">
                                <input type="hidden" name="" class="max_value" value="335.15">
                            </div>
                            <div id="slider" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
                                <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                                <span class="ui-slider-handle ui-state-default ui-corner-all"></span>
                                <span class="ui-slider-handle ui-state-default ui-corner-all"></span>
                            </div>
                        </fieldset>
                    </div>-->


                    <!--<div class="table_cell">
                        <fieldset>
                            <legend>Color</legend>
                            <div class="row">
                                <div class="col-sm-6">
                                    <ul class="simple_vertical_list">
                                        <li>
                                            <input type="checkbox" name="" id="color_btn_1">
                                            <label for="color_btn_1" class="color_btn green">Green</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" name="" id="color_btn_2">
                                            <label for="color_btn_2" class="color_btn yellow">Yellow</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" name="" id="color_btn_3">
                                            <label for="color_btn_3" class="color_btn red">Red</label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-sm-6">
                                    <ul class="simple_vertical_list">
                                        <li>
                                            <input type="checkbox" name="" id="color_btn_4">
                                            <label for="color_btn_4" class="color_btn blue">Blue</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" name="" id="color_btn_5">
                                            <label for="color_btn_5" class="color_btn grey">Grey</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" name="" id="color_btn_6">
                                            <label for="color_btn_6" class="color_btn orange">Orange</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>-->

                <!--<footer class="bottom_box">
                    <div class="buttons_row">
                        <button type="submit" class="button_grey button_submit">Search</button>
                        <button type="reset" class="button_grey filter_reset">Reset</button>
                    </div>
                </footer>-->
            </div>



        </form>
    </div>

</div>


</aside>
<!--Right Part End -->