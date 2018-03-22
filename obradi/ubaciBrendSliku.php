<?php
/**
 * Project: masinealati
 * Created by PhpStorm.
 * User: Nikola
 * Date: 10. 05. 2016.
 * Time: 11:03
 */


if ($BrendId) {

    $error_msg .= 'ok - Ubaceno u bazu';

    $slika = $_FILES;
    $imeslike = $BrendLink;
    $idba = $id;
    $table = 'brendovi';
    $kolona = 'BrendSlika';
    $location = '/assets/images/brands';
    $nazivInputPolja = 'BrendSlika';
    $idkolone = 'BrendId';
    $w = '';  // ako je prazno onda je default  800px
    $h = ''; // ako je prazno onda je default  800px
    $preview = '1'; //ako pravimo thumb sliku _mala (80, 110) i _srednja  250, 340
    $orgSlika = ''; // da li zelimo da snimimo i originalnu sliku


    $ubacisliku->ubacislikuBrend($slika, $imeslike, $idba, $table, $kolona, $location, $nazivInputPolja, $idkolone, $w, $h, $preview, $orgSlika);


} else {
    $error_msg .= 'Nema $BrendId : ' . $BrendId . ' $idUbacenogart : ' . $idubacenog;
    die;
}

