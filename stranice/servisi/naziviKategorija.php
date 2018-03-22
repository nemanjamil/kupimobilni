<?php
echo '<div style="background-color: #c7e2eb;padding: 10px;border: 2px solid">';

$db->where('KategorijaArtiklaExtId', $ID);
$kateg = $db->getOne('kategorijeartikala', 'KategorijaArtikalaId');
$KategorijaArtikalaId = $kateg['KategorijaArtikalaId'];

echo '<b class="bojaljubsvetank" >Selektovana kategorija - KategorijaArtikalaId: ' . $KategorijaArtikalaId . '</b>';
echo '</br>';


$db->where('IdKategorije', $KategorijaArtikalaId);
$db->where('IdLanguage', 5);
$kateg = $db->getOne('kategorijeartikalanaslov', 'NazivKategorije');
$NazivKategorije = $kateg['NazivKategorije'];



if ($NazivKategorije) {

    $update_Naziv_query = Array(
        'NazivKategorije' => $naziv,
    );

    $db->where('Idkategorije', $KategorijaArtikalaId);
    $db->where('IdLanguage', 5);
    $db->update('kategorijeartikalanaslov', $update_Naziv_query);

    echo '<b class="pozadinasiva"> Odradjen update u bazu - naziv: ' . $naziv . '</b>';
    echo '</br>';
    echo '</br>';



} else {

    $insert_Naziv_query = Array(
        'IdKategorije' => $KategorijaArtikalaId,
        'IdLanguage' => 5,
        'NazivKategorije' => $naziv,
    );
    $idUbac = $db->insert('kategorijeartikalanaslov', $insert_Naziv_query);


    echo '<b class="bojaplavasajt"> Odradjen insert - ubacen u naziv: ' . $naziv . '</b>';
    echo '</br>';
    echo '</br>';

}

echo '</div>';

?>