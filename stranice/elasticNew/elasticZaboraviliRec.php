<? if ($totalCountTag == 0) { ?>
    <div id="" class="navi left pozadinabela">
        <div class="navHeaderName"><label class="name">Grupacija po reči</label></div>
        <?
        $samoKategId = '';
        $elLiSearch = '';

        if ($aggregationsTagovi) {

            $elLiSearch .= '<ul class="elSearchKateg" id="">';

            foreach ($aggregationsTagovi AS $k => $keyArt):

                $KategorijaArtikalIdKoje = $keyArt['key'];
                $KategorijaArtikalIdKolikoIma = (int)$keyArt['doc_count'];

                $imaUKategEs = (in_array($KategorijaArtikalIdKoje, $_SESSION['elasticSes']['tagoviEs'])) ? 'X' : '';

                $elLiSearch .= '<li class="esLista">';
                $elLiSearch .= '<a class="ubaciTagEs ' . $imaUKategEs . '" kojaJeKateg="' . $KategorijaArtikalIdKoje . '" href="#">';
                $elLiSearch .= $KategorijaArtikalIdKoje; //.' <span class="font8 bojaplava3g">('.$KategorijaArtikalIdKolikoIma.')</span>';
                $elLiSearch .= '</a>';
                $elLiSearch .= '<a class="bojacrvena removeEsTag" kojaJeKategIzbaci="' . $KategorijaArtikalIdKoje . '" href=""><span>' . $imaUKategEs . '</span></a>';
                $elLiSearch .= '</li>';

            endforeach;
            $elLiSearch .= '</ul>';
        }
        echo $elLiSearch;
        ?>
    </div>

<? } ?>
