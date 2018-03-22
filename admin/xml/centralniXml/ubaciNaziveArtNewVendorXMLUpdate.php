<?php
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

        $insert_queryOpisNaz = Array(
            'OpisArtikla' => $modelNew
        );
        $db->where ('ArtikalId', $ArtikalId);
        $db->where ('IdLanguage', $IdLanguage);
        $db->update('artikalnazivnew', $insert_queryOpisNaz);



    endforeach;
} else {
    echo 'Ne postoji varijabla jezLan u index-u';
    die;
}


?>