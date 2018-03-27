<?php

// samo registrovani
if ($tipUsera > 3) {

    switch ($action) {

        case "getNodes":
            require('obradi/getNodes.php');
            break;
        case "getNodesDodajArt":
            require('obradi/getNodesDodajArt.php');
            break;
        case "getNodesKategHead":
            require('obradi/getNodesKategHead.php');
            break;
        case "getNodesZdravlje":
            require('obradi/getNodesZdravlje.php');
            break;
        case "getNodesZdravljeArt":
            require('obradi/getNodesZdravljeArt.php');
            break;
        case "dodajkateg":
            require('obradi/dodajkateg.php');
            break;
        case "dodajkategZdravlje":
            require('obradi/dodajkategZdravlje.php');
            break;
        case "editujkateg":
            require('obradi/editujkateg.php');
            break;
        case "activeKategZdravlje":
            require('obradi/activeKategZdravlje.php');
            break;
        case "activeKateg":
            require('obradi/activeKateg.php');
            break;
        case "obrisikateg":
            require('obradi/obrisikateg.php');
            break;
        case "obrisikateghead":
            require('obradi/obrisikateghead.php');
            break;
        case "obrisikategZdravlje":
            require('obradi/obrisikategZdravlje.php');
            break;

        case "dodajartikal":
            require('obradi/dodajartikal.php');
            break;
        case "listaTagova":
            require('obradi/listaTagova.php');
            break;
        case "listaTagovaSamoIme":
            require('obradi/listaTagovaSamoIme.php');
            break;
        case "dodajspecartikala":
            require('obradi/dodajspecartikala.php');
            break;
        case "promenimesto":
            require('obradi/promenimesto.php');
            break;
        case "editujKategZasebno":
            require('obradi/editujKategZasebno.php');
            break;
        case "editujKategZasebnoZdravlje":
            require('obradi/editujKategZasebnoZdravlje.php');
            break;
        case "dodajSpecGrupe":
            require('obradi/dodajSpecGrupe.php');
            break;
        case "editartikal":
            require('obradi/editartikal.php');
            break;
        case "obrisiSlikuArtikal":
            require('obradi/obrisiSlikuArtikal.php');
            break;
        case "obrisiSlikuKomitent":
            require('obradi/obrisiSlikuKomitent.php');
            break;
        case "obrisiSpecVrednost":
            require('obradi/obrisiSpecVrednost.php');
            break;
        case "dodajSpecVrednost":
            require('obradi/dodajSpecVrednost.php');
            break;
        case "editSpecVrednost":
            require('obradi/editSpecVrednost.php');
            break;
        case "dodajGrupuSpec":
            require('obradi/dodajGrupuSpec.php');
            break;
        case "editgrupuspec":
            require('obradi/editgrupuspec.php');
            break;
        case "kategZdravljenaArt":
            require('obradi/kategZdravljenaArt.php');
            break;
        case "dodajtag":
            require('obradi/dodajtag.php');
            break;
        case "edittag":
            require('obradi/edittag.php');
            break;
        case "obrisitag":
            require('obradi/obrisitag.php');
            break;
        case "dodajslider":
            require('obradi/dodajslider.php');
            break;
        case "editslider":
            require('obradi/editslider.php');
            break;
        case "obrisislider":
            require('obradi/obrisislider.php');
            break;
        case "dodajkomitenta":
            require('obradi/dodajkomitenta.php');
            break;
        case "editkomitenta":
            require('obradi/editkomitenta.php');
            break;
        case "obrisikomitenta":
            require('obradi/obrisikomitenta.php');
            break;
        case "obrisiartikal":
            require('obradi/obrisiartikal.php');
            break;
        case "dodajverifikacijudib":
            require('obradi/dodajverifikacijudib.php');
            break;
        case "obrisiverifdib":
            require('obradi/obrisiverifdib.php');
            break;
        case "editverifdib":
            require('obradi/editverifdib.php');
            break;
        case "dodajverifikacijuls":
            require('obradi/dodajverifikacijuls.php');
            break;
        case "obrisiverifls":
            require('obradi/obrisiverifls.php');
            break;
        case "editverifls":
            require('obradi/editverifls.php');
            break;
        case "dodajKategHead":
            require('obradi/dodajKategHead.php');
            break;
        case "editKategHead":
            require('obradi/editKategHead.php');
            break;
        case "editosnovnipodaciM":
            require('obradi/editosnovnipodaciM.php');
            break;
        case "editosnovnipodaciA":
            require('obradi/editosnovnipodaciA.php');
            break;
        case "dodajmailnews":
            require('obradi/dodajmailnews.php');
            break;
        case "editmail":
            require('obradi/editmail.php');
            break;
        case "obrisimail":
            require('obradi/obrisimail.php');
            break;
        case "dodajvest":
            require('obradi/dodajvest.php');
            break;
        case "editvest":
            require('obradi/editvest.php');
            break;
        case "obrisivest":
            require('obradi/obrisivest.php');
            break;
        case "editonama":
            require('obradi/editonama.php');
            break;
        case "obrisionama":
            require('obradi/obrisionama.php');
            break;
        case "dodajonama":
            require('obradi/dodajonama.php');
            break;
        case "editkomentar":
            require('obradi/editkomentar.php');
            break;
        case "obrisikomentar":
            require('obradi/obrisikomentar.php');
            break;
        case "obrisispeckategorije":
            require('obradi/obrisispeckategorije.php');
            break;
        case "edittxtnaslovnaM":
            require('obradi/edittxtnaslovnaM.php');
            break;
        case "edittxtnaslovnaA":
            require('obradi/edittxtnaslovnaA.php');
            break;
        case "edittxtzdravlje":
            require('obradi/edittxtzdravlje.php');
            break;
        case "dodajbrend":
            require('obradi/dodajbrend.php');
            break;
        case "editbrend":
            require('obradi/editbrend.php');
            break;
        case "obrisibrend":
            require('obradi/obrisibrend.php');
            break;
        case "dodajporez":
            require('obradi/dodajporez.php');
            break;
        case "editporez":
            require('obradi/editporez.php');
            break;
        case "obrisiporez":
            require('obradi/obrisiporez.php');
            break;
        case "dodajkategporez":
            require('obradi/dodajkategporez.php');
            break;
        case "editkategporez":
            require('obradi/editkategporez.php');
            break;
        case "obrisikategporez":
            require('obradi/obrisikategporez.php');
            break;
        case "dodajopisnotif":
            require('obradi/dodajopisnotif.php');
            break;
        case "editopisnotif":
            require('obradi/editopisnotif.php');
            break;
        case "obrisiopisnotif":
            require('obradi/obrisiopisnotif.php');
            break;
        case "liveg":
            require('obradi/liveg.php');
            break;
        case "upitartikli":
            require('obradi/upitartikli.php');
            break;
        case "dodajalatiimasinenapocetnu":
            require('obradi/dodajalatiimasinenapocetnu.php');
            break;
        case "dodajalpotrosnimaterijalnapocetnu":
            require('obradi/dodajalpotrosnimaterijalnapocetnu.php');
            break;
        case "dodajalsrafovenapocetnu":
            require('obradi/dodajalsrafovenapocetnu.php');
            break;


        /*
         * CODE
         */
        case "povucispecpribor":
            require('obradi/povucispecpribor.php');
            break;
        case "povucispec":
            require('obradi/povucispec.php');
            break;
        case "povucispecbasta":
            require('obradi/povucispecbasta.php');
            break;
        case "povucispecpriborDremel":
            require('obradi/povucispecpriborDremel.php');
            break;
        case "povucispecskilmasters":
            require('obradi/povucispecskilmasters.php');
            break;
        case "povucispecskil":
            require('obradi/povucispecskil.php');
            break;
        case "povucispecskilpribor":
            require('obradi/povucispecskilpribor.php');
            break;
        case "editartikalvebsop":
            require('obradi/editartikalvebsop.php');
            break;
        case "povucispeclumen":
            require('obradi/povucispeclumen.php');
            break;
        case "povucispecmakita":
            require('obradi/povucispecmakita.php');
            break;


        case "editrecenzije":
            require('obradi/editrecenzije.php');
            break;
        case "obrisirecenzije":
            require('obradi/obrisirecenzije.php');
            break;
        case "dodajsuperponudu":
            require('obradi/dodajsuperponudu.php');
            break;
        case "dodajpozicijusuper":
            require('obradi/dodajpozicijusuper.php');
            break;
        case "skinisuper":
            require('obradi/skinisuper.php');
            break;
        case "dodajakcijanovi":
            require('obradi/dodajakcijanovi.php');
            break;
        case "dodajpozicijunovi":
            require('obradi/dodajpozicijunovi.php');
            break;
        case "dodajpozicijunajprod":
            require('obradi/dodajpozicijunajprod.php');
            break;
        case "dodajakcijanajprod":
            require('obradi/dodajakcijanajprod.php');
            break;
        case "dodajakcijaPrepAndroid":
            require('obradi/dodajakcijaPrepAndroid.php');
            break;
        case "obrisiprijavu":
            require('obradi/obrisiprijavu.php');
            break;
        case "izmenitranslate":
            require('obradi/izmenitranslate.php');
            break;
        case "izmenitranslatevrednost":
            require('obradi/izmenitranslatevrednost.php');
            break;
        case "obrisitranslate":
            require('obradi/obrisitranslate.php');
            break;
        case "dodajtranslate":
            require('obradi/dodajtranslate.php');
            break;
        case "dodajvrednosttranslate":
            require('obradi/dodajvrednosttranslate.php');
            break;
        case "dodajjezik":
            require('obradi/dodajjezik.php');
            break;
        case "izmenijezik":
            require('obradi/izmenijezik.php');
            break;
        case "obrisijezik":
            require('obradi/obrisijezik.php');
            break;
        case "aktivirajdokumenta":
            require('obradi/aktivirajdokumenta.php');
            break;
        case "dodajmagacine":
            require('obradi/dodajmagacin.php');
            break;
        case "izmenimagacin":
            require('obradi/izmenimagacin.php');
            break;
        case "obrisimagacin":
            require('obradi/obrisimagacin.php');
            break;
        case "aktivirajstanjevarijable":
            require('obradi/aktivirajstanjevarijable.php');
            break;
        case "dodajsetvarijablu":
            require('obradi/dodajsetvarijablu.php');
            break;
        case "izmenisetvarijablu":
            require('obradi/izmenisetvarijablu.php');
            break;
        case "obrisisetvarijablu":
            require('obradi/obrisisetvarijablu.php');
            break;

        // MODELI NA EDIT ART
        case "ListaModelaJson":
            require('obradi/ListaModelaJson.php');
            break;
        case "dodajModelNaArt":
            require('obradi/dodajModelNaArt.php');
            break;
        case "removeModelNaArt":
            require('obradi/removeModelNaArt.php');
            break;
        // KRAJ MODALI NA EDIT ART



        /*
            * DODATNA OPREMA DEO*/

        case "promeniArtKateg":
            require('obradi/promeniArtKateg.php');
            break;

        /*
         * KRAJ CODE
         */


        /* SAJT !!!!!
         * POCETAK SENZORI SAJT */
        case "dodajkulturu":
            require('obradi/dodajkulturu.php');
            break;
        case "editkulture":
            require('obradi/editkulture.php');
            break;
        case "obrisikulturu":
            require('obradi/obrisikulturu.php');
            break;
        case "dodajsenz":
            require('obradi/dodajsenz.php');
            break;
        case "editsenz":
            require('obradi/editsenz.php');
            break;
        case "obrisisenz":
            require('obradi/obrisisenz.php');
            break;
        case "dodajTipSenzoraZaKuturu":
            require('obradi/dodajTipSenzoraZaKuturu.php');
            break;
        case "editpodkulturesve":
            require('obradi/editpodkulturesve.php');
            break;
        case "dodajKulturuNaSenzor":
            require('obradi/dodajKulturuNaSenzor.php');
            break;
        case "obrisiKulturuZaSenzor":
            require('obradi/obrisiKulturuZaSenzor.php');
            break;


        /*
         * KRAJ SENZORI SAJT
         * */

        // ovo ne mozemo da stavimo jer imamo upit registrovanog korisnika ciji query je u akcija.php
        /*default:
            echo 'Nije dobar upit na Akcija Registrovani Useri';
            die;*/

    }

}



?>

