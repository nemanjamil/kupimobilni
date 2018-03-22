<!-- ============================================== SIDEMENU  ============================================== -->
<div class="side-menu">
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <!--<h1 class="section-title"><?php /*echo $KategorijaArtikalaNaziv; */ ?></h1>-->
        <?php

        $sesPodzaSpec = $_SESSION['specPodaci'];
        if ($sesPodzaSpec) {
        foreach($sesPodzaSpec as $k => $v){
            $sesPodKey[] =  $k;
             }
        } else {
            $sesPodKey = array();
        }


        $db->setTrace(true);
        $cols = Array("SG.*", "SGN.NazivSpecGrupe");
        $db->join("specifikacijagrupe SG", "SG.IdSpecGrupe = SK.IdGrupeSpecKategorija");
        $db->join("specgrupenaz SGN", "SGN.IdSpecGrupe = SG.IdSpecGrupe AND SGN.IdLanguage = $jezikId");
        $db->where("SG.SajtSpecGrupe = 0");
        $db->groupBy ("SG.IdSpecGrupe");
        $db->orderBy("SG.MestoSpecGrupe","ASC");

        $spacgrupeKat = $db->get("speckategorija SK", null, $cols);


        if ($db->count > 0) {

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




                $uptOZ = ($OtvZarvSpecGrupe || in_array($IdSpecGrupeKat,$sesPodKey)) ? 'aria-expanded="true"' : 'class="collapsed" aria-expanded="false" ';

                $sg .= '<a  '.$uptOZ.' data-toggle="collapse" data-parent="#accordion" href="#collapseOne' . $IdSpecGrupeKat . '"  aria-controls="collapseOne' . $IdSpecGrupeKat . '">' . $ImeSpecGrupeKat . '</a>';

                $sg .= '</h4>';
                $sg .= '</div>';


                // otvoreno class="panel-collapse collapse in"   i aria-expanded="true"
                // zatvoreno aria-expanded="false" i  class="panel-collapse collapse"
                $uptOZ = ($OtvZarvSpecGrupe || in_array($IdSpecGrupeKat,$sesPodKey)) ? 'class="panel-collapse collapse in" aria-expanded="true"' : 'aria-expanded="false" class="panel-collapse collapse"';

                $sg .= '<div '.$uptOZ.' id="collapseOne' . $IdSpecGrupeKat . '"  role="tabpanel" aria-labelledby="headingOne' . $IdSpecGrupeKat . '">';
                //$sg .= '<div style="height: 0px;" aria-expanded="false" id="collapseOne"                        class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">';
                //$sg .= '<div style="" aria-expanded="true" id="collapseThree" class="panel-collapse collapse in" role="tabpanel"  aria-labelledby="headingThree">
                $sg .= '<div class="panel-body">';


                //$cols = Array("SV.IdSpecVrednosti", "SV.IdSpecVrednostiIme","SV.OpisSpecVrednosti");
                $cols = Array("SV.*", "SVN.SpecVredNaziv");
                $db->where("SV.IdSpecVrednostiGrupe", $IdSpecGrupeKat);
                $db->join("specvrednaziv SVN", "SVN.IdSpecVrednosti = SV.IdSpecVrednosti AND SVN.IdLanguage = $jezikId ", "LEFT");
                //$db->orderBy('Vre'.$jezik, "ASC");
                $spacgrupeVred = $db->get("specvrednosti SV", null, $cols);


                if ($db->count > 0) {
                    $sg .= '<ul>';
                    foreach ($spacgrupeVred as $ky => $vsvred) {
                        $IdSpecVrednostiVre = $vsvred['IdSpecVrednosti'];
                        $IdSpecVrednostiImeVre = $vsvred['SpecVredNaziv'];

                        $osv = ($IdSpecVrednostiImeVre) ? '<span class="pull-right"><a href="#" title="'.$IdSpecVrednostiImeVre.'"></a></span>' : '';


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
            echo $sg;
        }

        $sg = '';
        ?>
        <!-- /.panel -->
        <!--<div class="panel panel-default wow fadeIn" data-wow-delay="0.2s">
			<div class="panel-heading" role="tab" id="headingTwo">
				<h4 class="panel-title">
					<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
						Men
					</a>
				</h4>
			</div>
			<div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
				<div class="panel-body">
					<?php /*require RB_ROOT.'/parts/widgets/sidebar/sidebar-category-items.php' */ ?>
				</div>
			</div>
		</div>-->


    </div>
    <!-- /.panel-group -->
</div><!-- side-menu" -->
<!-- ============================================== SIDEMENU : END ============================================== -->