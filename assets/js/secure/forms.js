/* 
 * Copyright (C) 2013 peredur.net
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

function formhash(form, email, password) {

    if ( email.value == '' || password.value == '') {
        alert('Morate popuniti sva polja. Molimo Vas pokusajte ponovo');
        return false;
    }

    // Create a new element input, this will be our hashed password field.
    var p = document.createElement("input");

    // Add the new element to our form.
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);

    // Make sure the plaintext password doesn't get sent.
    password.value = "";

    // Finally submit the form. 
    //form.submit();
}

function regformhash(form, email, password, conf) {
    // Check each field has a value

    // Ako je u pitanju registracija veleprodajnog klijenta potrebno je ispitati i ova polja
   /* if (form.vrstaKomitenta2.checked){
        if (form.imeFirme.value == '' || form.PIB.value == '' || form.maticniFirma.value == '') {
            alert('Morate popuniti sva polja. Molimo Vas pokusajte ponovo');
            return false;
        }
    }*/


    if ( email.value == '' || password.value == '' || conf.value == '') {
        alert('Morate popuniti sva polja. Molimo Vas pokusajte ponovo');
        return false;
    }

 /*   // Ako je u pitanju registracija veleprodajnog klijenta potrebno je ispitati ovih polja. Samo u tom slucaju!
    if (form.vrstaKomitenta2.checked) {
        // Check PIB
        re = /^[0-9]+$/;
        if (!re.test(form.PIB.value) || (form.PIB.value.length != 9)) {
            alert('PIB mora da sadrzi samo brojeve i da ih bude tacno 9. Molimo Vas unesite ispravne podatke.');
            form.PIB.focus();
            return false;
        }

        re = /^[0-9]+$/;
        if (!re.test(form.maticniFirma.value)) {
            alert('Maticni broj mora da sadrzi samo brojeve. Molimo Vas unesite ispravne podatke.');
            form.maticniFirma.focus();
            return false;
        }
    }*/

    /*re = /^[a-zA-Z]+$/;
    if (!re.test(form.imeVlasnik.value) || !re.test(form.prezimeVlasnik.value)) {
        alert('Ime i prezime moraju da sadrze samo slova. Molimo Vas unesite ispravne podatke.');
        if(!re.test(form.imeVlasnik.value)){
            form.imeVlasnik.focus();
        } else {
            form.prezimeVlasnik.focus();
        }
        return false;
    }*/

   /* re = /^[a-zA-Z ]+$/;
    if(!re.test(form.mesto.value)){
        alert('Mesto mora da sadrzi samo slova. Molimo Vas unesite ispravne podatke.');
        form.mesto.focus();
        return false;
    }

    re = /^[0-9]+$/;
    if(!re.test(form.postanski.value) || (form.postanski.value.length != 5)){
        alert('Postanski broj mora da sadrzi samo brojeve i da ih bude tacno 5. Molimo Vas unesite ispravne podatke.');
        form.postanski.focus();
        return false;
    }

    re = /^(?:\+?\d+[\/ -]?\d+[ -]?\d+[ -]?\d+|\d+)$/;
    if(!re.test(form.telefon.value)){
        alert('Telefonski broj mora da sadrzi samo brojeve i moze se pisati u formatu 011/123-456 ili 011123456 ili +38111123456. Molimo Vas unesite ispravne podatke.');
        form.telefon.focus();
        return false;
    }

    // Check the username
    re = /^\w+$/;
    if(!re.test(form.username.value)) {
        alert("Korisnicko ime moze da sadrzi samo slova, brojeve i _. Molimo Vas pokušajte ponovo");
        form.username.focus();
        return false;
    }
*/
    // Check that the password is sufficiently long (min 6 chars)
    // The check is duplicated below, but this is included to give more
    // specific guidance to the user
    if (password.value.length < 6) {
        alert('Šifra mora da sadrži najmanje šest karaktera. Molimo Vas pokušajte ponovo');
        form.password.focus();
        return false;
    }

    // At least one number, one lowercase and one uppercase letter 
    // At least six characters 
    /*var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/; 
     if (!re.test(password.value)) {
     alert('Šifra mora da ima mininum jedan broj, jedno malo slov i jedno veliko slovo. Molimo Vas pokušajte ponovo');
     return false;
     }
     */

    // Check password and confirmation are the same
    if (password.value != conf.value) {
        alert('Vaše šifre se ne slažu. Molimo Vas pokušajte ponovo');
        form.password.focus();
        return false;
    }
        
    // Create a new element input, this will be our hashed password field. 
    var p = document.createElement("input");

    // Add the new element to our form. 
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);

    // Make sure the plaintext password doesn't get sent. 
    password.value = "";
    conf.value = "";

    // Finally submit the form. 
    //form.submit();
    return true;
}
