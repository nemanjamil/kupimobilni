<?php
$upitKateg = "CALL listaKategorijaPoParent(2,$tipUsera,0,100)";
$katspGlavne = $db->rawQuery($upitKateg);
if ($katspGlavne) {

    $kaL .= '<div class="col-xs-12 col-sm-12 col-md-12">';
    $kaL .= '<h2 class="title minsirinah"><a class="bojacrnadef" href="/voce">' . $jsonlang[171][$jezikId] . '</a></h2>';

    $kaL .= '<ul class="links">';
    foreach ($katspGlavne AS $kay => $val) {
        $KategorijaArtikalaNazivMM = $val['Kat' . $jezik];
        $KategorijaArtikalaLinkMM = $val['KategorijaArtikalaLink'];
        $kaL .= '<li><a href="/'.$KategorijaArtikalaLinkMM.'">'.$KategorijaArtikalaNazivMM.'</a></li>';
    }
    $kaL .= '</ul>';
    $kaL .= '</div>';
}
echo $kaL;
$kaL = '';
?>
