<?php
echo ini_get('display_errors');
ini_set('max_execution_time', 0);


$upit1 = $db->get('kategorijeartikala', null, 'KategorijaArtikalaId, KategorijaArtikalaSlika, KategorijaArtikalaTitle');

foreach ($upit1 as $k => $v1) {
    $KategorijaArtikalaId = $v1['KategorijaArtikalaId'];
    $KategorijaArtikalaSlika = $v1['KategorijaArtikalaSlika'];
    $KategorijaArtikalaTitle = $v1['KategorijaArtikalaTitle'];

    $slikanaziv = $common->friendly_convert($KategorijaArtikalaTitle);

    $slika = $slikanaziv . '.png';

    $update_input = Array(
        'KategorijaArtikalaSlika' => $slika
    );

    $db->where('KategorijaArtikalaId', $KategorijaArtikalaId);
    if ($db->update('kategorijeartikala', $update_input)) {

        echo '<b class="bojaplavasajt">'.$db->count . '</b> records were updated: <b class="bojaplavasajt">'.$KategorijaArtikalaTitle.'</b>';
        echo '</br>';
    } else {

        echo '<b class="bojacrvena"> update failed: ' . $db->getLastError() . '<b class="bojacrvena">'.$KategorijaArtikalaTitle.'</b>';
        echo '</br>';

    }

}


?>

<h1 class="centriraj">Zavrsen proces ubacivanja slika u tabelu Kategorije.</h1>
