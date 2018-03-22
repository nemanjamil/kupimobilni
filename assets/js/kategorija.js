(function ($) {
    "use strict";

    $(document).ready(function () {


        $("#targetArtikal").keyup(function (event) {

            var brojChar = $(this).val().length;
            var vrednost = String($(this).val());
            var kategorija = parseInt($(this).attr("kateg"));

            $("#reloadKategSearch").show();


            if (brojChar > 2 && kategorija > 0) {

                $.ajax({
                    url: "/akcija.php?action=traziArtKateg",
                    cache: false,
                    dataType: "json",
                    type: "POST",
                    //contentType: "application/json; charset=utf-8",
                    data: {string: vrednost, id: kategorija},
                    success: function (html) {

                        if ( html.artikli) {


                        var stanje = html.stanje;
                        var message = html.message;
                        var artlink = html.artikli.linkdoslike;
                        var artlinkUrl = html.artikli.link;

                        var  ufulu = '';

                        jQuery.each(html.artikli, function (i, vred) {


                            ufulu += '<div class="col-sm-6 col-md-6 col-xs-12">';
                            ufulu += '<div class="products grid-v1 clearfix">';
                            ufulu += '<div class="product clearfix">';

                                ufulu += '<div class="product-image col-md-5 col-xs-5 visinaSlikeKat paddingdesno5">';
                                    ufulu += '<a href="/'+vred.link+'">';

                                        ufulu += '<div class="image">';
                                            ufulu += '<img src="'+vred.srednja_slika+'" class="img-responsive"  alt="'+vred.ArtikalNaziv+'">';
                                        ufulu += '</div>';

                                        ufulu += '<div class="tag"><div class="tag-text sale">sale</div></div>';
                                        //ufulu += '<div class="tag"><div class="tag-text new">new</div></div>';
                                        //ufulu += '<div class="tag"><div class="tag-text hot">hot</div></div>';

                                        ufulu += '<div class="hover-effect"><i class="fa fa-search"></i></div>';

                                    ufulu += '</a>';
                                ufulu += '</div>';

                                ufulu += '<div class="product-info col-md-7 no-padding col-xs-7 visina2uredu">';
                                    ufulu += '<h3 class="name nemaMargineTop"><a href="/'+vred.link+'">'+vred.ArtikalNaziv+'</a></h3>';
                                        ufulu += '<div class="product-price">';
                                            ufulu += '<ins>';
                                                ufulu += '<span class="amount">'+vred.cenaPrikaz+' '+vred.cenaPrikazExt+'</span>';
                                            ufulu += '</ins>';
                                        ufulu += '</div>';
                                ufulu += '</div>';

                            ufulu += '</div>';
                            ufulu += '</div>';
                            ufulu += '</div>';




                        });


                        } else {
                            ufulu = '';
                            ufulu += '<div class="col-sm-6 col-md-6 col-xs-12">';
                            ufulu += '<div class="products grid-v1 clearfix">';
                            ufulu += '<div class="product clearfix">Nema podataka';
                            ufulu += '</div>';
                            ufulu += '</div>';
                            ufulu += '</div>';

                        }
                        $("#ovdeUbaci").html(ufulu);

                    }
                });

            }

        });

    });


})(jQuery);

