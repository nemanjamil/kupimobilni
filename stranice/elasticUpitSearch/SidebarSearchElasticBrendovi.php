<?php

if (!$_SESSION['elasticSes']['brendovi']) {
    $_SESSION['elasticSes']['brendovi'] = array();
}


$samoKategId = '';
$kategUpitAggr = '';
if ($aggregationsBrendovi) {
    foreach ($aggregationsBrendovi AS $k => $keyArt):

        $KategorijaArtikalIdKoje = (int)$keyArt['key'];
        $KategorijaArtikalIdKolikoIma = (int)$keyArt['doc_count'];

        $kategUpitAggr['KategorijaArtikalIdKoje'] = $KategorijaArtikalIdKoje;
        $kategUpitAggr['KategorijaArtikalIdKolikoIma'] = $KategorijaArtikalIdKolikoIma;
        $kategAggr[] = $kategUpitAggr;

        $samoKategId[] = $KategorijaArtikalIdKoje;

    endforeach;
}

$elLiSearch = '';
if ($samoKategId) {
    $ids = join("','", $samoKategId);
    $sqlEs = "SELECT B.BrendId, B.BrendLink, BI.BrendIme
              FROM brendovi B
              LEFT JOIN brendoviime BI ON BI.BrendId = B.BrendId AND BI.IdLanguage = $jezikId
              WHERE B.BrendId IN  ('$ids')";


    $upitEsKateg = $db->rawQuery($sqlEs);


    function sortArrayMultiZaElasticBrend($a, $b)
    {
        if ($a["BrendIme"] == $b["BrendIme"]) {
            return 0;
        }
        return ($a["BrendIme"] < $b["BrendIme"]) ? -1 : 1;
    }

    usort($upitEsKateg,"sortArrayMultiZaElasticBrend");


    if ($upitEsKateg) {

        $elLiSearch .= '<div class="panel panel-default wow fadeIn" data-wow-delay="0.2s">';
        $elLiSearch .= '<div class="panel-heading" role="tab" id="headingTwo"><h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" aria-expanded="true" aria-controls="collapseTwo">
            <!--<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">-->
                '.$jsonlang[91][$jezikId].' </a>
        </h4>
    </div>';
        $elLiSearch .= '<div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
        <div class="panel-body">
            <ul class="checkboxes_list">';
        foreach ($upitEsKateg AS $k => $v) {


            $KategorijaArtikalIdESKateg = $v['BrendId'];
            $KategorijaArtikalaNazivEsKateg = $v['BrendIme'];
            $KategorijaArtikalaLinkEsKateg = $v['BrendLink'];

            $imaUKategEs = (in_array($KategorijaArtikalIdESKateg, $_SESSION['elasticSes']['brendovi'])) ? 'checked="checked"' : '';


            $elLiSearch .= '<li>';
            $elLiSearch .= '<div class="checkbox"><label for="kategEs_'.$KategorijaArtikalIdESKateg.'">';
            $elLiSearch .= '<input type="checkbox" class="ubaciBrendEs" kojaJeKateg="' . $KategorijaArtikalIdESKateg . '" '.$imaUKategEs.' name="brendEs" id="brendEs'.$KategorijaArtikalIdESKateg.'">';
            $elLiSearch .= $KategorijaArtikalaNazivEsKateg.'</label></div>';
            $elLiSearch .= '</li>';


        }
        $elLiSearch .= '</ul>
        </div>
    </div>';
        $elLiSearch .= '</div>';
    }
}

echo $elLiSearch;
?>

