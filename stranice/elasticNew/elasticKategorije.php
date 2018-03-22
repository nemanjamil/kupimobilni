<style>
    #myList li{ display:none;
    }
    #loadMore {
        color:green;
        cursor:pointer;
    }
    #loadMore:hover {
        color:black;
    }
    #showLess {
        color:red;
        cursor:pointer;
    }
    #showLess:hover {
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
        $sqlEs = "SELECT KategorijaArtiklaId,KategorijaArtiklaNaziv,KategorijaArtikalaLink FROM dbo.kategorijeartikala WHERE KategorijaArtiklaId IN ('$ids')";
        $upitEsKateg = $conn->upitRaw($sqlEs);

        function sortArrayMultiZaElasticKategorije($a, $b)
        {
            if ($a["KategorijaArtiklaNaziv"] == $b["KategorijaArtiklaNaziv"]) {
                return 0;
            }
            return ($a["KategorijaArtiklaNaziv"] < $b["KategorijaArtiklaNaziv"]) ? -1 : 1;
        }

        usort($upitEsKateg,"sortArrayMultiZaElasticKategorije");

        if ($upitEsKateg) {

            $elLiSearch .= '<div class="table_cell">
                                <fieldset>
                                    <legend>Kategorije <span class="esLista font8 pull-right" style="margin: 0 0 0 5px" id="loadMore">Učitaj još</span> <span class="esLista font8 pull-right" id="showLess">Smanji</span></legend>
                                    <ul class="checkboxes_list elSearchKateg" id="myList">';
            foreach ($upitEsKateg AS $k => $v) {


                $KategorijaArtikalIdESKateg = $v['KategorijaArtiklaId'];
                $KategorijaArtikalaNazivEsKateg = $v['KategorijaArtiklaNaziv'];
                $KategorijaArtikalaLinkEsKateg = $v['KategorijaArtikalaLink'];

                $imaUKategEs = (in_array($KategorijaArtikalIdESKateg, $_SESSION['elasticSes']['kategorije'])) ? 'checked="checked"' : '';

                $elLiSearch .= '<li class="esLista">';
                $elLiSearch .= '<input type="checkbox" class="ubaciKategEs" kojaJeKateg="' . $KategorijaArtikalIdESKateg . '" '.$imaUKategEs.' name="manufacturer" id="kategEs_'.$KategorijaArtikalIdESKateg.'">';
                $elLiSearch .= '<label for="kategEs_'.$KategorijaArtikalIdESKateg.'">'.$KategorijaArtikalaNazivEsKateg.'</label>';
                $elLiSearch .= '</li>';
                /*$elLiSearch .= '<li class="esLista">';
                $elLiSearch .= '<a class="ubaciKategEs ' . $imaUKategEs . '" kojaJeKateg="' . $KategorijaArtikalIdESKateg . '" href="#">';
                $elLiSearch .= $KategorijaArtikalaNazivEsKateg;
                $elLiSearch .= '</a>';
                $elLiSearch .= '<a class="bojacrvena removeEsKateg" kojaJeKategIzbaci="' . $KategorijaArtikalIdESKateg . '" href=""><span>' . $imaUKategEs . '</span></a>';
                $elLiSearch .= '</li>';*/

            }
                        $elLiSearch .= '</ul>
                </fieldset>
            </div>';

            /*$elLiSearch .= '<ul class="loadMoreUl">';
            $elLiSearch .= '<li class="esLista" id="loadMore">Učitaj još</li>';
            $elLiSearch .= '<li class="esLista" id="showLess">Smanji</li>';
            $elLiSearch .= '</ul>';*/
        }
    }

    echo $elLiSearch;
    ?>


