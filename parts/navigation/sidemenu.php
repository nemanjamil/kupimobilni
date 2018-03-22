<?php
$sesPodzaSpec = $_SESSION['specPodaci'];
if ($sesPodzaSpec) {
    foreach ($sesPodzaSpec as $k => $v) {
        $sesPodKey[] = $k;
    }
} else {
    $sesPodKey = array();
}

$cols = Array("SG.IdSpecGrupe", "SG.OtvZarvSpecGrupe", "SGN.NazivSpecGrupe");
$db->join("specifikacijagrupe SG", "SG.IdSpecGrupe = SK.IdGrupeSpecKategorija");
$db->join("specgrupenaz SGN", "SGN.IdSpecGrupe = SG.IdSpecGrupe AND SGN.IdLanguage = $jezikId");
$db->where("SK.IdSpecKategorija", $KategorijaArtikalaIdOS);
$db->orderBy("SG.IdSpecGrupe", "ASC"); //  MestoSpecGrupe ako stavimo ovo onda moramo da setujemo na sajtu
$spacgrupeKat = $db->get("speckategorija SK", null, $cols);


if ($db->count > 0) {

    $sg .= '<div class="sidebar-filter col-md-12 col-sm-12 col-xs-12 no-padding hidden-xs">
                <div class="side-menu">
                <div class="panel-group specZaSpec" id="accordion" role="tablist" aria-multiselectable="true">';

    $sg .= '<form id="SpecForma" action="" method="POST">';
    /*<input type ="checkbox" name="cBox[]" value = "3" onchange="document.getElementById('formName').submit()">3</input>
    <input type="submit" name="submit" value="Search" />*/


    foreach ($spacgrupeKat as $ky => $vspk) {

        $IdSpecGrupeKat = $vspk['IdSpecGrupe'];
        $ImeSpecGrupeKat = $vspk['NazivSpecGrupe'];
        $OtvZarvSpecGrupe = $vspk['OtvZarvSpecGrupe'];


        /* wowXXX ovo smo dodali da nema hajdovanja */

        $sg .= '<div class="panel panel-default wowXXX fadeIn" data-wow-delay="0.2s">';
        $sg .= '<div class="panel-heading" role="tab" id="headingOne' . $IdSpecGrupeKat . '">';
        $sg .= '<h4 class="panel-title">';
        // otvoreno sve aria-expanded="true"
        // zatvoreno aria-expanded="false" i dodajemo klasu class="collapsed"


        $uptOZ = ($OtvZarvSpecGrupe || in_array($IdSpecGrupeKat, $sesPodKey)) ? 'aria-expanded="true"' : 'class="collapsed" aria-expanded="false" ';

        $sg .= '<a  ' . $uptOZ . ' data-toggle="collapse" data-parent="#accordion" href="#collapseOne' . $IdSpecGrupeKat . '"  aria-controls="collapseOne' . $IdSpecGrupeKat . '">' . $ImeSpecGrupeKat . '</a>';

        $sg .= '</h4>';
        $sg .= '</div>';


        // otvoreno class="panel-collapse collapse in"   i aria-expanded="true"
        // zatvoreno aria-expanded="false" i  class="panel-collapse collapse"
        $uptOZ = ($OtvZarvSpecGrupe || in_array($IdSpecGrupeKat, $sesPodKey)) ? 'class="panel-collapse collapse in" aria-expanded="true"' : 'aria-expanded="false" class="panel-collapse collapse"';

        $sg .= '<div ' . $uptOZ . ' id="collapseOne' . $IdSpecGrupeKat . '"  role="tabpanel" aria-labelledby="headingOne' . $IdSpecGrupeKat . '">';
        //$sg .= '<div style="height: 0px;" aria-expanded="false" id="collapseOne"                        class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">';
        //$sg .= '<div style="" aria-expanded="true" id="collapseThree" class="panel-collapse collapse in" role="tabpanel"  aria-labelledby="headingThree">
        $sg .= '<div class="panel-body">';

        //$cols = Array("SV.IdSpecVrednosti", "SV.IdSpecVrednostiIme","SV.OpisSpecVrednosti");
        $cols = Array("SV.IdSpecVrednosti", "SVN.SpecVredNaziv");
        $db->join("specvrednaziv SVN", "SVN.IdSpecVrednosti = SV.IdSpecVrednosti AND SVN.IdLanguage = $jezikId");
        $db->where("SV.IdSpecVrednostiGrupe", $IdSpecGrupeKat);
        $db->orderBy('SpecVredNaziv', "ASC");
        $spacgrupeVred = $db->get("specvrednosti SV", null, $cols);
        if ($db->count > 0) {
            $sg .= '<ul>';
            foreach ($spacgrupeVred as $ky => $vsvred) {
                $IdSpecVrednostiVre = $vsvred['IdSpecVrednosti'];
                $IdSpecVrednostiImeVre = $vsvred['SpecVredNaziv'];

                $osv = ($IdSpecVrednostiImeVre) ? '<span class="pull-right"><a href="#" title="' . $IdSpecVrednostiImeVre . '"></a></span>' : '';


                $cekiram = ($_SESSION['specPodaci'][$IdSpecGrupeKat][$IdSpecVrednostiVre] == 'on') ? 'checked' : '';

                $sg .= '<li> <div class="checkbox" idKat="' . $IdSpecGrupeKat . '">';
                $sg .= '<label>';
                $sg .= '<input type="checkbox"  name="specPodaci[' . $IdSpecGrupeKat . '][' . $IdSpecVrednostiVre . ']"  ' . $cekiram . ' class="klikniSubmitSpec" data-id="' . $IdSpecVrednostiVre . '">';
                $sg .= $IdSpecVrednostiImeVre;
                $sg .= '</label>';
                $sg .= $osv;
                $sg .= '</div></li>';

            }
            $sg .= '</ul>';
        }
        $sg .= '</div>';
        $sg .= '</div>';
        $sg .= '</div>';


    }

    $sg .= '</form>';

    $sg .= '</div>
                </div>
                </div>';

    echo $sg;
}

$sg = '';
?>


