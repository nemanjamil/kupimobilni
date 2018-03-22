<div class="container">






        <div class="example example_tagclass">
            <h3>Categorizing tags</h3>

            <p>
                You can set a fixed css class for your tags, or determine dynamically by providing a custom function.
            </p>

            <div class="bs-example">
                <input type="text"/>
            </div>
            <div class="accordion">
                <div class="accordion-group">
                    <div class="accordion-heading">
                        <a class="accordion-toggle" data-toggle="collapse" href="#accordion_example_tagclass">
                            Show code
                        </a>
                    </div>
                    <div id="accordion_example_tagclass" class="accordion-body collapse">
                        <div class="accordion-inner">
                  <pre><code data-language="html">&lt;input type=&quot;text&quot; /&gt;
                          &lt;script&gt;
                          var cities = new Bloodhound({
                          datumTokenizer: Bloodhound.tokenizers.obj.whitespace('text'),
                          queryTokenizer: Bloodhound.tokenizers.whitespace,
                          prefetch: 'assets/cities.json'
                          });
                          cities.initialize();

                          var elt = $('input');
                          elt.tagsinput({
                          tagClass: function(item) {
                          switch (item.continent) {
                          case 'Europe' : return 'label label-primary';
                          case 'America' : return 'label label-danger label-important';
                          case 'Australia': return 'label label-success';
                          case 'Africa' : return 'label label-default';
                          case 'Asia' : return 'label label-warning';
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
                          elt.tagsinput('add', { "value": 1 , "text": "Amsterdam" , "continent": "Europe" });
                          elt.tagsinput('add', { "value": 4 , "text": "Washington" , "continent": "America" });
                          elt.tagsinput('add', { "value": 7 , "text": "Sydney" , "continent": "Australia" });
                          elt.tagsinput('add', { "value": 10, "text": "Beijing" , "continent": "Asia" });
                          elt.tagsinput('add', { "value": 13, "text": "Cairo" , "continent": "Africa" });
                          &lt;/script&gt;</code></pre>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-condensed">
                <thead>
                <tr>
                    <th>statement</th>
                    <th>returns</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><code>$("input").val()</code></td>
                    <td>
                        <pre class="val"><code data-language="javascript"></code></pre>
                    </td>
                </tr>
                <tr>
                    <td><code>$("input").tagsinput('items')</code></td>
                    <td>
                        <pre class="items"><code data-language="javascript"></code></pre>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>




</div>




<script>
    $(document).ready(function () {


        $(function () {
            $('input, select').on('change', function (event) {
                var $element = $(event.target),
                    $container = $element.closest('.example');

                if (!$element.data('tagsinput'))
                    return;

                var val = $element.val();
                if (val === null)
                    val = "null";
                $('code', $('pre.val', $container)).html(($.isArray(val) ? JSON.stringify(val) : "\"" + val.replace('"', '\\"') + "\""));
                $('code', $('pre.items', $container)).html(JSON.stringify($element.tagsinput('items')));
            }).trigger('change');
        });


        var cities = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('text'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            prefetch: '/admin/plugins/tagmoderni/cities.json'
        });
        cities.initialize();

        var elt = $('input');
        elt.tagsinput({
            tagClass: function(item) {
                switch (item.continent) {
                    case 'Europe' : return 'label label-primary';
                    case 'America' : return 'label label-danger label-important';
                    case 'Australia': return 'label label-success';
                    case 'Africa' : return 'label label-default';
                    case 'Asia' : return 'label label-warning';
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
        elt.tagsinput('add', { "value": 1 , "text": "Amsterdam" , "continent": "Europe" });
        elt.tagsinput('add', { "value": 4 , "text": "Washington" , "continent": "America" });
        elt.tagsinput('add', { "value": 7 , "text": "Sydney" , "continent": "Australia" });
        elt.tagsinput('add', { "value": 10, "text": "Beijing" , "continent": "Asia" });
        elt.tagsinput('add', { "value": 13, "text": "Cairo" , "continent": "Africa" });



    });
</script>
<!--<script src="/admin/plugins/tagmoderni/app_bs3.js"></script>-->