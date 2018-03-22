<?php
//$co = Array("SG.IdSpecGrupe","SG.ImeSpecGrupe");
$co = Array("SG.IdSpecGrupe","SGN.NazivSpecGrupe");
$db->join("specifikacijagrupe SG", "SG.IdSpecGrupe = SAP.IdSpecArtikalGrupaPove");
$db->join("specgrupenaz SGN", "SGN.IdSpecGrupe = SG.IdSpecGrupe AND SGN.IdLanguage = $jezikId");
$db->where("SAP.IdSpecArtikalPov", $ArtikalId);
$specGrupe = $db->get("specartikalpov SAP", null, $co);
if ($specGrupe) { ?>

            <?php
            $sd = '';
            $sd .= '<ul class="font10">';
            foreach ($specGrupe as $k => $v):
                $IdSpecGrupe = $v['IdSpecGrupe'];
                $ImeSpecGrupe = $v['NazivSpecGrupe'];

                // $co = Array("SV.IdSpecVrednosti","SV.IdSpecVrednostiIme");
                $co = Array("SV.IdSpecVrednosti","SVN.SpecVredNaziv");
                $db->join("specvrednosti SV", "SV.IdSpecVrednosti = SAP.IdSpecArtikalPovIme");
                $db->join("specvrednaziv SVN", "SVN.IdSpecVrednosti = SV.IdSpecVrednosti AND SVN.IdLanguage = $jezikId");
                $db->where("SAP.IdSpecArtikalPov", $ArtikalId);
                $db->where("SAP.IdSpecArtikalGrupaPove", $IdSpecGrupe);
                $specGrupeVre = $db->getOne("specartikalpov SAP", null, $co);

                $sd .= '<li>';
                $sd .= '<span>' . $ImeSpecGrupe . '</span>';
                $sd .= '<span> => </span>';
                $sd .= '<span class="text-danger">' . $specGrupeVre['SpecVredNaziv'] . '</span>';
                $sd .= '</li>';

            endforeach;
            $sd .= '</ul>';

            echo $sd;

            ?>

<?php } ?>