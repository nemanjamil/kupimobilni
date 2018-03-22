<?php
/**
 * Created by PhpStorm.
 * User: Nikola Markovic
 * Date: 3.11.2017.
 * Time: 15:36
 */


$db->where('IdNarudzPov', $IdNarudzbine);
$NarudzbinaLista = $db->get('narudzlista', null, 'ArtIdNarudzLista, KolicinaNarudzlista');


foreach ( $NarudzbinaLista as $k => $v ) {
    $ArtIdNarudzLista = $v['ArtIdNarudzLista'];
    $KolicinaNarudzlista = $v['KolicinaNarudzlista'];


    $db->where('A.ArtikalId',$ArtIdNarudzLista);
    $db->where('AN.IdLanguage', 5);
    $db->join('artikalnazivnew AN', 'AN.ArtikalId = A.ArtikalId', 'LEFT');
    $Artikal = $db->getOne('artikli A',  'A.ArtikalId, A.ArtikalSifra, A.ArtikalExtId, AN.OpisArtikla');

    $ArtikalIdUbacUbac = $Artikal['ArtikalId'];
    $ArtikalSifraUbac = $Artikal['ArtikalSifra'];
    $ArtikalExtIdUbac = $Artikal['ArtikalExtId'];
    $OpisArtiklaUbac = $Artikal['OpisArtikla'];


}


