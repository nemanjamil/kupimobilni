<?
$elLiSearch = '';
if ($specVrednostAggs) {
    foreach ($specVrednostAggs AS $k => $keyArt):
        $specVrednostAggsId = (int)$keyArt['key'];
        $specVredAggr[] = $specVrednostAggsId;
    endforeach;

    $idSpecVred = join("','", $specVredAggr);
}

if ($specKategAggs && $specVrednostAggs) {
    foreach ($specKategAggs AS $k => $keyArt):

        $specGrupeId = (int)$keyArt['key'];
        $specGrupeDocCount = (int)$keyArt['doc_count'];

        $stupit = "SELECT
                         SV.IdSpecVrednosti,
                         SV.IdSpecVrednostiGrupe,
                         SVN.SpecVredNaziv,
                         SGN.NazivSpecGrupe
                    FROM
                         specvrednosti SV
                    JOIN specifikacijagrupe SG ON SG.IdSpecGrupe = SV.IdSpecVrednostiGrupe
                    JOIN specgrupenaz SGN ON SGN.IdSpecGrupe = SG.IdSpecGrupe AND SGN.IdLanguage = $jezikId
                    JOIN specvrednaziv SVN ON SVN.IdSpecVrednosti = SV.IdSpecVrednosti
                    AND SVN.IdLanguage = $jezikId
                    AND SV.IdSpecVrednostiGrupe = $specGrupeId
                    AND SV.IdSpecVrednosti IN ('$idSpecVred');";
        $specGrupeNaziv = $db->rawQuery($stupit);


        $nazivGrupeSpec = $specGrupeNaziv['0']['NazivSpecGrupe'];
        $elLiSearch .= '<div class="panel panel-default wow fadeIn" data-wow-delay="0.2s">';
        $elLiSearch .= '<div class="panel-heading" role="tab" id="headingThree"><h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" aria-expanded="true" aria-controls="collapseThree">
            <!--<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="true" aria-controls="collapseTwo">-->
                ' . $nazivGrupeSpec . ' </a>
        </h4>
    </div>';
        $elLiSearch .= '<div id="collapseThree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree">
        <div class="panel-body">
            <ul class="checkboxes_list" id="myList_' . $specGrupeId . '">';

        $imaUKategEs = ''; // da se ne bi pamtilo

        if ($nazivGrupeSpec) {
            foreach ($specGrupeNaziv AS $k => $v) {

                $IdGrupeSpecKategorija = (int)$v['IdSpecVrednostiGrupe'];
                $IdSpecVrednosti = (int)$v['IdSpecVrednosti'];
                $SpecVredNaziv = $v['SpecVredNaziv'];

                if (!empty($_SESSION['elasticSes']['specVrednosti'][$IdGrupeSpecKategorija])) {
                    $imaUKategEs = (in_array($IdSpecVrednosti, $_SESSION['elasticSes']['specVrednosti'][$IdGrupeSpecKategorija])) ? 'checked="checked"' : '';
                }

                $elLiSearch .= '<li class="esLista">';
                $elLiSearch .= '<div class="checkbox"><label for="specvrd_' . $IdSpecVrednosti . '">';
                $elLiSearch .= '<input type="checkbox" class="ubaciSpecVrednost"' . $imaUKategEs . '  kojaJeKateg="' . $IdSpecVrednosti . '" name="manufacturer" id="specvrd_' . $IdSpecVrednosti . '">';
                $elLiSearch .= $SpecVredNaziv . '</label></div>';
                $elLiSearch .= '</li>';
            }
        }
        $elLiSearch .= '</ul>
        </div>
    </div>';
        $elLiSearch .= '</div>';


    endforeach;
}

echo $elLiSearch;
?>



