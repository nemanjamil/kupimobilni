<?php

$data = Array("idSenzorSifra" => $idSifra,
    "vredSenzor" => $vrednostPodatak
);
$idSenzorPodatak = $db->insert('senzorvlaznosti', $data);

if (!$idSenzorPodatak) {
    $o['tag'] = 'idSenzorVazduha';
    $o['success'] = false;
    $o['error'] = 1;
    $o['error_msg'] =  "Nije upucana ".$opisSenzora;
    $o['error_podaci'] =  "Id -> ".$idSifra." ; Vrednost ".$vrednostPodatak;
    $o['error_msg_opis'] =  $db->getLastError();
    echo json_encode($o,JSON_UNESCAPED_UNICODE);
    die;
}


$tipSenzora = 1; // vlaznost vazduha
$tipBaga = (!$idSenzorPodatak) ? 1 : 0;

require "obradiFor.php";

?>