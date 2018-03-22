<?php
if ($idArt) {
    $pokazi .= '<div style="border: 1px solid #000000; padding: 40px;background-color: #DEDEDE">';
        $stjobr = $common->obrisiFolderodIdRazno($lokslifol);
        $pokazi .= '<li>$stajeObisano : ' . $stjobr . '</li>';

        $stjobrBaza = $common->obrisiSlikeIzBaze($idArt);
        $pokazi .= '<li>$stajeObisanoBaza : ' . $stjobrBaza . '</li>';
    $pokazi .= '</div>';
} else {
    echo 'idArt ne postoji';
    die;
}

?>