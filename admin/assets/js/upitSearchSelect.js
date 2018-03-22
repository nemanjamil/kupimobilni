$(document).ready(function(){

    /*
     * Odabir korisnika za zdanja
     * */
    function formatRepo (repo) {
        if (repo.loading) return repo.text;
        var markup = "<div class='select2-result-repository clearfix'>" +
            "<div class='select2-result-repository__meta'>" +
            "<div class='select2-result-repository__title'>" + repo.ModelNaziv + "</div>" +
            "</div>" +
            "</div>";

        return markup;
    }

    function formatRepoSelection (repo) {

        return repo.ModelNaziv || repo.text;
    }

    var $novi3g = $("#input18");
    $novi3g.select2({
        // enable tagging
        tags: true,
        //allowClear: true,
        //cache: true,
        // max tags is 3
        //maximumSelectionLength: 3,


        // loading remote data
        // see https://select2.github.io/options.html#ajax
        ajax: {
            url: "/akcija.php?action=ListaModelaJson", // "https://api.github.com/search/repositories"
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term // search term
                };
            },
            processResults: function (data, page) {
                return {
                    results: data.items
                };
            }
        },
        escapeMarkup: function (markup) { return markup; },
        minimumInputLength: 2,
        templateResult: formatRepo,
        templateSelection: formatRepoSelection
    });

    $novi3g.on('select2:select', function (evt) {


        var idModela = evt.params.data.id;
        var idArtikla = $("#id").val();

        if (!idModela) {
            alert('Nema ID idModela');
            return;
        }

        if (!idArtikla) {
            alert('Nema ID idArtikla');
            return;
        }


        console.log('Podaci : '+idArtikla +' '+idModela);

        var url = "/akcija.php?action=dodajModelNaArt";

        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: {id: idArtikla, br : idModela}, // serializes the form's elements.
            success: function (tekst) {
                if (tekst.success) {
                    //alert(tekst.error_msg);
                    // reload;
                } else {
                    alert(tekst.error_msg);
                }

            },
            error: function (response) {
                var r = jQuery.parseJSON(response.responseText);
                alert("Message: " + r.Message);
                alert("StackTrace: " + r.StackTrace);
                alert("ExceptionType: " + r.ExceptionType);
            }
        });
    });

    $novi3g.on('select2:unselect', function (evt) {


        var idModela = evt.params.data.id;
        var idArtikla = $("#id").val();

        if (!idModela) {
            alert('Nema ID idModela');
            return;
        }

        if (!idArtikla) {
            alert('Nema ID idArtikla');
            return;
        }


        console.log('Podaci : '+idArtikla +' '+idModela);

        var url = "/akcija.php?action=removeModelNaArt";

        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: {id: idArtikla, br : idModela}, // serializes the form's elements.
            success: function (tekst) {
                if (tekst.success) {
                    //alert(tekst.error_msg);
                    // reload;
                } else {
                    alert(tekst.error_msg);
                }

            },
            error: function (response) {
                var r = jQuery.parseJSON(response.responseText);
                alert("Message: " + r.Message);
                alert("StackTrace: " + r.StackTrace);
                alert("ExceptionType: " + r.ExceptionType);
            }
        });
    });


});