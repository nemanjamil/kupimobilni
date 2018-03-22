(function ($) {
    "use strict";


    $(document).ready(function () {


        function formatRepo(repo) {
            if (repo.loading) return repo.text;

            console.log(repo);

            var markup = "<div class='select2-result-repository clearfix'>" +
                    // "<div class='select2-result-repository__avatar'><img src='" + repo.items.avatar_url + "' /></div>" +
                            "<div class='select2-result-repository__meta'>" +
                                "<div class='select2-result-repository__title'>" + repo.ArtikalNaziv + "</div>" +
                            "</div>" +
                        "</div>";

            /*if (repo.description) {
             markup += "<div class='select2-result-repository__description'>" + repo.description + "</div>";
             }*/

            /* markup += "<div class='select2-result-repository__statistics'>" +
             "<div class='select2-result-repository__forks'><i class='fa fa-flash'></i> " + repo.forks_count + " Forks</div>" +
             "<div class='select2-result-repository__stargazers'><i class='fa fa-star'></i> " + repo.stargazers_count + " Stars</div>" +
             "<div class='select2-result-repository__watchers'><i class='fa fa-eye'></i> " + repo.watchers_count + " Watchers</div>" +
             "</div>" +
             "</div></div>";*/

            return markup;
        }

        function formatRepoSelection(repo) {
            return repo.full_name || repo.text;
        }

        var $ajaxSearch = $(".js-data-example-ajax");

        var odabir = $ajaxSearch.select2({
            ajax: {
                //url: "https://api.github.com/search/repositories",
                url: "/akcija.php?action=traziArtikle",
                dataType: 'json',
                delay: 250,
                //type: "POST",
                data: function (params) {
                    var searchTerm = params.term.toLowerCase();
                    return {
                        q: searchTerm, //params.term, // search term
                        page: params.page
                    };
                },
                processResults: function (data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;

                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 10) < data.total_count
                        }
                    };
                },
                cache: true
            },
           /* tags: true,
            createTag: function (tag) {
                console.log(tag);
                return {
                    id: tag.term,
                    text: tag.term,
                    isNew : true
                };
            },*/

            placeholder: 'Pretraga',
            "language": {
                "noResults": function () {
                    var inp = $('input.select2-search__field').val();
                    return "Nema rezultata <a href='/search?q="+inp+"' class='btn btn-danger'>Ipak pretraži</a>";

                },
                inputTooShort: function(args) {
                    // args.minimum is the minimum required length
                    // args.input is the user-typed text
                    return "";
                },
                searching: function() {
                    return "Tražim...";
                }
            },
            escapeMarkup: function (markup) {
                return markup;
            }, // let our custom formatter work
            minimumInputLength: 1,
            templateResult: formatRepo, // omitted for brevity, see the source of this page
            templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
        });

        $ajaxSearch.on('select2:select', function (evt) {
            //alert('select');
            /*var evt = $(this);
            console.log(evt);*/


            var idArtikla = evt.params.data.id;
            var ArtikalLink = evt.params.data.ArtikalLink;

            if (idArtikla) {
                window.location.href = "/"+ArtikalLink+"/"+idArtikla;
            }


        });
        $ajaxSearch.on('select2:close', function (evt) {
            //alert('close');
            var evt = $(this);
            // var sve = $ajaxSearch.select2('data');

            console.log(evt);
            //console.log(sve);
            //$ajaxSearch.html('<option>siki</option>');

        });

    });


})(jQuery);

