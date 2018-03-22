/*
 * Linkovi
 * https://developers.facebook.com/docs/facebook-login/web/login-button
 *
 * */

function getCookieFB(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function statusChangeCallbackInicijal(response) {
    if (response.status === 'connected') {

        console.log('Konektovan na FB => INCICIAL statusChangeCallback => connected');

        var userFbSetovan = getCookieFB("logovankako");
        if (userFbSetovan != 'FB') {
            console.log('Ne postoji Cookie logovankako Inicial -> sada cemo da ga setujemo');
            document.getElementById('nazivKomitentaHead').innerHTML = '<a href="#">Logovani ste</a>';
            document.getElementById('nazivKomitentaHead').style.display = "inline";

            testAPI();

            // skini dugme za remove
            document.getElementById('fbLogin').style.display = "none";

        } else {
            console.log('Postoji Cookie logovankako Inicial -> ' + userFbSetovan);
        }


    } else if (response.status === 'not_authorized') {
    } else {
    }

}


function statusChangeCallback(response) {

    if (response.status === 'connected') {

        console.log('Konektovan na FB => statusChangeCallback => connected');

        var userFbSetovan = getCookieFB("logovankako");
        console.log('Cookie userFbSetovan => '+userFbSetovan);

        if (userFbSetovan != 'FB') {

            console.log('Ne postoji Cookie logovankako');
            document.getElementById('nazivKomitentaHead').innerHTML = '<a href="#">Logovani ste</a>';
            document.getElementById('nazivKomitentaHead').style.display = "inline";
            document.getElementById('fbLogin').style.display = "none";
            testAPI();

        } else {
            console.log('Postoji Cookie logovankako -> ' + userFbSetovan);
        }

    } else if (response.status === 'not_authorized') {
        //document.getElementById('statusFB').innerHTML = 'Please log ' + 'into this app.';
    } else {
        //document.getElementById('statusFB').innerHTML = 'Please log ' + 'into Facebook.';
    }
}


function checkLoginState() {
    FB.getLoginStatus(function (response) {
        statusChangeCallbackInicijal(response);
    });
}

window.fbAsyncInit = function () {
    FB.init({
        appId: '542892295892333',   // org -> 542892295892333   testApp ->  542895772558652
        cookie: true,  // enable cookies to allow the server to access
                       // the session
        xfbml: true,  // parse social plugins on this page
        version: 'v2.6' // use graph api version 2.5
    });

    // 1. Logged into your app ('connected')
    // 2. Logged into Facebook, but not your app ('not_authorized')

    FB.getLoginStatus(function (response) {
        console.log(response);
        if (response.status === 'not_authorized' || response.status === 'connected') {
            statusChangeCallback(response);
        }
    });

};

// Load the SDK asynchronously
(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));


function testAPI() {
    FB.api('/me', {fields: 'name, gender, first_name, last_name, email, link,id,picture'}, function (response) {

        emailFb = response.email;
        idFb = response.id;
        first_nameFb = response.first_name;
        last_nameFb = response.last_name;
        linkFb = response.link;
        nameFb = response.name;
        genderFb = response.gender;

        // ako je povukao podatke sa FB-a problem jer svaki put pita FB
        if (idFb) {
            proveriKodNasUbazi(emailFb, idFb, first_nameFb, last_nameFb, linkFb, nameFb, genderFb);
        } else {
            console.log('nema Id FB tako da ga nema u bazi ni u Session');
        }

    });
}

function proveriKodNasUbazi(emailFb, idFb, first_nameFb, last_nameFb, linkFb, nameFb, genderFb) {
    //console.log('Podaci za Bazu: ' + emailFb + ' ' +idFb+' '+ first_nameFb + ' '+ last_nameFb + ' '+ linkFb + ' '+ nameFb + ' '+ genderFb + ' ');

    // proveravamo INT od ID FB
    var idFbInt = parseInt(idFb);

    if (!emailFb) {
        alert('Nema e-mail. Nismo uspeli da vas Logujemo');
        FB.api('/me/permissions', 'delete', function(response) {
            console.log(response.status); // true for successful logout.
            console.log(response);
        });
        return;
    }

    $.ajax({
        cache: false,
        type: "POST",
        data: {
            id: idFbInt,
            email: emailFb,
            first_nameFb: first_nameFb,
            last_nameFb: last_nameFb,
            linkFb: linkFb,
            nameFb: nameFb,
            genderFb: genderFb
        },
        url: "/akcija.php?action=logujFbUbazi",
        dataType: "json",
        success: function (data) {

            /*if (data.status === true) {
             alert(data.message);
             } else {
             alert(data.message);
             }*/
            //$('input.starri').rating('readOnly');

        }

    });

}