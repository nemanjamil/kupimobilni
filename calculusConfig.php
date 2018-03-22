<?php
/*
 *  Calculus configuration file.
 *
 * This file has all necessary configuration parameters for integration with Calculus ERP
 *
*/

if (isset($KomitentExtId) && $KomitentExtId > 0)
{
    $DokNaziv = REGISTROVANIKORISNICIDOKUMENT;
    }
else
{
    $DokNaziv = NEREGISTROVANIKORISNICIDOKUMENT;

}
$db->where('VrsteDokumenataPrefiks', $DokNaziv);
$db->where('VrsteDokumenataActive', 1);
$queryVrstaDokumentaIdResult = $db->getOne('vrstedokumenata');

//Vrsta dokumenata za sinhronizaciju
$VrsteDokumenataPrefiksZaSinhronizaciju = $queryVrstaDokumentaIdResult['VrsteDokumenataPrefiks'];

if (isset($KomitentExtId) && $KomitentExtId > 0)
{
    $MagNaziv = REGISTROVANIKORISNICIMAGACIN;
}
else
{
    $MagNaziv = NEREGISTROVANIKORISNICIMAGACIN;
}
$db->where('MagacinNaziv', $MagNaziv);
$db->where('MagacinActive', 1);
$queryMagacinIdResult = $db->getOne('magacin');

//Magacin za sinhronizaciju
$MagacinSifraZaSinhronizaciju = $queryMagacinIdResult['MagacinSifra'];


if (isset($KomitentId))
{
    $KomitentSifraZaSinhronizaciju = $KomitentSifra;
}
else
{
    //NEREGISTROVANIKORISNICIKORISNIK
    $db->where('KomitentNaziv', NEREGISTROVANIKORISNICIKORISNIK);
    $db->where('KomitentActive', 1);
    $queryKomitentiIdResult = $db->getOne('komitenti');

    //Komitent za sinhronizaciju
    $KomitentSifraZaSinhronizaciju = $queryKomitentiIdResult['KomitentSifra'];
}

$db->where('ValutaId', $valutasession);
$queryValutaIdResult = $db->getOne('valuta');

//Valuta za sinhronizaciju
$ValutaZaSinhronizaciju = $queryValutaIdResult['ValutaValuta'];


$KreatorZaSinhronizaciju = KREATORZASINHRONIZACIJUPORUDZBENICA;