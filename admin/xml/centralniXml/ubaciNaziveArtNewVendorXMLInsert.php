<?php

$db->where('ArtikalId', $idUbacenogart);
if ($db->delete('artikalnazivnew')) {
    $pokazi .= '<li>Obrisali smo sve NAZIVE za taj artikal iz baze</li>';
} else {
    $pokazi .= '<li>NISMO Obrisali smo sve NAZIVE za taj artikal iz baze</li>';
}


if ($jezLan) {
    foreach ($jezLan as $k => $v):
        $ShortLanguage = $v['ShortLanguage'];
        $IdLanguage = $v['IdLanguage'];

        $kategorijeDodatna->vice_versa_cySR($naziv, 'cy');

        switch ($IdLanguage) {
            case 1:  // srb
                $modelNew = $kategorijeDodatna->vice_versa_cySR($naziv, 'cy');
                break;
            case 2: // eng
                $modelNew = $naziv;
                continue;
                break;
            case 3: // ger
                $modelNew = $naziv;
                continue;
            case 4: // rus
                $modelNew = $naziv;
                continue;
            case 5: // srblat
                $modelNew = $naziv;
            break;
        }

        if (!$modelNew) {
            echo 'Ne postoji naziv artikla - ubaciNaziveArtNewVendorXMLInsert';
            $log->lwrite('Ne postoji naziv artikla '.$codetip.' : '.$naziv);
            echo $pokazi;
            die;
        }
        $insert_queryOpisNaz = Array(
            'ArtikalId' => $idUbacenogart,
            'IdLanguage' => $IdLanguage,
            'OpisArtikla' => $modelNew
        );
        $idTekstNew = $db->insert('artikalnazivnew', $insert_queryOpisNaz);


        if (!$idTekstNew) {
            echo 'Nije upisano u bazu novu -> Naziv artikla ';
            echo '<br/>';
            var_dump($insert_queryOpisNaz);
            echo  $db->getLastError();
            die;
        }

        $pokazi .=  '<li>Id Ubacenog Naziva artikla  : ' . $idTekstNew . ' za '.$modelNew.'</li>';

    endforeach;
} else {
    echo 'Ne postoji varijabla jezLan u index-u';
    die;
}


?>