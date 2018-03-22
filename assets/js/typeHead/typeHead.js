/**
 * Created by nemanja on 5.2.16..
 */


$(document).ready(function() {

    // prefetch
    // --------

    /*var countries = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('text'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,

        //prefetch: '/assets/js/typeHead/countries.json'
        prefetch: '/cron/crongotovo/artikliNazivXXX.json'
        // kada nema dovoljno podataka u states onda mozemo da korisimo remote
        /!*remote: {
            url: '../data/films/queries/%QUERY.json',
            wildcard: '%QUERY'
        }*!/
    });*/

    // passing in `null` for the `options` arguments will result in the default
    // options being used


    /*$("#prefetch .typeahead").typeahead({
            hint: false, // da ne ispisuje sta preporucuje
            highlight: true,
            minLength: 2
            /!*classNames: {
                input: 'Typeahead-input',
                hint: 'Typeahead-hint',
                selectable: 'Typeahead-selectable'
            }*!/

        },
        {
            name: "countries",
            limit : 10,
            displayKey: "text",
            source: countries.ttAdapter(),
            templates: {
                /!*header: '<h1>Name</h1>',
                empty: [
                    '<div class="empty-message">',
                    'unable to find any Best Picture winners that match the current query',
                    '</div>'
                ].join('\n'),*!/
                //suggestion: Handlebars.compile('<img class="typeahead_photo" src="{{image}}"/> <p><strong>{{name}}</strong></p> <p><em>{{lastname}}</em> </p> <p><em>{{release_year}}</em></p>') // layout of the searchbar results
                suggestion: function(el){return '<div class="col-md-12 col-xs-12"><a href="/'+el.artlink+'/'+el.value+'" class="btn col-md-3 col-xs-3 no-padding"><img class="img-responsive" src="'+el.slika+'" /></a><div class="col-md-9 col-xs-9"><a class="bojacrna small" href="/'+el.artlink+'/'+el.value+'">'+el.text+'</a></div></div>'}
            }/!*,
            templates: {
                empty: 'not found', //optional

            }*!/


        }).bind("typeahead:selected", function(obj, datum, name) {
            $('#hiddenInputElement').val(datum.value);
        });
*/
    /*remote: {
        url: "/api/getartists/%QUERY"
    },*/

    //http://kylefinley.net/twitter-typeahead-using-id-of-selected-item-label





















});

