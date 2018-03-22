<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 20. 05. 2016.
 * Time: 12:00
 */

// $idnaziv setujemo u fajlu gde se poziva ovaj fajl-ubaciNaziv
// $idnaziv = 'ArtikalId';
// $db->where('ArtikalId', $idUbacenogart);

$db->where($idnaziv, $idubacenog);

// $tabelaNaziv setujemo u fajlu gde se poziva ovaj fajl-ubaciNaziv
// if($db->delete('artikalnazivnew')) {
// $tabelaNaziv = 'artikalnazivnew';

if ($db->delete($tabelaNaziv)) {
    $obr = true;
} else {
    $obr = false;
}

if ($naziv) {
    foreach ($naziv as $key => $val) {

        //$kolonaNaziv setujemo u fajlu gde se poziva ovaj fajl-ubaciVelikiOpis
        //$kolonaIdLanguage setujemo u fajlu gde se poziva ovaj fajl-ubaciVelikiOpis

        // $kolonaIdLanguage = 'IdLanguage';
        // $kolonaNaziv = 'OpisLaLaLa';


        $insert_query = Array($idnaziv => $idubacenog, $kolonaIdLanguage => $key, $kolonaNaziv => $val);

        $db->setQueryOption(Array('IGNORE'));

        // $tabelaNaziv = 'artiklitekstovinew';
        $idArtNewInsert = $db->insert($tabelaNaziv, $insert_query);
    }
}
?>