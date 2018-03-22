<!-- ============================================== SIDEBAR COMPARISION ============================================== -->
<?php
$cols = Array ("ANN.OpisArtikla", "A.ArtikalLink","A.ArtikalId" );
$db->join("artikli A", "A.ArtikalId = C.ArtCompareId");
$db->join("artikalnazivnew ANN", "ANN.ArtikalId = A.ArtikalId AND  ANN.IdLanguage = $jezikId");
//$db->join("ArtikalNaziv AN", "C.ArtCompareId = AN.IdArtikalNaziv");
$db->where("C.KomitentCompareId", $KomitentId);

$KompaDB = $db->get ("compare C", Array (0, 10), $cols);


$comparearr = '';
if ($KompaDB) {

    $comparearr .= '<div class="compare">';
    $comparearr .= '<h3 class="section-title"><a class="bojaplavasajt" href="/compare">'.$jsonlang[74][$jezikId].'</a></h3>';
    $comparearr .= '<ul>';


    foreach ($KompaDB as $k => $v):
        $nazivKompre = $v['OpisArtikla'];
        $idKompare = $v['ArtikalId'];
        $ArtikalLinkKompare = $v['ArtikalLink'];
        $linkKoma = '/' . $ArtikalLinkKompare . '/' . $idKompare;
        $comparearr .= '<li class="clearfix okvIzbrisi"><a class="pull-left" target="_blank" href="' . $linkKoma . '">' . $nazivKompre . '</a><a href="" class="skiniKompare" data-skini="'.$idKompare.'"><i class="pull-right fa fa-times-circle"></i></a></li>';
    endforeach;

    $comparearr .= '</ul>';

    $comparearr .= '</div>';

    // ovo smo dodali jer ako ima onda odvoj
    $comparearr .= '<div class="odvojKategBaner clearfix"></div>';

    //$comparearr .= '<div><a href="/compare">Compare product</a></div>';

    echo $comparearr;

}

?>

