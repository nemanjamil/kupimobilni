<?php
/**
 * Created by PhpStorm.
 * User: Nikola Markovic
 * Date: 26.3.2018.
 * Time: 11:51
 */

/*
 * 6726 - Auto - 02.
 * 6728 - Mobilni - 09.
 * 6727 - Laptop - 07.
 * 5046 - Kamere - 06.
 * 6730 - Racunar - 14.
 * */


$cols = Array("K.KategorijaArtikalaId");
$db->where('K.KategorijaArtikalaSifra', Array('001.', '003.','002.','004.'), 'IN');
$tagoviArtupit = $db->get('kategorijeartikala K', null, $cols);
if ($tagoviArtupit) {
    $tagoviArt = $common->array_2_csv_sa_dodatkomnavodnika($tagoviArtupit);
}


define('KATEGORIJESAJTCRON', $tagoviArt);
