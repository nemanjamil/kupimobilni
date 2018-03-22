$(function() {
  /* var availableTags = [
        "ActionScript",
        "AppleScript",
        "Asp",
        "BASIC",
        "C",
        "C++",
        "Clojure",
        "COBOL",
        "ColdFusion",
        "Erlang",
        "Fortran",
        "Groovy",
        "Haskell",
        "Java",
        "JavaScript",
        "Lisp",
        "Perl",
        "PHP",
        "Python",
        "Ruby",
        "Scala",
        "Scheme"
    ];*/
   /* $( "#artNaAkciji" ).autocomplete({
        source: availableTags
    });
*/

    $( "#artNaAkciji" ).autocomplete({
        source: function( request, response ) {
            $.ajax({
                url: "/akcija.php?action=upitartikli",
                dataType: "json",
                data: {
                    //featureClass: "P",
                    miki: "fullLLALAL",
                    //maxRows: 12,
                    term: request.term  // ovo je terin koji saljemo kroz get
                },
                success: function( data ) {
                    response(data);
                }
            });
        },

        minLength: 2,
        messages: {
            noResults: 'Nismo nista nasli',
            results : function(count) {
                //return count + (count > 1 ? ' results' : ' result ') + ' found';
            }
        },
        select: function(event, ui) {
            var ArtikalId = ui.item.ArtikalId;
            var ArtikalLink = ui.item.ArtikalLink;
            var OpisArtikla = ui.item.OpisArtikla;
            $('#artNaAkcijiID').val(ArtikalId);
            $('#artNaAkciji').val(ArtikalLink);
            event.preventDefault();

        },

        html: false, // optional (jquery.ui.autocomplete.html.js required)
        // optional (if other layers overlap autocomplete list)
        // If you want to use html option to highlight results, get jquery.ui.autocomplete.html.js from here.
        open: function(event, ui) {
            $(".ui-autocomplete").css("z-index", 1000);
        }

    }).each(function() {
        $(this).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
            return $( "<li class='searchslika clearfix'>" )
                .append( " <a href='#' class='opis'>"+item.OpisArtikla+"</a>")
                .appendTo( ul );
        };
    });

});