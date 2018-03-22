<?php

if (!$id) {
    $o['tag'] = 'dodajsenzor';
    $o['success'] = false;
    $o['error'] = 3;  // stavio sam svuda 1
    $o['error_msg'] =  "Nema ID";
    echo json_encode($o,JSON_UNESCAPED_UNICODE);
    die;
}

if (!$string) {
    $o['tag'] = 'dodajsenzor';
    $o['success'] = false;
    $o['error'] = 4;  // stavio sam svuda 1
    $o['error_msg'] =  "Nema string";
    echo json_encode($o,JSON_UNESCAPED_UNICODE);
    die;
}


$cols = Array("LS.IdListaSenzora");
$db->where("LS.SenzorSifra", $string);
$db->where("LS.PripadaKomitentu", $id);
$link = $db->get("listasenzora LS", null, $cols);
$daliImauLS = $link[0]['IdListaSenzora'];

if ($daliImauLS) {


    $db->where('SenzorZaArtikal', $daliImauLS);
    if($db->delete('senzorizaartikal')) {
        $o['obrisaniIzArtikala'] = 1;
    } else {
        $o['obrisaniIzArtikala'] = 0;
    }


    // brisemo sve senzore$
    $db->setTrace(true);
    $db->where('SenzorSifra', $string);
    $db->where('PripadaKomitentu', $id);
    if($db->delete('listasenzora')) {

        $o['tag'] = 'obrisiSenzor';
        $o['success'] = true;
        $o['error'] = 0;  // stavio sam svuda 1
        $o['error_msg'] =  "Obrisan senzor";


    } else {
        $o['tag'] = 'obrisiSenzor';
        $o['success'] = false;
        $o['error'] = 2;  // stavio sam svuda 1
        $o['error_msg'] =  "Nije uspesno obrisan senzor";
    }


} else {

    $o['tag'] = 'obrisiSenzor';
    $o['success'] = false;
    $o['error'] = 1;  // stavio sam svuda 1
    $o['error_msg'] =  "Nema datog senzora koji pripada komitentu";

}

echo json_encode($o,JSON_UNESCAPED_UNICODE);

?>