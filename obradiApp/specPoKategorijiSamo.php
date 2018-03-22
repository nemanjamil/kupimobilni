<?php

if (!$id) {

    $m['tag'] = 'specPoKategoriji';
    $m['success'] = false;
    $m['error'] = 1;
    $m['error_msg'] = "Nema Id specPoKategoriji";
    echo json_encode($m, JSON_UNESCAPED_UNICODE);
    die;
}


$specPoKategArr = array();

$co = Array("SG.IdSpecGrupe", "SGN.NazivSpecGrupe","SG.OtvZarvSpecGrupe");
$db->join("specifikacijagrupe SG", "SG.IdSpecGrupe = SK.IdGrupeSpecKategorija");
$db->join("specgrupenaz SGN", "SGN.IdSpecGrupe = SG.IdSpecGrupe AND SGN.IdLanguage = $jezikId");
$db->where("SK.IdSpecKategorija", $id);
$db->orderBy("SG.MestoSpecGrupe", "ASC");
$spacgrupeKat = $db->get("speckategorija SK", null, $cols);

if ($db->count > 0) {


    foreach ($spacgrupeKat as $ky => $vspk) {

        $IdSpecGrupeKat = $vspk['IdSpecGrupe'];
        $ImeSpecGrupeKat = $vspk['NazivSpecGrupe'];
        $OtvZarvSpecGrupe = $vspk['OtvZarvSpecGrupe'];

        $spcK['IdSpecGrupe'] = $IdSpecGrupeKat;
        $spcK['Grupe'] = $ImeSpecGrupeKat;
        $spcK['OtvZarvSpecGrupe'] = $OtvZarvSpecGrupe;


        $spcK['detalj'] = '';


        $co = Array("SV.imeSpecGrupe", "SV.IdSpecVrednosti", "SVN.SpecVredNaziv");
        $db->join("specvrednaziv SVN", "SVN.IdSpecVrednosti = SV.IdSpecVrednosti AND SVN.IdLanguage = $jezikId");
        $db->where("SV.IdSpecVrednostiGrupe", $IdSpecGrupeKat);
        $db->orderBy('SpecVredNaziv', "ASC");
        $spacgrupeVred = $db->get("specvrednosti SV", null, $cols);
        if ($db->count > 0) {
            $sg .= '<ul>';
            foreach ($spacgrupeVred as $ky => $vsvred) {
                $IdSpecVrednostiVre = $vsvred['IdSpecVrednosti'];
                $IdSpecVrednostiImeVre = $vsvred['SpecVredNaziv'];


                $spcKdet['IdSpecVrednostiVre'] = $IdSpecVrednostiVre;
                $spcKdet['IdSpecVrednostiImeVre'] = $IdSpecVrednostiImeVre;


                $spcK['detalj'][] = $spcKdet;


            }

        }

        array_push($specPoKategArr, $spcK);


    }


    $m['tag'] = 'specPoKategoriji';
    $m['success'] = true;
    $m['error'] = 0;
    $m['error_msg'] = "Nema Errora";
    $m['spec'] = $specPoKategArr;
    echo json_encode($m, JSON_UNESCAPED_UNICODE);
    die;

} else {

    $m['tag'] = 'specPoKategoriji';
    $m['success'] = false;
    $m['error'] = 2;
    $m['error_msg'] = "Nema Specifikacije";
    echo json_encode($m, JSON_UNESCAPED_UNICODE);
    die;
}
?>
