<?php
if ($jezLan) {
    foreach ($jezLan as $k => $v):
        $ShortLanguage = $v['ShortLanguage'];
        $IdLanguage = $v['IdLanguage'];

        $kategorijeDodatna->vice_versa_cySR($model, 'cy');

        switch ($IdLanguage) {
            case 1:  // srb
                $modelNew = $kategorijeDodatna->vice_versa_cySR($model, 'cy');
                break;
            case 2: // eng
                $modelNew = $model;
                continue;
                break;
            case 3: // ger
                $modelNew = $model;
                continue;
            case 4: // rus
                $modelNew = $model;
                continue;
            case 5: // srblat
                $modelNew = $model;
            break;
        }

        $insert_queryOpisNaz = Array(
            'ArtikalId' => $idArt,
            'IdLanguage' => $IdLanguage,
            'OpisArtikla' => $modelNew
        );
        $idTekstNew = $db->insert('artikalnazivnew', $insert_queryOpisNaz);

        if (!$idTekstNew) {
            echo 'Nije upisano u bazu novu -> Naziv artikla';
            die;
        }

        $pokazi .=  '<li>Id Ubacenog Naziva artikla  : ' . $idTekstNew . '</li>';

    endforeach;
} else {
    echo 'Ne postoji varijabla jezLan u index-u';
    die;
}


?>