<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 20. 05. 2016.
 * Time: 12:01
 */

// $idnaziv setujemo u fajlu gde se poziva ovaj fajl-ubaciNaziv
// $idVelikiOpis = 'ArtikalId';
// $db->where('ArtikalId', $idUbacenogart);
$db->where($idKratakOpis, $idubacenog);

// $tabelaNaziv setujemo u fajlu gde se poziva ovaj fajl-ubaciNaziv
// if($db->delete('artikalnazivnew')) {
// $tabelaVelikiOpis = 'artikalnazivnew';
if ($db->delete($tabelaKratakOpis)) {
    $obr = true;
} else {
    $obr = false;
}

if ($kratakOpis) {
    foreach ($kratakOpis as $key => $val) {


        //$kolonaNaziv setujemo u fajlu gde se poziva ovaj fajl-ubaciVelikiOpis
        //$kolonaIdLanguage setujemo u fajlu gde se poziva ovaj fajl-ubaciVelikiOpis

        // $kolonaIdLanguage = 'IdLanguage';
        // $kolonaVelikiOpis = 'OpisLaLaLa';


        $insert_query = Array($idKratakOpis => $idubacenog, $kolonaIdLanguage => $key, $kolonaKratakOpis => $val);
        $db->setQueryOption(Array('IGNORE'));

        // $tabelaVelikiOpis = 'artiklitekstovinew';
        $idArtNewInsert = $db->insert($tabelaKratakOpis, $insert_query);
    }
}
