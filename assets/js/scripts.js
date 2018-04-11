(function ($) {
    "use strict";

    /*===================================================================================*/
    /*  owl carousel
     /*===================================================================================*/
    $(document).ready(function () {
        var dragging = true;
        var owlElementID = "#owl-main";

        function fadeInReset() {
            if (!dragging) {
                $(owlElementID + " .caption .fadeIn-1, " + owlElementID + " .caption .fadeIn-2, " + owlElementID + " .caption .fadeIn-3," + owlElementID + " .caption .fadeIn-4").stop().delay(800).animate({opacity: 0}, {
                    duration: 400,
                    easing: "easeInCubic"
                });
            }
            else {
                $(owlElementID + " .caption .fadeIn-1, " + owlElementID + " .caption .fadeIn-2, " + owlElementID + " .caption .fadeIn-3," + owlElementID + " .caption .fadeIn-4").css({opacity: 0});
            }
        }

        function fadeInDownReset() {
            if (!dragging) {
                $(owlElementID + " .caption .fadeInDown-1, " + owlElementID + " .caption .fadeInDown-2, " + owlElementID + " .caption .fadeInDown-3," + owlElementID + " .caption .fadeInDown-4").stop().delay(800).animate({
                    opacity: 0,
                    top: "-15px"
                }, {duration: 400, easing: "easeInCubic"});
            }
            else {
                $(owlElementID + " .caption .fadeInDown-1, " + owlElementID + " .caption .fadeInDown-2, " + owlElementID + " .caption .fadeInDown-3," + owlElementID + " .caption .fadeInDown-4").css({
                    opacity: 0,
                    top: "-15px"
                });
            }
        }

        function fadeInUpReset() {
            if (!dragging) {
                $(owlElementID + " .caption .fadeInUp-1, " + owlElementID + " .caption .fadeInUp-2, " + owlElementID + " .caption .fadeInUp-3," + owlElementID + " .caption .fadeInUp-4").stop().delay(800).animate({
                    opacity: 0,
                    top: "15px"
                }, {duration: 400, easing: "easeInCubic"});
            }
            else {
                $(owlElementID + " .caption .fadeInUp-1, " + owlElementID + " .caption .fadeInUp-2, " + owlElementID + " .caption .fadeInUp-3," + owlElementID + " .caption .fadeInUp-4").css({
                    opacity: 0,
                    top: "15px"
                });
            }
        }

        function fadeInLeftReset() {
            if (!dragging) {
                $(owlElementID + " .caption .fadeInLeft-1, " + owlElementID + " .caption .fadeInLeft-2, " + owlElementID + " .caption .fadeInLeft-3, " + owlElementID + " .caption .fadeInLeft-4").stop().delay(800).animate({
                    opacity: 0,
                    left: "15px"
                }, {duration: 400, easing: "easeInCubic"});
            }
            else {
                $(owlElementID + " .caption .fadeInLeft-1, " + owlElementID + " .caption .fadeInLeft-2, " + owlElementID + " .caption .fadeInLeft-3," + owlElementID + " .caption .fadeInLeft-4").css({
                    opacity: 0,
                    left: "15px"
                });
            }
        }

        function fadeInRightReset() {
            if (!dragging) {
                $(owlElementID + " .caption .fadeInRight-1, " + owlElementID + " .caption .fadeInRight-2, " + owlElementID + " .caption .fadeInRight-3," + owlElementID + " .caption .fadeInRight-4").stop().delay(800).animate({
                    opacity: 0,
                    left: "-15px"
                }, {duration: 400, easing: "easeInCubic"});
            }
            else {
                $(owlElementID + " .caption .fadeInRight-1, " + owlElementID + " .caption .fadeInRight-2, " + owlElementID + " .caption .fadeInRight-3," + owlElementID + " .caption .fadeInRight-4").css({
                    opacity: 0,
                    left: "-15px"
                });
            }
        }

        function fadeIn() {
            $(owlElementID + " .active .caption .fadeIn-1").stop().delay(500).animate({opacity: 1}, {
                duration: 800,
                easing: "easeOutCubic"
            });
            $(owlElementID + " .active .caption .fadeIn-2").stop().delay(700).animate({opacity: 1}, {
                duration: 800,
                easing: "easeOutCubic"
            });
            $(owlElementID + " .active .caption .fadeIn-3").stop().delay(1000).animate({opacity: 1}, {
                duration: 800,
                easing: "easeOutCubic"
            });
            $(owlElementID + " .active .caption .fadeIn-4").stop().delay(1000).animate({opacity: 1}, {
                duration: 800,
                easing: "easeOutCubic"
            });
        }

        function fadeInDown() {
            $(owlElementID + " .active .caption .fadeInDown-1").stop().delay(500).animate({
                opacity: 1,
                top: "0"
            }, {duration: 800, easing: "easeOutCubic"});
            $(owlElementID + " .active .caption .fadeInDown-2").stop().delay(700).animate({
                opacity: 1,
                top: "0"
            }, {duration: 800, easing: "easeOutCubic"});
            $(owlElementID + " .active .caption .fadeInDown-3").stop().delay(1000).animate({
                opacity: 1,
                top: "0"
            }, {duration: 800, easing: "easeOutCubic"});
            $(owlElementID + " .active .caption .fadeInDown-4").stop().delay(1000).animate({
                opacity: 1,
                top: "0"
            }, {duration: 800, easing: "easeOutCubic"});
        }

        function fadeInUp() {
            $(owlElementID + " .active .caption .fadeInUp-1").stop().delay(500).animate({
                opacity: 1,
                top: "0"
            }, {duration: 800, easing: "easeOutCubic"});
            $(owlElementID + " .active .caption .fadeInUp-2").stop().delay(700).animate({
                opacity: 1,
                top: "0"
            }, {duration: 800, easing: "easeOutCubic"});
            $(owlElementID + " .active .caption .fadeInUp-3").stop().delay(1000).animate({
                opacity: 1,
                top: "0"
            }, {duration: 800, easing: "easeOutCubic"});
            $(owlElementID + " .active .caption .fadeInUp-4").stop().delay(1000).animate({
                opacity: 1,
                top: "0"
            }, {duration: 800, easing: "easeOutCubic"});
        }

        function fadeInLeft() {
            $(owlElementID + " .active .caption .fadeInLeft-1").stop().delay(500).animate({
                opacity: 1,
                left: "0"
            }, {duration: 800, easing: "easeOutCubic"});
            $(owlElementID + " .active .caption .fadeInLeft-2").stop().delay(700).animate({
                opacity: 1,
                left: "0"
            }, {duration: 800, easing: "easeOutCubic"});
            $(owlElementID + " .active .caption .fadeInLeft-3").stop().delay(1000).animate({
                opacity: 1,
                left: "0"
            }, {duration: 800, easing: "easeOutCubic"});
            $(owlElementID + " .active .caption .fadeInLeft-4").stop().delay(1000).animate({
                opacity: 1,
                left: "0"
            }, {duration: 800, easing: "easeOutCubic"});
        }

        function fadeInRight() {
            $(owlElementID + " .active .caption .fadeInRight-1").stop().delay(500).animate({
                opacity: 1,
                left: "0"
            }, {duration: 800, easing: "easeOutCubic"});
            $(owlElementID + " .active .caption .fadeInRight-2").stop().delay(700).animate({
                opacity: 1,
                left: "0"
            }, {duration: 800, easing: "easeOutCubic"});
            $(owlElementID + " .active .caption .fadeInRight-3").stop().delay(1000).animate({
                opacity: 1,
                left: "0"
            }, {duration: 800, easing: "easeOutCubic"});
            $(owlElementID + " .active .caption .fadeInRight-4").stop().delay(1000).animate({
                opacity: 1,
                left: "0"
            }, {duration: 800, easing: "easeOutCubic"});
        }

        $(owlElementID).owlCarousel({
            animateOut: 'fadeOut',
            autoplay: false,
            autoplayTimeout: 2000,
            autoplayHoverPause: true,
            stopOnHover: true,
            loop: true,
            navRewind: true,
            items: 1,
            dots: true,
            nav: false,
            //navText: ["<i class='icon fa fa-angle-left'></i>", "<i class='icon fa fa-angle-right'></i>"],
            lazyLoad: true,
            stagePadding: 0,
            responsive: {
                0: {
                    items: 1,
                },
                480: {
                    items: 1,
                },
                768: {
                    items: 1,
                },
                992: {
                    items: 1,
                },
                1199: {
                    items: 1,
                },
                onTranslate: function () {
                    echo.render();
                }
            },


            onInitialize: function () {
                fadeIn();
                fadeInDown();
                fadeInUp();
                fadeInLeft();
                fadeInRight();
            },

            onInitialized: function () {
                fadeIn();
                fadeInDown();
                fadeInUp();
                fadeInLeft();
                fadeInRight();
            },

            onResize: function () {
                fadeIn();
                fadeInDown();
                fadeInUp();
                fadeInLeft();
                fadeInRight();
            },

            onResized: function () {
                fadeIn();
                fadeInDown();
                fadeInUp();
                fadeInLeft();
                fadeInRight();
            },

            onRefresh: function () {
                fadeIn();
                fadeInDown();
                fadeInUp();
                fadeInLeft();
                fadeInRight();
            },

            onRefreshed: function () {
                fadeIn();
                fadeInDown();
                fadeInUp();
                fadeInLeft();
                fadeInRight();
            },

            onUpdate: function () {
                fadeIn();
                fadeInDown();
                fadeInUp();
                fadeInLeft();
                fadeInRight();
            },

            onUpdated: function () {
                fadeIn();
                fadeInDown();
                fadeInUp();
                fadeInLeft();
                fadeInRight();
            },

            onDrag: function () {
                dragging = true;
            },

            onTranslate: function () {
                fadeIn();
                fadeInDown();
                fadeInUp();
                fadeInLeft();
                fadeInRight();
            },
            onTranslated: function () {
                fadeIn();
                fadeInDown();
                fadeInUp();
                fadeInLeft();
                fadeInRight();
            },

            onTo: function () {
                fadeIn();
                fadeInDown();
                fadeInUp();
                fadeInLeft();
                fadeInRight();
            },

            onChange: function () {
                fadeIn();
                fadeInDown();
                fadeInUp();
                fadeInLeft();
                fadeInRight();
            },

            onChanged: function () {
                fadeInReset();
                fadeInDownReset();
                fadeInUpReset();
                fadeInLeftReset();
                fadeInRightReset();
                dragging = false;
            }
        });


        $('.starri').rating({
            callback: function (value, link) {

                var miki, url, vrednost;

                //ArtikalId = $('#ArtikalId').val();
                miki = value;
                url = "/akcija.php?action=oceniZvezda";

                vrednost = $(this).closest('div.kojijeId').data("ime");

                if (vrednost && miki) {

                    $.ajax({
                        cache: false,
                        type: "POST",
                        data: {id: vrednost, br: miki}, // serializes the form's elements.
                        url: url,
                        dataType: "json",
                        success: function (data) {

                            if (data.ok) {
                                alert(data.ok);
                            } else {
                                alert(data.err);
                            }

                            $('input.starri').rating('readOnly');

                        }

                    });
                }


            }
        });
    });


    /*===================================================================================*/
    /*  Moje skripe
     /*===================================================================================*/

    $(function () {

        $("#opisDescArt img").addClass("img-responsive");
           // .children('img')


        $('.dodajkompare').click(function (e) {
            e.preventDefault();
            var th, artid, komitent;

            th = $(this);
            artid = th.data('id');

            komitent = $("#KomitentId").val();

            var url = "/akcija.php?action=dodajCompare"; // the script where you handle the form input.
            console.log(artid + ' ' + komitent);

            if (artid && komitent) {
                $.ajax({
                    type: "POST",
                    url: url,
                    dataType: "json",
                    data: {id: artid, br: komitent}, // serializes the form's elements.
                    success: function (tekst) {


                        if (tekst.ok) {
                            alert(tekst.ok);
                            window.location.reload();
                        } else {
                            alert(tekst.error);
                        }
                    }
                });
            } else {
                alert('id or User');
            }
        });

        $('.skiniKompare').click(function (e) {
            e.preventDefault();
            var th, artid, komitent, vrednost;

            th = $(this);
            artid = th.data('skini');
            vrednost = $(this).closest('.okvIzbrisi');

            komitent = $("#KomitentId").val();

            var url = "/akcija.php?action=skiniCompare"; // the script where you handle the form input.


            if (artid && komitent) {
                $.ajax({
                    type: "POST",
                    url: url,
                    dataType: "json",
                    data: {id: artid, br: komitent}, // serializes the form's elements.
                    success: function (tekst) {
                        if (tekst.ok) {
                            alert(tekst.ok);

                            vrednost.css("background-color", "#FF3700");
                            vrednost.fadeOut(400, function () {
                                vrednost.remove();
                            });

                        } else {
                            alert(tekst.error);
                        }
                    }
                });
            } else {
                alert('id or User SKINI');
            }
        });


    });

    $('.dodajuKorpuPocetna').click(function (e) {
        e.preventDefault();

        var ArtikalId, kolicinaArt;

        ArtikalId =  $(this).attr("data-id");
        kolicinaArt =  $(this).attr("data-kol");

        if (ArtikalId && kolicinaArt) {
            var url = "/akcija.php?action=dodajuKorpu"; // the script where you handle the form input.
            $.ajax({
                type: "POST",
                url: url,
                dataType: "json",
                data: {id: ArtikalId, br: kolicinaArt},
                success: function (response) {
                    if (response.ok) {
                        alert(response.ok);

                        var trenutnaKolicna = $('.ovkKolicina').html();
                        if (!trenutnaKolicna) {
                            trenutnaKolicna = 0;
                        }

                        var net = (trenutnaKolicna * 1) + (kolicinaArt * 1);
                        $('.ovkCart').html(net);


                    } else {
                        alert(response.error);
                    }
                },
                error: function (xhr, status, thrown) {

                    alert(error);

                }
            });
        } else {
            alert('No Id : ' + ArtikalId + ' or Qty : ' + kolicinaArt);
        }
    });


    // this is the id of the form
    $("#promPp").submit(function (r) {
        r.preventDefault();
        var pass1, cpass1, dis, pass1Sha, valPro, idUser;
        dis = $(this);

        pass1 = $('#pass1').val();
        cpass1 = $('#cpass1').val();
        idUser = $('#idUser').val();


        if (pass1 != cpass1) {
            alert('nisu iste sifre');
            valPro = '';
            return;
        } else {
            valPro = '1';
        }
        pass1Sha = hex_sha512(pass1);

        var url = "/akcija.php?action=prosp"; // the script where you handle the form input.

        if (valPro && idUser) {
            $.ajax({
                type: "POST",
                url: url,
                dataType: "json",
                data: {string: pass1Sha, id: idUser}, // serializes the form's elements.
                success: function (tekst) {

                    var agro = location.host; //agro
                    var protocol = location.protocol; // http:

                    if (tekst.ok) {
                        alert(tekst.ok);
                        window.location.assign(protocol + '//' + agro);
                    } else {
                        alert(tekst.error);
                    }
                }
            });
        } else {
            alert('No ' + idUser);
        }

    });

    // this is the id of the form
    $("#registracijasamo").submit(function (r) {
        r.preventDefault();
        var miki = $(this).serialize();

        prikaziTekst(miki, function (str) {
            var stre = $.trim(str);

            /* setTimeout(function(){
             window.location.reload();
             return;
             }, 3000);*/
        });
        $('#registracijasamo').html('<i class="fa fa-cog fa-spin"></i>');
        return false; // avoid to execute the actual submit of the form.
    });

    var prikaziTekst = function (miki, vratinazad) {

        var url = "/akcija.php?action=registruj"; // the script where you handle the form input.
        $.ajax({
            type: "POST",
            url: url,
            data: miki, // serializes the form's elements.
            success: function (tekst) {
                $('#registracijasamo').fadeOut(300, function () {
                    $('#registracijasamo').html(tekst).fadeIn(300, function () {
                        vratinazad(tekst);
                    });
                });

            },
            error: function (response) {
                var r = jQuery.parseJSON(response.responseText);
                alert("Message: " + r.Message);
                alert("StackTrace: " + r.StackTrace);
                alert("ExceptionType: " + r.ExceptionType);
            }

        });
    }

    $('#dodajMail').click(function (e) {
        e.preventDefault();
        var ovo;

        ovo = $("#eMailProiz").val();

        var url = "/akcija.php?action=dodajMail"; // the script where you handle the form input.

        if (ovo) {
            $.ajax({
                type: "POST",
                url: url,
                dataType: "json",
                data: {email: ovo}, // serializes the form's elements.
                success: function (tekst) {
                    if (tekst.ok) {
                        alert(tekst.ok);
                    } else {
                        alert(tekst.error);
                    }
                }
            });
        } else {
            alert('No mail');
        }
    });


    $('#logujse').submit(function (r) {
        r.preventDefault();


        var email = $('#logujse :input#emaillog').val();
        var passwordlog = $('#logujse :input#passwordlog').val();
        var p = hex_sha512(passwordlog);

        //var miki = $(this).serialize();

        if (!email) {
            alert("Email empty");
            return;
        }

        if (!p) {
            alert("Pass empty");
            return;
        }

        $(this).html('<i class="fa fa-cog fa-spin"></i>');

        var url = "/akcija.php?action=logujse"; // the script where you handle the form input.
        $.ajax({
            type: "POST",
            url: url,
            data: {email: email,p:p},
            //data: miki, // serializes the form's elements.
            dataType: "json",
            success: function (tekst) {

                var agro = location.host; //agro
                var protocol = location.protocol; // http:

                if (tekst.ok) {
                    alert(tekst.ok);
                    window.location.assign(protocol + '//' + agro);

                } else {
                    alert(tekst.err);
                    window.location.reload();
                }

                $('#logujse').fadeOut(300, function () {
                    $('#logujse').html(tekst).fadeIn(300, function () {


                        //window.location.assign(protocol + '//' + agro);

                        //window.location.reload();
                        //window.location.href = "http://agro";
                    });
                });

            }

        });

        return false; // avoid to execute the actual submit of the form.
    });

    $('.izlogujse').click(function (e) {
        e.preventDefault();
        var url = "/akcija.php?action=izlogujse"; // the script where you handle the form input.
        $.ajax({
            type: "POST",
            url: url,
            data: {name: "bilo sta"}, // serializes the form's elements.
            success: function (tekst) {


                /*FB.api('/me/permissions', 'delete', function(response) {
                    console.log(response.status); // true for successful logout.
                    console.log(response);

                });*/
                //ugaseno 10.01.2018.

                alert(tekst);

                setTimeout(function(){
                    // do stuff here, in your case, append text
                    window.location.reload();
                }, 450);
                //4500 promenjeno 10.01.2018.

/*

                FB.logout(function(response) {
                    // user is now logged out
                });
*/



            }
        });
    });

    $('#zaboravljenasifra').click(function (e) {
        e.preventDefault();
        $('.toggleform').toggle();
    });

    $('#izgsifr').submit(function (e) {
        e.preventDefault();
        var miki = $(this).serialize();

        $(this).html('<i class="fa fa-cog fa-spin"></i>');

        var url = "/akcija.php?action=izmenasifre"; // the script where you handle the form input.
        $.ajax({
            type: "POST",
            url: url,
            data: miki, // serializes the form's elements.
            dataType: "json",
            success: function (tekst) {

                if (tekst.error) {
                    alert(tekst.testsajt);
                    $('#izgsifr').html(tekst).fadeIn(300, function () {

                    });

                } else {
                    alert(tekst.testsajt);
                    window.location.reload();
                }

            }
        });
    });

    $("#SpecForma").on("change", "input:checkbox", function () {
        // $(this).submit();
        var sta, ceki, idChk, vrednost, ovo;
        ovo = $(this);

        idChk = ovo.data('id');
        sta = ovo.is(':checked');
        if (sta) {
            ceki = 1;
        } else {
            ceki = 0;
        }
        ///var listElements = $( '[vred]' );
        vrednost = ovo.closest('div').attr("idKat");

        if (idChk && vrednost) {
            // $(this).append("<input type='hidden' name='idSpec' value='"+idChk+"' />");
            // $(this).append("<input type='hidden' name='brSpec' value='"+vrednost+"' />");

            $("#SpecForma").submit();
        } else {
            alert('Nema Id : ' + idChk + ' ili Id Grupe: ' + vrednost);
        }

        //console.log(idChk+' '+vrednost);
    });


    $(document).ready(function () {

        $('#dodajuKorpu').click(function (e) {
            e.preventDefault();
            var ArtikalId, kolicinaArt;
            ArtikalId = $('#ArtikalId').val();
            kolicinaArt = $('#kolicinaArt').val();

            if (ArtikalId && kolicinaArt) {
                var url = "/akcija.php?action=dodajuKorpu"; // the script where you handle the form input.
                $.ajax({
                    type: "POST",
                    url: url,
                    dataType: "json",
                    data: {id: ArtikalId, br: kolicinaArt},
                    success: function (response) {
                        if (response.ok) {
                            alert(response.ok);

                            var trenutnaKolicna = $('.ovkKolicina').html();
                            if (!trenutnaKolicna) {
                                trenutnaKolicna = 0;
                            }

                            var net = (trenutnaKolicna * 1) + (kolicinaArt * 1);
                            $('.ovkCart').html(net);


                        } else {
                            alert(response.error);
                        }
                    },
                    error: function (xhr, status, thrown) {

                        alert(error);

                    }
                });
            } else {
                alert('No Id : ' + ArtikalId + ' or Qty : ' + kolicinaArt);
            }
        });


        $('.izbaciIzKorpe').click(function (e) {
            e.preventDefault();

            var ArtikalId, vrednost, komitent;
            ArtikalId = $(this).data('name');
            komitent = $("#KomitentId").val();


            vrednost = $(this).closest('.okvIzbrisi');

            if (ArtikalId && komitent) {
                var url = "/akcija.php?action=obrisiIzKorpe"; // the script where you handle the form input.
                $.ajax({
                    type: "POST",
                    url: url,
                    dataType: "json",
                    data: {id: ArtikalId, br: komitent},
                    success: function (response) {
                        if (response.ok) {
                            alert(response.ok);

                            vrednost.css("background-color", "#FF3700");
                            vrednost.fadeOut(400, function () {
                                vrednost.remove();
                            });

                        } else {
                            alert(response.error);
                        }
                    },
                    error: function (xhr, status, thrown) {

                        alert(error);

                    }
                });
            } else {
                alert('No Id : ' + ArtikalId + ' or User : ' + komitent);
            }
        });


        $('.promeniKolicinuArtCart').click(function (e) {
            e.preventDefault();

            var ArtikalId, idart, vrednost, kolicina, minKolicina;
            ArtikalId = $(this).data('name');
            idart = $(this).data('idart');


            vrednost = $(this).closest('.okvIzbrisi');

            kolicina = vrednost.find('#kolicinaKarta').val();
            minKolicina = vrednost.find('#kolicinaKarta').attr('min');

            /*   if (kolicina<minKolicina) {
             alert('minumum - ' +minKolicina);
             kolicina = minKolicina;
             }*/


            if (ArtikalId && kolicina) {

                var url = "/akcija.php?action=promeniKolCart"; // the script where you handle the form input.
                $.ajax({
                    type: "POST",
                    url: url,
                    dataType: "json",
                    data: {id: ArtikalId, br: kolicina, idart: idart},
                    success: function (response) {
                        if (response.ok) {
                            alert(response.ok);
                            window.location.reload();

                        } else {
                            alert(response.error);
                        }
                    },
                    error: function (xhr, status, thrown) {

                        alert(error);

                    }
                });
            } else {
                alert('No Id : ' + ArtikalId + ' or Qty : ' + kolicina);
            }
        });


    });


    $('.banner-slider').owlCarousel({
        loop: true,
        margin: 30,
        autoplay: true,
        nav: false,
        dots: true,
        navText: ["", ""],
        items: 1,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 1
            }
        }
    });
    $('.clients-say').owlCarousel({
        loop: true,
        margin: 30,
        autoplay: true,
        nav: true,
        navText: ["", ""],
        items: 1,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });
    $('.blog-slider-content').owlCarousel({
        loop: true,
        margin: 30,
        nav: true,
        navText: ["", ""],
        items: 3,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    });
    $('.blog-single').owlCarousel({
        loop: true,
        margin: 30,
        nav: true,
        navText: ["", ""],
        items: 1,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });
    $('.product-item-small-owl').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        navText: ["", ""],
        items: 1,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 1
            }
        }
    });
    $('.testimonial').owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        navText: ["", ""],
        items: 1,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });

    $('#client-testimonial').owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        dots: true,
        items: 1,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });

    $('.hot-sale-slider').owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        dots: true,

        items: 1,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });
    $('.our-brands').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        navText: ["", ""],
        items: 5,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            }
        }
    });
    $('.our-brands-v2').owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        navText: ["", ""],
        items: 8,
        responsive: {
            0: {
                items: 3
            },
            600: {
                items: 3
            },
            1000: {
                items: 8
            }
        }
    });

    $('.handtool-featured').owlCarousel({
        loop: true,
        margin: 30,
        nav: true,
        navText: ["", ""],
        items: 3,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 3
            }
        }
    });

    $('.digital-new').owlCarousel({
        loop: true,
        margin: 30,
        nav: true,
        navText: ["", ""],
        items: 5,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            }
        }
    });
    $('.new-furniture-product').owlCarousel({
        loop: true,
        margin: 30,
        nav: true,
        navText: ["", ""],
        items: 5,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            }
        }
    });
    $('.box-new').owlCarousel({
        loop: true,
        margin: 30,
        nav: true,
        navText: ["", ""],
        items: 5,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            }
        }
    });

    $('.featured-product').owlCarousel({

        loop: false,
        margin: 30,
        nav: false,
        navText: ["", ""],
        items: 3,
        dots: false,
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 3
            },
            1000: {
                items: 3
            }
        }
    });

    $('.single-product-tabs').on('shown.bs.tab', function () {
        $(this).parent().find('.tab-pane.active .home-carousel').owlCarousel({
            items: 4,
            nav: true,
            navText: ["", ""],
            margin: 30,
            slideSpeed: 300,
            dots: true,
            paginationSpeed: 400,
            responsive: {
                0: {
                    items: 1,
                },
                600: {
                    items: 2,
                },
                1000: {
                    items: 3,
                },
                1280: {
                    items: 4,
                }

            }
        });

    });

    $('.single-digital-product-tabs').on('shown.bs.tab', function () {
        $(this).parent().find('.tab-pane.active .digital-featured').owlCarousel({
            items: 5,
            nav: true,
            navText: ["", ""],
            margin: 30,
            slideSpeed: 300,
            dots: true,
            paginationSpeed: 400,
            responsive: {
                0: {
                    items: 1,
                },
                600: {
                    items: 2,
                },
                1000: {
                    items: 3,
                },
                1280: {
                    items: 5,
                }

            }
        });

    });

    $('.handtool-product-tab').on('shown.bs.tab', function () {
        $(this).parent().find('.tab-pane.active .handtool-featured1').owlCarousel({
            items: 3,
            nav: true,
            navText: ["", ""],
            margin: 30,
            slideSpeed: 300,
            dots: true,
            paginationSpeed: 400,
            responsive: {
                0: {
                    items: 1,
                },
                600: {
                    items: 2,
                },
                1000: {
                    items: 3,
                },
                1280: {
                    items: 3,
                }

            }
        });

    });

    $('.furniture-product-tabs').on('shown.bs.tab', function () {
        $(this).parent().find('.tab-pane.active .furniture-featured-product').owlCarousel({
            loop: true,
            margin: 30,
            nav: true,
            navText: ["", ""],
            items: 5,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 5
                }
            }
        });

    });

    $('.box-product-tabs').on('shown.bs.tab', function () {
        $(this).parent().find('.tab-pane.active .box-featured').owlCarousel({
            loop: true,
            margin: 30,
            nav: true,
            navText: ["", ""],
            items: 5,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 5
                }
            }
        });

    });


    $('#owl-single-product').owlCarousel({
        items: 1,
        nav: false
    });

    $('#owl-single-product-thumbnails').owlCarousel({
        items: 4,
        nav: false,
        dots: false,
        rewindNav: true,
        itemsTablet: [768, 4]
    });


    $(".slider-prev").click(function () {
        var owl = $($(this).data('target'));
        owl.trigger('owl.prev');
        return false;
    });

    $('.single-product-gallery .horizontal-thumb').click(function () {
        var $this = $(this), owl = $($this.data('target')), slideTo = $this.data('slide');
        owl.trigger('to.owl.carousel', slideTo);
        $this.addClass('active').parent().siblings().find('.active').removeClass('active');
        return false;
    });


    $('.fashion-v6-featured').owlCarousel({
        loop: true,
        margin: 30,
        nav: false,
        dots: false,
        autoplay: true,
        autoplayTimeout: 2000,
        items: 5,
        navText: ["", ""],
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            }
        }
    });

    $('.sidebar-single-product').owlCarousel({
        loop: true,
        margin: 30,
        nav: true,
        navText: ["", ""],
        autoplay: true,
        dots: false,
        items: 1,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 1
            }
        }
    });

    /*===================================================================================*/
    /*  LAZY LOAD IMAGES USING ECHO
     /*===================================================================================*/
    $(document).ready(function () {
        echo.init({
            offset: 100,
            throttle: 250,
            unload: false
        });
    });


    /*===================================================================================*/
    /* PRICE SLIDER
     /*===================================================================================*/
   /* $(document).ready(function () {

        // Price Slider
        if ($('.price-slider').length > 0) {
            $('.price-slider').slider({
                min: 100,
                max: 700,
                step: 10,
                value: [200, 500],
                handle: "square"

            });

        }

    });*/


    /*===================================================================================*/
    /*  WOW
     /*===================================================================================*/

    var wow = new WOW(
        {
            boxClass: 'wow',      // animated element css class (default is wow)
            animateClass: 'animated', // animation css class (default is animated)
            offset: 0,          // distance to the element when triggering the animation (default is 0)
            mobile: true,       // trigger animations on mobile devices (default is true)
            live: true,       // act on asynchronously loaded content (default is true)
            callback: function (box) {
                // the callback is fired every time an animation is started
                // the argument that is passed in is the DOM node being animated
            }
        }
    );
    wow.init();


    /*===================================================================================*/
    /*  TOOLTIP
     /*===================================================================================*/
    $("[data-toggle='tooltip']").tooltip();

    $('#transitionType li a').click(function () {

        $('#transitionType li a').removeClass('active');
        $(this).addClass('active');

        var newValue = $(this).attr('data-transition-type');

        $(owlElementID).data("owlCarousel").transitionTypes(newValue);
        $(owlElementID).trigger("owl.next");

        return false;

    });


    /*===================================================================================*/
    /* PRICE SLIDER
     /*===================================================================================*/
   /* $(document).ready(function () {

        // Price Slider
        if ($('.price-slider').length > 0) {
            $('.price-slider').slider({
                min: 100,
                max: 700,
                step: 10,
                value: [200, 500],
                handle: "square"

            });

        }

    });*/

    //$('#product-thumbnail .active').click(function() {
    //$('.detail .gallery li').removeClass('current');
    //var elem = $(this).attr('id');
    //$('.' + elem).addClass('current');
    //$(this).addClass('current');
    //});


    /*===================================================================================*/
    /*  custom select
     /*===================================================================================*/

// $(document).ready(function () {

// // Select Dropdown
// if($('.le-select').length > 0){
//     $('.le-select select').customSelect({customClass:'le-select-in'});
// }

// });
    $(document).ready(function () {
        $('select.styled').customSelect();
    });


    $('.fashion-v1-position').prev('header').addClass('behind-slider-h');
    $('.fashion-v1-position').next('footer').addClass('behind-slider-f');


})(jQuery);

