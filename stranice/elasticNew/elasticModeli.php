<style>
    #myListModeli li{ display:none;
    }
    #loadMoreModeli {
        color:green;
        cursor:pointer;
    }
    #loadMoreModeli:hover {
        color:black;
    }
    #showLessModeli {
        color:red;
        cursor:pointer;
    }
    #showLessModeli:hover {
        color:black;
    }
    ul.loadMoreUl {
        margin: 10px 10px 13px 20px !important;
    }
    ul.loadMoreUl li {
        font-size: 12px;
    }
</style>




    <?
    $kategAggr = array();
    $samoKategId = array();
    $samoKategId = '';
    if ($aggregationsModeli) {
        foreach ($aggregationsModeli AS $k => $keyArt):

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
        $sqlEs = "SELECT ModelId,ModelNaziv FROM dbo.Modeli WHERE ModelId IN ('$ids')";
        $upitEsKateg = $conn->upitRaw($sqlEs);


        function sortArrayMultiZaElasticModeli($a, $b)
        {
            if ($a["ModelNaziv"] == $b["ModelNaziv"]) {
                return 0;
            }
            return ($a["ModelNaziv"] < $b["ModelNaziv"]) ? -1 : 1;
        }

        usort($upitEsKateg,"sortArrayMultiZaElasticModeli");

        if ($upitEsKateg) {

            $elLiSearch .= '<div class="table_cell">
                                <fieldset>
                                    <legend>Modeli  <span class="esLista font8 pull-right" style="margin: 0 0 0 5px" id="loadMoreModeli">Učitaj još</span> <span class="esLista font8 pull-right" id="showLessModeli">Smanji</span> </legend>
                                        <ul class="checkboxes_list elSearchKateg" id="myListModeli">';

            foreach ($upitEsKateg AS $k => $v) {


                $ModelIdEs = $v['ModelId'];
                $ModelNazivEs = $v['ModelNaziv'];

                $imaUKategEs = (in_array($ModelIdEs, $_SESSION['elasticSes']['modeli'])) ? 'checked="checked"' : '';

                $elLiSearch .= '<li class="esLista">';
                    $elLiSearch .= '<input type="checkbox" class="ubaciModelEs" '.$imaUKategEs.' kojaJeKateg="' . $ModelIdEs . '" name="manufacturer" id="model_'.$ModelIdEs.'">';
                    $elLiSearch .= '<label for="model_'.$ModelIdEs.'">'.$ModelNazivEs.'</label>';
                $elLiSearch .= '</li>';

               /* $elLiSearch .= '<li class="esLista">';
                $elLiSearch .= '<a class="ubaciModelEs ' . $imaUKategEs . '" kojaJeKateg="' . $ModelIdEs . '" href="#">';
                $elLiSearch .= $ModelNazivEs;
                $elLiSearch .= '</a>';
                $elLiSearch .= '<a class="bojacrvena removeEsModel" kojaJeKategIzbaci="' . $ModelIdEs . '" href=""><span>' . $imaUKategEs . '</span></a>';
                $elLiSearch .= '</li>';*/

            }
                        $elLiSearch .= '</ul>
                </fieldset>
            </div>';

            /*$elLiSearch .= '<ul class="loadMoreUl">';
            $elLiSearch .= '<li class="esLista" id="loadMoreModeli">Učitaj još</li>';
            $elLiSearch .= '<li class="esLista" id="showLessModeli">Smanji</li>';
            $elLiSearch .= '</ul>';*/
        }
    }

    echo $elLiSearch;
    ?>



