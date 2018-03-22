<?php

$cols = Array("KategorijaArtikalaId", "KategorijaArtikalaLink");
$db->where("Kategorija_dodatna", $kategorija_id);
$users = $db->getOne("kategorijeartikala", null, $cols);


if ($db->count <= 0) {

    $pokazi .= '<ul style="border: 1px dashed darkgray">';
    $pokazi .= '<li> <strong style="color: red">Ne postoji kategoija za artikal id Vebsop ' . $idArtDodatna . '</strong></li>';
    $pokazi .= '<li>Kategorija Vebsop je : ' . $kategorija_id . '</li>';
    $pokazi .= '<li>Znaci da moras da napravis na AGRO bazi kategoriju gde upada artikal. To je na linku povuciKategorijeOpstalo</li>';
    $pokazi .= '</ul>';

    //echo $pokazi;
    continue;


} else {

    $kategorijaAgro = (int) $users['KategorijaArtikalaId'];
    $KategorijaArtikalaLink = $users['KategorijaArtikalaLink'];

    $pokazi .= '<ul style="border: 1px dashed coral">';
    $pokazi .= '<li> <strong style="color: red">Pripada kategoriji <a target="_blank" href="' . DPROOTADMIN . '/kat/' . $kategorijaAgro . '">' . $KategorijaArtikalaLink . '</a></strong></li>';
    $pokazi .= '<li>Id kategorije ' . $kategorijaAgro . '</li>';
    $pokazi .= '</ul>';
    //echo $pokazi;
}


if (!$kategorijaAgro) {
    echo $pokazi;
    die;
}

?>