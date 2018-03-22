<?php
$sec = array();
$spcGrp = '';


$co = Array("SG.IdSpecGrupe", "SGN.NazivSpecGrupe");
$db->join("specifikacijagrupe SG", "SG.IdSpecGrupe = SAP.IdSpecArtikalGrupaPove");
$db->join("specgrupenaz SGN", "SGN.IdSpecGrupe = SG.IdSpecGrupe AND SGN.IdLanguage = $jezikId");
$db->where("SAP.IdSpecArtikalPov", $ArtikalIdSmall);
$specGrupe = $db->get("specartikalpov SAP", null, $co);
if ($specGrupe) {

    foreach ($specGrupe as $k => $v):
        $IdSpecGrupe = $v['IdSpecGrupe'];
        $ImeSpecGrupe = $v['NazivSpecGrupe'];

        // $co = Array("SV.IdSpecVrednosti","SV.IdSpecVrednostiIme");
        $co = Array("SV.imeSpecGrupe", "SV.IdSpecVrednosti", "SVN.SpecVredNaziv");
        $db->join("specvrednosti SV", "SV.IdSpecVrednosti = SAP.IdSpecArtikalPovIme");
        $db->join("specvrednaziv SVN", "SVN.IdSpecVrednosti = SV.IdSpecVrednosti AND SVN.IdLanguage = $jezikId");
        $db->where("SAP.IdSpecArtikalPov", $ArtikalIdSmall);
        $db->where("SAP.IdSpecArtikalGrupaPove", $IdSpecGrupe);
        $specGrupeVre = $db->getOne("specartikalpov SAP", null, $co);

        $spcGrp['ImeSpecGrupe'] = $ImeSpecGrupe;
        $spcGrp['IdSpecGrupe'] = $IdSpecGrupe;
        $spcGrp['VredSpecGrupe'] = $specGrupeVre['SpecVredNaziv'];
        $spcGrp['IdSpecVrednosti'] = $specGrupeVre['IdSpecVrednosti'];


        array_push($sec, $spcGrp);

    endforeach;

} ?>


<?php
/*$sec = array();
$spcGrp = '';

$cols = Array("SG.IdSpecGrupe","SGN.NazivSpecGrupe");
$db->join("specifikacijagrupe SG", "SG.IdSpecGrupe = SK.IdGrupeSpecKategorija");
$db->join("specgrupenaz SGN", "SGN.IdSpecGrupe = SG.IdSpecGrupe AND SGN.IdLanguage = $jezikId");
$db->where("SK.IdSpecKategorija", $id);
$db->orderBy("SG.MestoSpecGrupe","ASC");
$specGrupe = $db->get("speckategorija SK", null, $cols);



if ($specGrupe) {

    foreach ($specGrupe as $k => $v):
        $IdSpecGrupe = $v['IdSpecGrupe'];
        $ImeSpecGrupe = $v['NazivSpecGrupe'];


        $co = Array("SV.IdSpecVrednosti","SVN.SpecVredNaziv");
        $db->join("specvrednosti SV", "SV.IdSpecVrednosti = SAP.IdSpecArtikalPovIme");
        $db->join("specvrednaziv SVN", "SVN.IdSpecVrednosti = SV.IdSpecVrednosti AND SVN.IdLanguage = $jezikId");
        $db->where("SAP.IdSpecArtikalPov", $ArtikalIdSmall);
        $db->where("SAP.IdSpecArtikalGrupaPove", $IdSpecGrupe);
        $specGrupeVre = $db->getOne("specartikalpov SAP", null, $co);


        $spcGrp['imeSpecGrupe'] = $ImeSpecGrupe;
        $spcGrp['vredSpecGrupe'] = $specGrupeVre['SpecVredNaziv'];
        $spcGrp['IdSpecVrednosti'] = $specGrupeVre['IdSpecVrednosti'];

        array_push($sec, $spcGrp);

    endforeach;

}*/
?>
