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

        /*
         * VERZIJA I
         * */
        $params = array($jezikId, $jezikId, $specGrupeId);
        $stupit = "SELECT SV.IdSpecVrednosti, SV.IdGrupeSpecKategorija, SVN.SpecVredNaziv, SGN.NazivSpecGrupe FROM dbo.specvrednosti SV
                        JOIN dbo.specifikacijagrupe SG ON SG.IdGrupeSpecKategorija = SV.IdGrupeSpecKategorija
                        JOIN dbo.specgrupenaz SGN ON  SGN.IdGrupeSpecKategorija = SG.IdGrupeSpecKategorija AND SGN.IdLanguage = ?
                        JOIN dbo.specvrednaziv SVN ON SVN.IdSpecVrednosti = SV.IdSpecVrednosti AND SVN.IdLanguage = ?
                        AND SV.IdGrupeSpecKategorija = ?
                        AND SV.IdSpecVrednosti IN ('$idSpecVred');";
        $getKategOpis = $conn->prepare($stupit);
        $getKategOpis->execute($params);
        $specGrupeNaziv = $getKategOpis->fetchAll(PDO::FETCH_ASSOC);

        $nazivGrupeSpec = $specGrupeNaziv['0']['NazivSpecGrupe'];

        $elLiSearch .= '<div class="table_cell">
                                <fieldset>
                                    <legend>' . $nazivGrupeSpec . '  <span class="esLista font8 pull-right" style="margin: 0 0 0 5px" id="loadMoreModeli">Učitaj još</span> <span class="esLista font8 pull-right" id="showLessModeli">Smanji</span> </legend>
                                        <ul class="checkboxes_list" id="myList_' . $specGrupeId . '">';

        $imaUKategEs = ''; // da se ne bi pamtilo

        if ($nazivGrupeSpec) {
            foreach ($specGrupeNaziv AS $k => $v) {


                $IdGrupeSpecKategorija = (int) $v['IdGrupeSpecKategorija'];
                $IdSpecVrednosti = (int)$v['IdSpecVrednosti'];
                $SpecVredNaziv = $v['SpecVredNaziv'];

                if (!empty($_SESSION['elasticSes']['specVrednosti'][$IdGrupeSpecKategorija])) {
                    $imaUKategEs = (in_array($IdSpecVrednosti, $_SESSION['elasticSes']['specVrednosti'][$IdGrupeSpecKategorija])) ? 'checked="checked"' : '';
                }

                $elLiSearch .= '<li class="esLista">';
                $elLiSearch .= '<input type="checkbox" class="ubaciSpecVrednost" ' . $imaUKategEs . ' kojaJeKateg="' . $IdSpecVrednosti . '" name="manufacturer" id="specvrd_' . $IdSpecVrednosti . '">';
                $elLiSearch .= '<label for="specvrd_' . $IdSpecVrednosti . '">' . $SpecVredNaziv . '</label>';
                $elLiSearch .= '</li>';
            }
        }
        $elLiSearch .= '</ul>
                </fieldset>
            </div>';



        /*
         * VERZIJA II
         * */
        /*
          $params = array($jezikId, $jezikId, $specGrupeId);
          $stupit = "SELECT SG.IdGrupeSpecKategorija, SGN.NazivSpecGrupe FROM dbo.specifikacijagrupe SG
                    JOIN dbo.specgrupenaz SGN ON SGN.IdGrupeSpecKategorija = SG.IdGrupeSpecKategorija AND SGN.IdLanguage = 1
                    WHERE Sg.IdGrupeSpecKategorija = $specGrupeId";
        $specGrupeNaziv = $conn->upitRawObj($stupit);

        $nazivGrupeSpec = $specGrupeNaziv->NazivSpecGrupe;
        $IdGrupeSpecKategorija = $specGrupeNaziv->IdGrupeSpecKategorija;

        $elLiSearch .= '<div class="table_cell">
                                <fieldset>
                                    <legend>' . $nazivGrupeSpec . '  <span class="esLista font8 pull-right" style="margin: 0 0 0 5px" id="loadMoreModeli">Učitaj još</span> <span class="esLista font8 pull-right" id="showLessModeli">Smanji</span> </legend>
                                        <ul class="checkboxes_list" id="myList_' . $specGrupeId . '">';


        $stupit = "SELECT SV.IdSpecVrednosti, SVN.SpecVredNaziv FROM dbo.specvrednosti SV
        JOIN dbo.specvrednaziv SVN ON SVN.IdSpecVrednosti = SV.IdSpecVrednosti AND SVN.IdLanguage = 1
        WHERE SV.IdGrupeSpecKategorija =$IdGrupeSpecKategorija
        AND SV.IdSpecVrednosti IN ('$idSpecVred') ";
        $specGrupeNazivVred = $conn->upitRaw($stupit);

        if ($specGrupeNazivVred) {
            foreach ($specGrupeNazivVred AS $k => $v) {

                $IdSpecVrednosti = (int) $v['IdSpecVrednosti'];
                $SpecVredNaziv = $v['SpecVredNaziv'];

                $imaUKategEs = (in_array($IdSpecVrednosti, $_SESSION['elasticSes']['specVrednosti'])) ? 'checked="checked"' : '';

                $elLiSearch .= '<li class="esLista">';
                $elLiSearch .= '<input type="checkbox" class="ubaciSpecVrednost" ' . $imaUKategEs . ' kojaJeKateg="' . $IdSpecVrednosti . '" name="manufacturer" id="specvrd_' . $IdSpecVrednosti . '">';
                $elLiSearch .= '<label for="specvrd_' . $IdSpecVrednosti . '">' . $SpecVredNaziv . '</label>';
                $elLiSearch .= '</li>';
            }
        }
        $elLiSearch .= '</ul>
                </fieldset>
            </div>';*/






    endforeach;
}

echo $elLiSearch;
?>



