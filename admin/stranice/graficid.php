<body>
<div id="container" style="min-width: 210px; height: 300px; margin: 0 auto"></div>

<script>
    var chart; // global

    function requestData() {
        $.getJSON({
            //url: '/admin/stranice/live.php', //dubesova verzija u realtime, koja iscrtava podatke
            url: '/akcija.php?action=liveg&id=2?',
            //url: 'http://www.kamatica.com/scripts/kurs-jsondata.php?id=2&period=max', //pokusali sa kamatice da povucemo data podatke
            success: function(point) {
                var series = chart.series[0],
                    shift = series.data.length > 20; // pomera graph ako je ima vise od 20 tacaka

                // dodavanje tacke
                chart.series[0].addPoint(eval(point), true, shift);

                // pozivanje sa 1sec timeout
                setTimeout(requestData, 1000);
            },
            cache: false
        });
    }

    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container',
                defaultSeriesType: 'spline',
                events: {
                    load: requestData
                }
            },
            title: {
                text: 'Temperatura vazduha'
            },
            xAxis: {
                type: 'datetime',
                tickPixelInterval: 150,
                maxZoom: 20 * 1000
            },
            yAxis: {
                minPadding: 0.2,
                maxPadding: 0.2,
                title: {
                    text: 'Vrednosti',
                    margin: 20
                },
                plotBands: [{
                    from: 18,
                    to: 24.1,
                    color: 'green'
                },{
                    from: 24.1,
                    to: 24.3,
                    color: 'yellow'
                },{
                    from: 24.3,
                    to: 26.5,
                    color: 'red'
                }]
            },
            series: [{
                name: 'Temperatura',
                data: []
            }]
        });
    });
</script>

</body>