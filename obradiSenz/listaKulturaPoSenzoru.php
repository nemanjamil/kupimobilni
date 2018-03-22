<?php
if(isset($_POST['id'])) {  $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT); } else { $id = ''; }

if (!$id) {
    $o['tag'] = 'listaKulturaPoSenzoru';
    $o['success'] = false;
    $o['error'] = 1;  // stavio sam svuda 1
    $o['error_msg'] =  "No Id Senzora";
    echo json_encode($o,JSON_UNESCAPED_UNICODE);
    die;
}

$colone = array("K.IdKulture","K.ImeKulture","K.SlikaKulture","KZ.KomitentId");
$db->join("kulture K", "K.IdKulture = KZ.IdKulture");
$db->where("KZ.IdListaSenzora",$id);
$data = $db->get("kulturasenzor KZ", null, $colone);

if ($db->count > 0) {

    $o['tag'] = 'listaKulturaPoSenzoru';
    $o['success'] = true;
    $o['error'] = 0;
    $o['error_msg'] =  "Ima podataka";

    foreach ($data as $sds => $link) {
        $IdKulture = $link['IdKulture'];
        $ImeKulture = $link['ImeKulture'];
        $SlikaKulture = $link['SlikaKulture'];
        $IdListaSenzora = $link['$id'];


        $slika = $common->locationslikaOstalo(KULTURESLIKELOK, $IdKulture);

        $ext = pathinfo($SlikaKulture, PATHINFO_EXTENSION);
        $fileName = pathinfo($SlikaKulture, PATHINFO_FILENAME);

        $mala_slika = $fileName . '.' . $ext;
        $lokSajtVar = $slika . '/' . $mala_slika;
        $lok = $common->nemaSlikeMala($lokSajtVar);
        $lokSajtHttp = DPROOT . $lok;

        $m['IdKulture'] = $IdKulture;
        $m['ImeKulture'] = $ImeKulture;
        $m['IdListaSenzora'] = $id;
        $m['slikaKulture'] = $lokSajtHttp;
        $m['KomitentId'] = $KomitentId;

        $r[] = $m;
    }

    $o['podaci'] = $r;



} else {

    $o['tag'] = 'listaKulturaPoSenzoru';
    $o['success'] = false;
    $o['error'] = 2;
    $o['error_msg'] =  "Nema povezanih kultura za dati senzor";

}


echo json_encode($o,JSON_UNESCAPED_UNICODE);



?>
