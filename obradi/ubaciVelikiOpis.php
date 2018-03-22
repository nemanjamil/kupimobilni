<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 20. 05. 2016.
 * Time: 12:01
 */


// $idVelikiOpis setujemo u fajlu gde se poziva ovaj fajl-ubaciVelikiOpis
// $db->where('ArtikalId', $idUbacenog);
// $idVelikiOpis = 'ArtikalId';
$db->where($idVelikiOpis, $idubacenog);

// $tabelaKratakOpis setujemo u fajlu gde se poziva ovaj fajl-ubaciVelikiOpis
// if($db->delete('artikalnazivnew')) {
// $tabelaVelikiOpis = 'artikalnazivnew';
if ($db->delete($tabelaVelikiOpis)) {
    $obr = true;
} else {
    $obr = false;
}

if ($velikiOpis) {
    foreach ($velikiOpis as $key => $val) {

        //$kolonaNaziv setujemo u fajlu gde se poziva ovaj fajl-ubaciVelikiOpis
        //$kolonaIdLanguage setujemo u fajlu gde se poziva ovaj fajl-ubaciVelikiOpis

        // $kolonaIdLanguage = 'IdLanguage';
        // $kolonaVelikiOpis = 'OpisLaLaLa';

        $insert_query = Array($idVelikiOpis => $idubacenog, $kolonaIdLanguage => $key, $kolonaVelikiOpis => $val);
        $db->setQueryOption(Array('IGNORE'));

        // $tabelaVelikiOpis = 'artiklitekstovinew';
        $idArtNewInsert = $db->insert($tabelaVelikiOpis, $insert_query);
    }
}

?>