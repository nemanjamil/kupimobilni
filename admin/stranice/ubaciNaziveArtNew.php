<?php
if ($jezLan) {
foreach ($jezLan as $k => $v):
    $ShortLanguage = $v['ShortLanguage'];
    $IdLanguage = $v['IdLanguage'];

    $insert_queryOpisNaz = Array(
        'ArtikalId' => $id,
        'IdLanguage' => $IdLanguage
    );
    $idTekst = $db->insert('artikalnazivnew', $insert_queryOpisNaz);

endforeach;
} else {
    echo 'Ne postoji varijabla jezLan u inexu';
    die;
}
?>