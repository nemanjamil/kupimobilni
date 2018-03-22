<?php
$data = Array("idSenzorSifra" => $idSifra,
    "vredSenzor" => $vrednostPodatak
);
$idSenzorPodatak = $db->insert('senzortemp', $data);

if (!$idSenzorPodatak) {
    $o['tag'] = 'idSenzorTemp';
    $o['success'] = false;
    $o['error'] = 2;
    $o['error_msg'] =  "Nije upucana ".$opisSenzora;
    $o['error_podaci'] =  "Id -> ".$idSifra." ; Vrednost ".$vrednostPodatak;
    $o['error_msg_opis'] =  $db->getLastError();
    echo json_encode($o,JSON_UNESCAPED_UNICODE);
    die;
}



$tipSenzora = 2; // temperatura
$tipBaga = (!$idSenzorPodatak) ? 1 : 0;

require "obradiFor.php";

?>


