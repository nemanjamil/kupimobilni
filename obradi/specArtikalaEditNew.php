<?php

if (isset($_POST['spec'])) {

    $db->where('IdSpecArtikalPov', $idUbacenogart);
    if($db->delete('specartikalpov')) {
        $error_msg .= 'Obrisane su specifikacije - ';
    } else {
        $error_msg .= 'Nije obrisao spacifikacije - ';
    }

    foreach ($_POST['spec'] AS $key => $value) {

        // sada proveravamo koji $value pripada kategoriji
        $cols = Array("IdSpecVrednostiGrupe");
        $db->where('IdSpecVrednosti', $value);
        $kojaJekategArr = $db->getOne("specvrednosti", null, $cols);
        $kojaJekateg = $kojaJekategArr['IdSpecVrednostiGrupe'];

        // ako ima id specifikacije Grupe onda dodajemo specifikaciju za dati artikal
        if ($kojaJekateg) {
            $insert_querySpec = Array(
                'IdSpecArtikalPov' => $idUbacenogart,
                'IdSpecArtikalPovIme' => $value,
                'IdSpecArtikalGrupaPove' => $kojaJekateg
            );
            $db->setQueryOption(Array('IGNORE'));
            $idArtSpec = $db->insert('specartikalpov', $insert_querySpec);
        }
    }
}

?>

