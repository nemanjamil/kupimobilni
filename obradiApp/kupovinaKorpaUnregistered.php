<?php
$m['success'] = true;


require('podaciUnregistrated.php');

require "snimiTxt.php";



if ($email) {


    /* Proveravamo valutu */

    $valutasessionUpper = strtoupper($valutasession);

    $cols = Array("ValutaId");
    $db->where("ValutaValuta", $valutasession);
    $valup = $db->getOne("valuta", null, $cols);

    $valutaId = $valup['ValutaId'];

    if (!$valutaId) {
        $m['tag'] = 'kupovinaKorpaUnregistered';
        $m['success'] = false;
        $m['error'] = 8;
        $m['error_msg'] = "Nema ID od valute";
        echo json_encode($m, JSON_UNESCAPED_UNICODE);
        die;
    }

    /* KRAJ  Proveravamo valutu */

    require('kupiArtikalOkAppUnreg.php');


} else {

    $m['tag'] = 'kupovinaKorpaUnregistered';
    $m['success'] = false;
    $m['error'] = 10;
    $m['error_msg'] = "Nema email";
    echo json_encode($m, JSON_UNESCAPED_UNICODE);
    die;

}

echo $json = json_encode($m, JSON_UNESCAPED_UNICODE);

?>