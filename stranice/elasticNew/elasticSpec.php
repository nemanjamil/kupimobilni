<div id="" class="navi left pozadinabela">
    <div class="navHeaderName"><label class="name">Specifikacije GRUPE</label></div>


    <?

    if (!$_SESSION['elasticSes']['specKategAggs']) {
        $_SESSION['elasticSes']['specKategAggs'] = array();
    }


    $samoKategSpecId = '';
    if ($specKategAggs) {
        foreach ($specKategAggs AS $k => $keyArt):

            $specKategAgg = (int)$keyArt['key'];
            $specKategAggKolikoIma = (int)$keyArt['doc_count'];

            /*$specKategUpitAggr['specKategAgg'] = $specKategAgg;
            $specKategUpitAggr['specKategAggKolikoIma'] = $specKategAggKolikoIma;*/

            $samoKategSpecId[] = $specKategAgg;

        endforeach;
    }

    $elLiSearch = '';

    if ($samoKategSpecId) {
        $ids = join("','", $samoKategSpecId);
        $sqlEs = "SELECT SGN.IdGrupeSpecKategorija, SGN.NazivSpecGrupe FROM dbo.specifikacijagrupe SG
                    JOIN dbo.specgrupenaz SGN ON SGN.IdGrupeSpecKategorija = SG.IdGrupeSpecKategorija AND SGN.IdLanguage = $jezikId
                    WHERE SG.IdGrupeSpecKategorija IN ('$ids')";
        $upitEsKateg = $conn->upitRaw($sqlEs);

        function sortArrayMultiZaElasticSpecGrupeKategorije($a, $b)
        {
            if ($a["NazivSpecGrupe"] == $b["NazivSpecGrupe"]) {
                return 0;
            }
            return ($a["NazivSpecGrupe"] < $b["NazivSpecGrupe"]) ? -1 : 1;
        }

        usort($upitEsKateg,"sortArrayMultiZaElasticSpecGrupeKategorije");


        if ($upitEsKateg) {

            $elLiSearch .= '<ul class="elSearchKateg" id="myListXXX">';
            foreach ($upitEsKateg AS $k => $v) {

                $IdGrupeSpecKategorija = (int) $v['IdGrupeSpecKategorija'];
                $NazivSpecGrupe = $v['NazivSpecGrupe'];


                $imaUKategEs = (in_array($IdGrupeSpecKategorija, $_SESSION['elasticSes']['specKategAggs'])) ? 'X' : '';

                $elLiSearch .= '<li class="esLista">';
                $elLiSearch .= '<a class="ubaciKategEs ' . $imaUKategEs . '" kojaJeKateg="' . $IdGrupeSpecKategorija . '" href="#">';
                $elLiSearch .= $NazivSpecGrupe;
                $elLiSearch .= '</a>';
                $elLiSearch .= '<a class="bojacrvena removeEsKateg" kojaJeKategIzbaci="' . $IdGrupeSpecKategorija . '" href=""><span>' . $imaUKategEs . '</span></a>';
                $elLiSearch .= '</li>';

            }
            $elLiSearch .= '</ul>';

            $elLiSearch .= '<ul class="loadMoreUl">';
            $elLiSearch .= '<li class="esLista" id="loadMore">Učitaj još</li>';
            $elLiSearch .= '<li class="esLista" id="showLess">Smanji</li>';
            $elLiSearch .= '</ul>';
        }
    }

    echo $elLiSearch;
    ?>


</div>

