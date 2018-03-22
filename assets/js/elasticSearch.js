(function ($) {
    "use strict";

    $(document).ready(function () {

        function loaduj($this){
            $this.html('<span style="color: red">Loading...</span>');
        }

        function refresuj(){
            //window.location.reload(true);
            //location.assign(window.location.href);
            location.reload();
        }

        $(".ubaciKategEs").click(function(e){

            var cekirano;
            var $this = $(this);
            var vrednostKlase = this.attributes.kojajekateg.value;
            //var vrednostKlaseJquery = $this.attr('kojajekateg');
            if (this.checked) {
                cekirano = 1;
            } else {
                cekirano = 0;
            }
            loaduj($(this));

            if (vrednostKlase) {
                $.ajax({
                    type: "POST",
                    url: "/akcija.php?action=dodajKategSesEs",
                    data: {id: vrednostKlase, br:cekirano},
                    cache: false,
                    success: function (html) {
                        refresuj();
                    }
                });
            } else {
                alert('Nema Vrednost Polje');
            }
        });

        $(".ubaciSpecVrednost").click(function(e){

            var cekirano;
            var $this = $(this);
            var vrednostKlase = this.attributes.kojajekateg.value;
            //var vrednostKlaseJquery = $this.attr('kojajekateg');
            if (this.checked) {
                cekirano = 1;
            } else {
                cekirano = 0;
            }
            loaduj($(this));

            if (vrednostKlase) {
                $.ajax({
                    type: "POST",
                    url: "/akcija.php?action=dodajSpecVrednostEs",
                    data: {id: vrednostKlase, br:cekirano},
                    cache: false,
                    success: function (html) {
                        refresuj();
                    }
                });
            } else {
                alert('Nema Vrednost Polje');
            }
        });

        $(".ubaciBrendEs").click(function(e){

            var cekirano;
            var $this = $(this);
            var vrednostKlase = this.attributes.kojajekateg.value;
            //var vrednostKlaseJquery = $this.attr('kojajekateg');
            if (this.checked) {
                cekirano = 1;
            } else {
                cekirano = 0;
            }
            loaduj($(this));

            if (vrednostKlase) {
                $.ajax({
                    type: "POST",
                    url: "/akcija.php?action=dodajBrendSesEs",
                    data: {id: vrednostKlase, br:cekirano},
                    cache: false,
                    success: function (html) {
                        refresuj();

                    }
                });
            } else {
                alert('Nema Vrednost Polje');
            }
        });

        $('.filter_resetES').on('click', function () {
            var form = $(this).closest('form'),
                range = form.find('.range');

            var fformb = form.find('.checkboxes_list').children();

            var fajl = '/akcija.php?action=obrisiSpecEs';
            var request = $.ajax({
                url: fajl,
                type: "POST"
            });

            request.done(function (msg) {
                // location.assign(window.location.href);
                $(fformb).each(function () {
                    var sta = $(this);
                    var inputVar = sta.children('input');
                    inputVar.removeAttr( 'checked' );
                });

            });
            request.success(function (html) {
                location.reload();

            });

            request.fail(function (jqXHR, textStatus) {
                alert("Request failed: " + textStatus);
            });

        });

        if ($("#slider").length) {

            var iNumMinSes = parseFloat($('#minCenaSes').val());
            var iNumMaxSes = parseFloat($('#maxCenaSes').val());

            var iNumMin = parseFloat($('#minCena').val());
            var iNumMax = parseFloat($('#maxCena').val());

            console.log(iNumMinSes+' '+iNumMaxSes);
            console.log(iNumMin+' '+iNumMax);

            window.startRangeValues = [iNumMinSes, iNumMaxSes];

            $('#slider').slider({

                range: true,
                min: iNumMin,
                max: iNumMax,
                value: window.startRangeValues,
                step: 1, //0.01,
                tooltip: 'always'
                //tooltip_split:true

                /*change: function(event, ui) {
                    console.log(event);
                    if (event.originalEvent) {

                        var iNumMinAjax = parseFloat($('#minCena').val());
                        var iNumMaxAjax = parseFloat($('#maxCena').val());

                        if (iNumMinAjax && iNumMaxAjax) {
                            $.ajax({
                                type: "POST",
                                url: "/akcija.php?action=dodajSpecCenaES",
                                data: {id: iNumMinAjax, br: iNumMaxAjax},
                                cache: false,
                                success: function (html) {
                                    location.assign(window.location.href);
                                }
                            });
                        } else {
                            alert('Nema Vrednost Polje');
                        }


                    }
                },

                slide: function (event, ui) {

                    var min = ui.values[0], //.toFixed(2),
                        max = ui.values[1], //.toFixed(2),
                        range = $(this).siblings('.range');

                    range.children('.min_value').val(min).next().val(max);

                    range.children('.min_val').text('' + min).next().text('' + max);

                },

                create: function (event, ui) {


                    var $this = $(this),
                        min = $this.slider("values", 0), //.toFixed(2),
                        max = $this.slider("values", 1), //.toFixed(2),
                        range = $this.siblings('.range');

                    range.children('.min_value').val(min).next().val(max);

                    range.children('.min_val').text('' + min).next().text('' + max);

                }*/

            });

            $('#slider').on("slideStop", function (slideEvt) {

                var iNumMinAjax = parseFloat(slideEvt.value[0]);
                var iNumMaxAjax = parseFloat(slideEvt.value[1]);

                if (iNumMaxAjax) {
                    $.ajax({
                        type: "POST",
                        url: "/akcija.php?action=dodajSpecCenaES",
                        data: {id: iNumMinAjax, br: iNumMaxAjax},
                        cache: false,
                        success: function (html) {
                            location.reload();

                        }
                    });
                } else {
                    alert('Nema Vrednost Polje');
                }

            });
        }



    });


})(jQuery);

