<?php
if(isset($_POST['id'])) {  $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT); } else { $id = ''; }

if (!$id) {
    $o['tag'] = 'listaSenzoraPoKomitentu';
    $o['success'] = false;
    $o['error'] = 1;  // stavio sam svuda 1
    $o['error_msg'] =  "No Id Komitent";
    echo json_encode($o,JSON_UNESCAPED_UNICODE);
    die;
}


$db->join("komitenti KO", "KO.KomitentId = LS.KomitentId ", "LEFT");
$db->where("LS.KomitentId",$id);
$data = $db->get("listasenzora LS", null, "LS.IdListaSenzora, LS.SenzorSifra, KO.KomitentIme, KO.KomitentPrezime");

if ($db->count > 0) {

    $o['tag'] = 'listaSenzoraPoKomitentu';
    $o['success'] = true;
    $o['error'] = 0;
    $o['error_msg'] =  "Ima podataka";

    foreach ($data as $sds => $link) {
        $IdListaSenzora = $link['IdListaSenzora'];
        $SenzorSifra = $link['SenzorSifra'];
        $KomitentIme = $link['KomitentIme'];
        $KomitentPrezime = $link['KomitentPrezime'];

        $m['IdListaSenzora'] = $IdListaSenzora;
        $m['SenzorSifra'] = $SenzorSifra;
        $m['KomitentIme'] = $KomitentIme;
        $m['KomitentPrezime'] = $KomitentPrezime;
        $m['KomitentId'] = $id;

        $r[] = $m;
    }

    $o['podaci'] = $r;



} else {

    $o['tag'] = 'listaSenzoraPoKomitentu';
    $o['success'] = false;
    $o['error'] = 2;
    $o['error_msg'] =  "Nema Senzora za datog komitenta";

}


echo json_encode($o,JSON_UNESCAPED_UNICODE);



?>
