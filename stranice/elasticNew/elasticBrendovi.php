   <?

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
        $sqlEs = "SELECT id,BrendIme,BrendLink FROM dbo.brendovi WHERE id IN  ('$ids')";
        $upitEsKateg = $conn->upitRaw($sqlEs);

        function sortArrayMultiZaElasticBrend($a, $b)
        {
            if ($a["BrendIme"] == $b["BrendIme"]) {
                return 0;
            }
            return ($a["BrendIme"] < $b["BrendIme"]) ? -1 : 1;
        }

        usort($upitEsKateg,"sortArrayMultiZaElasticBrend");


        if ($upitEsKateg) {

            $elLiSearch .= '<div class="table_cell">
                                <fieldset>
                                    <legend>Brendovi</legend>
                                    <ul class="checkboxes_list">';
            foreach ($upitEsKateg AS $k => $v) {


                $KategorijaArtikalIdESKateg = $v['id'];
                $KategorijaArtikalaNazivEsKateg = $v['BrendIme'];
                $KategorijaArtikalaLinkEsKateg = $v['BrendLink'];

                $imaUKategEs = (in_array($KategorijaArtikalIdESKateg, $_SESSION['elasticSes']['brendovi'])) ? 'checked="checked"' : '';

                $elLiSearch .= '<li class="esLista">';
                    $elLiSearch .= '<input type="checkbox" class="ubaciBrendEs" kojaJeKateg="' . $KategorijaArtikalIdESKateg . '" '.$imaUKategEs.' name="brendEs" id="brendEs'.$KategorijaArtikalIdESKateg.'">';
                    $elLiSearch .= '<label for="brendEs'.$KategorijaArtikalIdESKateg.'">'.$KategorijaArtikalaNazivEsKateg.'</label>';
                $elLiSearch .= '</li>';

               /* $elLiSearch .= '<li class="esLista">';
                $elLiSearch .= '<a class="ubaciBrendEs ' . $imaUKategEs . '" kojaJeKateg="' . $KategorijaArtikalIdESKateg . '" href="#">';
                $elLiSearch .= $KategorijaArtikalaNazivEsKateg;
                $elLiSearch .= '</a>';
                $elLiSearch .= '<a class="bojacrvena removeEsBrend" kojaJeKategIzbaci="' . $KategorijaArtikalIdESKateg . '" href=""><span>' . $imaUKategEs . '</span></a>';
                $elLiSearch .= '</li>';*/

            }
                        $elLiSearch .= '</ul>
                </fieldset>
            </div>';
        }
    }

    echo $elLiSearch;
    ?>


