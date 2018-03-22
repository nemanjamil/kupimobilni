<?php



/*if ($IdArtikliTekstovi) {


    $pokazi .= '<li><strong style="color: orange"> UPDATE TEKSTOVI OPIS  BOSCH</strong></li>';
    $data = Array(

        'OpisArtikliTekstovisrblat' => $sve,
        'OpisArtikliTekstovisrb' => $sve //$kategorijeDodatna->vice_versa_cySR($sve,'cy')
    );
    $db->where ('IdArtikliTekstovi', $idArt);
    if ($db->update ('ArtikliTekstovi', $data)) {

        $pokazi .= '<li>'.$db->count . ' ArtikliTekstovi records were UPDATE</li>';

    }    else {
        $pokazi .= '<li>update failed ArtikliTekstovi kod id : '.$idArt.' => error : ' . $db->getLastError().'</li>';
    }



} else { }*/


/*
 * INSERT
 */

/*
 * Prvo pobrisemo sve sto trenutno ima*/

$pokazi .= '<ul>';

$db->where('ArtikalId', $idArt);
if ($db->delete('artiklitekstovinew')) {
    $obr = true;
} else {
    $obr = false;
}


$db->startTransaction();

if ($jezLan) {
    foreach ($jezLan as $key => $val) {
        $ShortLanguage = $val['ShortLanguage'];
        $IdLanguage = $val['IdLanguage'];

        $insert_query = Array('ArtikalId' => $idArt, 'LanguageId' => $IdLanguage, 'OpisArtTekst' => $sve);
        $db->setQueryOption(Array('IGNORE'));
        $idArtNewInsert = $db->insert('artiklitekstovinew', $insert_query);
    }
}

if (!$idArtNewInsert) {
    echo 'insert failed ARIKAL TEKST u bazi ArtikliTekstovi ->  file je admin/stranice/dodatna/ubaciArtNazivArtOpisBosch.php : ' . $db->getLastError();
    $db->rollback();
    die;
} else {
    $pokazi .= '<li>Id artikla kod nas u bazi je : <a target="_blank" href="'.DPROOT.'/proiz/'.$idArt.'">' . $idArt . '</a><br></li>';
    $pokazi .= '<li>Id artikla kod nas u bazi EDIT je : <a target="_blank" href="'.DPROOTADMIN.'/str/editartikal/'.$idArt.'">' . $idArt . '</a><br></li>';
    $pokazi .= '<li>Vebsop ID je : <a target="_blank" href="http://dodatnaoprema.com/zzz/vvv/'.$idArtDodatna.'">' . $idArtDodatna . '</a></li>';
    $pokazi .= '<li>Naziv artikla  : ' . $model . '<br><br></li>';
    $db->commit();
}

$pokazi .= '</ul>'

// UBACIMO ARTIKAL OPIS ArtikliTekstovi
/*$pokazi .= '<li><strong style="color: #0016b0"> INSERT TEKSTOVI OPIS BOSCH </strong></li>';
$data = Array(
    'IdArtikliTekstovi' => $idArt,
    'OpisArtikliTekstovisrblat' => $sve,
    'OpisArtikliTekstovisrb' => $sve  //$kategorijeDodatna->vice_versa_cySR($sve,'cy')
);
$idNazivTekst = $db->insert('ArtikliTekstovi', $data);
if (!$idNazivTekst) {
    echo 'insert failed ARIKAL TEKST u bazi ArtikliTekstovi ->  file je admin/stranice/dodatna/ubaciArtNazivArtOpisBosch.php : ' . $db->getLastError();
    $db->rollback();
    die;
} else {
    $pokazi .= '<li>Id artikla kod nas u bazi je : ' . $idArt . '<br></li>';
    $pokazi .= '<li>Vebsop ID je : ' . $idArtDodatna . '<br></li>';
    $pokazi .= '<li>Naziv artikla  : ' . $model . '<br><br></li>';
    $db->commit();
}
;*/


?>
