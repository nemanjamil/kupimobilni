<?php

if (!$_SESSION['elasticSes']['kategorije']) {
    $_SESSION['elasticSes']['kategorije'] = array();
}


$samoKategId = '';
if ($aggregationsKateg) {
    foreach ($aggregationsKateg AS $k => $keyArt):

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
    $sqlEs = "SELECT KA.KategorijaArtikalaId,KA.KategorijaArtikalaLink, KAN.NazivKategorije FROM kategorijeartikala KA
JOIN kategorijeartikalanaslov KAN ON KA.KategorijaArtikalaId = KAN.IdKategorije AND KAN.IdLanguage = $jezikId
WHERE KA.KategorijaArtikalaId IN ('$ids')";

    $upitEsKateg = $db->rawQuery($sqlEs);

    function sortArrayMultiZaElasticKategorije($a, $b)
    {
        if ($a["KategorijaArtiklaNaziv"] == $b["KategorijaArtiklaNaziv"]) {
            return 0;
        }
        return ($a["KategorijaArtiklaNaziv"] < $b["KategorijaArtiklaNaziv"]) ? -1 : 1;
    }

    usort($upitEsKateg,"sortArrayMultiZaElasticKategorije");

    if ($upitEsKateg) {

        $elLiSearch .= '<div class="panel panel-default wow fadeIn" data-wow-delay="0.2s">';
        $elLiSearch .= '<div class="panel-heading" role="tab" id="headingOne"><h4 class="panel-title">
            <!--<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">-->
            <a data-toggle="collapse" data-parent="#accordion" aria-expanded="true" aria-controls="collapseOne">
                '.$jsonlang[21][$jezikId].' </a>
        </h4>
    </div>';
        $elLiSearch .= '<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
        <div class="panel-body">
            <ul class="checkboxes_list">';
        foreach ($upitEsKateg AS $k => $v) {


            $KategorijaArtikalIdESKateg = $v['KategorijaArtikalaId'];
            $KategorijaArtikalaNazivEsKateg = $v['NazivKategorije'];
            $KategorijaArtikalaLinkEsKateg = $v['KategorijaArtikalaLink'];

            $imaUKategEs = (in_array($KategorijaArtikalIdESKateg, $_SESSION['elasticSes']['kategorije'])) ? 'checked="checked"' : '';

            $elLiSearch .= '<li>';
            $elLiSearch .= '<div class="checkbox"><label for="kategEs_'.$KategorijaArtikalIdESKateg.'">';
            $elLiSearch .= '<input type="checkbox" class="ubaciKategEs" kojaJeKateg="' . $KategorijaArtikalIdESKateg . '" '.$imaUKategEs.' name="manufacturer" id="kategEs_'.$KategorijaArtikalIdESKateg.'">';
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
