/*
 * custom.js
 *
 * Place your code here that you need on all your pages.
 */

"use strict";


$(function () {
    $("#datepicker").datepicker({dateFormat: "yy-mm-dd"});
});


$(document).ready(function () {


    //onclick="return confirmSubmit()" validate click obrisi
    function confirmSubmit() {
        var agree = confirm("Are you sure");
        if (agree)
            return true;
        else
            return false;
    }


    //===== Sidebar Search (Demo Only) =====//
    $('.sidebar-search').submit(function (e) {
        //e.preventDefault(); // Prevent form submitting (browser redirect)

        $('.sidebar-search-results').slideDown(200);
        return false;
    });

    $('.sidebar-search-results .close').click(function () {
        $('.sidebar-search-results').slideUp(200);
    });


    $('.MainArtSlikeEdit').click(function () {

        var ceki, kojiIdSlike, sta;

        kojiIdSlike = $(this).data('name');

        sta = $(this).is(':checked');
        if (sta) {
            ceki = 1;
        } else {
            ceki = 0;
        }

        if (kojiIdSlike) {

            var url = "/akcija.php?action=postaviMainSliku";
            $.ajax({
                type: "POST",
                url: url,
                //dataType: "json",  // kada stavimo ovo onda nam ne radi jer dobijamo { ok:"Dodata kategorija"}  a bez toga dobijamo { "ok":"Dodata kategorija" }
                data: {id: kojiIdSlike, cekiran: ceki},
                success: function (response) {

                    var obj = jQuery.parseJSON(response);
                    if (obj.ok) {
                       // alert(obj.ok);
                    } else {
                       // alert(obj.error);
                    }

                }
            });

        } else {
            alert('Nema ' + kojiIdSlike);
        }

    });


    $('.MainKategSlikeEdit').click(function () {

        var ceki, kojiIdSlike, sta;

        kojiIdSlike = $(this).data('name');

        sta = $(this).is(':checked');
        if (sta) {
            ceki = 1;
        } else {
            ceki = 0;
        }

        if (kojiIdSlike) {

            var url = "/akcija.php?action=postaviMainSlikuKateg";
            $.ajax({
                type: "POST",
                url: url,
                //dataType: "json",  // kada stavimo ovo onda nam ne radi jer dobijamo { ok:"Dodata kategorija"}  a bez toga dobijamo { "ok":"Dodata kategorija" }
                data: {id: kojiIdSlike, cekiran: ceki},
                success: function (response) {

                    var obj = jQuery.parseJSON(response);
                    if (obj.ok) {
                        alert(obj.ok);
                    } else {
                        alert(obj.error);
                    }

                }
            });

        } else {
            alert('Nema ' + kojiIdSlike);
        }

    });


    $('.kategDodaj').click(function () {

        var ceki, kojaGrupa, sta;

        kojaGrupa = $(this).attr('kojaGrupa');
        sta = $(this).is(':checked');
        if (sta) {
            ceki = 1;
        } else {
            ceki = 0;
        }
        var idodKateg = $('#idodKateg').val();
        if (kojaGrupa && idodKateg) {

            var url = "/akcija.php?action=dodajSpecGrupe";
            $.ajax({
                type: "POST",
                url: url,
                //dataType: "json",  // kada stavimo ovo onda nam ne radi jer dobijamo { ok:"Dodata kategorija"}  a bez toga dobijamo { "ok":"Dodata kategorija" }
                data: {id: idodKateg, br: kojaGrupa, cekiran: ceki},
                success: function (response) {

                    var obj = jQuery.parseJSON(response);
                    if (obj.ok) {
                        alert(obj.ok);
                    } else {
                        alert(obj.error);
                    }

                }
            });

        }

    });


    //===== .row .row-bg Toggler =====//
    $('.row-bg-toggle').click(function (e) {
        e.preventDefault(); // prevent redirect to #

        $('.row.row-bg').each(function () {
            $(this).slideToggle(200);
        });
    });

    //===== Sparklines =====//

    $("#sparkline-bar").sparkline('html', {
        type: 'bar',
        height: '35px',
        zeroAxis: false,
        barColor: App.getLayoutColorCode('red')
    });

    $("#sparkline-bar2").sparkline('html', {
        type: 'bar',
        height: '35px',
        zeroAxis: false,
        barColor: App.getLayoutColorCode('green')
    });

    //===== Refresh-Button on Widgets =====//

    $('.widget .toolbar .widget-refresh').click(function () {
        var el = $(this).parents('.widget');

        App.blockUI(el);
        window.setTimeout(function () {
            App.unblockUI(el);
            noty({
                text: '<strong>Widget updated.</strong>',
                type: 'success',
                timeout: 1000
            });
        }, 1000);
    });

    //===== Fade In Notification (Demo Only) =====//
    setTimeout(function () {
        $('#sidebar .notifications.demo-slide-in > li:eq(1)').slideDown(500);
    }, 3500);

    setTimeout(function () {
        $('#sidebar .notifications.demo-slide-in > li:eq(0)').slideDown(500);
    }, 7000);









    /* =========  POCETAK ZTREE DODAJ ARTIKAL ================ */

    var settingDodajArtikal = {

        check: {
            enable: true,
            chkStyle: "radio", // radio
            chkboxType: {"Y": "", "N": ""},
            radioType: "all"
        },
        async: {
            enable: true,
            url: "/akcija.php?action=getNodesDodajArt",
            autoParam: ["id", "name", "level=lv", "parentId"],
            otherParam: {"otherParam": "zTreeDodajArtikal"}
            //dataFilter: filter
        },
        callback: {
            onCheck: myOnCheckDodajArtikal,
            onClick: myOnClickDodajArtikal
        }

    };

    function myOnCheckEditArtikal(event, treeId, treeNode) {

        var treeObjdodaj = $.fn.zTree.getZTreeObj("treeDemoEditArtikal");
        var nodes = treeObjdodaj.getCheckedNodes(true);
        var idKategorijeDodajArtikal = nodes[0].id;
        $('#idkategorijeDodajArtikal').val(idKategorijeDodajArtikal);

        // Specfikacije artikala
        var sa = $('#spefikacijeArtikala');
        var url = "/akcija.php?action=dodajspecartikala"; // the script where you handle the form input.
        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: {id: idKategorijeDodajArtikal},
            success: function (response) {

                // http://stackoverflow.com/questions/1208467/how-to-add-items-to-a-unordered-list-ul-using-jquery
                // $('#my_list').append.apply($('#my_list'), items);
                //var json = JSON.parse(jsonOsnovni);
                //var obj = jQuery.parseJSON(response);

                if (response.ok) {

                    var items = [];

                    $.each(response.ok, function (key, val) {

                        var sel = [];

                        $.each(val, function (kljuc, vrednost) {

                            var ime = vrednost.IdSpecVrednostiIme;
                            var id = vrednost.IdSpecVrednosti;

                            sel.push('<option value="' + id + '">' + ime + '</option>');
                            /* var obj = {};
                             obj[kljuc] = ime;
                             cities.push(obj);*/

                        });


                        items.push("<li><div><strong>" + key + "</strong></div><div class='specOdvoj'><select class=\"form-control\" id='" + key + "' name='spec[]'>" + sel.join('') + "</select></div></li>");

                        // items.push.apply(items, sds);

                    });


                    var ij = items.join("");

                    var selectUl = $("<ul/>", {
                        "class": "my-new-list",
                        "name": "moja Moda",
                        "style": ("list-style-type: none;"),
                        html: ij
                    });


                    sa.html(selectUl);

                } else {
                    sa.html('');
                    //alert(response.error);
                }


            },
            error: function (xhr, status, thrown) {

                alert(error);

            }
        });

    };
    function myOnClickEditArtikal(event, treeId, treeNode) {
        event.preventDefault();
        // alert(treeNode.tId + ", " + treeNode.name);
    };


    var curStatus = "init", curAsyncCount = 0, asyncForAll = false,
        goAsync = false;

    function expandAlldodaj() {

        if (!check()) {
            return;
        }
        var zTree = $.fn.zTree.getZTreeObj("treeDemoDodajArtikal");
        if (asyncForAll) {
            // $("#demoMsg").text(demoMsg.expandAll);
            zTree.expandAll(true);
        } else {
            expandNodesDodaj(zTree.getNodes());
            if (!goAsync) {
                // $("#demoMsg").text(demoMsg.expandAll);
                curStatus = "";
            }
        }
    }

    function check() {
        if (curAsyncCount > 0) {
            return false;
        }
        return true;
    }

    function expandNodesDodaj(nodes) {
        if (!nodes) return;
        curStatus = "expand";
        var zTree = $.fn.zTree.getZTreeObj("treeDemoDodajArtikal");
        for (var i = 0, l = nodes.length; i < l; i++) {
            zTree.expandNode(nodes[i], true, false, false);
            if (nodes[i].isParent && nodes[i].zAsync) {
                expandNodesDodaj(nodes[i].children);
            } else {
                goAsync = true;
            }
        }
    }

    $("#expandAllBtnDodaj").bind("click", expandAlldodaj);

   $.fn.zTree.init($("#treeDemoDodajArtikal"), settingDodajArtikal); // , zNodes

    /* =========  POCETAK ZTREE KRAJ  ARTIKAL ================ */




    /* =========  POCETAK ZTREE EDIT ARTIKAL ================ */

    var settingEditArtikal = {

        check: {
            enable: true,
            chkStyle: "radio", // radio
            chkboxType: {"Y": "", "N": ""},
            radioType: "all"
        },
        async: {
            enable: true,
            url: "/akcija.php?action=getNodesDodajArt",
            autoParam: ["id", "name", "level=lv", "parentId"],
            otherParam: {"otherParam": "zTreeDodajArtikal"}

        },
        callback: {
            onCheck: myOnCheckEditArtikal,
            onClick: myOnClickEditArtikal
        }

    };

    function myOnCheckDodajArtikal(event, treeId, treeNode) {

        var treeObjdodaj = $.fn.zTree.getZTreeObj("treeDemoDodajArtikal");
        var nodes = treeObjdodaj.getCheckedNodes(true);
        var idKategorijeDodajArtikal = nodes[0].id;
        $('#idkategorijeDodajArtikal').val(idKategorijeDodajArtikal);

        // Specfikacije artikala
        var sa = $('#spefikacijeArtikala');
        var url = "/akcija.php?action=dodajspecartikala"; // the script where you handle the form input.
        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: {id: idKategorijeDodajArtikal},
            success: function (response) {

                // http://stackoverflow.com/questions/1208467/how-to-add-items-to-a-unordered-list-ul-using-jquery
                // $('#my_list').append.apply($('#my_list'), items);
                //var json = JSON.parse(jsonOsnovni);
                //var obj = jQuery.parseJSON(response);

                if (response.ok) {

                    var items = [];

                    $.each(response.ok, function (key, val) {

                        var sel = [];

                        $.each(val, function (kljuc, vrednost) {

                            var ime = vrednost.IdSpecVrednostiIme;
                            var id = vrednost.IdSpecVrednosti;

                            sel.push('<option value="' + id + '">' + ime + '</option>');
                            /* var obj = {};
                             obj[kljuc] = ime;
                             cities.push(obj);*/

                        });


                        items.push("<li><div>" + key + "</div><div class='specOdvoj'><select id='" + key + "' name='spec[]'>" + sel.join('') + "</select></div></li>");

                        // items.push.apply(items, sds);

                    });


                    var ij = items.join("");

                    var selectUl = $("<ul/>", {
                        "class": "my-new-list",
                        "name": "moja Moda",
                        html: ij
                    });


                    sa.html(selectUl);

                } else {
                    sa.html('');
                    //alert(response.error);
                }


            },
            error: function (xhr, status, thrown) {

                alert(error);

            }
        });

    };
    function myOnClickDodajArtikal(event, treeId, treeNode) {
        event.preventDefault();
        // alert(treeNode.tId + ", " + treeNode.name);
    };

    var curStatus = "init", curAsyncCount = 0, asyncForAll = false,
        goAsync = false;

    function expandAll() {

        if (!check()) {
            return;
        }
        var zTree = $.fn.zTree.getZTreeObj("treeDemoEditArtikal");
        if (asyncForAll) {
            // $("#demoMsg").text(demoMsg.expandAll);
            zTree.expandAll(true);
        } else {
            expandNodes(zTree.getNodes());
            if (!goAsync) {
                // $("#demoMsg").text(demoMsg.expandAll);
                curStatus = "";
            }
        }
    }

    function check() {
        if (curAsyncCount > 0) {
            return false;
        }
        return true;
    }

    function expandNodes(nodes) {
        if (!nodes) return;
        curStatus = "expand";
        var zTree = $.fn.zTree.getZTreeObj("treeDemoEditArtikal");
        for (var i = 0, l = nodes.length; i < l; i++) {
            zTree.expandNode(nodes[i], true, false, false);
            if (nodes[i].isParent && nodes[i].zAsync) {
                expandNodes(nodes[i].children);
            } else {
                goAsync = true;
            }
        }
    }

    $("#expandAllBtn").bind("click", expandAll);

    $.fn.zTree.init($("#treeDemoEditArtikal"), settingEditArtikal); // , zNodes

    /* =========  POCETAK ZTREE EDIT  ARTIKAL ================ */


    /* =========  TAGOVI  POCETAK ================ */

    $('#tagdodaj').on('change', function (event) {

        var $element = $(event.target);

        if (!$element.data('tagsinput'))
            return;


        var val = $element.val();
        var errtt = $element.tagsinput();
        var ite = $element.tagsinput('items');
        var ed = $element.data('tagsinput');

        /* console.log(+val);
         console.log(errtt);
         console.log(ite);
         console.log(ed);*/

        if (val === null)
            val = "null";

        // put in div tag to see result
        $('#idtagova').val(($.isArray(val) ? JSON.stringify(val) : "\"" + val.replace('"', '\\"') + "\""));

    }).trigger('change');

    // Examples : http://twitter.github.io/typeahead.js/examples/
    var cities = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('text'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,

        prefetch: {
            // if you want to remove local storage go to console (developer FireFox) and type => localStorage.clear
            url: '/cron/crongotovo/cities.json'
            // cache : false // default is true
            /*
             [ { "value": 221 , "text": "Amsterdam"   , "continent": "Europe"    },
             { "value": 2215, "text": "Kinshasa"    , "continent": "Africa"    }
             ]
             */
        },
        remote: {
            /*
             url: 'http://api.themoviedb.org/3/search/movie?query=%QUERY&api_key=f22e6ce68f5e5002e71c20bcba477e7d',
             we can use this link but we neet to set  return => $.map(cities, $.map(cities.results, function (movie) because of JSON
             */
            url: '/akcija.php?action=listaTagova&string=%QUERY',
            filter: function (cities) {
                return $.map(cities, function (movie) {
                    return {
                        text: movie.text,
                        value: movie.value,
                        continent: movie.continent
                    };
                });
            }
        }
    });
    cities.initialize();

    var elt = $('#tagdodaj');
    elt.tagsinput({
        tagClass: function (item) {

            // console.log(item.continent);

            switch (item.continent) {
                case 'osnovni' :
                    return 'label label-primary'; // blue
                case "bazacron":
                    return 'label label-success label-important'; // green
                case 'baza' :
                    return 'label label-danger';  // red
                case 'Asia' :
                    return 'label label-warning';
                /*    default:
                 return 'label label-default';*/
            }
        },
        itemValue: 'value',
        itemText: 'text',
        typeaheadjs: {
            name: 'cities',
            displayKey: 'text',
            source: cities.ttAdapter()

        }
    });

    // get json strin from id that php is genarated
    // <input id="jsonTag" value="[{&quot;TagoviId&quot;:3,&quot;TagoviIme&quot;:&quot;Kola s\u0027tockovima&quot;,&quot;osnovni&quot;:&quot;osnovni&quot;}]" type="hidden">
    var jsonOsnovni = $('#jsonTag').val();

    if (jsonOsnovni) {
        // convert string to JSON
        var json = JSON.parse(jsonOsnovni);
        // EACH put default
        $.each(json, function (i, item) {
            elt.tagsinput('add', {"value": item.TagoviId, "text": item.TagoviIme, "continent": item.osnovni});
        });
    }


    /* =========  TAGOVI  END ================ */

    /* ============ TAGOVI ARTIKAL =============*/


    var citynames = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,

        prefetch: {
            url: '/cron/crongotovo/citynames.json'

        },
        remote: {
            url: '/akcija.php?action=listaTagovaSamoIme&string=%QUERY'
        }
    });
    citynames.initialize();

    var elt = $('#tagime');
    elt.tagsinput({
        typeaheadjs: {
            name: 'citynames',
            displayKey: 'name',
            valueKey: 'name',
            source: citynames.ttAdapter()
        }
    });

    /* ============ TAGOVI ARTIKAL  END =============*/


    /* ============ KREIRANJE URL-a kod Dodavanja Artikla  =============*/

    $("#urlartikla").focus(function () {

        /* var ime = $("#kategorija_id option:selected").text();
         ime = $.trim(ime);
         var brand = $("#brand option:selected").text();*/
        var varijabla = $("#ArtNazsrblat").val();

        /* if(ime && prezime && !this.value) {
         var varijabla = prezime + "-" + ime + "-" + brand;

         }*/


        varijabla = varijabla.toLowerCase();
        varijabla = varijabla.replace(/[^a-zA-Z0-9]/g, " ");
        varijabla = varijabla.replace(/  +/g, " "); // izbacimo multiple spaces
        varijabla = varijabla.replace(/\s/g, "-"); // izbacimo multiple spaces g znaci da svaki put ponovimo kada se desi space, i je da je case sensitive
        this.value = varijabla;
    });

    /* ============ KREIRANJE URL-a kod Dodavanja Artikla   END =============*/

    $(".obrisiSlikuArtikal").click(function (e) {
        e.preventDefault();

        var r = confirm("Confirm delete ?");
        if (r == false) {
            return false;
        }

        var vNazivSlikeArt, idArt, idSlike, tr;
        vNazivSlikeArt = $(this).attr('lds');
        idArt = $(this).attr('idArt');
        idSlike = $(this).attr('idSlike');

        // ovo smo stavili pre jer nece da radi ako ga stavimo kod tr.css
        tr = $(this).closest('tr');


        if (vNazivSlikeArt && idArt && idSlike) {
            var url = "/akcija.php?action=obrisiSlikuArtikal";
            $.ajax({
                type: "POST",
                url: url,
                dataType: "json",
                data: {string: vNazivSlikeArt, id: idArt, br: idSlike},
                success: function (response) {

                    if (response.ok) {

                        tr.css("background-color", "#FF3700");
                        tr.fadeOut(400, function () {
                            tr.remove();
                        });


                    } else {
                        alert(response.error);
                    }

                }

            });
        } else {
            alert('Nisu prosledjeni parametri naziv slike i Id artikla');
        }

    });


    $(".obrisiSlikuKomitent").click(function (e) {
        e.preventDefault();

        var r = confirm("Confirm delete ?");
        if (r == false) {
            return false;
        }

        var vNazivSlikeArt, idArt, idSlike, tr;
        vNazivSlikeArt = $(this).attr('lds');
        idArt = $(this).attr('idArt');
        idSlike = $(this).attr('idSlike');

        // ovo smo stavili pre jer nece da radi ako ga stavimo kod tr.css
        tr = $(this).closest('tr');


        if (vNazivSlikeArt && idArt && idSlike) {
            var url = "/akcija.php?action=obrisiSlikuKomitent";
            $.ajax({
                type: "POST",
                url: url,
                dataType: "json",
                data: {string: vNazivSlikeArt, id: idArt, br: idSlike},
                success: function (response) {

                    if (response.ok) {

                        tr.css("background-color", "#FF3700");
                        tr.fadeOut(400, function () {
                            tr.remove();
                        });


                    } else {
                        alert(response.error);
                    }

                }

            });
        } else {
            alert('Nisu prosledjeni parametri naziv slike i Id artikla');
        }

    });


    $(".obrisiSpecVrednost").click(function (e) {
        e.preventDefault();

        var r = confirm("Confirm delete ?");
        if (r == false) {
            return false;
        }

        var idArt, tr;

        idArt = $(this).attr('idArt');

        // ovo smo stavili pre jer nece da radi ako ga stavimo kod tr.css
        tr = $(this).closest('tr');

        if (idArt) {
            var url = "/akcija.php?action=obrisiSpecVrednost";
            $.ajax({
                type: "POST",
                url: url,
                dataType: "json",
                data: {id: idArt},
                success: function (response) {

                    if (response.ok) {

                        tr.css("background-color", "#FF3700");
                        tr.fadeOut(400, function () {
                            tr.remove();
                        });


                    } else {
                        alert(response.error);
                    }

                }

            });


        } else {
            alert('Nisu prosledjeni parametri naziv slike i Id artikla');
        }

    });

//ARTIKAL AKTIVAN, CENA ILI DOSTUPNO OD
    $("#uskoro").hide('');

    $("#hide").click(function(){
        $("#uskoro").hide('fast');
        $('#uskoro input').val("");
    });

    $("#hide1").click(function(){
        $("#uskoro").hide('fast');
        $('#uskoro input').val("");
    });

    $("#show").click(function(){
        $("#uskoro").show('fast');

    });



    /*$("#containerchart").bind('mousemove touchmove', function (e) {
        var chart,
            point,
            i;

        for (i = 0; i < Highcharts.charts.length; i = i + 1) {
            chart = Highcharts.charts[i];
            e = chart.pointer.normalize(e); // Find coordinates within the chart
            point = chart.series[0].searchPoint(e, true); // Get the hovered point

            if (point) {
                point.onMouseOver(); // Show the hover marker
                chart.tooltip.refresh(point); // Show the tooltip
                chart.xAxis[0].drawCrosshair(e, point); // Show the crosshair
            }
        }
    });

    Highcharts.Pointer.prototype.reset = function () {
        return undefined;
    };

    function syncExtremes(e) {
        var thisChart = this.chart;

        Highcharts.each(Highcharts.charts, function (chart) {
            if (chart !== thisChart) {
                if (chart.xAxis[0].setExtremes) { // It is null while updating
                    chart.xAxis[0].setExtremes(e.min, e.max);
                }
            }
        });
    }

    $.getJSON("/akcija.php?action=jsonpodaciSenzor&id=2?", function (activity) {
        $.each(activity.datasets, function (i, dataset) {

            // Add X values
            dataset.data = Highcharts.map(dataset.data, function (val, j) {
                return [activity.xData[j], val];
            });

            $('<div class="chartadmin">')
                .appendTo("#containerchart")
                .highcharts({
                    chart: {
                        marginLeft: 40, // Keep all charts left aligned
                        spacingTop: 20,
                        spacingBottom: 20
                        // zoomType: 'x',
                        // pinchType: null // Disable zoom on touch devices
                    },
                    title: {
                        text: dataset.name,
                        align: 'left',
                        margin: 0,
                        x: 30
                    },
                    credits: {
                        enabled: false
                    },
                    legend: {
                        enabled: false
                    },
                    xAxis: {
                        crosshair: true,
                        type: 'datetime',
                        dateTimeLabelFormats: {
                            millisecond: '%H:%M:%S.%L',
                            second: '%H:%M:%S',
                            minute: '%H:%M',
                            hour: '%H:%M',
                            day: '%e. %b',
                            week: '%e. %b',
                            month: '%b \'%y',
                            year: '%Y'
                        },
                        events: {
                         setExtremes: syncExtremes
                         }
                        /!*labels: {
                         format: '{value} h'
                         }*!/
                    },
                    yAxis: {
                        title: {
                            text: null
                        }
                    },
                    tooltip: {
                        positioner: function () {
                            return {
                                x: this.chart.chartWidth - this.label.width, // right aligned
                                y: -1 // align to title
                            };
                        },
                        borderWidth: 0,
                        backgroundColor: 'none',
                        pointFormat: '{point.y}',
                        headerFormat: '',
                        shadow: false,
                        style: {
                            fontSize: '18px'
                        },
                        valueDecimals: dataset.valueDecimals

                    },
                    series: [{
                        data: dataset.data,
                        name: dataset.name,
                        type: dataset.type,
                        color: Highcharts.getOptions().colors[i],
                        fillOpacity: 0.3,
                        tooltip: {
                            valueSuffix: ' ' + dataset.unit
                        }
                    }]
                });
        });
    });*/

    $('.AktivirajKomitenta').click(function () {


        var cekiran, KomitentId, sta, komitenti;

        KomitentId = $(this).data('id');

        sta = $(this).is(':checked');
        if (sta) {
            cekiran = 'aktiviraj';
        } else {
            cekiran = 'deaktiviraj';
        }

        komitenti = 'komitenti';

        if (KomitentId ) {

            var url = "/akcija.php?action=aktivirajdokumenta";
            $.ajax({
                type: "GET",
                url: url,
                data: {naziv: komitenti, string: cekiran, id:KomitentId},
                success: function (response) {
                    var obj = jQuery.parseJSON(response);
                    if (obj.ok) {
                        alert(obj.ok);
                    } else {
                        alert(obj.error);
                    }

                }
            });

        } else {
            alert('Nema ' + kojiIdSlike);
        }

    });



});

function confirmSubmit() {
    var agree = confirm("Da li ste sigurni");
    if (agree)
        return true;
    else
        event.preventDefault();
}

